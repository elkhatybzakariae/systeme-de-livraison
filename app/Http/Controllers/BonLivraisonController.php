<?php

namespace App\Http\Controllers;

use App\Models\BonLivraison;
use App\Models\Colis;
use App\Models\colisinfo;
use Carbon\Exceptions\EndLessPeriodException;
use Dompdf\Dompdf;

use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use League\Csv\Writer;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
use PDF;
use Picqer\Barcode\BarcodeGeneratorPNG;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use TCPDF;

class BonLivraisonController extends Controller
{
    public function index($id_BL = null)
    {
        $user = session('user');
        // $colis = DB::select('select * from colis 
        //              inner join villes on villes.id_V = colis.ville_id 
        //              where id_BL is null and status= nouveau and id_Cl=?', [$user['id_Cl']]);
        $colis = Colis::where('id_BL', null)
            ->where('status', 'nouveau')
            ->with('ville') // Eager load related city information (optional)
            ->get();

        $colisBon = [];
        // dd($colis);
        if (!$id_BL) {
            if ($user) {

                $bonLivraison = BonLivraison::create([
                    'id_BL' => 'BL-' . Str::random(12),
                    'reference' => 'BL-' . Str::random(10),
                    'status' => 'nouveau',
                    'id_Cl' => $user['id_Cl']
                ]);
            } else {
                return redirect(route('auth.client.signIn'));
            }
        } else {
            $bonLivraison = BonLivraison::query()->with('colis')->where('id_BL', $id_BL)->first();
            $colisBon = DB::select('select * from colis 
            inner join villes on villes.id_V = colis.ville_id 
            where id_BL =?', [$id_BL]);
        }
        // dd($bonLivraison)  ;
        // dd($colis,$colisBon);
        $breads = [
            ['title' => 'créer un Bon Livraison', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.bonLivraison.index', compact("colis", "bonLivraison", 'colisBon', 'breads'));
    }
    public function list()
    {
        $user = session('user');
        if (!$user) {
            return redirect(route('auth.admin.signIn'));
        }
        $bons = BonLivraison::withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('clients', 'bon_livraisons.id_Cl', '=', 'clients.id_Cl')
            ->select('bon_livraisons.*', 'clients.nomcomplet as client_nomcomplet')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BL = bon_livraisons.id_BL) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BL = bon_livraisons.id_BL) as total_prix'))
            ->leftJoin('colis', 'bon_livraisons.id_BL', '=', 'colis.id_BL')
            ->with('colis', 'colis.ville')
            ->distinct()
            ->get();

        $breads = [
            ['title' => 'Liste des Bon Livraison', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonLivraison.index', compact("bons", 'breads'));
    }

    public function create()
    {
        $user = session('user');
        if (!$user) {
            return redirect(route('auth.client.signIn'));
        }
        $breads = [
            ['title' => 'Creér un Bon Livraison', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        $colis = Colis::query()->where('id_BL', null)->where(['id_Cl' => $user['id_Cl'], 'status' => 'nouveau'])->get()->count();
        return view('pages.clients.bonLivraison.create', compact("colis", 'breads'));
    }

    public function update($id, $id_BL)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BL' => $id_BL, 'status' => 'Attente de Ramassage']);
        $coli = Colis::where('id', $id)->first();
        $colisinfo = colisinfo::where('id', $id)->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',non paye,Attente de Ramassage,' . $coli['updated_at'] .','.' '.'_';

        $colisinfo->update(['info' => $newInfo]);

        return redirect()->route('bon.livraison.index', $id_BL);
    }
    public function destroy($id)
    {
        $bon = BonLivraison::find($id);
        $bon->delete();
        return redirect()->route('bon.livraison.list')->with('success', 'bon deleted successfully.');
    }
    public function recu($id_BL)
    {
        Colis::where('id_BL', $id_BL)
            ->update(['status' => 'Ramasse']);
        BonLivraison::where('id_BL', $id_BL)
            ->update(['status' => 'Ramasse']);
        $coli = Colis::where('id_BL', $id_BL)->first();
        $colisinfo = colisinfo::where('id', $coli['id'])->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',non paye,Ramasse,' . $coli['updated_at'] .','.' '.'_';

        $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('bon.livraison.list');
    }
    public function updateDelete($id, $id_BL)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BL' => null, 'status' => 'nouveau']);
        return redirect()->route('bon.livraison.index', $id_BL);
    }

    public function updateAll(Request $request, $id_BL)
    {
        // dd($request->input('query'));
        if ($request->input('query')) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_BL' => $id_BL, 'status' => 'Attente de Ramassage']);
        } else {


            foreach ($request->colis as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BL' => $id_BL, 'status' => 'Attente de Ramassage']);
            }
        }
        return redirect()->route('bon.livraison.index', $id_BL);
    }
    public function updateDeleteAll(Request $request, $id_BL)
    {
        if ($request->query) {
            $colis = Colis::where('id', $request->input('query'))
                ->update(['id_BL' => null, 'status' => 'nouveau']);
        } else {
            foreach ($request->colisDelete as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BL' => null, 'status' => 'nouveau']);
            }
        }
        return redirect()->route('bon.livraison.index', $id_BL);
    }



    public function exportColis($id_BL)
    {
        $colis = Colis::where('id_BL', $id_BL)->get();
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
        $fileName = 'colis_' . $id_BL . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        echo $csv->getContent();
    }
    public function getPdf($id)
    {
        // $bon = BonDistribution::where('id_BD', $id)->first();
        $bon = BonLivraison::where('bon_livraisons.id_BL', $id) // Specify the table for id_BL
            ->withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            // ->leftJoin('livreurs', 'bon_livraisons.id_Liv', '=', 'l.ivreurs.id_Liv')
            ->leftJoin('colis', 'bon_livraisons.id_BL', '=', 'colis.id_BL')
            // ->leftJoin('colis', 'colis.zone', '=', 'zones.id_Z')
            // ->select('bon_livraisons.*', 'livreurs.nomcomplet as liv_nom', 'livreurs.Phone as liv_tele', 'zones.zonename as liv_zone')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BL = bon_livraisons.id_BL) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BL = bon_livraisons.id_BL) as prix_total')) // Corrected table name (BL -> BD)
            // ->with('colis', 'colis.ville')
            ->first();

        // dd($bon);
        $colis = Colis::query()->where('id_BL', $id)->get();
        $data = [
            'bon' => $bon,
            'colis' => $colis
        ];
        $dompdf = new Dompdf();
        // 
        //     // Load the HTML content into Dompdf
        $html = view('pages.admin.bonLivraison.getPdf', $data)->render();
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon' . $bon->id_BD . '.pdf');
    }
    public function generateEtiqueteuse($id)
    {
        // Create a new Dompdf instance
        $dompdf = new Dompdf();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $bon = BonLivraison::where('id_BL', $id)->first();
        $colis = Colis::input('query')()->where('id_BL', $id)->get();
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
            </style>
        </head>
        
        <body>
            <div style="border: 1px solid black;">
                <div style="display: grid;grid-template-columns: auto auto;">
                    <div>
                        <div style=" margin: 10px; padding: 10px;">
                            <span>Vendeur:</span>
                            <span>CarolThompson</span><br>
                            <span>Date:</span>
                            <span>2024-05-04 16:02</span>
                        </div>
                    </div>
                    <div>
                        <div style="margin: 10px; padding: 10px;">Livraison</div>
                    </div>
                </div>
                <table cellspacing="0" cellpadding="0"
                    style="border:1pt solid #000000; width: 100%; -aw-border:0.5pt single; -aw-border-insideh:0.5pt single #000000; -aw-border-insidev:0.5pt single #000000; border-collapse:collapse">
                    <tr style="height:15.6pt; -aw-height-rule:exactly">
                        <td
                            style="width:36pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single">
                            <p style="font-size:8pt"><span style="font-family:Calibri">Destinataire</span></p>
                        </td>
                        <td
                            style="width:105.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
                            <p style="font-size:8pt"><span style="font-family:Calibri">Fiiiiiiiiii</span></p>
                        </td>
                    </tr>
                    <tr style="height:18.65pt; -aw-height-rule:exactly">
                        <td
                            style="width:36pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                            <p style="font-size:8pt"><span style="font-family:Calibri">Telephone</span></p>
                        </td>
                        <td
                            style="width:82.35pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border:0.5pt single">
                            <p style="font-size:8pt"><span style="font-family:Calibri">0777777777</span></p>
                        </td>
                    </tr>
                    <tr style="height:18.2pt; -aw-height-rule:exactly">
                        <td
                            style="width:36pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                            <p style="font-size:8pt"><span style="font-family:Calibri">Adresse</span></p>
                        </td>
                        <td
                            style="width:105.75pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border:0.5pt single">
                            <p style="font-size:8pt"><span style="font-family:Calibri">kkkkkkkk</span></p>
                        </td>
                    </tr>
                    <tr style="height:18.2pt; -aw-height-rule:exactly">
                        <td
                            style="width:36pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                            <p style="font-size:8pt"><span style="font-family:Calibri">Ville</span></p>
                        </td>
                        <td
                            style="width:105.75pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border:0.5pt single">
                            <p style="font-size:8pt"><span style="font-family:Calibri">fes</span></p>
                        </td>
                    </tr>
                    <tr style="height:18.2pt; -aw-height-rule:exactly">
                        <td
                            style="width:36pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                            <p style="font-size:8pt"><span style="font-family:Calibri">Commentaire</span></p>
                        </td>
                        <td
                            style="width:105.75pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border:0.5pt single">
                            <p style="font-size:8pt"><span style="font-family:Calibri">ccccccccccc</span></p>
                        </td>
                    </tr>
                    <tr style="height:18.2pt; -aw-height-rule:exactly">
                        <td
                            style="width:36pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                            <p style="font-size:8pt"><span style="font-family:Calibri">Produit</span></p>
                        </td>
                        <td
                            style="width:105.75pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border:0.5pt single">
                            <p style="font-size:8pt"><span style="font-family:Calibri">llllllllllll</span></p>
                        </td>
                    </tr>
                    <tr style="height:18.2pt; -aw-height-rule:exactly">
                        <td
                            style="width:36pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                            <p style="font-size:8pt"><span style="font-family:Calibri">Ouvrir</span></p>
                        </td>
                        <td
                            style="width:105.75pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border:0.5pt single">
                            <p style="font-size:8pt"><span style="font-family:Calibri">non</span></p>
                        </td>
                    </tr>
                    <tr style="height:18.2pt; -aw-height-rule:exactly">
                        <td
                            style="width:36pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                            <p style="font-size:8pt"><span style="font-family:Calibri">Crbt :</span></p>
                        </td>
                        <td
                            style="width:105.75pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border:0.5pt single">
                            <p style="font-size:8pt"><span style="font-family:Calibri">632 Dhs</span></p>
                        </td>
                    </tr>
                </table> <br>
            </div>
        </body>
        
        </html>';

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);
        // dd($dompdf);
        // Render the PDF
        $dompdf->render();

        // Output the generated PDF to the browser
        return $dompdf->stream('Ettiquettes-' . $bon->id_BL . '.pdf');
    }

    public function generateStikers($id)
    {
        // Create a new Dompdf instance
        $dompdf = new Dompdf();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $bon = BonLivraison::where('id_BL', $id)->first();
        $colis = Colis::query()->where('id_BL', $id)->get();
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
        return $dompdf->stream('Stikers-' . $bon->id_BL . '.pdf');
    }
    public function generateFacture($id)
    {
        $bon = BonLivraison::where('id_BL', $id)->first();
        $colis = Colis::query()->where('id_BL', $id)->get();
        $data = [
            'bon' => $bon,
            'colis' => $colis
        ];
        $dompdf = new Dompdf();
        // 
        //     // Load the HTML content into Dompdf
        $html = view('pages.admin.livraiosn.getPdf', $data)->render();
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon-' . $bon->id_BL . '.pdf');
    }
}
