<?php

namespace App\Http\Controllers\Sklep\AktualizacjaStanu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produkty\Produkty;

class AktualizacjaStanuController extends Controller
{
    public function zaktualizujStan(Request $request)
    {
        $quantity = $request->input('quantity');
        $products = $request->input('products');
    
        try {
            // Rozpocznij transakcję
            \DB::beginTransaction();
    
            // Aktualizuj stan magazynowy dla każdego produktu
            foreach ($products as $productData) {
                $product = Produkty::where('nazwa', $productData['product'])->firstOrFail();
                $product->decrement('stan_magazynowy', $productData['quantity']);
            }
    
            // Zakończ transakcję
            \DB::commit();
    
            return response()->json(['message' => 'Stan magazynowy zaktualizowany pomyślnie'], 200);
        } catch (\Exception $e) {
            // Wycofaj transakcję w przypadku błędu
            \DB::rollBack();
    
            // Log the exception for debugging
            \Log::error('Error updating stock: ' . $e->getMessage());
    
            return response()->json(['error' => 'Błąd podczas aktualizacji stanu magazynowego'], 500);
        }
    }
}
