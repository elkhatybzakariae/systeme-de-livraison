<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Colis;
use App\Models\colisinfo;
use App\Models\Livreur;
use App\Models\Ville;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkProcessor;
use Picqer\Barcode\BarcodeGeneratorPNG;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ColisImport;
class ColisController extends Controller
{
    public function index()
    {
        $colis = Colis::query()->whereNot('status','nouveau')->get();
        $colisinfo = colisinfo::all();
        $breads = [
            ['title' => 'Liste des Colis', 'url' => null],
            ['text' => 'Colis', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.colis.index', compact('colis','breads','colisinfo'));
    }
 
    public function indexAdmin()
    {
        $colis = Colis::query()->whereNot('status','nouveau')->get();
        $status = Colis::query()->select('status')->distinct()->get();
        $breads = [
            ['title' => 'Liste des Colis', 'url' => null],
            ['text' => 'Colis', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.colis.index', compact('colis','status','breads'));
    }
    public function indexRamassage()
    {
        $colis = Colis::query()->where('status','nouveau')->get();
        $breads = [
            ['title' => 'Liste des Colis', 'url' => null],
            ['text' => 'Colis', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];

        return view('pages.clients.colis.indexRamassage', compact('colis','breads'));
    }

    public function create()
    {
        $villes=Ville::all();
        $zones=Zone::all();
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
            'info'=>$colis['code_d_envoi'].','.'non paye'.','.'nouveau'.','.$colis['updated_at'].','.' '.'_',
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
