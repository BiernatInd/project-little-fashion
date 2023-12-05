<?php

namespace App\Http\Controllers\PanelAdministratora\Uzytkownicy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ListaUzytkownikowController extends Controller
{
    public function pobierzUzytkownikow() {
        $uzytkownicy = User::all();
        return response()->json(['uzytkownicy' => $uzytkownicy]);
    }
}
