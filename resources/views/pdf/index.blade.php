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

        </div>
        <button type="submi">Upload</button>
    </form>
@endsection