<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Colis;
use App\Models\DemandeModificationColi;
use App\Models\Etat;
use App\Models\Option;
use Illuminate\Http\Request;

class DemandeModificationColiController extends Controller
{
    public function all()
    {
        $demandes = DemandeModificationColi::with('colis')
        ->orderBy('created_at','desc')
        ->get();
        
        $cl=Option::query()->orderBy('created_at','desc')->get();
        $etat=Etat::query()->orderBy('created_at','desc')->get();
        $breads = [
            ['title' => 'Liste des Demandes Modification Colis', 'url' => null],
            ['text' => 'Demandes', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.demandemodificationcoli.index', compact('demandes','cl','etat', 'breads'));
    }
    public function store(Request $request, $id)
    {
        $id_DMC = Helpers::generateIdDMC();
        $validatedData = $request->validate([
            'destinataire' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'commentaire' => 'nullable|string',
            'adresse' => 'required|string|max:255',
            // 'fragile' => 'nullable|boolean',
            // 'ouvrir' => 'nullable|boolean',
        ]);
        $validatedData['id_DMC'] = $id_DMC;
        $validatedData['id'] = $id;
        DemandeModificationColi::create($validatedData);
        return back()->with('success', 'DemandeModificationColi created successfully.');
    }
    // public function update(Request $request,$id)
    // {
    //     $oldDMC=DemandeModificationColi::findOrFail($id);
    //     $validatedData = $request->validate([
    //         'destinataire' => 'required|string|max:255',
    //         'telephone' => 'required|string|max:255',
    //         'prix' => 'required|numeric',
    //         'commentaire' => 'nullable|string',
    //         'adresse' => 'required|string|max:255',
    //         // 'fragile' => 'nullable|boolean',
    //         // 'ouvrir' => 'nullable|boolean',
    //     ]);
    //     $oldDMC->update($validatedData);
    //     return redirect()->route('DemandeModificationColi.index')->with('success', 'DemandeModificationColi updated successfully.');
    // }


    public function accepte(Request $request, $id)
    {
        $dmc = DemandeModificationColi::findOrFail($id);
        // dd($dmc);
        $coli = Colis::findOrFail($dmc->id); 
        $dmc->update([
            'isAccepted' => 'Accepte',
        ]);
        $c=$coli->update([
            'destinataire' => $dmc->destinataire,
            'telephone' => $dmc->telephone,
            'prix' => $dmc->prix,
            'commentaire' => $dmc->commentaire,
            'adresse' => $dmc->adresse,
        ]);
        return back();
    }
    public function refuse(Request $request, $id)
    {
        $dmc = DemandeModificationColi::findOrFail($id);
        $dmc->update([
            'isAccepted' => 'Annule',
        ]);
        return back();
    }
}
