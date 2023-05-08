<?php

namespace App\Http\Controllers;

use App\Models\PdfDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\PdfToText\Pdf as PdfToText;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PdfDocumentController extends Controller
{
    pru $pdf;
    public function index(){
       return view('pdf.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:2048'
        ]);

        $this->$pdf = $request->file('pdf_file');
        $pdfPath = $this->$pdf->getPathname();

        $pdfToText = new PdfToText($pdfPath);
        $text = $pdfToText->text();

        Log::debug("Extracted text : ",[$text]);

        $pdfDocument = new PdfDocument;
        $pdfDocument->title = $pdf->getClientOriginalName();
        $pdfDocument->content = $text;
        $pdfDocument->save();

        $pdfPath = $pdf->store('pdf', 'public');

        return redirect()->back()->with('success', 'PDF uploaded successfully')->with('pdf', asset('storage/'.$pdfPath));
    }
}
