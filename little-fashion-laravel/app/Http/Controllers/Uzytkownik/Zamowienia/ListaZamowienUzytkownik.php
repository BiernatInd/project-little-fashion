<?php

namespace App\Http\Controllers\Uzytkownik\Zamowienia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zamowienia\ZamowieniaFirma;
use App\Models\Zamowienia\ZamowieniaOsobaPrywatna;

class ListaZamowienUzytkownik extends Controller
{
    public function pobierzListeZamowien(Request $request)
    {
        try {
            $userName = $request->input('userName', '');

            // Pobierz rekordy z obu tabel
            $ordersFirma = ZamowieniaFirma::all();
            $ordersOsobaPrywatna = ZamowieniaOsobaPrywatna::all();

            // Filtruj rekordy dla danego użytkownika
            $filteredOrdersFirma = $ordersFirma->where('nazwa_uzytkownika', $userName);
            $filteredOrdersOsobaPrywatna = $ordersOsobaPrywatna->where('nazwa_uzytkownika', $userName);

            // Łącz i zwróć wyniki
            $allOrders = $filteredOrdersFirma->merge($filteredOrdersOsobaPrywatna);
            
            return response()->json($allOrders, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
}
