@extends('layouts.app')

@section('content')

<div class='container'>
 @if($errors->any())
 <div class="alert alert-danger">
    @foreach($errors)
 </div>
 @endif
</div>
@endsection