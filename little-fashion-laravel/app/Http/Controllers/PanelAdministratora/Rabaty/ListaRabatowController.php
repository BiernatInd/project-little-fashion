<?php

namespace App\Http\Controllers\PanelAdministratora\Rabaty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rabaty\Rabaty;

class ListaRabatowController extends Controller
{
    public function pobierzRabaty()
    {
        $rabaty = Rabaty::all();

        return response()->json(['rabaty' => $rabaty]);
    }

    public function usunRabat($id)
    {
        $rabat = Rabaty::find($id);

        if (!$rabat) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $rabat->delete();

        return response()->json(['message' => 'Produkt został pomyślnie usunięty.']);
    }
}
