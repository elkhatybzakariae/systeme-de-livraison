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
        $breads = [
            ['title' => 'Tableau de bord', 'url' => null],
            ['text' => 'Tableau', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.dashboard',compact('breads'));
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
        $validation['id_Cl'] = $id_Cl;
        $validation['isAdmin'] = 1;
        $validation['password'] = Hash::make($validation['password']);
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

    public function newuser()
    {
        $users = Client::where('user', Auth::id())->get();
        $breads = [
            ['title' => 'Liste de utilisateurs', 'url' => null],
            ['text' => 'Utilisateurs', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.users.index', compact('users','breads'));
    }
    public function storenewuser(Request $request)
    {
        $id_Cl = Helpers::generateIdCl();
        $id_Mag = Auth::id();
        $validation = $request->validate([
            'nomcomplet' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'password' => 'required|string|min:8',
        ]);
        $validation['id_Cl'] = $id_Cl;
        $validation['isAdmin'] = 0;
        $validation['user'] = $id_Mag;
        $validation['nommagasin'] = '-';
        $validation['typeentreprise'] = '-';
        $validation['cin'] = '-';
        $validation['ville'] = '-';
        $validation['adress'] = '-';
        $validation['password'] = Hash::make($validation['password']);
        Client::create($validation);
        return back()->with('success', ' ');
    }
    public function updatenewuser(Request $request, $id)
    {
        $client = Client::find($id);

        $validation = $request->validate([
            'password' => 'required|string|min:8',
        ]);

        $validation['password'] = Hash::make($validation['password']);

        $client->update($validation);
        return back()->with('success', 'Client mis à jour avec succès !');
    }
    public function validernewuser($id)
    {
        $client = Client::find($id);

        if ($client) {
            $client->update([
                'valider' => 1,
            ]);

            // Success message (consider using a more descriptive message)
            return back()->with('success', 'Client updated successfully!');
        } else {
            // Handle case where Client with the provided ID is not found
            return back()->with('error', 'Client not found!');
        }
    }
    public function nonvalidernewuser($id)
    {
        $client = Client::find($id);

        if ($client) {
            $client->update([
                'valider' => 0,
            ]);

            // Success message (consider using a more descriptive message)
            return back()->with('success', 'Client updated successfully!');
        } else {
            // Handle case where Client with the provided ID is not found
            return back()->with('error', 'Client not found!');
        }
    }
    public function deletenewuser($id)
    {
        Client::find($id)->delete();
        return back()->with('success', ' ');
    }
}
