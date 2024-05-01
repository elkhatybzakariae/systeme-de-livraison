<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.admin.index');
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
        // dd(Hash::make('password'));
        $v = $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|string|min:8',
        ]);
        $u = Admin::where('email', $request->email)->first();
        if ($u) {
            if (Hash::check($request->password, $u->password)) {

                Auth::login($u);
                return redirect()->route('admin.index');
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
        return redirect()->route('auth.signIn');
    }

    public function newclients()
    {
        $list= Client::where('isAccepted',0)->get();
        return view('pages.admin.newclients',compact('list'));
    }
    public function accepteclient($id)
    {
        Client::where('id_Cl', $id)->update([
            'isAccepted' => 1,
        ]);
        return redirect()->route('newclients');
    }
    public function deleteclient($id)
    {
        Client::find($id)->delete();
        return redirect()->route('newclients');
    }
    public function newlivreurs()
    {
        $list= Livreur::where('isAccepted',0)->get();
        return view('pages.admin.newlivreurs',compact('list'));
    }
    public function acceptelivreur($id)
    {
        Livreur::where('id_Liv', $id)->update([
            'isAccepted' => 1,
        ]);
        return redirect()->route('newlivreurs');
    }
    public function deletelivreur($id)
    {
        Livreur::find($id)->delete();
        return redirect()->route('newlivreurs');
    }
}
