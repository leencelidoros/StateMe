@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>ALL Clients</h1>
        <h6><small><button class="btn btn-success" ><a style="text-decoration:none;color:white;"  href="{{url('/listclient')}}">Filter according to Office</a></button></small></h6>

        <table class="table">
            <thead>
                <tr>
                    <th>#.</th>
                    <th>Full Name.</th>
                    <th>Account No.</th>
                    <th>Office Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <th>{{$client->id}}</th>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->accountNo }}</td>
                        <td>{{ $client->officeName }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
