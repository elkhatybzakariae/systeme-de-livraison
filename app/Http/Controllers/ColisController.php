<?php

namespace App\Http\Controllers;

use App\Models\Colis;
use Illuminate\Http\Request;

class ColisController extends Controller
{
    public function index()
    {
        $colis = Colis::all();
        return view('pages.colis.index', compact('colis'));
    }

    public function create()
    {
        return view('pages.colis.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code_d_envoi' => 'required|string|max:255',
            'date_d_expedition' => 'required|date',
            'destinataire' => 'required|string|max:255',
            'id_Cl' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'marchandise' => 'required|string|max:255',
            'etat' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'zone' => 'required|string|max:255',
            'ville_id' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            'commentaire' => 'nullable|string',
            'adresse' => 'required|string|max:255',
            'fragile' => 'nullable|boolean',
            'ovrire' => 'nullable|boolean',
            'colis_a_remplacer' => 'nullable|boolean',
        ]);

        Colis::create($validatedData);

        return redirect()->route('colis.index')->with('success', 'Colis created successfully.');
    }

    public function update(Request $request, Colis $colis)
    {
        $validatedData = $request->validate([
            'code_d_envoi' => 'required|string|max:255',
            'date_d_expedition' => 'required|date',
            'destinataire' => 'required|string|max:255',
            'id_Cl' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'marchandise' => 'required|string|max:255',
            'etat' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'zone' => 'required|string|max:255',
            'ville_id' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            'commentaire' => 'nullable|string',
            'adresse' => 'required|string|max:255',
            'fragile' => 'nullable|boolean',
            'ovrire' => 'nullable|boolean',
            'colis_a_remplacer' => 'nullable|boolean',
        ]);

        $colis->update($validatedData);

        return redirect()->route('colis.index')->with('success', 'Colis updated successfully.');
    }


    public function show(Colis $colis)
    {
        return view('colis.show', compact('colis'));
    }

    public function edit(Colis $colis)
    {
        return view('colis.edit', compact('colis'));
    }



    public function destroy(Colis $colis)
    {
        $colis->delete();
        return redirect()->route('colis.index')->with('success', 'Colis deleted successfully.');
    }
}
