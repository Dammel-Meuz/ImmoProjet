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
        $propriétés = Propertie::where('en_vedette', true)
                        ->orderBy('created_at', 'desc')
                        ->take(6) // Limit to 6 featured properties
                        ->get();
           
        // This method returns the view for the welcome page.
        return view('Accueil.accueil', compact('propriétés'));
    }
    /**
     * Display the properties page.
     *
     * @return \Illuminate\View\View
     */
    public function properties()
    {
        $propriétés = Propertie::where('status', 'disponible')
                        ->orderBy('created_at', 'desc')
                        ->paginate(12);
        
        // This method returns the view for the properties page.
        return view('Accueil.properties', compact('propriétés'));
    }
    /**
     * Display the property details page.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $propriété = Propertie::findOrFail($id);
        // This method returns the view for a specific property.
        return view('Accueil.showPropertie', compact('propriété'));
    }
}
