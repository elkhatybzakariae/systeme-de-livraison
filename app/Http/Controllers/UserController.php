<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role_User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class UserController extends Controller
{
public function index(){
    return view('pages.admin.index');
}
    // public function redirectToGoogle()
    // {
    //     return Socialite::driver('google')->redirect();
    // }

    // public function handleGoogleCallback()
    // {
    //     $id_U = Helpers::generateIdU();
    //     $id = Helpers::generateIdUR();
    //     $googleUser = Socialite::driver('google')->user();
    //     $user = User::where('Email', $googleUser->email)->first();
    //     if ($user) {
    //         if ($user->roles->contains('role_name', 'client')) {
    //             Auth::login($user);
    //             return redirect()->route('index');
    //         } else {
    //             Auth::login($user);
    //             return redirect()->route('home2');
    //         }
    //         // dd($user->roles->contains('role_name', 'client'));
    //     } else {
    //         $fullname = explode(" ", $googleUser['name']);
    //         $newUser = User::create([
    //             'id_U' => $id_U,
    //             'FirstName' => $fullname[0],
    //             'LastName' => $fullname[1],
    //             'Email' => $googleUser->email,
    //             'Password' => bcrypt(Str::random(16)),
    //         ]);
    //         // dd($newUser);
    //         Role_User::create([
    //             'id' => $id,
    //             'id_U' => $newUser->id_U,
    //             'id_R' => "3",
    //         ]);

    //         // Auth::login($newUser);

    //         if ($newUser->roles->contains('role_name', 'client')) {
    //             Auth::login($newUser);
    //             return redirect()->route('index');
    //         } else {
    //             Auth::login($newUser);
    //         }
    //     }

    //     return redirect()->route('dashboard');
    // }

    // public function dashboard()
    // {
    //     return view('auth.dashboard');
    // }
    // public function profile()
    // {
    //     $id = Auth::id();
    //     $profile = User::find($id);
    //     return view('auth.profile', compact('profile'));
    // }
    // public function update(Request $req)
    // {
    //     $validation = $req->validate([
    //         'FirstName' => 'required|string|max:50',
    //         'LastName' => 'required|string|max:50',
    //         // 'Phone' => 'required|string|max:50',
    //     ]);
    //     $id = Auth::id();
    //     $profile = User::find($id);
    //     if ($profile) {
    //         $profile->update($req->all());

    //         return redirect()->route('profile', $profile->id_U)->with('success', 'Record updated successfully.');
    //     } else {
    //         return redirect()->route('profile', $profile->id_U)->with('error', 'profile not found.');
    //     }
    // }


    public function signuppage()
    {
        // $roles = Role::all();, compact('roles')
        return view('auth.sign-up');
    }
    public function signup(Request $request)
    {
        $id_U = Helpers::generateIdU();
        // $id = Helpers::generateIdUR();
        $validation = $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|string|min:8',
        ]);
        if ($request->password === $request->confirmpassword) {
            $newuser = User::create([
                'id_U' => $id_U,
                'email' => $validation['email'],
                'password' => Hash::make($validation['password']),
                'id_R' => 1,
            ]);
            // $type=Role::where('role_name',$validation['usertype'])->first();

            // Role_User::create([
            //     'id' => $id,
            //     'id_U' => $newuser->id_U,
            //     'id_R' => $type->id_R,
            // ]);
            auth()->login($newuser);
            // return redirect()->route('dashboard');
            // return redirect()->route('index');
            return redirect()->route('index');
        } else {
            return redirect()->route('signuppage');
        }
    }
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
        $u = User::where('email', $request->email)->first();
        if ($u) {
            if (Hash::check($request->password, $u->password)) {
                // Authentication was successful
                // auth()->login($u);
                // return redirect()->route('dashboard'); // Redirect to the intended page after login
                // if ($u->roles->contains('role_name', 'client')) {
                //     Auth::login($u);
                //     return redirect()->route('index');
                // } else {
                Auth::login($u);
                // }

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
        return redirect()->route('signinpage');
    }


    // public function gestiondescomptes()
    // {
    //     $users = User::where('id_U', '!=', auth()->id())->get();
    //     return view('auth.superadmin.index', compact('users'));
    // }
    // public function edituser($id)
    // {
    //     // $user = User::find($id);
    //     $user = Role_User::where('id_U', $id)->first();
    //     $roles = Role::all();
    //     return view('auth.superadmin.edit', compact('user', 'roles'));
    // }
    // public function updateuser(Request $req, $id)
    // {
    //     $user = Role_User::where('id_U', $id);
    //     $user->update([
    //         'id_R' => $req->id_R,
    //     ]);
    //     return redirect()->route('gestiondescomptes');
    // }
}
