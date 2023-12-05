<?php

namespace App\Http\Controllers\PanelAdministratora\Odstapienie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Odstapienie\Odstapienie;
use Illuminate\Support\Str;

class OdstapienieController extends Controller
{
    public function wyslijOdstapienie(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg', // Dodaj odpowiednie rozszerzenia plików
        ]);
    
        $odstapienie = new Odstapienie;
        $odstapienie->save();
    
        // Przesyłanie pliku na serwer
        $file = $request->file('file');
        $path = "odstapienia/{$odstapienie->id}";
    
        // Generowanie losowej nazwy pliku o maksymalnej długości 10 znaków
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        
        $file->move(public_path($path), $filename);
    
        // Zapisywanie ścieżki do bazy danych
        $odstapienie->sciezka_zdjecia = "http://localhost:8000/$path/$filename";
        $odstapienie->save();
    
        return response()->json(['message' => 'Odstapienie dodane pomyślnie'], 201);
    }
    

    public function pobierzOdstapienia()
    {
        $odstapienia = Odstapienie::all();

        return response()->json(['odstapienia' => $odstapienia]);
    }

    public function pobierzOdstapienie($id)
    {
        $odstapienie = Odstapienie::find($id);

        if (!$odstapienie) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        return response()->json(['odstapienie' => $odstapienie]);
    }
}
