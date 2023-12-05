<?php

namespace App\Http\Controllers\PanelAdministratora\Rabaty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rabaty\Rabaty;

class ObslugaRabatowController extends Controller
{
    public function obslugaKoduRabatowego(Request $request)
    {
        $kodRabatowy = $request->input('kod_rabatowy');
    
        // Sprawdź, czy istnieje kod rabatowy w bazie danych
        $rabat = Rabaty::where('kod_rabatowy', $kodRabatowy)->first();
    
        if ($rabat) {
            // Kod rabatowy istnieje, przekształć odpowiedź JSON z informacjami o rabacie
            return response()->json([
                'success' => true,
                'znizka' => $rabat->znizka,
            ]);
        } else {
            // Kod rabatowy nie istnieje, zwróć odpowiedź o błędzie
            return response()->json([
                'success' => false,
                'message' => '',
            ]);
        }
    }
}
