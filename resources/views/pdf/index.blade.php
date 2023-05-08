@extends('layouts.app')

@section('content')

<div class='container'>
 @if($errors->any())
 <div class="alert alert-danger">
   <ul>
   @foreach($errors as $error)
   $end.forEach((value, index, array) => {})
   </ul>
 </div>
 @endif
</div>
@endsection