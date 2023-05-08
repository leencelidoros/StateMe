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
    <div></div>
@endif
@endsection