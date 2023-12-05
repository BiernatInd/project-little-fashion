<?php

namespace App\Http\Controllers\PanelAdministratora\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\ListaWpisow;

class MetaTagiController extends Controller
{
    public function pobierzMetaDane($sciezka_artykulu)
    {
        $article = ListaWpisow::where('sciezka_artykulu', $sciezka_artykulu)->first();
    
        if (!$article) {
            return response()->json(['message' => 'Artykuł nie znaleziony'], 404);
        }
    
        return response()->json(['article' => $article], 200);
    }        
}
