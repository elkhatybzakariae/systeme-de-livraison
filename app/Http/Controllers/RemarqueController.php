<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Remarque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RemarqueController extends Controller
{
    public function index()
    {
        $remarques = Remarque::query()->orderBy('created_at','desc')->get();
        $breads = [
            ['title' => 'Liste des remarques', 'url' => null],
            ['text' => 'remarques', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.remarque.index', compact('remarques', 'breads'));
    }
    public function store(Request $request)
    {
        $id_Rem = Helpers::generateIdRem();

        $id_Ad = Auth::id();
        $validatedData = $request->validate([
            'remarque' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'cible' => 'required|string|max:255',
            'section' => 'nullable|string|max:255',
        ]);
        $validatedData['id_Rem'] = $id_Rem;
        $validatedData['id_Ad'] = $id_Ad;
        Remarque::create($validatedData);
        return redirect()->route('remarque.index')->with('success', 'remarque coli created successfully.');
    }
    public function update(Request $request, $id)
    {
        $remarque = Remarque::find($id);
        $validatedData = $request->validate([
            'remarque' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'cible' => 'required|string|max:255',
            'section' => 'nullable|string|max:255',
        ]);
        $remarque->update($validatedData);

        return redirect()->route('remarque.index')->with('success', 'remarque coli up successfully.');
    }

    public function destroy($id)
    {
        Remarque::find($id)->delete();
        return redirect()->route('remarque.index')->with('success', 'remarque deleted successfully');
    }


    // public function show(Ramassagecoli $Ramassagecoli)
    // {
    //     return view('Ramassagecoli.show', compact('Ramassagecoli'));
    // }

    // public function traiteRec(Request $request, $id)
    // {
    //     $record = Ramassagecoli::findOrFail($id);
    //     $record->update([
    //         'etat' => 1,
    //     ]);
    //     return redirect()->route('Ramassagecoli.all');
    // }

}
