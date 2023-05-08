@extends('layouts.app')

@section('content')

<div class='container'>
    @if($errors->any())
        <div class="alert alert-danger">
        <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                $endforeach
        </ul>
        </div>                                                                          
    @endif
</div>

    $if(session('success'))
        <div class="alert alert-success">
        {{section('success')}}
        </div>
    @endif


    <form action="{{route('pdf.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="pdf_file">Select pdf to Upload </label>
            <input type="file">
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
@endsection