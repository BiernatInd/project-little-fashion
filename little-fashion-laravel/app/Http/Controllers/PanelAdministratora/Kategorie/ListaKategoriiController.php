<?php

namespace App\Http\Controllers\PanelAdministratora\Kategorie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategorie\KategorieProduktow;

class ListaKategoriiController extends Controller
{
    public function pobierzListeKategorii()
    {
        $kategorie = KategorieProduktow::all();

        return response()->json(['kategorie' => $kategorie]);
    }

    public function pobierzKategorie($id)
    {
        $kategorie = KategorieProduktow::find($id);
    
        if (!$kategorie) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }
    
        return response()->json(['kategorie' => $kategorie]);
    }

    public function usunKategorie($id)
    {
        $kategorie = KategorieProduktow::find($id);

        if (!$kategorie) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $kategorie->delete();

        return response()->json(['message' => 'Produkt został pomyślnie usunięty.']);
    }
    
}
