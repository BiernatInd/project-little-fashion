<?php

namespace App\Http\Controllers\PanelAdministratora\Rabaty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rabaty\Rabaty;

class DodawanieKodowRabatowych extends Controller
{
    public function dodajKodRabatowy(Request $request)
    {
        $request->validate([
            'kod_rabatowy' => 'required|string',
            'znizka' => 'required|integer',
        ]);

        $rabat = new Rabaty;
        $rabat->kod_rabatowy = $request->input('kod_rabatowy');
        $rabat->znizka = $request->input('znizka');

        $rabat->save();

        return response()->json(['message' => 'Rabat dodany pomyślnie'], 201);
    }
}
