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
            'code_d_envoi' => 'required|string',
            'date_d_expedition' => 'required|date',
            'etat' => 'required|string',
            'status' => 'required|string',
            'ville_id' => 'required|exists:villes,id_V',
            'prix' => 'required|numeric',
        ]);
        Colis::create($validatedData);
        return redirect()->route('colis.index')->with('success', 'Colis created successfully');
    }

    public function show(Colis $colis)
    {
        
        return view('pages.colis.edit', compact('colis'));
        
    }

    public function edit(Colis $colis)
    {
        return view('pages.colis.edit', compact('colis'));

    }

    public function update(Request $request, Colis $colis)
    {
        $validatedData = $request->validate([
            'code_d_envoi' => 'required|string',
            'date_d_expedition' => 'required|date',
            'etat' => 'required|string',
            'status' => 'required|string',
            'ville_id' => 'required|exists:villes,id_V',
            'prix' => 'required|numeric',
        ]);
        $colis->update($validatedData);
        return redirect()->route('colis.index')->with('success', 'Colis updated successfully');
    }

    public function destroy(Colis $colis)
    {
        $colis->delete();
        return redirect()->route('colis.index')->with('success', 'Colis deleted successfully');
    }
}
