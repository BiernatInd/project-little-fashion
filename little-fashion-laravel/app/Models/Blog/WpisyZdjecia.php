<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpisyZdjecia extends Model
{
    use HasFactory;

    protected $table = 'wpisy_zdjecia';

    protected $fillable = [
        'zdjecie_artykulu',
        'sciezka_artykulu',
    ];
}
