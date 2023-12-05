<?php

namespace App\Http\Controllers\PanelAdministratora\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\ListaWpisow;
use Illuminate\Support\Facades\Log;
use App\Models\Blog\WpisyZdjecia;
use App\Models\Blog\WpisyNaglowek;
use App\Models\Blog\WpisyParagraf;

class ListaWpisowController extends Controller
{
    public function pobierzListeWpisow()
    {
        $entries = ListaWpisow::all();
        return response()->json(['entries' => $entries]);
    }

    public function pobierzWpisPoSciezce($sciezkaArtykulu)
    {
        $entry = ListaWpisow::where('sciezka_artykulu', $sciezkaArtykulu)->first();

        if ($entry) {
            return response()->json(['entry' => $entry]);
        } else {
            return response()->json(['message' => 'Wpis o podanej ścieżce nie został znaleziony.'], 404);
        }
    }

    public function usunWpis($sciezkaArtykulu)
    {
        $entry = ListaWpisow::where('sciezka_artykulu', $sciezkaArtykulu)->first();

        if ($entry) {
            // Delete associated records in wpisy_paragrafow table
            WpisyParagraf::where('sciezka_artykulu', $sciezkaArtykulu)->delete();

            // Delete associated records in wpisy_naglowkow table
            WpisyNaglowek::where('sciezka_artykulu', $sciezkaArtykulu)->delete();

            // Delete associated records in wpisy_zdjecia table
            WpisyZdjecia::where('sciezka_artykulu', $sciezkaArtykulu)->delete();

            // Finally, delete the main entry
            $entry->delete();

            return response()->json(['message' => 'Wpis i powiązane rekordy zostały usunięte pomyślnie']);
        } else {
            return response()->json(['error' => 'Nie znaleziono wpisu o podanej ścieżce']);
        }
    }
}
