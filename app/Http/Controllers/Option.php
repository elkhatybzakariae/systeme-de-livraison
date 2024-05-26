<?php

namespace App\Http\Controllers;

use App\Models\Etat;
use App\Models\Option as ModelsOption;
use App\Models\typeBank;
use App\Models\typeClient;
use Illuminate\Http\Request;

class Option extends Controller
{
    public function index()
    {
        $Options = ModelsOption::query()->orderBy('created_at','desc')->get();
        $typeClient = typeClient::query()->orderBy('created_at','desc')->get();
        $typeBank = typeBank::query()->orderBy('created_at','desc')->get();
        $etat = Etat::query()->orderBy('created_at','desc')->get();
        $breads = [
            ['title' => 'Liste des Options', 'url' => null],
            ['text' => 'Options', 'url' => null],
        ];
        return view('pages.option.index', compact('Options','typeClient','typeBank','etat', 'breads'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'couleur' => 'required|string|max:255',
        ]);
        ModelsOption::create($validatedData);
        return redirect()->route('option.index')->with('success', 'ModelsOption created successfully');
    }
    public function update(Request $request, $id)
    {

        $Option = ModelsOption::find($id);
        $validatedData = $request->validate([
            // 'code' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'couleur' => 'required|string|max:255',
        ]);
        if (!$Option) {
            return redirect()->route('option.index')->with('error', 'option not found');
        }
        $Option->update($validatedData);
        return redirect()->route('option.index')->with('success', 'option updated successfully');
    }

    public function delete($id)
    {
        ModelsOption::find($id)->delete();
        return redirect()->route('option.index')->with('success', 'option deleted successfully');
    }
}
