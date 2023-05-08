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
        $contents = file_get_contents($pdf->getRealPath());
        $conv_contents = iconv('ISO-8859-1', 'UTF-8', $contents);
    
        $pdfDocument = new PdfDocument;
        $pdfDocument->title = $pdf->getClientOriginalName();
        $pdfDocument->content = $conv_contents;
        $pdfDocument->save();
    
        $pdfPath = $pdf->store('pdf', 'public');
    
        return redirect()->back()->with('success', 'PDF uploaded successfully')->with('pdf', asset('storage/'.$pdfPath));
    }
    
    // public function store(Request $request){
    //     $validated=$request->validate(
    //        [ 'pdf_file'=>'required|mimes:pdf|max:2048']
    //     );

    //     $pdf=$request->file('pdf_file');
    //     $contents=file_get_contents($pdf->getRealPath());
    //     // $contents = mb_convert_encoding($contents, 'UTF-8', 'auto');
    //     $conv_contents = iconv('ISO-8859-1', 'UTF-8', $contents);

    //     $contents=$conv_contents;
    //     try {
    //         $pdfDocument = new PdfDocument;
    //         $pdfDocument->title = $pdf->getClientOriginalName();
    //         $pdfDocument->content = $contents;
    //         $pdfDocument->save();
    //         //dd(   $pdfDocument);

    //         $pdfPath = public_path('storage/pdf/' . $pdfDocument->id . '.pdf');
    //         file_put_contents($pdfPath, $contents);
    //     } catch (\Exception $e) {

    //         return response()->json(['error' => $e->getMessage()]);
    //     }
        
    //     return redirect()->back()->with('success','pdf uploaded succesfully');
    // }
}
