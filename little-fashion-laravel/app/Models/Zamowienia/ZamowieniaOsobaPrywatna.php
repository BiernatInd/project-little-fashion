<?php

namespace App\Models\Zamowienia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZamowieniaOsobaPrywatna extends Model
{
    use HasFactory;

    protected $table = 'zamowienia_osoba_prywatna';

    protected $fillable = [
        'imie',
        'nazwisko',
        'email',
        'telefon',
        'kraj',
        'ulica_i_numer_domu',
        'miejscowosc',
        'kod_pocztowy',
        'faktura_imie',
        'faktura_nazwisko',
        'faktura_ulica_i_numer_domu',
        'faktura_miejscowosc',
        'faktura_kod_pocztowy',
        'laczna_kwota',
        'platnosc',
        'podatek_vat',
        'dostawa',
        'status_zamowienia',
        'numer_zamowienia',
        'wprowadzony_kod_promocyjny',
        'znizka',
        'zakupione_produkty',
        'nazwa_uzytkownika',
    ];
}
