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
