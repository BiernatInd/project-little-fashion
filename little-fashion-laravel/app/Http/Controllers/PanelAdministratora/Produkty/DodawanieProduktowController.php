<?php

namespace App\Http\Controllers\PanelAdministratora\Produkty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produkty\Produkty;

class DodawanieProduktowController extends Controller
{
    public function dodajProdukt(Request $request)
    {
        $request->validate([
            'nazwa' => 'required|string',
            'kategoria' => 'required|string',
            'cena' => 'required|string',
            'cena_promocyjna' => 'nullable|string',
            'stan_magazynowy' => 'required|string',
        ]);

        $produkt = new Produkty;
        $produkt->nazwa = $request->input('nazwa');
        $produkt->kategoria = $request->input('kategoria');
        $produkt->cena = $request->input('cena');
        $produkt->cena_promocyjna = $request->input('cena_promocyjna');
        $produkt->stan_magazynowy = $request->input('stan_magazynowy');

        $produkt->save();

        // Handle multiple images
        for ($i = 1; $i <= 3; $i++) {
            $inputName = "zdjecie_produktu_$i";
            if ($request->hasFile($inputName)) {
                $file = $request->file($inputName);
                $path = "zdjecia-produktow/{$produkt->id}";
                $filename = "$i." . $file->getClientOriginalExtension();

                // Store the file in the public directory
                $file->move(public_path($path), $filename);

                // Save the file path to the database
                $columnName = "zdjecie_produktu_$i";
                $produkt->$columnName = "http://localhost:8000/$path/$filename";
            }
        }

        $produkt->save();

        return response()->json(['message' => 'Produkt dodany pomyślnie'], 201);
    }
}
