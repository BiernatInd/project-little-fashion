<?php

namespace App\Models\Kolekcje;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriaKolekcje extends Model
{
    use HasFactory;

    protected $table = 'galeria_kolekcje';

    protected $fillable = [
        'zdjecie_kolekcji',
        'sciezka_kolekcji',
    ];
}
