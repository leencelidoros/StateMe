<?php

namespace App\Http\Controllers;

use App\Models\PdfDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PdfDocumentController extends Controller
{
    public function index(){
       return view('pdf.index');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:2048'
        ]);
    
        $pdf = $request->file('pdf_file');

        $text = shell_exec("pdftotext {$pdf->getRealPath()} -");
        Log::debug("Ex")

        $pdfDocument = new PdfDocument;
        $pdfDocument->title = $pdf->getClientOriginalName();
        $pdfDocument->content =$text ;
        $pdfDocument->save();
    
        $pdfPath = $pdf->store('pdf', 'public');
    
        return redirect()->back()->with('success', 'PDF uploaded successfully')->with('pdf', asset('storage/'.$pdfPath));
    }
}
