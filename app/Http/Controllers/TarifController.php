<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Requests\TarifRequest;
use App\Models\Tarif;
use App\Models\Ville;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function index()
    {
        $tarifs = tarif::all();
        $villes = Ville::all();
        return view('pages.tarif.index', compact('tarifs','villes'));
    }


    public function create()
    {
        return view('pages.tarif.create');
    }



    public function store(TarifRequest $request)
    {
        $customIdTar = Helpers::generateIdTar();
        $validatedData = $request->validated();
        // dd($validatedData);
        $validatedData['id_Tar'] = $customIdTar;
        tarif::create($validatedData);
        return redirect()->route('tarif.index')->with('success', 'tarif created successfully');
    }

    public function edit($id)
    {
        $tarif = tarif::find($id);
        if (!$tarif) {
            return view('404');
        }
        return view('pages.tarif.edit', compact('tarif'));
    }
    public function update(TarifRequest $request, $id)
    {

        $tarif = tarif::find($id);
        if (!$tarif) {
            return redirect()->route('tarif.index')->with('error', 'tarif not found');
        }
        $tarif->update($request->validated());
        return redirect()->route('tarif.index')->with('success', 'tarif updated successfully');
    }

    public function destroy($id)
    {
        tarif::find($id)->delete();
        return redirect()->route('tarif.index')->with('success', 'tarif deleted successfully');
    }
}

