<?php

namespace App\Http\Controllers\PanelAdministratora\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\WpisyNaglowek;
use App\Models\Blog\WpisyParagraf;

class EdytowanieWpisowController extends Controller
{
    public function edytujNaglowek(Request $request)
    {
        // Walidacja danych wejściowych (możesz dostosować do własnych potrzeb)
        $request->validate([
            'numerNaglowka' => 'required|numeric',
            'nowyNaglowek' => 'required|string',
        ]);
    
        // Dodaj log do zobaczenia przesyłanych danych
        \Log::info('Dane wejściowe:', $request->all());
    
        // Znajdź nagłówek do aktualizacji
        $naglowek = WpisyNaglowek::where('numer_naglowka', $request->numerNaglowka)->first();
    
        // Aktualizuj nagłówek
        if ($naglowek) {
            $naglowek->tresc_naglowka = $request->nowyNaglowek;
            $naglowek->save();
    
            return response()->json(['message' => 'Nagłówek został zaktualizowany pomyślnie']);
        } else {
            return response()->json(['error' => 'Nie znaleziono nagłówka o podanym numerze']);
        }
    }

    public function edytujParagraf(Request $request)
{
    $request->validate([
        'numerParagrafu' => 'required|numeric',
        'nowyParagraf' => 'required|string',
    ]);

    \Log::info('Dane wejściowe:', $request->all());

    $paragraf = WpisyParagraf::where('numer_paragrafu', $request->numerParagrafu)->first();

    if ($paragraf) {
        $paragraf->tresc_paragrafu = $request->nowyParagraf;
        $paragraf->save();

        return response()->json(['message' => 'Paragraf został zaktualizowany pomyślnie']);
    } else {
        return response()->json(['error' => 'Nie znaleziono paragrafu o podanym numerze']);
    }
}
}
