<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Livreur;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $breads = [
            ['title' => 'Tableau de bord', 'url' => null],
            ['text' => 'Tableau', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.index' ,compact('breads'));
    }
    public function signuppage()
    {
        return view('auth.admin.sign-up');
    }
    public function signinpage()
    {

        return view('auth.admin.sign-in');
    }

    public function signin(Request $request)
    {
        $v = $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|string|min:8',
        ]);
        $u = Admin::where('email', $request->email)->first();
        if ($u) {
            if (Hash::check($request->password, $u->password)) {

                Auth::login($u);
                session(["user" => $u]);
                // dd(session('user'));
                return redirect()->route('admin.index');
            }
        } else {
            return back()->with('error', 'Invalid email or password.');
        }
    }
    public function signout()
    {
        Auth::logout();
        return redirect()->route('auth.admin.signIn');
    }



    public function newuser()
    {
        $users = Admin::where('user', Auth::id())->get();
        $villes = Ville::all();
        $breads = [
            ['title' => 'liste des nouveaux clients ', 'url' => null],
            ['text' => 'nouveau client', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.users.index', compact('users', 'villes','breads'));
    }
    public function storenewuser(Request $request)
    {
        $id_Ad = Helpers::generateIdAd();
        $id_A = Auth::id();
        $validation = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nomcomplet' => 'required|string|max:50',
            'cin' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'Phone' => 'nullable|string|max:50',
            'password' => 'required|string|min:8',
            'ville' => 'required|string|max:150',
            'adress' => 'required|string|max:150',
            'nombanque' => 'nullable|string|max:50',
            'numerocompte' => 'nullable|string|max:50',
            'cinrecto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cinverso' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'RIB' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd($validation);
        if ($request->password === $request->cpassword) {
            // dd('dd');
            $photo = $request->file('photo')->store('public/images');
            $cinrecto = $request->file('cinrecto')->store('public/images');
            $cinverso = $request->file('cinverso')->store('public/images');
            $RIB = $request->file('RIB')->store('public/images');

            $validation['photo'] = $photo;
            $validation['cinverso'] = $cinverso;
            $validation['cinrecto'] = $cinrecto;
            $validation['RIB'] = $RIB;
            $validation['id_Ad'] = $id_Ad;
            $validation['isAdmin'] = 0;
            $validation['user'] = $id_A;
            $validation['password'] = Hash::make($validation['password']);
            Admin::create($validation);

            return back()->with('success', '');
        } else {
            dd('fff');
            return back()->with('error', '');
        }
        // return back()->with('success', ' ');
    }
    public function updatenewuser(Request $request, $id)
    {
        $admin = Admin::find($id);

        $validation = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nomcomplet' => 'required|string|max:50',
            'cin' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'Phone' => 'nullable|string|max:50',
            'email' => 'required|email|max:50',
            'password' => 'required|string|min:8',
            'ville' => 'required|string|max:150',
            'adress' => 'required|string|max:150',
            'nombanque' => 'nullable|string|max:50',
            'numerocompte' => 'nullable|string|max:50',
            'cinrecto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cinverso' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'RIB' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validation['password'] = Hash::make($validation['password']);

        $admin->update($validation);
        return back()->with('success', 'person mis à jour avec succès !');
    }
    // public function validernewuser($id)
    // {
    //     $client = Client::find($id);

    //     if ($client) {
    //         $client->update([
    //             'valider' => 1,
    //         ]);

    //         // Success message (consider using a more descriptive message)
    //         return back()->with('success', 'Client updated successfully!');
    //     } else {
    //         // Handle case where Client with the provided ID is not found
    //         return back()->with('error', 'Client not found!');
    //     }
    // }
    // public function nonvalidernewuser($id)
    // {
    //     $client = Client::find($id);

    //     if ($client) {
    //         $client->update([
    //             'valider' => 0,
    //         ]);

    //         // Success message (consider using a more descriptive message)
    //         return back()->with('success', 'Client updated successfully!');
    //     } else {
    //         // Handle case where Client with the provided ID is not found
    //         return back()->with('error', 'Client not found!');
    //     }
    // }
    public function deletenewuser($id)
    {
        Admin::find($id)->delete();
        return back()->with('success', ' ');
    }

    public function clients()
    {
        $users = Client::where('isAdmin', 1)->get();
        $breads = [
            ['title' => 'liste des  clients ', 'url' => null],
            ['text' => 'Clients', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.clients.index', compact('users','breads'));
    }
}
