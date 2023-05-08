<?php

namespace App\Http\Controllers;

use App\Models\PdfDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\PdfToText\Pdf as PdfToText;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PdfDocumentController extends Controller
{
    private $pdf;

    public function index()
    {
        return view('pdf.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:2048'
        ]);
        $this->pdf->setPdf().get;
        $text = $this->pdf->text();

        $this->pdf = $request->file('pdf_file');
        $pdfPath = $this->pdf->getPathname();

        $pdfToText = new PdfToText($pdfPath);
        $text = $pdfToText->text();

        Log::debug("Extracted text : ", [$text]);

        $pdfDocument = new PdfDocument;
        $pdfDocument->title = $this->pdf->getClientOriginalName();
        $pdfDocument->content = $text;
        $pdfDocument->save();

        $pdfPath = $this->pdf->store('pdf', 'public');

        return redirect()->back()->with('success', 'PDF uploaded successfully')->with('pdf', asset('storage/'.$pdfPath));
    }
}
