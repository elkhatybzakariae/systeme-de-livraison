<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Requests\DepenseRequest;
use App\Models\Depense;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    public function index()
    {
        $depenses = Depense::all();
        return view('pages.depense.index', compact('depenses'));
    }


    public function create()
    {
        return view('pages.depense.create');
    }



    public function store(DepenseRequest $request)
    {
        $customIdDep = Helpers::generateIdDep();
        $validatedData = $request->validated();

        $validatedData['id_Dep'] = $customIdDep;
        Depense::create($validatedData);
        return redirect()->route('depense.index')->with('success', 'Depense created successfully');
    }

    public function edit($id)
    {
        $depense = Depense::find($id);
        if (!$depense) {
            return view('404');
        }
        return view('pages.depense.edit', compact('depense'));
    }
    public function update(DepenseRequest $request, $id)
    {

        $depense = Depense::find($id);
        if (!$depense) {
            return redirect()->route('depense.index')->with('error', 'Depense not found');
        }
        $depense->update($request->validated());
        return redirect()->route('depense.index')->with('success', 'Depense updated successfully');
    }

    public function destroy($id)
    {
        Depense::find($id)->delete();
        return redirect()->route('depense.index')->with('success', 'Depense deleted successfully');
    }
}
