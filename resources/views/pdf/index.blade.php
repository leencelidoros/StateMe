@extends('layouts.app')

@section('content')

<div class='container'>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- <form action="{{ route('pdf.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="pdf_file">Select PDF to upload</label>
            <input type="file" class="form-control-file" name="pdf_file">
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form> -->

    <form action="{{ route('pdf.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
       <div class="row">
       <div class="form-group col-sm-6">
            <label for="mpesa_pdf">M-Pesa PDF:</label>
            <input type="file" class="form-control-file" name="mpesa_pdf">
        </div>
        <div class="form-group col-sm-6">
            <label for="bank_pdf">Bank PDF:</label>
            <input type="file" class="form-control-file" name="bank_pdf">
        </div>
       </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>

    @if (session('mpesa_pdf') || session('bank_pdf'))
        <h3>Uploaded PDF:</h3>
        <div class="row">
      
            <div class="pdf-js col-sm-6">
           
                <object data="{{ session('mpesa_pdf') }}" type="application/pdf" width="100%" height="150px">
                    <p>Your browser doesn't support PDF viewing. Please download the PDF to view it: <a href="{{ session('pdf') }}">Download PDF</a>.</p>
                </object>
                
            </div>
            <div class="pdf-js col-sm-6">
      
                <object data="{{ session('bank_pdf') }}" type="application/pdf" width="100%" height="150px">
                    <p>Your browser doesn't support PDF viewing. Please download the PDF to view it: <a href="{{ session('pdf') }}">Download PDF</a>.</p>
                </object>
               
            </div>
        </div>
    @endif

    <h3>Exracted Data:</h3>
</div>
@endsection
