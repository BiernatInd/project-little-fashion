<?php

namespace App\Models\Produkty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produkty extends Model
{
    use HasFactory;

    protected $table = 'produkty';

    protected $fillable = [
        'nazwa',
        'kategoria',
        'cena',
        'cena_promocyjna',
        'stan_magazynowy',
        'zdjecie_produktu_1',
        'zdjecie_produktu_2',
        'zdjecie_produktu_3',
    ];
}
