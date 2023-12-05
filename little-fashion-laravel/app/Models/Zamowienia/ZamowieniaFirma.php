<?php

namespace App\Models\Zamowienia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZamowieniaFirma extends Model
{
    use HasFactory;

    protected $table = 'zamowienia_firma';

    protected $fillable = [
        'nip',
        'nazwa_firmy',
        'ulica_i_numer_domu',
        'miejscowosc',
        'kod_pocztowy',
        'faktura_imie',
        'faktura_nazwisko',
        'faktura_email',
        'faktura_telefon',
        'faktura_kraj',
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
