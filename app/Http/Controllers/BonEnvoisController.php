<?php

namespace App\Http\Controllers;

use App\Models\BonEnvois;
use App\Models\BonLivraison;
use App\Models\Colis;
use App\Models\Zone;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BonEnvoisController extends Controller
{
    public function index(Request $request ,$id_BE=null) 
    {
        $id_Z = $request->input('zone');
        if($id_Z == null){
            $id_Z=session('zone');
        }else{
            session(['zone'=>$id_Z]);
        }
        // dd(session('zone'));
        $user=session('user');
        $colis =Colis::query()->with('ville')->whereNull('id_BE')->where('zone',$id_Z)->get();

        $colisBon=[];
        // dd($colis);
        if (!$id_BE) {
            if($user ){
                $bonLivraison= BonEnvois::create([
                    'id_BE'=>'BE-'.Str::random(12),
                    'reference'=>'BE-'.Str::random(10),
                    'status'=>'nouveau',
                    // 'id_Cl'=>$user['id_Cl']
                ]);
            }else{
                return redirect(route('auth.client.signIn'));
            }
        }else{
            $bonLivraison= BonEnvois::query()->with('colis')->where('id_BE',$id_BE)->first();
            $colisBon= DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_BE =?',[$id_BE]);
        // dd($colisBon)  ;

        }
        // dd($colis,$colisBon);
        $breads = [
            ['title' => 'créer un Bon Envoi', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonEnvoi.index',compact("colis", "bonLivraison",'colisBon','breads'));
    }
    public function list()
    {
        $user=session('user');
        if(!$user){
            return redirect(route('auth.admin.signIn'));
        }
        $bons = DB::table('bon_envois')
        ->select(
            'bon_envois.id_BE', 
            'bon_envois.reference',  
            'bon_envois.status', 
            'bon_envois.created_at',
            'clients.nomcomplet as client_nomcomplet',
            DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BE = bon_envois.id_BE) as colis_count'),
            DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BE = bon_envois.id_BE) as total_prix')
        )
        ->leftJoin('colis', 'bon_envois.id_BE', '=', 'colis.id_BE')
        ->leftJoin('clients', 'colis.id_Cl', '=', 'clients.id_Cl')
        ->get();
    // $bons=BonEnvois::all();
    // dd($bons);
    $breads = [
        ['title' => 'Liste des Bons d\'Envoi', 'url' => null],
        ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
    ];
        return view('pages.admin.bonEnvoi.list',compact("bons",'breads'));
    } 
    public function create()
    {
        $user=session('user');
        if(!$user){
            return redirect(route('auth.client.signIn'));
        }

  
$zones = Zone::whereHas('colis', function ($query) {
    $query->where('status', 'recu');
})->with('colis')->withCount('colis')->get();

        

        $breads = [
            ['title' => 'créer un Bon Envoi', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        // dd($zones);
        return view('pages.admin.bonEnvoi.create',compact("zones",'breads'));
    } 
       
    public function update($id,$id_BE)
    {
        $colis = Colis::where('id', $id)
        ->update(['id_BE' => $id_BE,'status'=>'distribution']);
        return redirect()->route('bon.envoi.index',$id_BE);
    }    
    public function updateDelete($id,$id_BE)
    {
        $colis = Colis::where('id', $id)
        ->update(['id_BE' => null]);

        // dd($colis);
        return redirect()->route('bon.envoi.index',$id_BE);
    
    }  
     
    public function updateAll(Request $request,$id_BE)
    {
        // dd($request);
        foreach($request->colis as $colis){

            $colis = Colis::where('id', $colis)
            ->update(['id_BE' => $id_BE]);
        }
        return redirect()->route('bon.envoi.index',$id_BE);
    }    
    public function updateDeleteAll(Request $request,$id_BE)
    {
        foreach($request->colisDelete as $colis){

            $colis = Colis::where('id', $colis)
            ->update(['id_BE' => null]);
        }
        return redirect()->route('bon.envoi.index',$id_BE);
    
    }  
    public function generateStikers ($id) {
        // Create a new Dompdf instance
        $dompdf = new Dompdf();
    
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $bon=BonLivraison::where('id_BE',$id)->first();
        $colis=Colis::query()->where('id_BE',$id)->get();
        // dd($colis);
        // Set options
        $dompdf->setOptions($options);
        $html = '
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Colis Sticker</title>
                    <link href="../../../public/storage/assets/home-page/css/bootstrap.min.css" />
                    <style>
                        .sticker {
                            width: 650px;
                            height: 450px;
                            background-color: #fff;
                            border: 1px solid #000;
                            border-radius: 5px;
                            padding: 10px;
                            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
                            font-family: sans-serif;
                            font-size: 14px; 
                        }
                        
                        .sticker .info {
                            display: flex;
                            flex-wrap: wrap;
                        }
                        .sticker .info span {
                            margin-right: 10px;
                        }
                        .sticker .commentaire {
                            font-style: italic;
                        }
                        td {
                            border: #000 2px solid;
                        }
                        .sticker .barcode {
                            text-align: center;
                        }
                        .row {
                            display: flex;
                            flex-wrap: wrap;
                            margin-right: -15px;
                            margin-left: -15px;
                        }
                        .col-4 {
                            flex: 0 0 33.333333%;
                            max-width: 33.333333%;
                            padding-right: 15px;
                            padding-left: 15px;
                        }
                        .col-8 {
                            flex: 0 0 66.666667%;
                            max-width: 66.666667%;
                            padding-right: 15px;
                            padding-left: 15px;
                        }
                        .table {
                            display: table;
                            width: 100%;
                            max-width: 100%;
                            margin-bottom: 1rem;
                            background-color: transparent;
                        }
                    </style>
                </head>
                <body>';

                foreach ($colis as $c) {
                    $html .= '
                    <div class="sticker " style="margin-top:50px;margin-bottom:360px">
                        <div class="row">
                            <div class="col-8">
                                <div class="info">
                                    <span>Date:</span> 2024-05-04
                                </div>
                                <div class="info">
                                    <span>Vendeur:</span> Carol Thompson ( +1 (919) 584-7463 )
                                </div>
                                <table class="table">
                                    <tr>
                                        <td><strong>Destinataire:</strong></td>
                                        <td>' . $c->destinataire . '</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Téléphone:</strong></td>
                                        <td>' . $c->telephone . '</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Adresse:</strong></td>
                                        <td>' . $c->adresse . '</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Commentaire:</strong></td>
                                        <td>' . $c->commentaire . '</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Produit:</strong></td>
                                        <td>' . $c->adresse . '</td>
                                    </tr>
                                </table>
                                <h4 class="fw-bold">ERRAZY LIVRASON</h4>
                                <table class="table">
                                    <tr>
                                        <td colspan="4"><strong>Ramasse</strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>PR</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>IJ</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>RB</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>AN</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>RF</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-4" >
                               
                            </div>
                        </div>
                        <table class="table " style="width: 400px; height: 10px;">
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>Value</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Interdit d\'ouvrir</strong></td>
                                <td><div class="badge">Colis normal</div></td>
                            </tr>
                        </table>
                        <div class="barcode"></div>
                    </div>';
                }

                $html .= '
                </body>
                </html>';

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);
        // dd($dompdf);
        // Render the PDF
        $dompdf->render();
    
        // Output the generated PDF to the browser
        return $dompdf->stream('sample_pdf_with_details.pdf');
    }
    public function generateEtiqueteuse ($id) {
        // Create a new Dompdf instance
        $dompdf = new Dompdf();
    
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $bon=BonLivraison::where('id_BE',$id)->first();
        $colis=Colis::query()->where('id_BE',$id)->get();
        // dd($colis);
        // Set options
        $dompdf->setOptions($options);
        $html = '<html>

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta http-equiv="Content-Style-Type" content="text/css" />
            <meta name="generator" content="Aspose.Words for .NET 24.4.0" />
            <title></title>
            <style type="text/css">
                body {
                    font-family: "Times New Roman";
                    font-size: 12pt
                }
        
                p {
                    margin: 0pt
                }
        
                table {
                    margin-top: 0pt;
                    margin-bottom: 0pt
                }
            </style>
        </head>
        
        <body>';

                foreach ($colis as $c) {
                    $html .= '
                    <div class="sticker " style="margin-top:50px;margin-bottom:360px">
                        <div class="row">
                            <div class="col-8">
                                <div class="info">
                                    <span>Date:</span> 2024-05-04
                                </div>
                                <div class="info">
                                    <span>Vendeur:</span> Carol Thompson ( +1 (919) 584-7463 )
                                </div>
                                <table class="table">
                                    <tr>
                                        <td><strong>Destinataire:</strong></td>
                                        <td>' . $c->destinataire . '</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Téléphone:</strong></td>
                                        <td>' . $c->telephone . '</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Adresse:</strong></td>
                                        <td>' . $c->adresse . '</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Commentaire:</strong></td>
                                        <td>' . $c->commentaire . '</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Produit:</strong></td>
                                        <td>' . $c->adresse . '</td>
                                    </tr>
                                </table>
                                <h4 class="fw-bold">ERRAZY LIVRASON</h4>
                                <table class="table">
                                    <tr>
                                        <td colspan="4"><strong>Ramasse</strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>PR</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>IJ</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>RB</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>AN</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>RF</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-4" >
                               
                            </div>
                        </div>
                        <table class="table " style="width: 400px; height: 10px;">
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>Value</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Interdit d\'ouvrir</strong></td>
                                <td><div class="badge">Colis normal</div></td>
                            </tr>
                        </table>
                        <div class="barcode"></div>
                    </div>';
                }

                $html .= '
                </body>
                </html>';

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);
        // dd($dompdf);
        // Render the PDF
        $dompdf->render();
    
        // Output the generated PDF to the browser
        return $dompdf->stream('sample_pdf_with_details.pdf');
    }

}
