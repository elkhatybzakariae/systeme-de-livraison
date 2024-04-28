<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Requests\VilleRequest;
use App\Models\Ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    public function index()
    {
        $villes = Ville::all();
        return view('pages.ville.index', compact('villes'));
    }


    public function create()
    {
        return view('pages.ville.create');
    }



    public function store(VilleRequest $request)
    {
        $customIdV = Helpers::generateIdZ();
        $validatedData = $request->validated();

        $validatedData['id_V'] = $customIdV;
        Ville::create($validatedData);
        return redirect()->route('ville.index')->with('success', 'ville created successfully');
    }

    public function edit($id)
    {
        $ville = ville::find($id);
        if (!$ville) {
            return view('404');
        }
        return view('pages.ville.edit', compact('ville'));
    }
    public function update(VilleRequest $request, $id)
    {

        $ville = ville::find($id);
        if (!$ville) {
            return redirect()->route('ville.index')->with('error', 'ville not found');
        }
        $ville->update($request->validated());
        return redirect()->route('ville.index')->with('success', 'ville updated successfully');
    }

    public function destroy($id)
    {
        ville::find($id)->delete();
        return redirect()->route('ville.index')->with('success', 'ville deleted successfully');
    }
}
