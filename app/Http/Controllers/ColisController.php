<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Colis;
use App\Models\Ville;
use App\Models\Zone;
use Illuminate\Http\Request;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkProcessor;

class ColisController extends Controller
{
    public function index()
    {
        $colis = Colis::query()->whereNot('status','nouveau')->get();
        return view('pages.clients.colis.index', compact('colis'));
    }
    public function indexAdmin()
    {
        $colis = Colis::query()->whereNot('status','nouveau')->get();
        return view('pages.clients.colis.index', compact('colis'));
    }
    public function indexRamassage()
    {
        $colis = Colis::query()->where('status','nouveau')->get();

        return view('pages.clients.colis.indexRamassage', compact('colis'));
    }

    public function create()
    {
        $villes=Ville::all();
        $zones=Zone::all();

        return view('pages.clients.colis.create',compact('zones','villes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code_d_envoi' => 'required|string|max:255',
            'destinataire' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'marchandise' => 'required|string|max:255',
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
        $validatedData['id_C']=Helpers::generateIdC();
        $validatedData['id_Cl']=session('user')['id_Cl'];
        // $validatedData['id_Cl']=session('user')['id_Cl'];
        // dd($validatedData);

        Colis::create($validatedData);

        return redirect()->route('colis.index')->with('success', 'Colis created successfully.');
    }

    public function update(Request $request, Colis $colis)
    {
        $validatedData = $request->validate([
            'code_d_envoi' => 'required|string|max:255',
            'destinataire' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'marchandise' => 'required|string|max:255',
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
        return view('pages.clients.colis.edit', compact('colis'));
    }



    public function destroy(Colis $colis)
    {
        $colis->delete();
        return redirect()->route('colis.index')->with('success', 'Colis deleted successfully.');
    }
}
