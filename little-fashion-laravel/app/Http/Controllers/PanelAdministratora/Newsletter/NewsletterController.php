<?php

namespace App\Http\Controllers\PanelAdministratora\Newsletter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter\Newsletter;

class NewsletterController extends Controller
{
    public function newsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:lista_newsletter,email',
        ]);

        $newsletter = Newsletter::create([
            'email' => $request->email,
        ]);

        return response()->json(['message' => 'Subscription successful']);
    }

    public function pobierzNewslettery()
    {
        $newsletter = Newsletter::all();

        return response()->json(['newsletter' => $newsletter]);
    }
}
