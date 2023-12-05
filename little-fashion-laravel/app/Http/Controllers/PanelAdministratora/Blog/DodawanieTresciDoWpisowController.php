<?php

namespace App\Http\Controllers\PanelAdministratora\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\WpisyNaglowek;
use App\Models\Blog\WpisyParagraf;
use App\Models\Blog\WpisyZdjecia;

class DodawanieTresciDoWpisowController extends Controller
{
    public function dodajNaglowek(Request $request, $sciezkaArtykulu)
    {
        $naglowek = new WpisyNaglowek();
        $naglowek->tresc_naglowka = $request->input('tresc_naglowka');
        $naglowek->sciezka_artykulu = $sciezkaArtykulu;

        // Znajdź maksymalny numer nagłówka dla danej ścieżki artykułu
        $maxNumerNaglowka = WpisyNaglowek::where('sciezka_artykulu', $sciezkaArtykulu)->max('numer_naglowka');

        // Jeśli nie ma jeszcze nagłówków dla tej ścieżki, ustaw numer na 1, w przeciwnym razie zwiększ o 1
        $naglowek->numer_naglowka = $maxNumerNaglowka ? $maxNumerNaglowka + 1 : 1;

        $naglowek->save();

        return response()->json(['message' => 'Nagłówek dodany pomyślnie']);
    }

    public function dodajParagraf(Request $request, $sciezkaArtykulu)
    {
        $paragraf = new WpisyParagraf();
        $paragraf->tresc_paragrafu = $request->input('tresc_paragrafu');
        $paragraf->sciezka_artykulu = $sciezkaArtykulu;

        // Znajdź maksymalny numer paragrafu dla danej ścieżki artykułu
        $maxNumerParagrafu = WpisyParagraf::where('sciezka_artykulu', $sciezkaArtykulu)->max('numer_paragrafu');

        // Jeśli nie ma jeszcze paragrafów dla tej ścieżki, ustaw numer na 1, w przeciwnym razie zwiększ o 1
        $paragraf->numer_paragrafu = $maxNumerParagrafu ? $maxNumerParagrafu + 1 : 1;

        $paragraf->save();

        return response()->json(['message' => 'Paragraf dodany pomyślnie']);
    }

    public function pobierzDane($sciezkaArtykulu)
    {
        // Pobierz dane z bazy danych na podstawie ścieżki artykułu
        $naglowki = WpisyNaglowek::where('sciezka_artykulu', $sciezkaArtykulu)->get();
        $paragrafy = WpisyParagraf::where('sciezka_artykulu', $sciezkaArtykulu)->get();

        return response()->json(['naglowki' => $naglowki, 'paragrafy' => $paragrafy]);
    }

    public function pobierzZdjecia($sciezkaArtykulu)
    {
        // Pobierz dane z bazy danych na podstawie ścieżki artykułu z tabeli wpisy_zdjecia
        $zdjecie = WpisyZdjecia::where('sciezka_artykulu', $sciezkaArtykulu)->first();

        return response()->json(['zdjecie' => $zdjecie]);
    }

    public function pobierzWszystkieZdjecia()
    {
        try {
            // Pobierz wszystkie zdjęcia
            $zdjecia = WpisyZdjecia::all();

            // Sprawdź, czy znaleziono jakiekolwiek zdjęcia
            if ($zdjecia->isEmpty()) {
                return response()->json(['message' => 'Brak zdjęć'], 404);
            }

            return response()->json(['zdjecia' => $zdjecia]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Wystąpił błąd podczas pobierania zdjęć'], 500);
        }
    }
}