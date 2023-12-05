<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpisyParagraf extends Model
{
    use HasFactory;

    protected $table = 'wpisy_paragrafow';

    protected $fillable = [
        'tresc_paragrafu',
        'sciezka_artykulu',
        'numer_naglowka',
    ];
}
