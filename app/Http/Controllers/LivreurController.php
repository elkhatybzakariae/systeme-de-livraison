<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Livreur;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LivreurController extends Controller
{
    public function index()
    {
        $breads = [
            ['title' => 'Taleau de bord', 'url' => null],
            ['text' => 'Tableau', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.livreur.dashboard',compact('breads'));
    }
    public function signuppage()
    {
        $zones=Zone::query()->with('ville')->get();
        // dd($zones->ville);
        return view('auth.livreur.sign-up',compact('zones'));
    }
    public function signup(Request $request)
    {
        $id_Liv = Helpers::generateIdLiv();
        $validation = $request->validate([
            'nomcomplet' => 'required|string|max:50',
            'cin' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'Phone' => 'nullable|string|max:50',
            'ville' => 'required|string|max:150',
            'id_Z' => 'required',
            'adress' => 'required|string|max:150',
            'fraislivraison' => 'required|integer',
            'fraisrefus' => 'required|integer',
            'nombanque' => 'nullable|string|max:50',
            'numerocompte' => 'nullable|string|max:50',
            'password' => 'required|string|min:8',
            'cinrecto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cinverso' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'RIB' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->password === $request->confirmpassword) {
            $cinrecto = $request->file('cinrecto')->store('public/images');
            $cinverso = $request->file('cinverso')->store('public/images');
            $RIB = $request->file('RIB')->store('public/images');
            $validation['id_Liv']=$id_Liv;
            $validation['cinverso']=$cinverso;
            $validation['cinrecto']=$cinrecto;
            $validation['RIB']=$RIB;
            $validation['password']=Hash::make($validation['password']);
            $newLivreur = Livreur::create($validation);
            
            return back()->with('success', 'Nous avons bien reçu votre demande de création de compte. Nous vous contacterons ultérieurement.');

        } else {
            return redirect()->route('auth.livreur.signUp');
        }
    }
    public function signinpage()
    {
        return view('auth.livreur.sign-in');
    }

    public function signin(Request $request)
    {
        $v = $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|string|min:8',
        ]);
        
        $Livreur = Livreur::where('email', $request->email)->first();
        if ($Livreur) {
            if (Hash::check($request->password, $Livreur->password)) {

                Auth::login($Livreur);
                session(["user" => $Livreur]);
                return redirect()->route('livreur.index');
            }
        } else {
            return back()->with('error', 'Invalid email or password.');
        }
    }
    public function signout()
    {
        Auth::logout();
        return redirect()->route('auth.livreur.signIn');
    }
}
