@extends('layouts.app')

@section('content')

<div class='container'>
 @if($errors->any())
 <div class="alert alert-danger">
   <ul>
    
   </ul>
 </div>
 @endif
</div>
@endsection