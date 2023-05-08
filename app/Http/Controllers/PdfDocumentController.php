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
        // $contents = mb_convert_encoding($contents, 'UTF-8', 'auto');
        $conv_contents = iconv('ISO-8859-1', 'UTF-8', $contents);

        if($conv_contents == false){
            \Log::error('Failed to convert into UTF_8 encoding')
        }

        try {
            $pdfDocument = new PdfDocument;
            $pdfDocument->title = $pdf->getClientOriginalName();
            $pdfDocument->content = $contents;
            $pdfDocument->save();
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()]);
        }
        
        return redirect()->back()->with('success','pdf uploaded succesfully');
    }
}
