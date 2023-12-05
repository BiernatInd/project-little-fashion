<?php

namespace App\Http\Controllers\Sklep\Zamowienia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zamowienia\ZamowieniaOsobaPrywatna;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;
class ZamowieniaOsobaPrywatnaController extends Controller
{
    public function zapiszDane(Request $request)
    {
        $data = $request->validate([
            'imie' => 'required|string',
            'nazwisko' => 'required|string',
            'email' => 'required|email',
            'telefon' => 'required|string',
            'kraj' => 'required|string',
            'ulica_i_numer_domu' => 'required|string',
            'miejscowosc' => 'required|string',
            'kod_pocztowy' => 'required|string',
            'faktura_imie' => 'nullable|string',
            'faktura_nazwisko' => 'nullable|string',
            'faktura_ulica_i_numer_domu' => 'nullable|string',
            'faktura_miejscowosc' => 'nullable|string',
            'faktura_kod_pocztowy' => 'nullable|string',
            'wprowadzony_kod_promocyjny' => 'nullable|string',
            'znizka' => 'nullable|numeric',
            'dostawa' => 'required|string',
            'laczna_kwota' => 'required|numeric',
            'platnosc' => 'required|string',
            'podatek_vat' => 'required|numeric',
            'zakupione_produkty' => 'required|string',
            'numer_zamowienia' => 'required|string',
            'nazwa_uzytkownika' => 'nullable|string'
        ]);

        // Usunięcie ewentualnego JSON encoding, ponieważ zakupiono jest typu string

        $zamowienie = ZamowieniaOsobaPrywatna::create($data);

        $zamowienie->update(['status_zamowienia' => 'Nie opłacono']);
    
        // Wysłanie e-maila potwierdzającego
        Mail::to($data['email'])->send(new OrderConfirmationMail($data));
    
        return response()->json($zamowienie, 201);
    }
}
