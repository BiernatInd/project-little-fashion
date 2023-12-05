<?php

namespace App\Http\Controllers\PanelAdministratora\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog\WpisyZdjecia;

class DodawanieZdjeciaDoWpisu extends Controller
{
    public function dodajZdjecie(Request $request, $sciezkaArtykulu)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $imageExtension = $image->getClientOriginalExtension();

        // Generuj unikalną nazwę pliku na podstawie daty i czasu
        $imageName = now()->format('YmdHis') . '_' . uniqid() . '.' . $imageExtension;
        $imagePath = "zdjecia-blog/{$sciezkaArtykulu}";

        // Zapisz zdjęcie na serwerze w folderze publicznym
        $image->move(public_path($imagePath), $imageName);

        // Utwórz pełną ścieżkę z adresem URL
        $fullImagePath = url($imagePath . '/' . $imageName);

        // Dodaj pełną ścieżkę do kolumny zdjecie_artykulu w tabeli wpisy
        $wpis = WpisyZdjecia::create([
            'zdjecie_artykulu' => $fullImagePath,
            'sciezka_artykulu' => $sciezkaArtykulu,
        ]);

        return response()->json(['message' => 'Zdjęcie dodane pomyślnie']);
    }
    
}
