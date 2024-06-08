<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Client;
use App\Models\Colis;
use App\Models\Message;
use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReclamationController extends Controller
{
    public function index()
    {
        $idU= Auth::id();
        $reclamations = Reclamation::where('id_Cl', $idU)
        ->with(['client', 'message' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])
        ->get();
        // dd($recla.mations);
        $messages = Message::whereIn('id_Rec', $reclamations->pluck('id_Rec'))->get();  
        $breads = [
            ['title' => 'Liste des Reclamations', 'url' => null],
            ['text' => 'Reclamations', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.reclamation.index', compact('reclamations','messages','breads'));
    }
    public function all()
    {
        $reclamations = Reclamation::query()->with(['client','message' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->orderBy('created_at','desc')->get(); 
        $messages = Message::whereIn('id_Rec', $reclamations->pluck('id_Rec'))->get(); 
        $breads = [
            ['title' => 'Liste des Reclamations', 'url' => null],
            ['text' => 'Reclamations', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.reclamation.index', compact('reclamations','messages','breads'));
    }

   

    public function store(Request $request)
    {
        // dd($request);
        $id_Rec = Helpers::generateIdRec();
        $id_Mess = Helpers::generateIdMess();

        $id_Cl= Auth::id();
        $id_C=$request->id_C ?$request->id_C :Null;
        // dd($id_C);
        $validatedData = $request->validate([
            'objet' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $newRec=Reclamation::create([
            'id_Rec' => $id_Rec,
            'objet' => $validatedData['objet'],
            'id_C' => $id_C,
            'id_Cl' => $id_Cl,
        ]);
        $newMess=Message::create([
            'id_Mess' => $id_Mess,
            'message' => $validatedData['message'],
            'id_Rec' => $newRec['id_Rec'],
            'id_Ad' => null,
        ]);
        // return redirect()->route('reclamation.index')->with('success', 'reclamation created successfully.');
        return back();
    }

   


    public function show(reclamation $reclamation)
    {
        return view('reclamation.show', compact('reclamation'));
    }

    public function traiteRec(Request $request, $id)
    {
        $record = Reclamation::findOrFail($id);
        $record->update([
            'etat' => 1,
        ]);
        return redirect()->route('reclamation.all');
    }
    
}

