<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Requests\DepenseRequest;
use App\Models\Depense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepenseController extends Controller
{
    public function index()
    {
        $depenses = Depense::query()->orderBy('created_at','desc')->get();
        $breads = [
            ['title' => 'Liste des depenses', 'url' => null],
            ['text' => 'Depenses', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.depense.index', compact('depenses','breads'));
    }
    public function store(DepenseRequest $request)
    {
        $user = session('admin');
        // dd($user['id_Ad']);
        $customIdDep = Helpers::generateIdDep();
        $validatedData = $request->validated();
        $validatedData['id_Dep'] = $customIdDep;

        $validatedData['id_Ad'] = $user['id_Ad'];
        // dd($validatedData);
        Depense::create($validatedData);
        return redirect()->route('depense.index')->with('success', 'Depense created successfully');
    }

    // public function edit($id)
    // {
    //     $depense = Depense::find($id);
    //     if (!$depense) {
    //         return view('404');
    //     }
    //     return view('pages.depense.edit', compact('depense'));
    // }
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
