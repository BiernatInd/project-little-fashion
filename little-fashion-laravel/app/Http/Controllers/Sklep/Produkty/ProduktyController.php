<?php

namespace App\Http\Controllers\Sklep\Produkty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produkty\Produkty;

class ProduktyController extends Controller
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

}
