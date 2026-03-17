{{-- <!doctype html> --}}
{{-- <html lang="en"> --}}
{{-- <head> --}}
{{-- <meta charset="UTF-8"> --}}
{{-- <meta name="viewport" --}}
{{-- content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"> --}}
{{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
{{-- <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css ')}}"> --}}
{{-- <!-- Font Awesome --> --}}
{{-- <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}} "> --}}
{{-- <!-- Ionicons --> --}}
{{-- <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css')}} "> --}}

{{-- <title>Ledger Details Export All PDF</title> --}}
{{-- </head> --}}
{{-- <body> --}}
<style>
    #categories {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #categories td,
    #categories th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #categories tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #categories tr:hover {
        background-color: #ddd;
    }

    #categories th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>
<h1 style="text-align: center;">All Ledger Entries</h1>
<table id="categories" width="100%">
    <thead>
        <tr>
            <td>ID</td>
            <td>Date</td>
            <td>Sr No</td>
            <td>Action</td>
            <td>Done By</td>
            <td>Parts&Consumables</td>
            <td>Spent</td>
            <td>Reading</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($ledgers as $ledger)
            <tr>
                <td>{{ $ledger->id }}</td>
                <td>{{ $ledger->date }}</td>
                <td>{{ $ledger->srNo }}</td>
                <td>{{ $ledger->action_done }}</td>
                <td>{{ $ledger->staff_id }}</td>
                <td>{{ $ledger->partsAndConsumables }}</td>
                <td>{{ $ledger->totalSpent }}</td>
                <td>{{ $ledger->todayReading }}</td>
            </tr>
        @endforeach
    </tbody>

</table>


{{-- <!-- jQuery 3 --> --}}
{{-- <script src="{{  asset('assets/bower_components/jquery/dist/jquery.min.js') }} "></script> --}}
{{-- <!-- Bootstrap 3.3.7 --> --}}
{{-- <script src="{{  asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script> --}}
{{-- <!-- AdminLTE App --> --}}
{{-- <script src="{{  asset('assets/dist/js/adminlte.min.js') }}"></script> --}}
{{-- </body> --}}
{{-- </html> --}}
