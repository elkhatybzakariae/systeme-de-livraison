<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Admin;
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
        return view('auth.sign-up');
    }
    // public function signup(Request $request)
    // {
    //     $id_Ad = Helpers::generateIdAd();
    //     $validation = $request->validate([
    //         'email' => 'required|email|max:50',
    //         'password' => 'required|string|min:8',
    //     ]);
    //     if ($request->password === $request->confirmpassword) {
    //         $role = Role::all()[0]->id_R;
    //         // dd($role);
    //         $newuser = User::create([
    //             'id_Ad' => $id_Ad,
    //             'email' => $validation['email'],
    //             'password' => Hash::make($validation['password']),
    //             'id_R' => $role,
    //         ]);
    //         // $type=Role::where('role_name',$validation['usertype'])->first();

    //         // Role_User::create([
    //         //     'id' => $id,
    //         //     'id_Ad' => $newuser->id_Ad,
    //         //     'id_R' => $type->id_R,
    //         // ]);
    //         auth()->login($newuser);
    //         // return redirect()->route('dashboard');
    //         // return redirect()->route('index');
    //         return redirect()->route('index');
    //     } else {
    //         return redirect()->route('auth.signUp');
    //     }
    // }
    public function signinpage()
    {
        return view('auth.sign-in');
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
        return redirect()->route('auth.signIn');
    }
}
