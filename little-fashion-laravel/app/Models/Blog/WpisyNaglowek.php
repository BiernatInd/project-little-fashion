<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpisyNaglowek extends Model
{
    use HasFactory;

    protected $table = 'wpisy_naglowkow';

    protected $fillable = [
        'tresc_naglowka',
        'sciezka_artykulu',
        'numer_naglowka',
    ];
}
