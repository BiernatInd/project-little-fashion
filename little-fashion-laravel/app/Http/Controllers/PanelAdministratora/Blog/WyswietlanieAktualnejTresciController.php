<?php

namespace App\Http\Controllers\PanelAdministratora\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\WpisyZdjecia;
use App\Models\Blog\WpisyNaglowek;
use App\Models\Blog\WpisyParagraf;

class WyswietlanieAktualnejTresciController extends Controller
{
    public function pobierzSciezkeZdjecia($sciezkaArtykulu)
    {
        $zdjecie = WpisyZdjecia::where('sciezka_artykulu', $sciezkaArtykulu)->first();

        if ($zdjecie) {
            return response()->json(['sciezka_zdjecia' => $zdjecie->zdjecie_artykulu]);
        } else {
            return response()->json(['error' => 'Nie znaleziono zdjęcia dla artykułu']);
        }
    }

    public function pobierzTresci($sciezkaArtykulu)
    {
        $tresci = WpisyNaglowek::where('sciezka_artykulu', $sciezkaArtykulu)->get();
        $tresci = WpisyParagraf::where('sciezka_artykulu', $sciezkaArtykulu)->get();

        if ($tresci->isNotEmpty()) {
            return response()->json(['tresci' => $tresci]);
        } else {
            return response()->json(['error' => 'Nie znaleziono treści dla artykułu']);
        }
    }
}
