<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LivreurController extends Controller
{
    public function index()
    {
        return view('pages.admin.index');
    }
    public function signuppage()
    {
        return view('auth.livreur.sign-up');
    }
    public function signup(Request $request)
    {
        $id_Liv = Helpers::generateIdLiv();
        $validation = $request->validate([
            'nomcomplet' => 'required|string|max:50',
            'cin' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'Phone' => 'nullable|string|max:50',
            'ville' => 'required|string|max:50',
            'adress' => 'required|string|max:50',
            'fraislivraison' => 'required|integer|max:50',
            'fraisrefus' => 'required|integer|max:50',
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
            $newLivreur = Livreur::create([
                'id_Liv' => $id_Liv,
                'nomcomplet' => $validation['nomcomplet'],
                'cin' => $validation['cin'],
                'email' => $validation['email'],
                'Phone' => $validation['Phone'],
                'ville' => $validation['ville'],
                'adress' => $validation['adress'],
                'fraislivraison' => $validation['fraislivraison'],
                'fraisrefus' => $validation['fraisrefus'],
                'nombanque' => $validation['nombanque'],
                'numerocompte' => $validation['numerocompte'],
                'password' => Hash::make($validation['password']),
                'cinrecto' => $cinrecto,
                'cinverso' => $cinverso,
                'RIB' => $RIB,
            ]);
            auth()->login($newLivreur);
            return redirect()->route('index');
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
                return redirect()->route('index');
            }
            // return redirect()->route('signinpage');
        } else {
            // Password is incorrect; show an error message
            return back()->with('error', 'Invalid email or password.');
        }
    }
    public function signout()
    {
        Auth::logout();
        return redirect()->route('auth.livreur.signIn');
    }
}
