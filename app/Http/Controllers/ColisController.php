<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Imports\ColisImport;
use App\Models\Colis;
use App\Models\colisinfo;
use App\Models\DemandeModificationColi;
use App\Models\Etat;
use App\Models\Livreur;
use App\Models\Option as ModelsOption;
use App\Models\Ville;
use App\Models\Zone;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkProcessor;
use League\Csv\Writer;
use Maatwebsite\Excel\Facades\Excel;
use Picqer\Barcode\BarcodeGeneratorPNG;

class ColisController extends Controller
{
    public function index()
    {
        $id=Auth::id();
        $colis = Colis::query()->where('id_Cl',$id)->with('client','bonLivraison','bonEnvoi','bonDistribution','bonPaymentLivreur','bonPaymentZone')->whereNot('status','nouveau')
            ->orderBy('created_at','desc')
            ->get();        
        $colisstatuss = $colis->pluck('status')->toArray();
        $cl=ModelsOption::query()->orderBy('created_at','desc')->get();
        $etat=Etat::query()->orderBy('created_at','desc')->get();
        // dd($cl);
        // $cl=$colis->getColisWithCouleur($colis->status);
        $colisIds = $colis->pluck('id')->toArray();
        $demandes=DemandeModificationColi::whereIn('id',$colisIds)->get();
        $colisinfo = colisinfo::query()->orderBy('created_at','desc')->get();
        $breads = [
            ['title' => 'Liste des Colis', 'url' => null],
            ['text' => 'Colis', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.colis.index', compact('colis','demandes','cl','etat','breads','colisinfo'));
    }
 
    public function indexAdmin(Request $request)
    {

        $villes = Ville::query()->orderBy('created_at','desc')->get();
        $zones = Zone::query()->orderBy('created_at','desc')->get();

        $query = Colis::query()->whereNot('status','Nouveau')->with(['client','bonLivraison','bonEnvoi','bonDistribution','bonPaymentLivreur','bonPaymentZone']);
        
    
    if ($request->has('client_id') && $request->client_id) {
        $query->where('id_Cl', $request->client_id);
    }
    
    if ($request->has('status_filter') && $request->status_filter) {
        $query->where('status', $request->status_filter);
    }
    
    if ($request->has('etat_filter') && $request->etat_filter) {
        $query->where('etat', $request->etat_filter);
    }
    
    if ($request->has('ville_filter') && $request->ville_filter) {
        $query->where('ville_id', $request->ville_filter);
    }
    
    if ($request->has('zone_filter') && $request->zone_filter) {
        $query->where('zone', $request->zone_filter);
    }

    $colis=Helpers::applyDateFilter($query, $request)->get();
    // dd($colis->get());
        $status = Colis::query()->select('status')->distinct()->get();
        
        $cl=ModelsOption::query()->orderBy('created_at','desc')->get();
        $etat=Etat::query()->orderBy('created_at','desc')->get();
        $breads = [
            ['title' => 'Liste des Colis', 'url' => null],
            ['text' => 'Colis', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.colis.index', compact('colis','cl','etat','status','breads', 'villes', 'zones'));
    }
    public function indexRamassage()
    {
        $colis = Colis::query()->where('status','Nouveau')->get();
        $breads = [
            ['title' => 'Liste des Colis', 'url' => null],
            ['text' => 'Colis', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];

        return view('pages.clients.colis.indexRamassage', compact('colis','breads'));
    }

    public function create()
    {
        $villes=Ville::query()->orderBy('created_at','desc')->get();
        $zones=Zone::query()->orderBy('created_at','desc')->get();
        $breads = [
            ['title' => 'Nouveau Colis', 'url' => null],
            ['text' => 'Nouveau Colis', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.colis.create',compact('zones','villes','breads'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // 'code_d_envoi' => 'required|string|max:255',
            'destinataire' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'marchandise' => 'required|string|max:255',
            'zone' => 'required|string|max:255',
            'ville_id' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            'commentaire' => 'nullable|string',
            'adresse' => 'required|string|max:255',
            'fragile' => 'nullable|boolean',
            'ovrire' => 'nullable|boolean',
            'colis_a_remplacer' => 'nullable|boolean',
        ]);
        
        
        $validatedData['id']=Helpers::generateIdC();
        $validatedData['code_d_envoi'] = 'Colis-' . Str::random(7);
        $validatedData['id_Cl']=session('user')['id_Cl'];
        // $validatedData['id_Cl']=session('user')['id_Cl'];
        // dd($validatedData);
        
        $colis=Colis::create($validatedData);
        colisinfo::create([
            'info'=>$colis['code_d_envoi'].','.'Non Paye'.','.'Nouveau'.','.$colis['updated_at'].','.' '.'_',
            'id'=>$colis['id'],
        ]);
        // $generator = new BarcodeGeneratorPNG();
        // $barcode = base64_encode($generator->getBarcode($colis->id, $generator::TYPE_CODE_128));
        // $bon=Colis::where('id',$colis->id)->update(['barcode'=>$barcode]);
        $bonLivraison=Colis::where('id',$colis->id)->first();
        return redirect()->route('colis.indexRamassage')->with('success', 'Colis created successfully.');
    }

    public function update(Request $request, Colis $colis)
    {
        $validatedData = $request->validate([
            // 'code_d_envoi' => 'required|string|max:255',
            'destinataire' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'marchandise' => 'required|string|max:255',
            'zone' => 'required|string|max:255',
            'ville_id' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            'commentaire' => 'nullable|string',
            'adresse' => 'required|string|max:255',
            'fragile' => 'nullable|boolean',
            'ovrire' => 'nullable|boolean',
            'colis_a_remplacer' => 'nullable|boolean',
        ]);

        $colis->update($validatedData);

        return redirect()->route('colis.indexRamassage')->with('success', 'Colis updated successfully.');
    }


    public function show(Colis $colis)
    {
        return view('colis.show', compact('colis'));
    }

    public function edit(Colis $colis)
    {
        $breads = [
            ['title' => 'Liste des Colis', 'url' => null],
            ['text' => 'Colis', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.colis.edit', compact('colis','breads'));
    }



    public function destroy(Colis $colis)
    {
        $colis->delete();
        return redirect()->route('colis.index')->with('success', 'Colis deleted successfully.');
    }

    public function exportColis()
    {
        $colis = Colis::query()->get();
        $csv = Writer::createFromString('');
        $csv->insertOne(['Code d\'envoi', 'Destinataire', 'Date de creation', 'Prix', 'Ville']);
        foreach ($colis as $colisItem) {
            $csv->insertOne([
                $colisItem->code_d_envoi,
            $colisItem->destinataire,
                $colisItem->created_at,
                $colisItem->prix,
                $colisItem->ville->villename
            ]);
        }
        $fileName = 'colis_all.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        echo $csv->getContent();
    }

    public function showImportPage()
    {
        return view('pages.clients.colis.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file');
        Excel::import(new ColisImport, $file);

        return back()->with('success', 'Colis imported successfully.');
    }

    public function downloadTemplate()
    {
        $path = public_path('storage/excel/template.xlsx');
        return response()->download($path);
    }
}
