<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfDocumentController extends Controller
{
    public function index(){
        return view('pdf.index');
    }

    public function store(Request $request){
        $request->validate(
            'pdf_documment'
        )
    }
}
