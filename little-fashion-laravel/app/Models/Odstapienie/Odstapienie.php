<?php

namespace App\Models\Odstapienie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Odstapienie extends Model
{
    use HasFactory;

    protected $table = 'lista_odstapien';

    protected $fillable = [
        'sciezka_zdjecia',
    ];
}
