<?php

namespace App\Http\Controllers\Sklep\Koszyk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Koszyk\Koszyk;
use App\Models\Produkty\Produkty;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ShoppingCartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = $request->input('product');
    
        // Pobierz aktualne dane koszyka z sesji
        $cartData = Session::get('cartData', []);
    
        // Sprawdź, czy produkt o danym ID znajduje się już w koszyku
        $existingProduct = collect($cartData)->firstWhere('id', $product['id']);
    
        if ($existingProduct) {
            // Produkt już istnieje w koszyku, możesz zaktualizować ilość lub inne dane
            // Tutaj przykład zwiększenia ilości o 1
            $existingProduct['quantity'] += 1;
        } else {
            // Produkt nie istnieje w koszyku, dodaj go
            $cartData[] = $product;
        }
    
        // Zapisz zaktualizowane dane koszyka w sesji
        Session::put('cartData', $cartData);
    
        // Opcjonalnie możesz zwrócić zaktualizowane dane koszyka jako odpowiedź
        return response()->json(['cartData' => $cartData]);
    }
}
