<?php

namespace App\Http\Controllers\PanelAdministratora\Produkty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produkty\Produkty;
use Illuminate\Support\Facades\Storage;

class EdytowanieProduktowController extends Controller
{
    public function edytujNazweProduktu(Request $request, $id)
    {
        $request->validate([
            'nowaNazwa' => 'required|string|max:255',
        ]);

        $product = Produkty::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->nazwa = $request->input('nowaNazwa');
        $product->save();

        return response()->json(['message' => 'Nazwa produktu została zaktualizowana pomyślnie.']);
    }

    public function edytujKategorieProduktu (Request $request, $id)
    {
        $request->validate([
            'nowaKategoriaProduktu' => 'required|string|max:255',
        ]);

        $product = Produkty::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->kategoria = $request->input('nowaKategoriaProduktu');
        $product->save();

        return response()->json(['message' => 'Nazwa produktu została zaktualizowana pomyślnie.']);
    }

    public function edytujCeneProduktu (Request $request, $id)
    {
        $request->validate([
            'nowaCenaProduktu' => 'required|string|max:255',
        ]);

        $product = Produkty::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->cena = $request->input('nowaCenaProduktu');
        $product->save();

        return response()->json(['message' => 'Nazwa produktu została zaktualizowana pomyślnie.']);
    }

    public function edytujCenePromocyjnaProduktu (Request $request, $id)
    {
        $request->validate([
            'nowaCenaPromocyjnaProduktu' => 'required|string|max:255',
        ]);

        $product = Produkty::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->cena_promocyjna = $request->input('nowaCenaPromocyjnaProduktu');
        $product->save();

        return response()->json(['message' => 'Nazwa produktu została zaktualizowana pomyślnie.']);
    }

    public function edytujStanMagazynowyProduktu (Request $request, $id)
    {
        $request->validate([
            'nowyStanMagazynowyProduktu' => 'required|string|max:255',
        ]);

        $product = Produkty::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->stan_magazynowy = $request->input('nowyStanMagazynowyProduktu');
        $product->save();

        return response()->json(['message' => 'Nazwa produktu została zaktualizowana pomyślnie.']);
    }
    
    public function edytujPierwszeZdjecie(Request $request, $id)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = Produkty::find($id);

    if (!$product) {
        return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
    }

    // Sprawdź, czy produkt ma już przypisane zdjęcie i usuń je
    if (!empty($product->zdjecie_produktu_1)) {
        $oldImagePath = public_path('zdjecia-produktow/' . $id . '/' . $product->zdjecie_produktu_1);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
    }

    $image = $request->file('image');
    
    // Zawsze nadawaj nazwę "1" nowemu zdjęciu
    $imageName = '1.' . $image->getClientOriginalExtension();
    
    $image->move(public_path('zdjecia-produktow/' . $id), $imageName);

    // Dodaj do modelu Produkty pole przechowujące pełną ścieżkę URL dla nowego zdjęcia
    $imageUrl = url('zdjecia-produktow/' . $id . '/' . $imageName);
    $product->zdjecie_produktu_1 = $imageUrl;
    $product->save();

    return response()->json(['message' => 'Zdjęcie produktu zostało dodane pomyślnie.', 'image_url' => $imageUrl]);
}

public function edytujDrugieZdjecie(Request $request, $id)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = Produkty::find($id);

    if (!$product) {
        return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
    }

    // Sprawdź, czy produkt ma już przypisane zdjęcie i usuń je
    if (!empty($product->zdjecie_produktu_2)) {
        $oldImagePath = public_path('zdjecia-produktow/' . $id . '/' . $product->zdjecie_produktu_2);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
    }

    $image = $request->file('image');
    
    // Zawsze nadawaj nazwę "1" nowemu zdjęciu
    $imageName = '2.' . $image->getClientOriginalExtension();
    
    $image->move(public_path('zdjecia-produktow/' . $id), $imageName);

    // Dodaj do modelu Produkty pole przechowujące pełną ścieżkę URL dla nowego zdjęcia
    $imageUrl = url('zdjecia-produktow/' . $id . '/' . $imageName);
    $product->zdjecie_produktu_2 = $imageUrl;
    $product->save();

    return response()->json(['message' => 'Zdjęcie produktu zostało dodane pomyślnie.', 'image_url' => $imageUrl]);
}

public function edytujTrzecieZdjecie(Request $request, $id)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = Produkty::find($id);

    if (!$product) {
        return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
    }

    // Sprawdź, czy produkt ma już przypisane zdjęcie i usuń je
    if (!empty($product->zdjecie_produktu_3)) {
        $oldImagePath = public_path('zdjecia-produktow/' . $id . '/' . $product->zdjecie_produktu_3);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
    }

    $image = $request->file('image');
    
    // Zawsze nadawaj nazwę "1" nowemu zdjęciu
    $imageName = '3.' . $image->getClientOriginalExtension();
    
    $image->move(public_path('zdjecia-produktow/' . $id), $imageName);

    // Dodaj do modelu Produkty pole przechowujące pełną ścieżkę URL dla nowego zdjęcia
    $imageUrl = url('zdjecia-produktow/' . $id . '/' . $imageName);
    $product->zdjecie_produktu_3 = $imageUrl;
    $product->save();

    return response()->json(['message' => 'Zdjęcie produktu zostało dodane pomyślnie.', 'image_url' => $imageUrl]);
}

}
