@extends('layouts.app')

@section('content')

<div class='container'>
 @if($errors->any())
 <div class="alert alert-danger">

 </div>
 @endif
</div>
@endsection