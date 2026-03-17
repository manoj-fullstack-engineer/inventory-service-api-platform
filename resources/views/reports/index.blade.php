@extends('layouts.master')
@section('top')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<!-- Log on to codeastro.com for more projects! -->
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
<div class="box box-success">

    <div class="box-header">
        <h3 class="box-title">Ledger Entry Report</h3>
    </div>

    <div class="box-header">
        <!-- <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus"></i> Add Ledger Entry</a> -->
        <a href="{{ route('exportPDF.ledgersAll') }}" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export PDF</a>
        <a href="{{ route('exportExcel.ledgersAll') }}" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Export Excel</a>
    </div>

    <div class="box-header">
        <div class="row input-daterange">
            <div class="col-md-4">
                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date (DD/MM/YYYY)" readonly />
            </div>
            <div class="col-md-4">
                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date(DD/MM/YYYY)" readonly />
            </div>
            <div class="col-md-4">
                <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
            </div>
        </div>
    </div>



    <!-- /.box-header -->
    <div class="box-body">
        <table id="ledger-out-table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Sr No.</th>
                    <th>Model</th>
                    <th>Client</th>
                    <th>Status</th>
                    <th>Staff</th>
                    <th>Job Done</th>
                    <th>Parts</th>
                    <th>Amout</th>
                    <th>Mtr Reading</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>

@include('ledgers.form')

@endsection

@section('bot')

<!-- DataTables -->
<script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

<!-- Log on to codeastro.com for more projects! -->
<!-- InputMask -->
<script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('assets/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- bootstrap time picker -->
<script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
{{-- Validator --}}
<script src="{{ asset('assets/validator/validator.min.js') }}"></script>

<!-- <script>
    $(function() {
        // $('#items-table').DataTable()
        $('#invoice').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            'processing': true,
            // 'serverSide'  : true
        })
    })
</script> -->

<script>
    $(function() {

        //Date picker
        $('#date').datepicker({
            autoclose: true,
            // dateFormat: 'yyyy-mm-dd'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    })
</script>

<script type="text/javascript">
    load_data();
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'dd/mm/yyyy',
            autoclose: true
        });

    });


    function load_data(from_date = '', to_date = '') {

        var table = $('#ledger-out-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('api.reports') }}",
                data: {
                    from_date: from_date,
                    to_date: to_date
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'srNo',
                    name: 'srNo'
                },
                {
                    data: 'pmodel',
                    name: 'pmodel'
                },
                {
                    data: 'cust_name',
                    name: 'cust_name'
                },
                {
                    data: 'agrStatus',
                    name: 'agrStatus'
                },
                {
                    data: 'staffName',
                    name: 'staffName'
                },
                {
                    data: 'action_done',
                    name: 'action_done'
                },
                {
                    data: 'partsAndConsumables',
                    name: 'partsAndConsumables'
                },
                {
                    data: 'totalSpent',
                    name: 'totalSpent'
                },
                {
                    data: 'totalReading',
                    name: 'totalReading'
                },
                // {
                //     data: 'action',
                //     name: 'action',
                //     orderable: false,
                //     searchable: false
                // }
            ]
        });
    }



    $('#filter').click(function() {
        var from_date = $('#from_date').val();
        // alert(from_date);
        var to_date = $('#to_date').val();
        if (from_date != '' && to_date != '') {
            $('#ledger-out-table').DataTable().destroy();
            load_data(from_date, to_date);
        } else {
            alert('Both Dates Required');
        }
    });

    $('#refresh').click(function() {
        $('#from_date').val('');
        $('#to_date').val('');
        $('#ledger-out-table').DataTable().destroy();
        load_data();
    });
</script>

@endsection