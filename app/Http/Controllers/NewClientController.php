<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class NewClientController extends Controller
{
    public function newclients()
    {
        $list= Client::where('isAccepted',0)->get();
        return view('pages.admin.clients.newclients',compact('list'));
    }
    public function profile($id)
    {
        $client= Client::find($id);
        return view('pages.admin.clients.profile',compact('client'));
    }
    public function accept(Request $request,$id)
    {
        $validation = $request->validate([
            'nommagasin' => 'required|string|max:50',
            'nomcomplet' => 'required|string|max:50',
            'typeentreprise' => 'required|string|max:50',
            'cin' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'Phone' => 'nullable|string|max:50',
            'ville' => 'required|string|max:150',
            'villeRamassage' => 'nullable|string|max:150',
            'adress' => 'required|string|max:150',
            'siteweb' => 'nullable|string|max:150',
            'nombanque' => 'nullable|string|max:50',
            'numerocompte' => 'nullable|string|max:50',
        ]);
        $validation['isAccepted']=1;
        Client::where('id_Cl', $id)->update($validation);
        return redirect()->route('newclients');
    }
    public function deleteclient($id)
    {
        Client::find($id)->delete();
        return redirect()->route('newclients');
    }
}
