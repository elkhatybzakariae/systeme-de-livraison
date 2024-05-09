<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Ramassagecoli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RamassagecoliController extends Controller
{
    public function index()
    {
        $idU= Auth::id();
        $Ramassages = Ramassagecoli::where('id_Cl', $idU)->get();
        $breads = [
            ['title' => 'Liste des Ramassages', 'url' => null],
            ['text' => 'Ramassages', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.ramassagecolis.index', compact('Ramassages','breads'));
    }
    public function all()
    {
        $ramassages = Ramassagecoli::query()->with('client')->get(); 
        $breads = [
            ['title' => 'Liste des Ramassages', 'url' => null],
            ['text' => 'Ramassages', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.ramassagecolis.index', compact('ramassages','breads'));
    }
    public function store(Request $request)
    {
        $id_Ram = Helpers::generateIdRam();

        $id_Cl= Auth::id();
        $cl = Auth::user();
        // dd($cl);
        // $id_C=$request->filled('id_C') ?$request->input('id_C') :'';
        $validatedData = $request->validate([
            'remarque' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
        ]);
        $validatedData['id_Ram']=$id_Ram;
        $validatedData['ville']=$cl['ville'];
        // $validatedData['etat']=
        $validatedData['id_Cl']=$id_Cl;
        $newRec=Ramassagecoli::create($validatedData);
        return redirect()->route('ramassagecolis.index')->with('success', 'Ramassage coli created successfully.');
    }
    public function update(Request $request)
    {
        $itemId = $request->input('itemId');
        $newEtat = $request->input('newEtat');

        $Rcoli = Ramassagecoli::find($itemId);
        $Rcoli::update([
            'etat'=>$newEtat,
        ]);
        return redirect()->route('ramassagecolis.index')->with('success', 'Ramassage coli up successfully.');
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
