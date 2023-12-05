<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaWpisow extends Model
{
    use HasFactory;

    protected $table = 'lista_wpisow';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'sciezka_artykulu',
    ];
}
