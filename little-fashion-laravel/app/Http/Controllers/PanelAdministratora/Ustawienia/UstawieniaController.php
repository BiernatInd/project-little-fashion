<?php

namespace App\Http\Controllers\PanelAdministratora\Ustawienia;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UstawieniaController extends Controller
{
    public function pobierzAdministratora() {
        $administratorzy = User::where('role', 'admin')->get();
        return response()->json(['administratorzy' => $administratorzy]);
    }

    public function zmienEmailAdministratora(Request $request, $id)
    {
        // Walidacja żądania
        $request->validate([
            'nowy_email' => 'required|email',
            'haslo' => 'required',
        ]);

        // Znajdź administratora
        $administrator = User::findOrFail($id);

        // Sprawdź poprawność hasła
        if (!Hash::check($request->haslo, $administrator->password)) {
            return response()->json(['error' => 'Nieprawidłowe hasło'], 401);
        }

        // Zmiana adresu e-mail
        $administrator->email = $request->nowy_email;
        $administrator->save();

        return response()->json(['message' => 'Adres e-mail został pomyślnie zmieniony']);
    }

    public function usunUzytkownika($id)
    {
        $uzytkownicy = User::find($id);

        if (!$uzytkownicy) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $uzytkownicy->delete();

        return response()->json(['message' => 'Produkt został pomyślnie usunięty.']);
    }

}
