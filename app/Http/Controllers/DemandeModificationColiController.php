<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Colis;
use App\Models\DemandeModificationColi;
use Illuminate\Http\Request;

class DemandeModificationColiController extends Controller
{
    public function all()
    {
        $demandes = DemandeModificationColi::with('colis')->get();
        // dd($demandes); 
        $breads = [
            ['title' => 'Liste des Demandes Modification Colis', 'url' => null],
            ['text' => 'Demandes', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.demandemodificationcoli.index', compact('demandes', 'breads'));
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
        dd($id);
        $dmc = DemandeModificationColi::findOrFail($id);
        $coli = Colis::findOrFail($dmc->coli_id); // Assuming `coli_id` is the correct foreign key column in `DemandeModificationColi`
        dd($coli);
        $dmc->update([
            'isAccepted' => 'Accepte',
        ]);
        $coli->update([
            // Assuming you want to update some specific fields in the Colis model
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
