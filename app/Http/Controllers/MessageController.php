<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Message;
use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request,$id)
    {
        $id_Mess = Helpers::generateIdMess();

       $user=session('admin');
       if(isset($user['id_Ad'])){
        $id_Ad=$user['id_Ad'];
       }
        $validatedData = $request->validate([
            'message' => 'required|string',
        ]);

        $Rec=Reclamation::find($id);
        $newMess=Message::create([
            'id_Mess' => $id_Mess,
            'message' => $validatedData['message'],
            'id_Rec' => $Rec['id_Rec'],
            'id_Ad'=>$id_Ad??null,
        ]);
        return back()->with('success', 'message created successfully.');
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
        return redirect()->route('reclamation.index');
    }
    
}

