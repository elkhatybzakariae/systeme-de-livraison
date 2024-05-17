<?php

namespace App\Http\Controllers;

use App\Models\typeClient;
use Illuminate\Http\Request;

class typeClientController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
        ]);
        typeClient::create($validatedData);
        return redirect()->route('option.index')->with('success', 'type created successfully');
    }
    public function update(Request $request, $id)
    {

        $typeC = typeClient::find($id);
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
        ]);
        if (!$typeC) {
            return redirect()->route('option.index')->with('error', 'type not found');
        }
        $typeC->update($validatedData);
        return redirect()->route('option.index')->with('success', 'type updated successfully');
    }

    public function delete($id)
    {
        typeClient::find($id)->delete();
        return redirect()->route('option.index')->with('success', 'type deleted successfully');
    }
}
