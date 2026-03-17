{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--<meta charset="UTF-8">--}}
{{--<meta name="viewport"--}}
{{--content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css ')}}">--}}
{{--<!-- Font Awesome -->--}}
{{--<link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}} ">--}}
{{--<!-- Ionicons -->--}}
{{--<link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css')}} ">--}}

{{--<title>Staff PDF</title>--}}
{{--</head>--}}
{{--<body>--}}
<style>
    #staffs {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #staffs td, #staffs th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #staffs tr:nth-child(even){background-color: #f2f2f2;}

    #staffs tr:hover {background-color: #ddd;}

    #staffs th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>
<h1 style="text-align: center;">Staff List </h1>
<table id="staffs" width="100%">
    <thead>
    
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>DOB</td>
        <td>Designation</td>
        <td>Email</td>
        <td>Phone</td>
    </tr>
    </thead>
    @foreach($staffs as $s)
        <tbody>
        <tr>
            <td>{{ $s->id }}</td>
            <td>{{ $s->staffName }}</td>
            <td>{{ $s->dob }}</td>
            <td>{{ $s->designation }}</td>
            <td>{{ $s->email }}</td>
            <td>{{ $s->telephone }}</td>
        </tr>
        </tbody>
    @endforeach

</table>


{{--<!-- jQuery 3 -->--}}
{{--<script src="{{  asset('assets/bower_components/jquery/dist/jquery.min.js') }} "></script>--}}
{{--<!-- Bootstrap 3.3.7 -->--}}
{{--<script src="{{  asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>--}}
{{--<!-- AdminLTE App -->--}}
{{--<script src="{{  asset('assets/dist/js/adminlte.min.js') }}"></script>--}}
{{--</body>--}}
{{--</html>--}}


    