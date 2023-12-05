<?php

namespace App\Models\Rabaty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rabaty extends Model
{
    use HasFactory;

    protected $table = 'kody_rabatowe';

    protected $fillable = [
        'kod_rabatowy',
        'znizka',
        'ilosc_kodow',
    ];
}