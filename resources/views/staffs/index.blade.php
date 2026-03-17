@extends('layouts.master')


@section('top')
<!-- DataTables --><!-- Log on to codeastro.com for more projects! -->
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
{{--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">--}}
@include('sweet::alert')
@endsection

@section('content')
<div class="box box-success">

    <div class="box-header">
        <h3 class="box-title">List of Staff</h3>
    </div>

    <div class="box-header">
        @if(Auth::user()->role == "admin")
        <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus"></i> Add Staff</a>
        @else
        <a onclick="addForm()" class="btn btn-success" style="display: none;" ><i class="fa fa-plus"></i> Add Staff</a>
        @endif
        <a href="{{ route('exportPDF.staffsAll') }}" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export PDF</a>
        <a href="{{ route('exportExcel.staffsAll') }}" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Export Excel</a>
    </div>


    <!-- /.box-header -->
    <div class="box-body">
        <table id="staff-table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Designation</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>DOJ</th>
                    <th>DOL</th>
                    <th>Remark</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>


@include('staffs.form')

@endsection

@section('bot')

<!-- DataTables -->
<script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

{{-- Validator --}}
<script src="{{ asset('assets/validator/validator.min.js') }}"></script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>--}}

<!-- {{--<script>--}}
    {{--$(function () {--}}
    {{--$('#items-table').DataTable()--}}
    {{--$('#example2').DataTable({--}}
    {{--'paging'      : true,--}}
    {{--'lengthChange': false,--}}
    {{--'searching'   : false,--}}
    {{--'ordering'    : true,--}}
    {{--'info'        : true,--}}
    {{--'autoWidth'   : false--}}
    {{--})--}}
    {{--})--}}
    {{--</script>--}} -->

<script type="text/javascript">
    var table = $('#staff-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('api.staffs') }}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'staffName',
                name: 'staffName'
            },
            {
                data: 'dob',
                name: 'dob'
            },
            {
                data: 'designation',
                name: 'designation'
            },
            {
                data: 'address',
                name: 'address'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'telephone',
                name: 'telephone'
            },
            {
                data: 'doj',
                name: 'doj'
            },
            {
                data: 'dol',
                name: 'dol'
            },
            {
                data: 'remark',
                name: 'remark'
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
        $('.modal-title').text('Add Staff');
    }

    function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
            url: "{{ url('staffs') }}" + '/' + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#modal-form').modal('show');
                $('.modal-title').text('Edit Staff');

                $('#id').val(data.id);
                $('#staffName').val(data.staffName);
                $('#dob').val(data.dob);
                $('#designation').val(data.designation);
                $('#address').val(data.address);
                $('#email').val(data.email);
                $('#telephone').val(data.telephone);
                $('#doj').val(data.doj);
                $('#dol').val(data.dol);
                $('#remark').val(data.remark);
            },
            error: function() {
                alert("Nothing Data");
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
                url: "{{ url('staffs') }}" + '/' + id,
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
                if (save_method == 'add') url = "{{ url('staffs') }}";
                else url = "{{ url('staffs') . '/' }}" + id;

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
                            title: 'Oops...',
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