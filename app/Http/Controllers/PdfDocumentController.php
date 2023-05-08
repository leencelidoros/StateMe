<?php

namespace App\Http\Controllers;

use App\Models\PdfDocument;
use Illuminate\Http\Request;

class PdfDocumentController extends Controller
{
    public function index(){
        return view('pdf.index');
    }

    public function store(Request $request){
        $validated=$request->validate(
           [ 'pdf_file'=>'required|mimes:pdf|max:2048']
        );

        $pdf=$request->file('pdf_file');
        $contents=file_get_contents($pdf->getRealPath());

        $pdf_document = new PdfDocument();
        $pdf_document ->title= file_get_contents($pdf->getC)
    }
}
