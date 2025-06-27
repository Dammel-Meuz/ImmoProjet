<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{   
     /**
     * Ajouter une propriété aux favoris.
     */
    public function store(Request $request, $propertyId)
    {
        $user = Auth::user();

        $exists = Favorite::where('user_id', $user->id)
                          ->where('property_id', $propertyId)
                          ->exists();

        if ($exists) {
            return redirect()->back()->with('message', 'Déjà ajouté aux favoris.');
        }

        Favorite::create([
            'user_id' => $user->id,
            'property_id' => $propertyId,
        ]);

        return redirect()->back()->with('success', 'Propriété ajoutée aux favoris.');
    }

    /**
     * Supprimer un favori.
     */
    public function destroy($propertyId)
    {
        $user = Auth::user();

        Favorite::where('user_id', $user->id)
                ->where('property_id', $propertyId)
                ->delete();

        return redirect()->back()->with('success', 'Favori supprimé.');
    }

    /**
     * Lister les favoris de l'utilisateur connecté.
     */
    public function index()
    {
        $user = Auth::user();
        $favorites = Favorite::with('property')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('favorites.index', compact('favorites'));
    }
}
