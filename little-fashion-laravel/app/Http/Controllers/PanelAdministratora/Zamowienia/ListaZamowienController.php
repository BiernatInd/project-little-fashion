<?php

namespace App\Http\Controllers\PanelAdministratora\Zamowienia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zamowienia\ZamowieniaFirma;
use App\Models\Zamowienia\ZamowieniaOsobaPrywatna;

class ListaZamowienController extends Controller
{
    public function pobierzListeZamowien()
    {
        $ordersFirma = ZamowieniaFirma::all();
        $ordersOsobaPrywatna = ZamowieniaOsobaPrywatna::all();

        return response()->json(['ordersFirma' => $ordersFirma, 'ordersOsobaPrywatna' => $ordersOsobaPrywatna]);
    }

    public function pobierzSzczegolyZamowienia($numerZamowienia)
    {
        $orderFirma = ZamowieniaFirma::where('numer_zamowienia', 'LIKE', '%' . $numerZamowienia . '%')->first();
        $orderOsobaPrywatna = ZamowieniaOsobaPrywatna::where('numer_zamowienia', 'LIKE', '%' . $numerZamowienia . '%')->first();
    
        if ($orderFirma) {
            $orderFirma['typ_zamowienia'] = 'firma';
            return response()->json(['order' => $orderFirma]);
        } elseif ($orderOsobaPrywatna) {
            $orderOsobaPrywatna['typ_zamowienia'] = 'osoba_prywatna';
            return response()->json(['order' => $orderOsobaPrywatna]);
        } else {
            return response()->json(['message' => 'Zamówienie o podanym numerze nie zostało znalezione.']);
        }
    }
    
    public function aktualizujStatusZamowienia(Request $request, $numerZamowienia)
    {
        try {
            $validatedData = $request->validate([
                'nowy_status' => 'required|in:Zrealizowano,Opłacono,Nie opłacono',
            ]);

            $orderFirma = ZamowieniaFirma::where('numer_zamowienia', 'LIKE', '%' . $numerZamowienia . '%')->first();
            $orderOsobaPrywatna = ZamowieniaOsobaPrywatna::where('numer_zamowienia', 'LIKE', '%' . $numerZamowienia . '%')->first();

            if ($orderFirma) {
                $orderFirma->update(['status_zamowienia' => $validatedData['nowy_status']]);
                return response()->json(['message' => 'Status zamówienia zaktualizowany pomyślnie']);
            } elseif ($orderOsobaPrywatna) {
                $orderOsobaPrywatna->update(['status_zamowienia' => $validatedData['nowy_status']]);
                return response()->json(['message' => 'Status zamówienia zaktualizowany pomyślnie']);
            } else {
                return response()->json(['message' => 'Zamówienie o podanym numerze nie zostało znalezione.'], 404);
            }
        } catch (\Exception $e) {
            \Log::error('Błąd aktualizacji statusu zamówienia: ' . $e->getMessage());
            return response()->json(['error' => 'Wystąpił błąd podczas aktualizacji statusu zamówienia. Sprawdź logi dla więcej informacji.'], 500);
        }
    }

    public function usunZamowienie($numerZamowienia)
    {
        try {
            $orderFirma = ZamowieniaFirma::where('numer_zamowienia', 'LIKE', '%' . $numerZamowienia . '%')->first();
            $orderOsobaPrywatna = ZamowieniaOsobaPrywatna::where('numer_zamowienia', 'LIKE', '%' . $numerZamowienia . '%')->first();

            if ($orderFirma) {
                $orderFirma->delete();
                return response()->json(['message' => 'Zamówienie usunięte pomyślnie']);
            } elseif ($orderOsobaPrywatna) {
                $orderOsobaPrywatna->delete();
                return response()->json(['message' => 'Zamówienie usunięte pomyślnie']);
            } else {
                return response()->json(['message' => 'Zamówienie o podanym numerze nie zostało znalezione.'], 404);
            }
        } catch (\Exception $e) {
            \Log::error('Błąd usuwania zamówienia: ' . $e->getMessage());
            return response()->json(['error' => 'Wystąpił błąd podczas usuwania zamówienia. Sprawdź logi dla więcej informacji.'], 500);
        }
    }
}
