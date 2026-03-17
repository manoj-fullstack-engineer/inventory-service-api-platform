@extends('layouts.master')
@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- Log on to codeastro.com for more projects! -->
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="box box-success">

        <div class="box-header">
            <h3 class="box-title">Outgoing/Sales List</h3>
        </div>

        <div class="box-header">
            @if (Auth::user()->role == 'admin')
                <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus"></i> Add New Sales/Outgoing Product</a>
            @else
                <a onclick="addForm()" class="btn btn-success" style="display: none;"><i class="fa fa-plus"></i> Add New
                    Sales/Outgoing Product</a>
            @endif
            <a href="{{ route('exportPDF.productKeluarAll') }}" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i>
                Export PDF</a>
            <a href="{{ route('exportExcel.productKeluarAll') }}" class="btn btn-primary"><i class="fa fa-file-excel-o"></i>
                Export Excel</a>
        </div>
        {{-- <div class="box-header">
            <div class="row input-daterange">
                <div class="col-md-4">
                    <input type="text" name="from_date" id="from_date" class="form-control"
                        placeholder="From Date (DD/MM/YYYY)" readonly />
                </div>
                <div class="col-md-4">
                    <input type="text" name="to_date" id="to_date" class="form-control"
                        placeholder="To Date(DD/MM/YYYY)" readonly />
                </div>
                <div class="col-md-4">
                    <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                    <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                </div>
            </div>
        </div> --}}

        <!-- /.box-header -->
        <div class="box-body">
            <table id="products-out-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date(Y-M-D)</th>
                        <th>Time</th>
                        <th>Customer</th>
                        <th>Products</th>
                        <th>Amount</th>
                        <th>By Staff</th>
                        <th>Remark</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>


    <!--
        <div class="box box-success col-md-6">

            <div class="box-header">
                <h3 class="box-title">Export Boucher</h3>
            </div>

            {{-- <div class="box-header"> --}}
            {{-- <a onclick="addForm()" class="btn btn-primary" >Add Products Out</a> --}}
            {{-- <a href="{{ route('exportPDF.productKeluarAll') }}" class="btn btn-danger">Export PDF</a> --}}
            {{-- <a href="{{ route('exportExcel.productKeluarAll') }}" class="btn btn-success">Export Excel</a> --}}
            {{-- </div> --}}

            
            <div class="box-body">
                <table id="invoice" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Products</th>
                            <th>Customer</th>
                            <th>Qty.</th>
                            <th>Date</th>
                            <th>Issuing Staff</th>
                            <th>Desc</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    {{-- @foreach ($invoice_data as $i) --}}
                    {{-- <tbody>
                <td>{{ $i->id }}</td>
                <td>{{ $i->partsAndConsumables }}</td>
                <td>{{ $i->customer->nama }}</td>
                <td>{{ $i->qty }}</td>
                <td>{{ $i->tanggal }}</td>
                <td>{{ $i->staff->staffName }}</td>
                <td>{{ $i->desc }}</td>
                <td>
                    <a href="{{ route('exportPDF.productKeluar', [ 'id' => $i->id ]) }}" class="btn btn-sm btn-danger">Export Invoice</a>
                </td>
            </tbody>
            @endforeach --}}
                </table>
            </div>
           
        </div> -->

    @include('product_keluar.form')
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
    <script src="{{ asset('assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}">
    </script>
    <!-- bootstrap time picker -->
    <script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    <script>
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
    </script>

    <script>
        $(function() {

            //Date picker
            $('#tanggal').datepicker({
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
        var table = $('#products-out-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.productsOut') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },

                {
                    data: 'tanggal',
                    name: 'tanggal'
                },

                {
                    data: 'productIssueTime',
                    name: 'productIssueTime'
                },
                {
                    data: 'customer_name',
                    name: 'customer_name'
                },
                {
                    data: 'partsAndConsumables',
                    name: 'partsAndConsumables'
                },

                {
                    data: 'totalAmount',
                    name: 'totalAmount'
                },
               
                {
                    data: 'staffName',
                    name: 'staffName'
                },
                {
                    data: 'desc',
                    name: 'desc'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Add Sales/Outgoing Products');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('productsOut') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Products');
                    $('#id').val(data.id);
                    $('#tanggal').val(data.tanggal);
                    $('#productIssueTime').val(data.productIssueTime);
                    $('#customer_id').val(data.customer_id);
                    $('#partsAndConsumables').val(data.partsAndConsumables);
                    $('#totalAmount').val(data.totalAmount);
                    $('#staff_id').val(data.staff_id);
                    $('#desc').val(data.desc);

                },
                error: function() {
                    alert("No Data Available");
                }
            });
        }

        function deleteData(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(function() {
                $.ajax({
                    url: "{{ url('productsOut') }}" + '/' + id,
                    type: "POST",
                    data: {
                        '_method': 'DELETE',
                        '_token': csrf_token
                    },
                    success: function(data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    },
                    error: function() {
                        swal({
                            title: 'Oops...',
                            text: data.message,
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            });
        }

        $(function() {
            $('#modal-form form').validator().on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('productsOut') }}";
                    else url = "{{ url('productsOut') . '/' }}" + id;

                    $.ajax({
                        url: url,
                        type: "POST",
                        //hanya untuk input data tanpa dokumen
                        //                      data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error: function(data) {
                            swal({
                                title: 'No/Invalid Outgoing/Sales Items',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                    return false;
                }
            });
        });
    </script>
@endsection
