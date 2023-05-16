<?php
namespace App\Http\Controllers;

use App\Models\PdfDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Smalot\PdfParser\Parser;

class PdfDocumentController extends Controller
{
    private $pdf;

    public function index()
    {

        $pdfs=PdfDocument::all();
        //dd($pdfs);
        return view('pdf.index',compact('pdfs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mpesa_pdf' => 'required|mimes:pdf|max:2048',
            'bank_pdf' => 'required|mimes:pdf|max:2048'
        ]);

        // Processing the Mpesa data and saving it
        $this->mpesaPDF = $request->file('mpesa_pdf'); 

        $mpesaParser = new Parser();
        $mpesaPDF = $mpesaParser->parseFile($this->mpesaPDF->getPathname());
        $mpesaText = $mpesaPDF->getText();

        Log::debug("Extracted text : ", [$mpesaText]);

        $pdfDocument = new PdfDocument;
        $pdfDocument->title = $this->mpesaPDF->getClientOriginalName();
        $pdfDocument->content = $mpesaText;
        $pdfDocument->save();

        // Mpessa Path
        $mpesaPath= $this->mpesaPDF->store('pdf','public');

         // Processing the Mpesa data and saving it
        $this->bankPDF= $request->file('bank_pdf');

        $bankParser= new Parser();
        $bankPDF = $bankParser->parseFile($this->bankPDF->getPathName());
        $bankText = $bankPDF->getText();

        Log::debug("Extracted text : ", [$bankText]);

        $pdfDocument = new PdfDocument;
        $pdfDocument->title = $this->bankPDF->getClientOriginalName();
        $pdfDocument->content = $bankText;
        $pdfDocument->save();
        
        // Bank Path
        $bankPath =$this->bankPDF->store('pdf','public');
        
        // $pdfPath = $this->pdf->store('pdf', 'public');
        return redirect()->back()->with('success', 'PDFs uploaded successfully')->with('mpesa_pdf', asset('storage/'.$mpesaPath))->with('bank_pdf', asset('storage/'.$bankPath));
    }
}
