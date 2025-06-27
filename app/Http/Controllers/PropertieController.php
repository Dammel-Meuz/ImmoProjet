<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Propertie;
use Illuminate\Support\Str;
use App\Models\TypeProperty;
use Illuminate\Http\Request;

class PropertieController extends Controller
{
   public function index()
    {
        $properties = Propertie::with('typeProperty', 'agent')->get();
        return view('properties.index', compact('properties'));
    }

    public function create()
    {
        $types = TypeProperty::all();
        $agents = User::where('role', 'agent')->get();
        return view('properties.create', compact('types', 'agents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'transaction_type' => 'required|in:vente,location',
            'prix' => 'required|numeric',
            'surface_habitable' => 'required|numeric',
            'address' => 'required|string',
            'type_properties_id' => 'required|exists:type_properties,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:disponible,vendu,loue,reserve',
            'is_active' => 'boolean',
            'en_vedette' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        Propertie::create($validated);

        return redirect()->route('properties.index')->with('success', 'Propriété créée avec succès.');
    }

    public function show(Propertie $property)
    {
        return view('properties.show', compact('property'));
    }

    public function edit(Propertie $property)
    {
        $types = TypeProperty::all();
        $agents = User::where('role', 'agent')->get();
        return view('properties.edit', compact('property', 'types', 'agents'));
    }

    public function update(Request $request, Propertie $property)
    {
       
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'transaction_type' => 'required|in:vente,location',
            'prix' => 'required|numeric',
            'surface_habitable' => 'required|numeric',
            'address' => 'required|string',
            'type_properties_id' => 'required|exists:type_properties,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:disponible,vendu,loue,reserve',
            'is_active' => 'boolean',
            'en_vedette' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['en_vedette'] = $request->has('en_vedette') ? true : false;
        //  dd($validated);
        $property->update($validated);

        return redirect()->route('properties.index')->with('success', 'Propriété mise à jour avec succès.');
    }

    public function destroy(Propertie $property)
    {
        $property->delete();
        return redirect()->route('properties.index')->with('success', 'Propriété supprimée.');
    }
}
