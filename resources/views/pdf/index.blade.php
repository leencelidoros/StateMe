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

    <form action="{{ route('pdf.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="pdf_file">Select PDF to upload</label>
            <input type="file" class="form-control-file" name="pdf_file">
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>

    @if (session('pdf'))
        <h3>Uploaded PDF:</h3>
        <div class="pdf-container">
            <div class="pdf-js">
                <object data="{{ session('pdf') }}" type="application/pdf" width="100%" height="500px">
                    <p>Your browser doesn't support PDF viewing. Please download the PDF to view it: <a href="{{ session('pdf') }}">Download PDF</a>.</p>
                </object>
            </div>
        </div>
    @endif
</div>
@endsection
