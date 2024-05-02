<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        return view('pages.produit.index', compact('produits'));
    }

    public function create()
    {
        return view('pages.produit.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'imgpro' => 'required|string|max:255',
            'nompro' => 'required|date',
            'refpro' => 'required|string|max:255',
            'quantitie' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'id_Cl' => 'required|string|max:255',
        ]);

        produit::create($validatedData);

        return redirect()->route('produit.index')->with('success', 'produit created successfully.');
    }

    public function update(Request $request, produit $produit)
    {
        $validatedData = $request->validate([
            'imgpro' => 'required|string|max:255',
            'nompro' => 'required|date',
            'refpro' => 'required|string|max:255',
            'quantitie' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $produit->update($validatedData);

        return redirect()->route('produit.index')->with('success', 'produit updated successfully.');
    }


    public function show(produit $produit)
    {
        return view('produit.show', compact('produit'));
    }

    public function edit(produit $produit)
    {
        return view('produit.edit', compact('produit'));
    }



    public function destroy(produit $produit)
    {
        $produit->delete();
        return redirect()->route('produit.index')->with('success', 'produit deleted successfully.');
    }
}


