<?php

namespace App\Http\Controllers;

use App\Models\BonLivraison;
use App\Models\Colis;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BonEnvoisController extends Controller
{
    public function index($id_BL=null) 
    {
        $user=session('user');
        $colis = DB::select('select * from colis 
                     inner join villes on villes.id_V = colis.ville_id 
                     where id_BL is null and id_Cl=?', [$user['id_Cl']]);

        $colisBon=[];
        // dd($colis);
        if (!$id_BL) {
            if($user ){
                $bonLivraison= BonLivraison::create([
                    'id_BL'=>'BL-'.Str::random(12),
                    'reference'=>'BL-'.Str::random(10),
                    'status'=>'nouveau',
                    'id_Cl'=>$user['id_Cl']
                ]);
            }else{
                return redirect(route('auth.client.signIn'));
            }
        }else{
            $bonLivraison= BonLivraison::query()->with('colis')->where('id_BL',$id_BL)->first();
            $colisBon= DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_BL =?',[$id_BL]);
            // dd($colisBon)  ;

        }
        // dd($colis,$colisBon);
        return view('pages.clients.bonLivraison.index',compact("colis", "bonLivraison",'colisBon'));
    }
    public function list()
    {
        $user=session('user');
        if(!$user){
            return redirect(route('auth.admin.signIn'));
        }
        $bons = DB::table('bon_livraisons')
            ->select('bon_livraisons.id_BL', 'bon_livraisons.reference', 'bon_livraisons.id_Cl', 'bon_livraisons.status', 'bon_livraisons.created_at')
            ->leftJoin('clients', 'bon_livraisons.id_Cl', '=', 'clients.id_Cl')
            ->select('bon_livraisons.*', 'clients.nomcomplet as client_nomcomplet')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BL = bon_livraisons.id_BL) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BL = bon_livraisons.id_BL) as total_prix'))
            ->get();
    // dd($bons);
        return view('pages.admin.bonLivraison.index',compact("bons"));
    } 
    public function create()
    {
        $user=session('user');
        if(!$user){
            return redirect(route('auth.client.signIn'));
        }

        $colis = Colis::query()->where('id_BL',null)->where('id_Cl',$user['id_Cl'])->get()->count();
        return view('pages.clients.bonLivraison.create',compact("colis"));
    } 
       
    public function update($id,$id_BL)
    {
        $colis = Colis::where('id', $id)
        ->update(['id_BL' => $id_BL]);
        return redirect()->route('bon.livraison.index',$id_BL);
    }    
    public function updateDelete($id,$id_BL)
    {
        $colis = Colis::where('id', $id)
        ->update(['id_BL' => null]);
        return redirect()->route('bon.livraison.index',$id_BL);
    
    }  
     
    
    public function generateStikers ($id) {
        // Create a new Dompdf instance
        $dompdf = new Dompdf();
    
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $bon=BonLivraison::where('id_BL',$id)->first();
        $colis=Colis::query()->where('id_BL',$id)->get();
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
        $bon=BonLivraison::where('id_BL',$id)->first();
        $colis=Colis::query()->where('id_BL',$id)->get();
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

}
