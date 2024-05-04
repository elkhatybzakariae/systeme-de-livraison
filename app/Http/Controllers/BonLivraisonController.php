<?php

namespace App\Http\Controllers;

use App\Models\BonLivraison;
use App\Models\Colis;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BonLivraisonController extends Controller
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
                    'id_BL'=>'BL-'.Str::random(10),
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
        return view('pages.clients.bonLivraison.index',compact("colis", "bonLivraison",'colisBon'));
    }
    public function create()
    {
        $colis = Colis::query()->where('status','nouveau')->get()->count();
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
     
    
    public function generateStikers () {
        // Create a new Dompdf instance
        $dompdf = new Dompdf();
    
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
    
        // Set options
        $dompdf->setOptions($options);

        $html = '<!DOCTYPE html>
                <html lang="en">
                    <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Colis Sticker</title>
                    // 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                    // <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
                .sticker h3, .sticker h4 {
                  margin: 5px 0;
                }
                .sticker .info {
                  display: flex;
                  flex-wrap: wrap;
                  margin-bottom: 5px;
                }
                .sticker .info span {
                  margin-right: 10px;
                }
                .sticker .commentaire {
                  font-style: italic;
                }
                            table,tr,td{
                                border: #000 2px solid;
                            }
                            .sticker .barcode {
                                text-align: center;
                            }
              </style>
                    </head>
                    <body>
                        <div class="sticker m-4">
                            <div class="row">
                                <div class="col-8">
                                    <div class="info">
                                        <span>Date:</span> 2024-05-04
                                    </div>
                                    <div class="info">
                                        <span>Vendeur:</span> Carol Thompson ( +1 (919) 584-7463 )
                                    </div>
                                    <table class="table " style="margin-bottom: 0;">
                                        <tr>
                                            <td><strong>Destinataire:</strong></td>
                                            <td>value</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Destinataire:</strong></td>
                                            <td>value</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Téléphone:</strong></td>
                                            <td>value</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Adresse:</strong></td>
                                            <td>value</td>
                                        </tr>
                                        <tr>
                                            <td><strong>commentaire:</strong></td>
                                            <td>value</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Produit:</strong></td>
                                            <td>value</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-4">
                                    <h4 class="fw-bold ">ERRAZY LIVRASON</h4>
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
                         </div>
            
           
              <table class="table" style="width: 400px;height: 10px;">
								<tr>
									<td ><strong>Total</strong></td>
									<td ><strong>Value</strong></td>
								</tr>
								<tr>
									<td><strong>Interdit d\'ouvrir</strong></td>
									<td><div class="badge">Colis normal</div></td>
								</tr>
							</table>
							<div class="barcode">
							
							</div> 
							
          </div>
        </body>
        </html>
        ';
    
        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);
        // dd($dompdf);
        // Render the PDF
        $dompdf->render();
    
        // Output the generated PDF to the browser
        return $dompdf->stream('sample_pdf_with_details.pdf');
    }
}
