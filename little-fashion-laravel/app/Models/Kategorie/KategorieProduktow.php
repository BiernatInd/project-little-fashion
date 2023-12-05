<?php

namespace App\Models\Kategorie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategorieProduktow extends Model
{
    use HasFactory;

    protected $table = 'kategorie_produktow';
    
    protected $fillable = [
        'nazwa_kategorii',
        'sciezka_kategorii',
    ];
}
