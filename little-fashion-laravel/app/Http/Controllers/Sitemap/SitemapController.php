<?php

namespace App\Http\Controllers\Sitemap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\ListaWpisow;
use App\Models\Produkty\Produkty;

class SitemapController extends Controller
{
    public function generate()
    {
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('urlset');
        $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        // Dodaj statyczne ścieżki
        $staticRoutes = [
            '/blog' => 'monthly',
            '/faq' => 'monthly',
            '/galeria' => 'monthly',
            '/kontakt' => 'monthly',
            '/o-naszej-firmia' => 'monthly',
            '/odstapienie' => 'monthly',
            '/podziekowanie-za-zamowienie' => 'monthly',
            '/polityka-cookies' => 'monthly',
            '/polityka-prywatnosci' => 'monthly',
            '/regulamin' => 'monthly',
            '/sklep' => 'monthly',
            '/strona-glowna' => 'monthly',
            '/strona-koszyka' => 'monthly',
            '/strona-produktu' => 'monthly',
            '/strona-zamowienia' => 'monthly',
        ];

        foreach ($staticRoutes as $path => $changefreq) {
            $this->addUrl($xml, 'http://szambo-na-lata.pl' . $path, '2023-10-10T00:00:00+00:00', $changefreq, 0.8);
        }

        // Pobierz dynamiczne wpisy z modelu Wpisy
        $entries = ListaWpisow::all();

        // Dodaj dynamiczne strony na podstawie danych z modelu Wpisy (na końcu sitemapu)
        foreach ($entries as $entry) {
            $url = 'http://szambo-na-lata.pl/artykul/' . $entry->sciezka_artykulu;
            $lastmod = $entry->updated_at->toIso8601String();
            $this->addUrl($xml, $url, $lastmod, 'weekly', 0.6);
        }

        $products = Produkty::all();

        foreach ($products as $product) {
            $url = 'http://szambo-na-lata.pl/strona-produktu/' . $product->id;
            $lastmod = $product->updated_at->toIso8601String();
            $this->addUrl($xml, $url, $lastmod, 'weekly', 0.6);
        }

        $xml->endElement();
        $xmlContent = $xml->outputMemory();

        return response($xmlContent)->header('Content-Type', 'text/xml');
    }

    private function addUrl(\XMLWriter $xml, $loc, $lastmod, $changefreq, $priority)
    {
        $xml->startElement('url');
        $xml->writeElement('loc', $loc);
        $xml->writeElement('lastmod', $lastmod);
        $xml->writeElement('changefreq', $changefreq);
        $xml->writeElement('priority', $priority);
        $xml->endElement();
    }
}
