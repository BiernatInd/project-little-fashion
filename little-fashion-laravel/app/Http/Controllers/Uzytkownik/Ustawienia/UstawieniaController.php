<?php

namespace App\Http\Controllers\Uzytkownik\Ustawienia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UstawieniaController extends Controller
{
    public function pobierzUzytkownika() {
        $uzytkownicy = User::where('role', 'user')->get();
        return response()->json(['uzytkownicy' => $uzytkownicy]);
    }

    public function zmienEmailUzytkownika(Request $request, $id)
    {
        // Walidacja żądania
        $request->validate([
            'nowy_email' => 'required|email',
            'haslo' => 'required',
        ]);

        // Znajdź administratora
        $uzytkownik = User::findOrFail($id);

        // Sprawdź poprawność hasła
        if (!Hash::check($request->haslo, $uzytkownik->password)) {
            return response()->json(['error' => 'Nieprawidłowe hasło'], 401);
        }

        // Zmiana adresu e-mail
        $uzytkownik->email = $request->nowy_email;
        $uzytkownik->save();

        return response()->json(['message' => 'Adres e-mail został pomyślnie zmieniony']);
    }

    public function usunUzytkownika($id)
    {
        // Znajdź użytkownika do usunięcia
        $uzytkownik = User::findOrFail($id);

        // Usuń użytkownika
        $uzytkownik->delete();

        return response()->json(['message' => 'Konto zostało pomyślnie usunięte']);
    }
}
