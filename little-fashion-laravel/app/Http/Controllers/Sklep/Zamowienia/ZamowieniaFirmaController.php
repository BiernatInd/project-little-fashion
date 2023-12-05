<?php

namespace App\Http\Controllers\Sklep\Zamowienia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zamowienia\ZamowieniaFirma;

class ZamowieniaFirmaController extends Controller
{
    public function zapiszDane(Request $request)
    {
        $data = $request->validate([
            'nip' => 'required|string',
            'nazwa_firmy' => 'required|string',
            'ulica_i_numer_domu' => 'required|string',
            'miejscowosc' => 'required|string',
            'kod_pocztowy' => 'required|string',
            'faktura_imie' => 'required|string',
            'faktura_nazwisko' => 'required|string',
            'faktura_email' => 'required|email',
            'faktura_telefon' => 'required|string',
            'faktura_kraj' => 'required|string',
            'faktura_ulica_i_numer_domu' => 'required|string',
            'faktura_miejscowosc' => 'required|string',
            'faktura_kod_pocztowy' => 'required|string',
            'wprowadzony_kod_promocyjny' => 'nullable|string',
            'znizka' => 'nullable|numeric',
            'dostawa' => 'required|string',
            'laczna_kwota' => 'required|numeric',
            'platnosc' => 'required|string',
            'podatek_vat' => 'required|numeric',
            'zakupione_produkty' => 'required|string',
            'numer_zamowienia' => 'required|string',
            'nazwa_uzytkownika' => 'required|nullable'
        ]);

        // Usunięcie ewentualnego JSON encoding, ponieważ zakupiono jest typu string

        $zamowienie = ZamowieniaFirma::create($data);

        $zamowienie->update(['status_zamowienia' => 'Nie opłacono']);
    
        // Wysłanie e-maila potwierdzającego
        Mail::to($data['email'])->send(new OrderConfirmationMail($data));
    
        return response()->json($zamowienie, 201);
    }
}
