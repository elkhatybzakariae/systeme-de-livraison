<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Livreur;
use App\Models\typeBank;
use App\Models\Ville;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function overview()
    {
        $admin = Admin::find(session('admin')['id_Ad']);
        $breads = [
            ['title' => 'Profile Admin ', 'url' => null],
            ['text' => 'Profile', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.profile.overview', compact('admin', 'breads'));
    }
    public function editAd()
    {
        $admin = Admin::find(session('admin')['id_Ad']);
        $ville = Ville::all();
        $tb = typeBank::all();
        $breads = [
            ['title' => 'Edit Information Admin ', 'url' => null],
            ['text' => 'Profile', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.profile.edit', compact('admin', 'breads', 'ville', 'tb'));
    }
    public function updateAd(Request $req)
    {
        $admin = Admin::find(session('admin')['id_Ad']);
        $validation = $req->validate([
            'nomcomplet' => 'required|string|max:50',
            'cin' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'Phone' => 'nullable|string|max:50',
            'ville' => 'required|string',
            'adress' => 'required|string|max:150',
            'nombanque' => 'nullable|string|max:50',
            'numerocompte' => 'nullable|string|max:50',
        ]);
        $admin->update($validation);
        return redirect()->route('admin.profile.overview')->with('success', 'Informations mis à jour avec succès !');
    }

    public function editAdPass()
    {
        $admin = Admin::find(session('admin')['id_Ad']);
        $breads = [
            ['title' => 'Edit Votre Mot de Passe', 'url' => null],
            ['text' => 'Livreur', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.livreur.profile.editpass', compact('livreur', 'breads'));
    }
    public function updateAdPass(Request $req)
    {
        $admin = Admin::find(session('admin')['id_Ad']);
        $validation = $req->validate([
            'password' => 'required|string|min:8',
            'confirmpassword' => 'required|string|min:8',
        ]);
        $validation['password'] = Hash::make($validation['password']);
        $livreur->update($validation);
        return redirect()->route('overviewLiv')->with('success', 'Votre Mot de passe mis à jour avec succès !');
    }








    public function overviewLiv()
    {
        $livreur = Livreur::find(session('livreur')['id_Liv']);
        $breads = [
            ['title' => 'Profile Livreur ', 'url' => null],
            ['text' => 'Profile', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.livreur.profile.overview', compact('livreur', 'breads'));
    }
    public function editLiv()
    {
        $livreur = Livreur::find(session('livreur')['id_Liv']);
        $zone = Zone::with('ville')->get();
        $tb = typeBank::all();
        $breads = [
            ['title' => 'Edit Information Livreur ', 'url' => null],
            ['text' => 'Profile', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.livreur.profile.edit', compact('livreur', 'breads', 'zone', 'tb'));
    }
    public function updateLiv(Request $req)
    {
        $livreur = Livreur::find(session('livreur')['id_Liv']);
        $validation = $req->validate([
            'nomcomplet' => 'required|string|max:50',
            'cin' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'Phone' => 'nullable|string|max:50',
            'id_Z' => 'required|string|max:50',
            'ville' => 'required|string',
            'adress' => 'required|string|max:150',
            'nombanque' => 'nullable|string|max:50',
            'numerocompte' => 'nullable|string|max:50',
        ]);
        $livreur->update($validation);
        return redirect()->route('overviewLiv')->with('success', 'Informations mis à jour avec succès !');
    }

    public function editPass()
    {
        $livreur = Livreur::find(session('livreur')['id_Liv']);
        $breads = [
            ['title' => 'Edit Votre Mot de Passe', 'url' => null],
            ['text' => 'Livreur', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.livreur.profile.editpass', compact('livreur', 'breads'));
    }
    public function updatePass(Request $req)
    {
        $livreur = Livreur::find(session('livreur')['id_Liv']);
        $validation = $req->validate([
            'password' => 'required|string|min:8',
            'confirmpassword' => 'required|string|min:8',
        ]);
        $validation['password'] = Hash::make($validation['password']);
        $livreur->update($validation);
        return redirect()->route('overviewLiv')->with('success', 'Votre Mot de passe mis à jour avec succès !');
    }









    public function overviewClient()
    {
        $client = Client::with('Cville')->find(session('client')['id_Cl']);
        $breads = [
            ['title' => 'Profile Client ', 'url' => null],
            ['text' => 'Profile', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.profile.overview', compact('client', 'breads'));
    }
    public function editCl()
    {
        $client = Client::with('Cville')->find(session('client')['id_Cl']);
        $zone = Zone::with('ville')->get();
        $tb = typeBank::all();
        $breads = [
            ['title' => 'Edit Information Client ', 'url' => null],
            ['text' => 'Profile', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.profile.edit', compact('client', 'breads', 'zone', 'tb'));
    }
    public function updateCl(Request $req)
    {
        $client = Client::find(session('client')['id_Cl']);
        $validation = $req->validate([
            'nomcomplet' => 'required|string|max:50',
            'cin' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'Phone' => 'nullable|string|max:50',
            'id_Z' => 'required|string|max:50',
            'ville' => 'required|string',
            'adress' => 'required|string|max:150',
            'nombanque' => 'nullable|string|max:50',
            'numerocompte' => 'nullable|string|max:50',
        ]);
        $client->update($validation);
        return redirect()->route('overviewClient')->with('success', 'Informations mis à jour avec succès !');
    }

    public function editmyclPass()
    {
        $client = Client::find(session('client')['id_Cl']);
        $breads = [
            ['title' => 'Edit Votre Mot de Passe', 'url' => null],
            ['text' => 'Livreur', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.profile.editpass', compact('client', 'breads'));
    }
    public function updatemyclPass(Request $req)
    {
        $client = Client::find(session('client')['id_Cl']);
        $validation = $req->validate([
            'password' => 'required|string|min:8',
            'confirmpassword' => 'required|string|min:8',
        ]);
        $validation['password'] = Hash::make($validation['password']);
        $client->update($validation);
        return redirect()->route('overviewClient')->with('success', 'Votre Mot de passe mis à jour avec succès !');
    }
}
