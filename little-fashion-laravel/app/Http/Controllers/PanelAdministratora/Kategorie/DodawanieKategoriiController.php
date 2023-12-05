<?php

namespace App\Http\Controllers\PanelAdministratora\Kategorie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategorie\KategorieProduktow;

class DodawanieKategoriiController extends Controller
{
    public function dodajKategorie(Request $request)
    {
        $request->validate([
            'nazwa_kategorii' => 'required|string',
            'sciezka_kategorii' => 'required|string',
        ]);

        $kategorie = new KategorieProduktow;
        $kategorie->nazwa_kategorii = $request->input('nazwa_kategorii');
        $kategorie->sciezka_kategorii = $request->input('sciezka_kategorii');

        $kategorie->save();

        return response()->json(['message' => 'Produkt dodany pomyślnie'], 201);
    }
}
