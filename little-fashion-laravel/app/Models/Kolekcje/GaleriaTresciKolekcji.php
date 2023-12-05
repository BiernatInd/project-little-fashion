<?php

namespace App\Models\Kolekcje;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriaTresciKolekcji extends Model
{
    use HasFactory;
    
    protected $table = 'galeria_tresci_kolekcji';

    protected $fillable = [
        'zdjecia_kolekcji',
        'sciezka_kolekcji',
    ];
}
