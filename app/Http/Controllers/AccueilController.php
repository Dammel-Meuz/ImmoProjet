<?php

namespace App\Http\Controllers;

use App\Models\Propertie;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    /**
     * Display the welcome page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $propriétés = Propertie::where('is_active', true)
                     ->where('en_vedette', true)
                        ->orderBy('created_at', 'desc')
                        ->take(3)
                        ->get();
           
        // This method returns the view for the welcome page.
        return view('Accueil.accueil');
    }
}
