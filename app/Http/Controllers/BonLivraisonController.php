<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\BonLivraison;
use App\Models\Colis;
use App\Models\colisinfo;
use App\Models\Etat;
use App\Models\Option;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use League\Csv\Writer;


class BonLivraisonController extends Controller
{
    public function index($id_BL = null)
    {
        $user = session('client');
        // $colis = DB::select('select * from colis 
        //              inner join villes on villes.id_V = colis.ville_id 
        //              where id_BL is null and status= nouveau and id_Cl=?', [$user['id_Cl']]);
        $colis = Colis::where('id_BL', null)
            ->where('status', 'Nouveau')
            ->where('id_Cl', $user['id_Cl'])
            ->with('ville')
            ->get();

        $colisBon = [];
        if (!$id_BL) {
            if ($user) {

                $bonLivraison = BonLivraison::create([
                    'id_BL' => 'BL-' . Str::random(12),
                    'reference' => 'BL-' . Str::random(10),
                    'status' => 'Nouveau',
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
        $breads = [
            ['title' => 'créer un Bon Livraison', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.bonLivraison.index', compact("colis", "bonLivraison", 'colisBon', 'breads'));
    }
    public function list()
    {
        
        $bons = BonLivraison::withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('clients', 'bon_livraisons.id_Cl', '=', 'clients.id_Cl')
            ->select('bon_livraisons.*', 'clients.nomcomplet as client_nomcomplet')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BL = bon_livraisons.id_BL) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BL = bon_livraisons.id_BL) as total_prix'))
            ->leftJoin('colis', 'bon_livraisons.id_BL', '=', 'colis.id_BL')
            ->with('colis', 'colis.ville')
            ->distinct()
            ->orderBy('created_at','desc')
            ->get();

            $cl=Option::all();
            $etat=Etat::all();
        $breads = [
            ['title' => 'Liste des Bon Livraison', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.bonLivraison.index', compact("bons",'cl','etat', 'breads'));
    }
    public function getClientBons()
    {
        $user = session('client');
        $bons = BonLivraison::withCount('colis') // Count related colis
            ->withSum('colis', 'prix') // Sum prices of related colis
            ->leftJoin('clients', 'bon_livraisons.id_Cl', '=', 'clients.id_Cl')
            ->select('bon_livraisons.*', 'clients.nomcomplet as client_nomcomplet')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BL = bon_livraisons.id_BL) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BL = bon_livraisons.id_BL) as total_prix'))
            ->leftJoin('colis', 'bon_livraisons.id_BL', '=', 'colis.id_BL')
            ->with('colis', 'colis.ville')
            ->where('clients.id_Cl',$user['id_Cl'])
            ->distinct()
            ->get();

            $cl=Option::all();
            $etat=Etat::all();
        $breads = [
            ['title' => 'Liste des Bon Livraison', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.bonLivraison.list', compact("bons",'cl','etat', 'breads'));
    }

    public function create()
    {
        $user = session('client');
        
        $breads = [
            ['title' => 'Creér un Bon Livraison', 'url' => null],
            ['text' => 'Bons', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        $colis = Colis::query()->where('id_BL', null)->where(['id_Cl' => $user['id_Cl'], 'status' => 'Nouveau'])->get()->count();
        return view('pages.clients.bonLivraison.create', compact("colis", 'breads'));
    }

    public function update($id, $id_BL)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BL' => $id_BL, 'status' => 'Attente de Ramassage']);
        $coli = Colis::where('id', $id)->first();
        $colisinfo = colisinfo::where('id', $id)->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',Non Paye,Attente de Ramassage,' . $coli['updated_at'] .','.' '.'_';

        $colisinfo->update(['info' => $newInfo]);

        return redirect()->route('bon.livraison.index', $id_BL);
    }
    public function destroy($id)
    {
        $bon = BonLivraison::find($id);
        $bon->delete();
        return redirect()->back()->with('success', 'bon deleted successfully.');
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
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',Non Paye,Ramasse,' . $coli['updated_at'] .','.' '.'_';

        $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('bon.livraison.list');
    }
    public function nonrecu($id_BL)
    {
        Colis::where('id_BL', $id_BL)
            ->update(['status' => 'Attente de Ramassage']);
        BonLivraison::where('id_BL', $id_BL)
            ->update(['status' => 'Nouveau']);
        $coli = Colis::where('id_BL', $id_BL)->first();
        $colisinfo = colisinfo::where('id', $coli['id'])->first();
        $oldinfo = $colisinfo['info'];
        $newInfo = $oldinfo . $coli['code_d_envoi'] . ',Non Paye,Attente de Ramassage,' . $coli['updated_at'] .','.' '.'_';

        $colisinfo->update(['info' => $newInfo]);
        return redirect()->route('bon.livraison.list');
    }
    public function updateDelete($id, $id_BL)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BL' => null, 'status' => 'Nouveau']);
        return redirect()->route('bon.livraison.index', $id_BL);
    }
    public function updateDeleteColis($id)
    {
        $colis = Colis::where('id', $id)
            ->update(['id_BL' => null, 'status' => 'Nouveau']);
        return redirect()->route('bon.livraison.list');
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
                ->update(['id_BL' => null, 'status' => 'Nouveau']);
        } else {
            foreach ($request->colisDelete as $colis) {

                $colis = Colis::where('id', $colis)
                    ->update(['id_BL' => null, 'status' => 'Nouveau']);
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
    public function getPdfColis($id,$idC)
    {
        $bon = BonLivraison::where('bon_livraisons.id_BL', $id) // Specify the table for id_BL
            ->withCount('colis') 
            ->withSum('colis', 'prix')
            ->leftJoin('clients', 'clients.id_Cl', '=', 'bon_livraisons.id_Cl')
            ->leftJoin('colis', 'bon_livraisons.id_BL', '=', 'colis.id_BL')
            ->select('clients.nomcomplet as nomcomplet','clients.Phone as telephone','bon_livraisons.*')
             ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BL = bon_livraisons.id_BL) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BL = bon_livraisons.id_BL) as prix_total')) // Corrected table name (BL -> BD)
            ->first();
        $colis = Colis::query()
        ->where('id', $idC)->get();
        $img = Helpers::base64Image();
        $data = [
            'bon' => $bon,
            'colis' => $colis,
            'img'=>$img
        ];
        $dompdf = new Dompdf();
        
        $html = view('pages.admin.bonLivraison.getPdf', $data)->render();
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon-' . $bon->id_BL . '.pdf');
    }
    public function getPdf($id)
    {
        $bon = BonLivraison::where('bon_livraisons.id_BL', $id) // Specify the table for id_BL
            ->withCount('colis') 
            ->withSum('colis', 'prix')
            ->leftJoin('clients', 'clients.id_Cl', '=', 'bon_livraisons.id_Cl')
            ->leftJoin('colis', 'bon_livraisons.id_BL', '=', 'colis.id_BL')
            ->select('clients.nomcomplet as nomcomplet','clients.Phone as telephone','bon_livraisons.*')
             ->addSelect(DB::raw('(SELECT COUNT(*) FROM colis WHERE colis.id_BL = bon_livraisons.id_BL) as colis_count'))
            ->addSelect(DB::raw('(SELECT SUM(prix) FROM colis WHERE colis.id_BL = bon_livraisons.id_BL) as prix_total')) // Corrected table name (BL -> BD)
            ->first();
        $colis = Colis::query()->where('id_BL', $id)->get();
        $img = Helpers::base64Image();
        $data = [
            'bon' => $bon,
            'colis' => $colis,
            'img'=>$img
        ];
        $dompdf = new Dompdf();
        
        $html = view('pages.admin.bonLivraison.getPdf', $data)->render();
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon-' . $bon->id_BL . '.pdf');
    }
    public function generateEtiqueteuseColis($id,$id_BL)
    {
      
        $bon = BonLivraison::where('id_BL', $id_BL)->first();
        $colis = Colis::query()->where('id', $id)->get();
       
        $img = Helpers::base64Image();
        $data = [
            'bon' => $bon,
            'colis' => $colis,
            'img'=>$img
        ];
        $dompdf = new Dompdf();
        
        $html = view('pages.clients.bonLivraison.stickers', $data)->render();
        $dompdf->loadHtml($html);
        $customPaper = array(0, 0, 250, 250); 
        $dompdf->setPaper($customPaper, 'portrait');
        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon-' . $bon->id_BL . '.pdf');
    }
    public function generateStikersColis($id,$id_BL)
    {
      
        $bon = BonLivraison::where('id_BL', $id_BL)->first();
        $colis = Colis::query()->where('id', $id)->get();
       
        $img = Helpers::base64Image();
        $data = [
            'bon' => $bon,
            'colis' => $colis,
            'img'=>$img
        ];
        $dompdf = new Dompdf();
        
        $html = view('pages.clients.bonLivraison.tickets', $data)->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon-' . $bon->id_BL . '.pdf');
    }
    public function generateEtiqueteuse($id)
    {
      
        $bon = BonLivraison::where('id_BL', $id)->first();
        $colis = Colis::query()->where('id_BL', $id)->get();
       
        $img = Helpers::base64Image();
        $data = [
            'bon' => $bon,
            'colis' => $colis,
            'img'=>$img
        ];
        $dompdf = new Dompdf();
        
        $html = view('pages.clients.bonLivraison.stickers', $data)->render();
        $dompdf->loadHtml($html);
        $customPaper = array(0, 0, 250, 250); 
        $dompdf->setPaper($customPaper, 'portrait');
        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon-' . $bon->id_BL . '.pdf');
    }
    public function generateStikers($id)
    {
      
        $bon = BonLivraison::where('id_BL', $id)->first();
        $colis = Colis::query()->where('id_BL', $id)->get();
       
        $img = Helpers::base64Image();
        $data = [
            'bon' => $bon,
            'colis' => $colis,
            'img'=>$img
        ];
        $dompdf = new Dompdf();
        
        $html = view('pages.clients.bonLivraison.tickets', $data)->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        // Render the PDF
        $dompdf->render();
        return $dompdf->stream('bon-' . $bon->id_BL . '.pdf');
    }

   
}
