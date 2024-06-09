<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BonEnvois;
use App\Models\BonLivraison;
use App\Models\BonRetourClient;
use App\Models\Client;
use App\Models\Colis;
use App\Models\Facture;
use App\Models\Reclamation;
use App\Models\Remarque;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $idC=Auth::id();
        $colis = Colis::where('id_Cl',$idC)->count();
        $liv = BonLivraison::where('id_Cl',$idC)->count();
        $retourC = BonRetourClient::all()->count();
        $fact = Facture::all()->count();
        $rec = Reclamation::where('id_Cl',$idC)->count();

        
        $query=Colis::query()->where('id_Cl',$idC);
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

        $statistics = $query->selectRaw('status, COUNT(*) as count')
                            ->groupBy('status')
                            ->pluck('count', 'status')
                            ->toArray();

        $statusesBL = array_keys($statistics);
        $countsBL = array_values($statistics);

        $query = BonRetourClient::query()->where('id_Cl',$idC);


        $statistics = $query->selectRaw('status, COUNT(*) as count')
                            ->groupBy('status')
                            ->pluck('count', 'status')
                            ->toArray();

        $statusesBRC = array_keys($statistics);
        $countsBRC = array_values($statistics);

        $query = Reclamation::query();

        $statistics = $query->selectRaw('etat, COUNT(*) as count')
                            ->groupBy('etat')
                            ->pluck('count', 'etat')
                            ->toArray();

        $statusesR = array_keys($statistics);
        $countsR = array_values($statistics);

        $remarques=Remarque::query()->where('cible','Vendeur')->get();

        $breads = [
            ['title' => 'Tableau de bord', 'url' => null],
            ['text' => 'Tableau', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.dashboard' ,compact('breads','colis','liv','retourC','fact','rec','remarques',
        'statuses', 'counts',
        'statusesBL', 'countsBL',
        'statusesBRC', 'countsBRC',
        'statusesR', 'countsR',
    ));
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
            'password' => 'required',
        ]);
        $client = Client::where('email', $request->email)->first();
        // dd($client);
        if ($client) {
            if (Auth::attempt($v) ) {
                
                Auth::login($client);
                session(["client" => $client]);
                $url=session('url.intended');
                if ($url) {
                    session(['url'=>null]);
                    return redirect()->to($url);
                }
                
                return redirect()->route('client.index')->with('success', 'successfull!!!!.');
            }
        }
        return back()->with('error', 'Invalid email or password.');
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
                'isAccepted' => 1,
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
                'isAccepted' => 0,
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





    public function showLinkRequestForm()
    {
        return view('auth.client.forgot');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = Client::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
        }
        $token = Str::random(60);
        $user = Client::where('email', $request->email)->
        update([
            'token' => bcrypt($token),
        ]);
        Mail::send('auth.client.email', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Your Password Reset Link');
        });

        return back()->with(['status' => 'We have emailed your password reset link!']);
    }
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.client.reset')->with(
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
        $user = Client::where('email', $request->email)->first();

        // Check if the user exists and if the token is valid
        if (!$user || !Hash::check($request->token, $user->token)) {
            // dd($request->all());
            return back()->withErrors(['email' => 'The provided credentials are incorrect.']);
        }
            
       

        // Reset the user's password
        Client::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);


        return redirect()->route('auth.client.signIn')->with('status', 'Your password has been reset!');
    }
}
