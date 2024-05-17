<?php

namespace App\Http\Controllers;

use App\Models\typeBank;
use Illuminate\Http\Request;

class typeBankController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
        ]);
        typeBank::create($validatedData);
        return redirect()->route('option.index')->with('success', 'typeBank created successfully');
    }
    public function update(Request $request, $id)
    {

        $bank = typeBank::find($id);
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
        ]);
        if (!$bank) {
            return redirect()->route('option.index')->with('error', 'bank not found');
        }
        $bank->update($validatedData);
        return redirect()->route('option.index')->with('success', 'bank updated successfully');
    }

    public function delete($id)
    {
        typeBank::find($id)->delete();
        return redirect()->route('option.index')->with('success', 'bank deleted successfully');
    }
}
