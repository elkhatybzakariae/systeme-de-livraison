<?php

namespace App\Http\Controllers;

use App\Models\BonLivraison;
use App\Models\Colis;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use TCPDF;

class HomeController extends Controller
{
    //
    public function index() {
        $breads = [
            ['title' => 'Liste des Colis', 'url' => null],
            ['text' => 'Colis', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.landing.index');
    }
    public function tarifs() {
        return view('pages.landing.tarifs');
    }
    public function option() {
        $breads = [
            ['title' => 'Liste des options', 'url' => null],
            ['text' => 'Options', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.option.index',compact('breads'));
    }
    public function generatePDF()
    {
         // Create new PDF instance
         $pdf = new TCPDF();

         // Set document information, etc.
 
         // Add a page
         $pdf->AddPage();
 
         // Get the HTML content from a Blade view
         $bon=BonLivraison::query()->first();
        $colis=Colis::query()->get();
        $data=[
            'bon'=>$bon,
            'colis'=>$colis
        ];
         $html = view('pages.clients.pdfs.pdf1',$data)->render();

 
        // Path to store the generated PDF
        $pdfPath = storage_path('app/public/sample.pdf');

        // Generate PDF using wkhtmltopdf
        $process = new Process([
            'wkhtmltopdf',
            '-',
            $pdfPath
        ]);

        // Set input and run the process
        $process->setInput($html);
        $process->run();

        // Check if process was successful
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Return a response or redirect to the generated PDF
        return response()->file($pdfPath);
}
}