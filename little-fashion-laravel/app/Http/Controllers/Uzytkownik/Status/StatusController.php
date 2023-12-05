<?php

namespace App\Http\Controllers\Uzytkownik\Status;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zamowienia\ZamowieniaFirma;
use App\Models\Zamowienia\ZamowieniaOsobaPrywatna;
use Illuminate\Support\Facades\Log;

class StatusController extends Controller
{
    public function pobierzStatusZamowienia($numerZamowienia)
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
}
