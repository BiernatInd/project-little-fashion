<?php

namespace App\Http\Controllers\PanelAdministratora\Kategorie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategorie\KategorieProduktow;

class EdytowanieKategoriiController extends Controller
{
    public function edytujNazweKategorii(Request $request, $id)
    {
        $request->validate([
            'nowaNazwaKategorii' => 'required|string|max:255',
        ]);

        $kategorie = KategorieProduktow::find($id);

        if (!$kategorie) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $kategorie->nazwa_kategorii = $request->input('nowaNazwaKategorii');
        $kategorie->save();

        return response()->json(['message' => 'Nazwa produktu została zaktualizowana pomyślnie.']);
    }

    public function edytujSciezkeKategorii(Request $request, $id)
    {
        $request->validate([
            'nowaSciezkaKategorii' => 'required|string|max:255',
        ]);

        $kategorie = KategorieProduktow::find($id);

        if (!$kategorie) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $kategorie->sciezka_kategorii = $request->input('nowaSciezkaKategorii');
        $kategorie->save();

        return response()->json(['message' => 'Nazwa produktu została zaktualizowana pomyślnie.']);
    }
}
