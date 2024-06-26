<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\BonDistribution;
use App\Models\BonPaymentLivreur;
use App\Models\BonRetourLivreur;
use App\Models\Colis;
use App\Models\colisinfo;
use App\Models\Etat;
use App\Models\Livreur;
use App\Models\Option;
use App\Models\Remarque;
use App\Models\typeBank;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class LivreurController extends Controller
{
    public function index(Request $request)
    {
        $idLiv = Auth::id();

        $query = Colis::query()
        ->leftJoin('bon_distributions','colis.id_BD','bon_distributions.id_BD')
        ->leftJoin('livreurs','bon_distributions.id_Liv','livreurs.id_Liv')
        ->where('livreurs.id_Liv',$idLiv)
        ;

        $query=Helpers::applyDateFilter($query,$request,'colis.');
        $statistics = $query->selectRaw('colis.status, COUNT(*) as count')
                            ->groupBy('colis.status')
                            ->pluck('count', 'status')
                            ->toArray();

        $statuses = array_keys($statistics);
        $counts = array_values($statistics);

        $query = BonDistribution::query() 
        ->leftJoin('livreurs','bon_distributions.id_Liv','livreurs.id_Liv')
        ->where('livreurs.id_Liv',$idLiv);
        $query=Helpers::applyDateFilter($query,$request,'bon_distributions.');
        $statistics = $query->selectRaw('status, COUNT(*) as count')
                            ->groupBy('status')
                            ->pluck('count', 'status')
                            ->toArray();
        $statusesBD = array_keys($statistics);
        $countsBD = array_values($statistics);

        $query = BonPaymentLivreur::query() 
        ->leftJoin('livreurs','bon_payment_livreurs.id_Liv','livreurs.id_Liv')
        ->where('livreurs.id_Liv',$idLiv);
        $query=Helpers::applyDateFilter($query,$request,'bon_payment_livreurs.');
        $statistics = $query->selectRaw('status, COUNT(*) as count')
                            ->groupBy('status')
                            ->pluck('count', 'status')
                            ->toArray();
        $statusesBPL = array_keys($statistics);
        $countsBPL = array_values($statistics);
        $query = BonRetourLivreur::query()
        ->leftJoin('livreurs','bon_retour_livreurs.id_Liv','livreurs.id_Liv')
        ->where('livreurs.id_Liv',$idLiv);

        $query=Helpers::applyDateFilter($query,$request,'bon_retour_livreurs.');
        $statistics = $query->selectRaw('status, COUNT(*) as count')
                            ->groupBy('status')
                            ->pluck('count', 'status')
                            ->toArray();
        $statusesBRL = array_keys($statistics);
        $countsBRL = array_values($statistics);

        $colisStatus = Colis::query()
        ->select('colis.status', DB::raw('count(*) as total'))
        ->leftJoin('bon_distributions','colis.id_BD','bon_distributions.id_BD')
        ->leftJoin('livreurs','bon_distributions.id_Liv','livreurs.id_Liv')
        ->where('livreurs.id_Liv',$idLiv)
        ->groupBy('colis.status')
        ->orderBy('colis.status')
        ;

        $colisStatus=Helpers::applyDateFilter($colisStatus,$request,'colis.');
        $colisStatus=$colisStatus->get();

        $remarques = Remarque::query()->where('cible', 'Livreur')->get();

        $breads = [
            ['title' => 'Taleau de bord', 'url' => null],
            ['text' => 'Tableau', 'url' => null], ];
       
        return view('pages.livreur.dashboard', compact(
            'breads','remarques', 
            'statuses', 'counts','colisStatus',
            'statusesBD', 'countsBD',
            'statusesBPL', 'countsBPL',
            'statusesBRL', 'countsBRL',
        ));
    }
    public function signuppage()
    {
        $zones = Zone::query()->with('ville')->get();
        $banks = typeBank::all();
        // dd($zones->ville);
        return view('auth.livreur.sign-up', compact('zones','banks'));
    }
    public function signup(Request $request)
    {
        $id_Liv = Helpers::generateIdLiv();
        $validation = $request->validate([
            'nomcomplet' => 'required|string|max:50',
            'cin' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'Phone' => 'required|string|max:50',
            'ville' => 'required|string|max:150',
            'id_Z' => 'required',
            'adress' => 'required|string|max:150',
            'fraislivraison' => 'required|integer',
            'fraisrefus' => 'required|integer',
            'nombanque' => 'nullable|string|max:50',
            'numerocompte' => 'nullable|string|max:50',
            'password' => 'required|string|min:8',
            'confirmpassword' => 'required|string|min:8',
            'cinrecto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cinverso' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'RIB' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->password === $request->confirmpassword) {
            if ($request->file('cinrecto')) {
                $file = $request->file('cinrecto');
                $cinrecto = time() . '_' . $file->getClientOriginalName();
                $path = public_path('imgs'); 
                $file->move($path, $cinrecto);        
                $validation['cinrecto'] = $cinrecto;  
            }
            if ($request->file('cinverso')) {
                $file = $request->file('cinverso');
                $cinverso = time() . '_' . $file->getClientOriginalName();
                $path = public_path('imgs'); 
                $file->move($path, $cinverso);        
                $validation['cinverso'] = $cinverso;
            }
            if ($request->file('RIB')) {
                $file = $request->file('RIB');
                $RIB = time() . '_' . $file->getClientOriginalName();
                $path = public_path('imgs'); 
                $file->move($path, $RIB);        
                $validation['RIB'] = $RIB;
            }
            $validation['id_Liv'] = $id_Liv;
            $validation['password'] = Hash::make($validation['password']);
            // dd($validation);
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
            'password' => 'required|string',
        ]);
        
        $Livreur = Livreur::where('email', $request->email)->first();
        if ($Livreur) {
            if (Hash::check($request->password, $Livreur->password)) {
                
                Auth::login($Livreur);
                session(["livreur" => $Livreur]);
                $url = session('url.intended');
                if ($url) {
                    // dd($url);
                    session(['url' => null]);
                    return redirect()->to($url);
                }
                // dd($url);
                return redirect()->route('livreur.index');
            }
        } 
        return back()->with('error', 'Invalid email or password.');
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
            ['title' => 'Liste des colis', 'url' => null],
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

        $cl = Option::query()->orderBy('created_at', 'desc')->get();
        $etat = Etat::query()->orderBy('created_at', 'desc')->get();
        // dd($colis);
        return view('pages.livreur.colis.index', compact('colis', 'cl', 'etat', 'breads'));
    }

    public function changestatus(Request $req, $id)
    {
        $livId = Auth::id();
        $livreur = Livreur::find($livId, ['Phone', 'nomcomplet']);

        $breads = [
            ['title' => 'Liste des colis', 'url' => null],
            ['text' => 'colis', 'url' => null],
        ];
        if ($req->status == 'Livre') {
            Colis::where('id', $id)
                ->update(['etat' => 'Paye']);
            $dt = 'Paye,Livre';
        } else {
            $dt = 'Non Paye,' . $req->status;
        }
        if ($req->cmt == '') {
            $cmt = '';
        } else {
            $cmt = 'Commentaire:' . $req->cmt;
        }
        $info = 'Livreur:' . $livreur->nomcomplet . '<br>Telephone:' . $livreur->Phone . '<br>' . $cmt;
        $colis = Colis::where('id', $id)
            ->update(['status' => $req->status]);
        $coli = Colis::where('id', $id)->first();
        $colisinfo = colisinfo::where('id', $id)->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',' . $dt . ',' . $coli['updated_at'] . ',' . $info . '_';

        $colisinfo->update(['info' => $newInfo]);

        return back();
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
        $user = Livreur::where('email', $request->email)->update([
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
            // dd($request->query()->orderBy('created_at','desc')->get());
            return back()->withErrors(['email' => 'The provided credentials are incorrect.']);
        }



        // Reset the user's password
        Livreur::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);


        return redirect()->route('auth.livreur.signIn')->with('status', 'Your password has been reset!');
    }
}
