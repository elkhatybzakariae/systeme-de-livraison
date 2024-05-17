<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\BonDistribution;
use App\Models\Colis;
use App\Models\Livreur;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class LivreurController extends Controller
{
    public function index()
    {
        $breads = [
            ['title' => 'Taleau de bord', 'url' => null],
            ['text' => 'Tableau', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.livreur.dashboard', compact('breads'));
    }
    public function signuppage()
    {
        $zones = Zone::query()->with('ville')->get();
        // dd($zones->ville);
        return view('auth.livreur.sign-up', compact('zones'));
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
            $validation['id_Liv'] = $id_Liv;
            $validation['cinverso'] = $cinverso;
            $validation['cinrecto'] = $cinrecto;
            $validation['RIB'] = $RIB;
            $validation['password'] = Hash::make($validation['password']);
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
    public function allcolis()
    {
        $liv = Auth::id();
        $breads = [
            ['title' => 'Liste des colid', 'url' => null],
            ['text' => 'colis', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        // $colis= BonDistribution::where('id_Liv',$liv)->with('colis')->get();
        // $colis= Colis::where('id_Liv',$liv)->with('colis')->get();
        // $colis = DB::table('colis')
        //     ->join('bon_distributions', 'bon_distributions.id_BD', '=', 'colis.id_BD')
        //     ->where('bon_distributions.id_Liv', $liv)
        //     ->select('colis.*', 'bon_distributions.id_BD')
        //     ->get();
        $colis = Colis::whereHas('bonDistribution', function ($query) use ($liv) {
            $query->where('id_Liv', $liv);
        })->with(['bonDistribution', 'client'])->get();

        // dd($colis);
        return view('pages.livreur.colis.index', compact('colis', 'breads'));
    }
    public function allBD()
    {
        $liv = Auth::id();
        $breads = [
            ['title' => 'Liste des Bons de distributions', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        $bons = BonDistribution::where('id_Liv', $liv)
            ->with('zone', 'colis')
            ->withCount('colis')
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BD = bon_distributions.id_BD) as total_prix'))
            ->leftJoin('colis', 'bon_distributions.id_BD', '=', 'colis.id_BD')
            ->with('colis', 'colis.ville')            
            ->distinct()
            ->get();

        return view('pages.livreur.bonDistribution.index', compact('bons', 'breads'));
    }



    public function showLinkRequestForm()
    {
        return view('auth.livreur.forgot');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = Livreur::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
        }
        $token = Str::random(60);
        $user = Livreur::where('email', $request->email)->
        update([
            'token' => bcrypt($token),
        ]);
        Mail::send('auth.livreur.email', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Your Password Reset Link');
        });

        return back()->with(['status' => 'We have emailed your password reset link!']);
    }
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.livreur.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);
        $user = Livreur::where('email', $request->email)->first();

        // Check if the user exists and if the token is valid
        if (!$user || !Hash::check($request->token, $user->token)) {
            // dd($request->all());
            return back()->withErrors(['email' => 'The provided credentials are incorrect.']);
        }
            
       

        // Reset the user's password
        Livreur::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);


        return redirect()->route('auth.livreur.signIn')->with('status', 'Your password has been reset!');
    }
}
