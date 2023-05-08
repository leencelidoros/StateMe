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
}
