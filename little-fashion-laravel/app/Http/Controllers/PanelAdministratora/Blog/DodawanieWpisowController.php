<?php

namespace App\Http\Controllers\PanelAdministratora\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\ListaWpisow;

class DodawanieWpisowController extends Controller
{
    public function dodajWpis(Request $request)
    {
        $request->validate([
            'metaTitle' => 'required|string',
            'metaDescription' => 'required|string',
            'sciezkaArtykulu' => 'required|string',
        ]);

        $wpis = new ListaWpisow();
        $wpis->meta_title = $request->input('metaTitle');
        $wpis->meta_description = $request->input('metaDescription');
        $wpis->sciezka_artykulu = $request->input('sciezkaArtykulu');
        $wpis->nazwa_artykulu = $request->input('nazwaArtykulu');
        $wpis->save();

        return response()->json(['message' => 'Wpis dodany pomyślnie']);
    }
}
