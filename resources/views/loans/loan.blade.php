@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>ALL Loans</h1>
        <h6><small><button class="btn btn-success" ><a style="text-decoration:none;color:white;"  href="{{url('/listclient')}}">Filter according to Office</a></button></small></h6>

        <table class="table">
            <thead>
                <tr>
                    <th>#.</th>
                    <th>Client Name.</th>
                    <th>Account No.</th>
                    <th> Loan Product Name.</th>
                    <th>Principal.</th>
                    <th>N0. of Repayments.</th>
                    <!-- <th>Amount Disbursed</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $loan)
                    <tr>
                        <th>{{$loan->id}}</th>
                        <td>{{ $loan->clientName }}</td>
                        <td>{{ $loan->accountNo }}</td>
                        <td>{{ $loan->loanProductName }}</td>
                        <td>{{ $loan->principal }}</td>
                        <td>{{ $loan->repayments }}</td>
                        <!-- <td>{{ $loan->amtDisbursed }}</td> -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
