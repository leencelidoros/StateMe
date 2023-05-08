<?php
use Smalot\PdfParser\Parser;

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

        $this->pdf = $request->file('pdf_file');

        $parser = new Parser();
        $pdf = $parser->parseFile($this->pdf->getPathname());
        $text = $pdf->getText();

        Log::debug("Extracted text : ", [$text]);

        $pdfDocument = new PdfDocument;
        $pdfDocument->title = $this->pdf->getClientOriginalName();
        $pdfDocument->content = $text;
        $pdfDocument->save();

        $pdfPath = $this->pdf->store('pdf', 'public');

        return redirect()->back()->with('success', 'PDF uploaded successfully')->with('pdf', asset('storage/'.$pdfPath));
    }
}
