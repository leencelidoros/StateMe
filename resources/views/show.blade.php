@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Client Listing</h1>
        <table>
        <thead>
            <tr>
               <th colspan="2" ></th> {{-- empty cell to align with office id column --}}
                <th >#.</th>
                <th >Full Name.</th>
                <!-- <th >mobile No.</th> -->
                <th >Account No.</th>
              
            </tr>
        </thead>
    <tbody>
        @foreach($groupedUsers as $officeName => $clients)
            <tr>
               <td colspan="2"></td> {{-- empty cell to span two columns --}}
                <td class="office-name" style="background-color: #f0f0f0; padding: 10px; ">{{ $officeName }} </td>
                <td colspan="2"></td> {{-- empty cell to span two columns --}}
            </tr>
            @foreach($clients as $user)
                <tr class="client-row">
                    <td colspan="2" ></td> {{-- empty cell to align with office id column --}}
                    
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->mobileNo }}</td>
                    <td>{{ $user->accountNo }}</td>
                    
                   
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

    </div>
    <script>
    $(document).ready(function() {
        console.log('jQuery code is running');
        $('.office-name').click(function() {
            console.log('Office name clicked');
            var clientRows = $(this).closest('tr').nextUntil('tr:has(.office-name)');
            console.log('Client rows:', clientRows);
            clientRows.toggle();
        });
    });
</script>


@endsection
