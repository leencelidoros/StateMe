<?php

namespace App\Http\Controllers;

use App\Models\PdfDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use mikehaertl\pdftk\Pdf as Pdftk;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
        $pdfPath = $pdf->getPathname();
        $pdftk = new Pdftk($pdfPath);
        $dataFields = $pdftk->getDataFields();

        if(is_array($dataFields)){
            else
        }
        $text = '';
        foreach ($dataFields as $fieldName => $fieldValue) {
            if ($fieldName == 'Metadata') {
                $text .= $fieldValue;
            } else {
                $text .= "\n" . $fieldName . ': ' . $fieldValue;
            }
        }
        Log::debug("Extracted text : ",[$text]);

        $pdfDocument = new PdfDocument;
        $pdfDocument->title = $pdf->getClientOriginalName();
        $pdfDocument->content = $text;
        $pdfDocument->save();

        $pdfPath = $pdf->store('pdf', 'public');

        return redirect()->back()->with('success', 'PDF uploaded successfully')->with('pdf', asset('storage/'.$pdfPath));
    }

}
