<?php

namespace App\Http\Controllers;

use App\Models\Livreur;
use App\Models\Zone;
use Illuminate\Http\Request;

class NewLivreurController extends Controller
{
    public function newlivreurs()
    {
        $list= Livreur::where('isAccepted',0)->with('zone')->orderBy('created_at','desc')->get();
        $breads = [
            ['title' => 'Liste des nouveaux Livreurs', 'url' => null],
            ['text' => 'Nouveax livreurs', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.livreur.newlivreurs',compact('list','breads'));
    }
    
    public function profile($id)
    {
        $livreur= Livreur::find($id);
        $zone=Zone::with('ville')->get();
        $breads = [
            ['title' => 'Modifier Profile', 'url' => null],
            ['text' => 'Profile', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.livreur.profile',compact('livreur','breads','zone'));
    }
    public function accept(Request $request,$id)
    {
        $validation = $request->validate([
            'nomcomplet' => 'required|string|max:50',
            'cin' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'Phone' => 'nullable|string|max:50',
            'id_Z' => 'required|string|max:150',
            'ville' => 'required|string|max:150',
            'adress' => 'required|string|max:150',
            'fraislivraison' => 'required|integer',
            'fraisrefus' => 'required|integer',
            'nombanque' => 'nullable|string|max:50',
            'numerocompte' => 'nullable|string|max:50',
            'password' => 'nullable|string|min:8',
            'cinrecto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cinverso' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'RIB' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
      
            if ($request->file('cinrecto')) {
                $file = $request->file('cinrecto');
                $cinrecto = time() . '_' . $file->getClientOriginalName();
                $path = public_path('imgs'); 
                $file->move($path, $cinrecto);        
                $validation['cinrecto'] = $cinrecto;
            }
            if ($request->file('cinverso')) {
                $file = $request->file('cinverso');
                $cinverso = time() . '_' . $file->getClientOriginalName();
                $path = public_path('imgs'); 
                $file->move($path, $cinverso);        
                $validation['cinverso'] = $cinverso;
            }
            if ($request->file('RIB')) {
                $file = $request->file('RIB');
                $RIB = time() . '_' . $file->getClientOriginalName();
                $path = public_path('imgs'); 
                $file->move($path, $RIB);        
                $validation['RIB'] = $RIB;
            }
            
        $validation['isAccepted']=1;
        Livreur::where('id_Liv', $id)->update($validation);
        return redirect()->route('newlivreurs');
    }
    public function deletelivreur($id)
    {
        Livreur::find($id)->delete();
        return redirect()->route('newlivreurs');
    }
}
