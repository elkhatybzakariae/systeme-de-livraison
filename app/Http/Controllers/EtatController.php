<?php

namespace App\Http\Controllers;

use App\Models\Etat;
use Illuminate\Http\Request;

class EtatController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'couleur' => 'required|string|max:255',
        ]);
        Etat::create($validatedData);
        return redirect()->route('option.index')->with('success', 'Etat created successfully');
    }
    public function update(Request $request, $id)
    {

        $etat = Etat::find($id);
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'couleur' => 'required|string|max:255',
        ]);
        if (!$etat) {
            return redirect()->route('option.index')->with('error', 'etat not found');
        }
        $etat->update($validatedData);
        return redirect()->route('option.index')->with('success', 'etat updated successfully');
    }

    public function delete($id)
    {
        Etat::find($id)->delete();
        return redirect()->route('option.index')->with('success', 'etat deleted successfully');
    }
}
