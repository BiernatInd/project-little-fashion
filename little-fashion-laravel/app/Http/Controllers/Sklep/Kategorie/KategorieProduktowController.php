<?php

namespace App\Http\Controllers\Sklep\Kategorie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategorie\KategorieProduktow;

class KategorieProduktowController extends Controller
{
    public function pobierzKategorie()
{
    $categories = KategorieProduktow::all();
    return response()->json($categories);
}
}
