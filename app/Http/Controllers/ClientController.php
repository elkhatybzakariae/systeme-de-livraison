<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function index()
    {
        return view('pages.clients.dashboard');
    }
    public function signuppage()
    {
        return view('auth.client.sign-up');
    }
    public function signup(Request $request)
    {
        $id_Cl = Helpers::generateIdCl();
        $validation = $request->validate([
            'nommagasin' => 'required|string|max:50',
            'nomcomplet' => 'required|string|max:50',
            'typeentreprise' => 'required|string|max:50',
            'cin' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'Phone' => 'nullable|string|max:50',
            'ville' => 'required|string|max:50',
            'villeRamassage' => 'nullable|string|max:50',
            'adress' => 'required|string|max:50',
            'siteweb' => 'nullable|string|max:50',
            'nombanque' => 'nullable|string|max:50',
            'numerocompte' => 'nullable|string|max:50',
            'password' => 'required|string|min:8',
        ]);
        $validation['id_Cl']=$id_Cl;
        $validation['password']=Hash::make($validation['password']);
        if ($request->password === $request->confirmpassword) {
            $newclient = Client::create($validation);
            return back()->with('success', 'Nous avons bien reçu votre demande de création de compte. Nous vous contacterons ultérieurement.');

        } else {
            return redirect()->route('auth.client.signUp');
        }
    }
    public function signinpage()
    {
        return view('auth.client.sign-in');
    }

    public function signin(Request $request)
    {
        $v = $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|string|min:8',
        ]);
        $client = Client::where('email', $request->email)->first();
        if ($client) {
            if (Hash::check($request->password, $client->password)) {

                Auth::login($client);
                session(["user" => $client]);
                return redirect()->route('client.index')->with('success', 'successfull!!!!.');
            }
        } else {
            return back()->with('error', 'Invalid email or password.');
        }
    }
    public function signout()
    {
        auth()->logout();
        return redirect()->route('auth.client.signIn');
    }

}
