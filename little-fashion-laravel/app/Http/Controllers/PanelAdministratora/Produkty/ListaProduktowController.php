<?php

namespace App\Http\Controllers\PanelAdministratora\Produkty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produkty\Produkty;

class ListaProduktowController extends Controller
{
    public function pobierzProdukty()
    {
        $products = Produkty::all();

        return response()->json(['products' => $products]);
    }

    public function pobierzProdukt($id)
    {
        $product = Produkty::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        return response()->json(['product' => $product]);
    }

    public function usunProdukt($id)
    {
        $product = Produkty::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Produkt został pomyślnie usunięty.']);
    }
}
