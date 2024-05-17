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
use App\Models\BonRetourZone;
use App\Models\Client;
use App\Models\Colis;
use App\Models\Facture;
use App\Models\Livreur;
use App\Models\Reclamation;
use App\Models\Ville;
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
        $colis = Colis::all()->count();
        $liv = BonLivraison::all()->count();
        $env = BonEnvois::all()->count();
        $dis = BonDistribution::all()->count();
        $payLiv = BonPaymentLivreur::all()->count();
        $retourC = BonRetourClient::all()->count();
        $payZ = BonPaymentZone::all()->count();
        $fact = Facture::all()->count();
        $rec = Reclamation::all()->count();
        $cl = Client::all()->count();
        $retourZ = BonRetourZone::all()->count();
        $clients = Client::all();

        // Fetch statistics
        $query = Colis::query();

        if ($request->has('client_id') && $request->client_id) {
            $query->where('id_Cl', $request->client_id);
        }

        $statistics = $query->selectRaw('status, COUNT(*) as count')
                            ->groupBy('status')
                            ->pluck('count', 'status')
                            ->toArray();

        $statuses = array_keys($statistics);
        $counts = array_values($statistics);

        $breads = [
            ['title' => 'Tableau de bord', 'url' => null],
            ['text' => 'Tableau', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.index' ,compact('breads','statuses', 'counts','colis','liv','env','dis','cl','payLiv','retourC','payZ','fact','clients','rec','retourZ'));
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
        // dd($u);
        if ($u) {
            if (Hash::check($request->password, $u->password)) {

                Auth::login($u);
                session(["user" => $u]);
                return redirect()->route('admin.index');
            }
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
        $user = Admin::where('email', $request->email)->
        update([
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
}
