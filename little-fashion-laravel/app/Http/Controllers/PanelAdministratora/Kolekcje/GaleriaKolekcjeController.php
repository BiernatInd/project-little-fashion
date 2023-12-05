<?php

namespace App\Http\Controllers\PanelAdministratora\Kolekcje;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Kolekcje\GaleriaKolekcje;
use App\Models\Kolekcje\GaleriaTresciKolekcji;
use Illuminate\Support\Facades\Log;

class GaleriaKolekcjeController extends Controller
{
    public function dodajKolekcje(Request $request)
    {
        // Walidacja żądania
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sciezka_kolekcji' => 'required|string', // Dodaj walidację dla ścieżki kolekcji
        ]);

        $image = $request->file('file');
        $imageExtension = $image->getClientOriginalExtension();

        // Generuj unikalną nazwę pliku na podstawie daty i czasu
        $imageName = now()->format('YmdHis') . '_' . uniqid() . '.' . $imageExtension;
        $imagePath = "zdjecia-kolekcja/{$request->input('sciezka_kolekcji')}";

        // Zapisz zdjęcie na serwerze w folderze publicznym
        $image->move(public_path($imagePath), $imageName);

        // Utwórz pełną ścieżkę z adresem URL
        $fullImagePath = url("{$imagePath}/{$imageName}");

        // Dodaj ścieżkę do bazy danych
        $galeriaKolekcje = new GaleriaKolekcje([
            'zdjecie_kolekcji' => $fullImagePath,
            'sciezka_kolekcji' => $request->input('sciezka_kolekcji'),
        ]);

        $galeriaKolekcje->save();

        // Zwróć ścieżkę URL do przesyłanego pliku
        return response()->json(['url' => $fullImagePath], 200);
    }

    public function dodajZdjeciaKolekcji(Request $request)
    {
        $request->validate([
            'files.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sciezka_kolekcji' => 'required|string',
        ]);

        $uploadedImages = [];

        foreach ($request->file('files') as $image) {
            $imageExtension = $image->getClientOriginalExtension();
            $imageName = now()->format('YmdHis') . '_' . uniqid() . '.' . $imageExtension;
            $imagePath = "zdjecia-kolekcji/{$request->input('sciezka_kolekcji')}";

            $image->move(public_path($imagePath), $imageName);

            $fullImagePath = url("{$imagePath}/{$imageName}");
            $uploadedImages[] = $fullImagePath;
        }

        $sciezkaKolekcji = $request->input('sciezka_kolekcji');

        // Dodaj zdjęcia do bazy danych lub przetworz je w dowolny inny sposób.
        foreach ($uploadedImages as $fullImagePath) {
            $galeriaTresciKolekcji = new GaleriaTresciKolekcji([
                'zdjecia_kolekcji' => $fullImagePath,
                'sciezka_kolekcji' => $sciezkaKolekcji,
            ]);
            $galeriaTresciKolekcji->save();
        }

        // Możesz dodać zdjęcia do bazy danych lub przetworzyć je w dowolny inny sposób.

        return response()->json(['images' => $uploadedImages], 200);
    }

    public function pobierzDaneKolekcji()
    {
        $galerieKolekcje = GaleriaKolekcje::all();

        return response()->json($galerieKolekcje);
    }

    public function pobierzDaneTresciKolekcji(Request $request, $sciezkaKolekcji)
{
    Log::info('Wartość $sciezkaKolekcji: ' . $sciezkaKolekcji);

    // Pobierz rekordy z bazy danych na podstawie sciezka_kolekcji
    $daneTresci = GaleriaTresciKolekcji::where('sciezka_kolekcji', $sciezkaKolekcji)->get();

    // Loguj wyniki
    Log::info('Liczba rekordów: ' . $daneTresci->count());
    Log::info('Dane: ' . json_encode($daneTresci));

    // Zwróć pobrane dane w formie odpowiedzi JSON
    return response()->json($daneTresci);
}

public function usunKolekcje(Request $request, $id)
{
    // Pobierz rekord z bazy danych na podstawie identyfikatora
    $galeriaKolekcje = GaleriaKolekcje::find($id);

    if (!$galeriaKolekcje) {
        return response()->json(['message' => 'Nie znaleziono kolekcji o podanym identyfikatorze.'], 404);
    }

    // Pobierz wszystkie powiązane wpisy w tabeli GaleriaTresciKolekcji
    $daneTresci = GaleriaTresciKolekcji::where('sciezka_kolekcji', $galeriaKolekcje->sciezka_kolekcji)->get();

    // Usuń pliki ze ścieżki na serwerze dla każdego wpisu w tabeli GaleriaTresciKolekcji
    foreach ($daneTresci as $tresc) {
        $imagePath = public_path(str_replace(url('/'), '', $tresc->zdjecia_kolekcji));
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Usuń rekordy z tabeli GaleriaTresciKolekcji
    GaleriaTresciKolekcji::where('sciezka_kolekcji', $galeriaKolekcje->sciezka_kolekcji)->delete();

    // Usuń rekord z bazy danych w tabeli GaleriaKolekcje
    $galeriaKolekcje->delete();

    // Zwróć odpowiedź JSON
    return response()->json(['message' => 'Kolekcja i powiązane wpisy zostały pomyślnie usunięte.'], 200);
}


public function usunTresciKolekcji(Request $request, $id)
{
    // Pobierz rekord z bazy danych na podstawie identyfikatora
    $galeriaTresciKolekcji = GaleriaTresciKolekcji::find($id);

    if (!$galeriaTresciKolekcji) {
        return response()->json(['message' => 'Nie znaleziono wpisu o podanym identyfikatorze.'], 404);
    }

    // Usuń plik ze ścieżki na serwerze
    $imagePath = public_path(str_replace(url('/'), '', $galeriaTresciKolekcji->zdjecia_kolekcji));
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    // Usuń rekord z bazy danych
    $galeriaTresciKolekcji->delete();

    // Zwróć odpowiedź JSON
    return response()->json(['message' => 'Wpis został pomyślnie usunięty.'], 200);
}

}