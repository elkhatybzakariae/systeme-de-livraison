<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Admin;
use App\Models\BonDistribution;
use App\Models\BonEnvois;
use App\Models\BonLivraison;
use App\Models\BonPaymentLivreur;
use App\Models\BonPaymentZone;
use App\Models\BonRetourClient;
use App\Models\BonRetourLivreur;
use App\Models\BonRetourZone;
use App\Models\Client;
use App\Models\Colis;
use App\Models\colisinfo;
use App\Models\Facture;
use App\Models\Livreur;
use App\Models\Reclamation;
use App\Models\Remarque;
use App\Models\Role;
use App\Models\Ville;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use Twilio\Rest\Client as CL;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        // Count total records
        $query = Colis::query();
        $colis = Helpers::applyDateFilter($query, $request);
        $colis = $colis->count();

        $query = BonLivraison::query();
        $liv = Helpers::applyDateFilter($query, $request);
        $liv = $liv->count();

        $query = BonEnvois::query();
        $env = Helpers::applyDateFilter($query, $request);
        $env = $env->count();

        $query = BonDistribution::query();
        $dis = Helpers::applyDateFilter($query, $request);
        $dis = $dis->count();

        $query = BonPaymentLivreur::query();
        $payLiv = Helpers::applyDateFilter($query, $request);
        $payLiv = $payLiv->count();

        $query = BonRetourClient::query();
        $retourC = Helpers::applyDateFilter($query, $request);
        $retourC = $retourC->count();

        $query = BonRetourLivreur::query();
        $retourL = Helpers::applyDateFilter($query, $request);
        $retourL = $retourL->count();

        $query = BonPaymentZone::query();
        $payZ = Helpers::applyDateFilter($query, $request);
        $payZ = $payZ->count();

        $query = Facture::query();
        $fact = Helpers::applyDateFilter($query, $request);
        $fact = $fact->count();

        $query = Reclamation::query();
        $rec = Helpers::applyDateFilter($query, $request);
        $rec = $rec->count();
        $query = Client::query();
        $cl = Helpers::applyDateFilter($query, $request);
        $cl = $cl->count();

        $query = BonRetourZone::query();
        $retourZ = Helpers::applyDateFilter($query, $request);
        $retourZ = $retourZ->count();

        $clients = Client::all();

        $query = Colis::query();

        if ($request->has('client_id') && $request->client_id) {
            $query->where('id_Cl', $request->client_id);
        }

        $query = Helpers::applyDateFilter($query, $request);
        $statistics = $query->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $statuses = array_keys($statistics);
        $counts = array_values($statistics);


        $query = BonLivraison::query();
        if ($request->has('client_id') && $request->client_id) {
            $query->where('id_Cl', $request->client_id);
        }
        // Apply date filter to BonLivraison
        $query = Helpers::applyDateFilter($query, $request);
        $statistics = $query->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
        $statusesBL = array_keys($statistics);
        $countsBL = array_values($statistics);

        $query = BonEnvois::query();
        $query = Helpers::applyDateFilter($query, $request);
        $statistics = $query->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
        $statusesBE = array_keys($statistics);
        $countsBE = array_values($statistics);

        $query = BonDistribution::query();
        $query = Helpers::applyDateFilter($query, $request);
        $statistics = $query->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
        $statusesBD = array_keys($statistics);
        $countsBD = array_values($statistics);

        $query = BonPaymentLivreur::query();
        $query = Helpers::applyDateFilter($query, $request);
        $statistics = $query->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
        $statusesBPL = array_keys($statistics);
        $countsBPL = array_values($statistics);

        $query = BonRetourClient::query();
        $query = Helpers::applyDateFilter($query, $request);
        $statistics = $query->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
        $statusesBRC = array_keys($statistics);
        $countsBRC = array_values($statistics);

        $query = BonRetourLivreur::query();
        $query = Helpers::applyDateFilter($query, $request);
        $statistics = $query->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
        $statusesBRL = array_keys($statistics);
        $countsBRL = array_values($statistics);

        // Fetch remarques
        $remarques = Remarque::all();

        // Define breadcrumbs
        $breads = [
            ['title' => 'Tableau de bord', 'url' => null],
            ['text' => 'Tableau', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];

        // Return the view with data
        return view('pages.admin.index', compact(
            'breads',
            'remarques',
            'statuses',
            'counts',
            'statusesBL',
            'countsBL',
            'statusesBE',
            'countsBE',
            'statusesBD',
            'countsBD',
            'statusesBPL',
            'countsBPL',
            'statusesBRC',
            'countsBRC',
            'statusesBRL',
            'countsBRL',
            'colis',
            'liv',
            'env',
            'dis',
            'cl',
            'payLiv',
            'retourC',
            'retourL',
            'payZ',
            'fact',
            'clients',
            'rec',
            'retourZ'
        ));
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
                session(["admin" => $u]);
                $url = session('url.intended');
                if ($url) {
                    session(['url' => null]);
                    return redirect()->to($url);
                }
                return redirect()->route('admin.index');
            }
            // dd(Hash::check($request->password, $u->password),$u->password);
        }
        return back()->with('error', 'Invalid email or password.');
    }
    public function signout()
    {
        Auth::logout();
        return redirect()->route('auth.admin.signIn');
    }



    public function newuser()
    {
        // $users = Admin::where('user', Auth::id())->with('referrer')->get();
        $users = Admin::whereNotNull('user')->with('referrals')->get();
        $admins = Admin::where('role', 'Admin')->get();

        // dd($users);
        $villes = Ville::all();
        $zones = Zone::all();
        // $roles = Role::all();, 'roles'
        $breads = [
            ['title' => 'liste des utilisateurs ', 'url' => null],
            ['text' => 'utilisateurs', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.users.index', compact('users', 'admins', 'villes', 'zones', 'breads'));
    }
    public function storenewuser(Request $request)
    {
        $id_Ad = Helpers::generateIdAd();
        $id_A =   session('admin')['id_Ad'];
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
            'role' => 'required|string|max:50',
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
            $validation['password'] = bcrypt($validation['password']);
            // dd($validation);

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
            'password' => 'required|string|min:8',
            'ville' => 'required|string|max:150',
            'adress' => 'required|string|max:150',
            'nombanque' => 'nullable|string|max:50',
            'numerocompte' => 'nullable|string|max:50',
            'role' => 'required|string|max:150',
            'cinrecto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cinverso' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'RIB' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        dd($validation);
        $validation['password'] = Hash::make($validation['password']);

        $admin->update($validation);
        return back()->with('success', 'person mis à jour avec succès !');
    }
    public function updateclient(Request $request, $id)
    {
        $client = Client::find($id);
        $validation = $request->validate([
            'nommagasin' => 'required|string|max:50',
            'nomcomplet' => 'required|string|max:50',
            'cin' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'Phone' => 'nullable|string|max:50',
            'password' => 'required|string|min:8',
            'adress' => 'required|string|max:150',
            'nombanque' => 'nullable|string|max:50',
            'numerocompte' => 'nullable|string|max:50',
        ]);

        $validation['password'] = Hash::make($validation['password']);

        $client->update($validation);
        return back()->with('success', 'person mis à jour avec succès !');
    }
    public function deletenewuser($id)
    {
        Admin::find($id)->delete();
        return back()->with('success', ' ');
    }

    public function clients()
    {
        $users = Client::where('isAdmin', 1)->where('isAccepted', 1)->with('acceptedByA')->get();
        $breads = [
            ['title' => 'liste des  clients ', 'url' => null],
            ['text' => 'Clients', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.clients.index', compact('users', 'breads'));
    }
    public function livreurs()
    {
        $users= Livreur::where('isAccepted',1)->with('zone')->get();
        $breads = [
            ['title' => 'Liste des Livreurs', 'url' => null],
            ['text' => 'livreurs', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.livreur.index',compact('users','breads'));
    }

    public function getsendSMS(Request $request)
    {
        return view('pages.admin.SMS.index');
    }
    public function sendSMS(Request $request)
    {
        $twilio_sid = env('TWILIO_SID');
        $twilio_token = env('TWILIO_TOKEN');
        $twilio_phone_number = env('TWILIO_PHONE_NUMBER');

        $client = new CL($twilio_sid, $twilio_token);

        $message = $client->messages->create(
            $request->input('to'), // Receiver's phone number
            [
                'from' => $twilio_phone_number, // Sender's Twilio phone number
                'body' => $request->input('text') // Message body
            ]
        );

        if ($message->sid) {
            return back()->with('error', 'Message sent successfully');
        } else {
            return back()->with('error', 'Failed to send message');
        }
    }




    public function showLinkRequestForm()
    {
        return view('auth.admin.forgot');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = Admin::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
        }
        $token = Str::random(60);
        $user = Admin::where('email', $request->email)->update([
                'token' => bcrypt($token),
            ]);
        Mail::send('auth.admin.email', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Your Password Reset Link');
        });

        return back()->with(['status' => 'We have emailed your password reset link!']);
    }
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.admin.reset')->with(
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
        $user = Admin::where('email', $request->email)->first();

        // Check if the user exists and if the token is valid
        if (!$user || !Hash::check($request->token, $user->token)) {
            // dd($request->all());
            return back()->withErrors(['email' => 'The provided credentials are incorrect.']);
        }



        // Reset the user's password
        Admin::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);


        return redirect()->route('auth.admin.signIn')->with('status', 'Your password has been reset!');
    }

    public function changestatus(Request $req, $id)
    {
        $colis = Colis::where('id', $id)
            ->update(['status' => $req->status]);
        $coli = Colis::where('id', $id)->first();
        $colisinfo = colisinfo::where('id', $id)->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',' . 'non paye,' . $req->status . ',' . $coli['updated_at'] . ',' . ' ' . '_';

        $colisinfo->update(['info' => $newInfo]);
        return back();
    }
    public function ActiverClient(Request $req, $id)
    {
        $client = Client::find($id);

        if ($client) {
            $client->update([
                'isActive' => 1,
            ]);

            // Success message (consider using a more descriptive message)
            return back()->with('success', 'Client updated successfully!');
        } else {
            // Handle case where Client with the provided ID is not found
            return back()->with('error', 'Client not found!');
        }
    }
    public function DesactiverClient(Request $req, $id)
    {
        $client = Client::find($id);

        if ($client) {
            $client->update([
                'isActive' => 0,
            ]);

            // Success message (consider using a more descriptive message)
            return back()->with('success', 'Client updated successfully!');
        } else {
            // Handle case where Client with the provided ID is not found
            return back()->with('error', 'Client not found!');
        }
    }
}
