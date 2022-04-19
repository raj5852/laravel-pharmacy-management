@extends('admin.layouts.app')
@section('css-add')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/dataTables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Location Rack Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col col-md-6 ">
                                <i style="font-size:16px" class="fa">&#xf0ce;</i>

                                Location Rack Management
                            </div>
                            <div class="col col-md-6" align="right">
                                <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create Rack</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="location-rack-management">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Location Rack Name</th>

                                    <th>Date & Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <!-- boostrap company model -->
                <div class="modal fade" id="rack-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="RackModel"></h4>
                            </div>
                            <div class="modal-body">
                                <form action="javascript:void(0)" id="RackForm" name="RackForm" class="form-horizontal"
                                    method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" id="id" minlength="8" required>
                                    <div class="form-group">
                                        <label for="name">
                                            <p>Location Rack Name:</p>
                                        </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter Rack Name" maxlength="50" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary" id="btn-save">Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end bootstrap model -->














            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js-add')
    <script src="{{ asset('js/dataTables.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#location-rack-management').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('tablemanagement') }}",
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            });


        });

        function add() {
            $('#RackForm').trigger("reset");
            $('#RackModel').html("Add Rack");
            $('#rack-modal').modal('show');
            $('#id').val('');

        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('tableedit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#RackModel').html("Edit Rack");
                    $('#rack-modal').modal('show');
                    $('#id').val(res.id);
                    $('#name').val(res.name);

                }
            });

        }

        function deleteFunc(id) {
            if (confirm("Delete Record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ route('tabledelete') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        var oTable = $('#location-rack-management').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        }

        $('#RackForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('tablestore') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#rack-modal").modal('hide');
                var oTable = $('#location-rack-management').dataTable();
                oTable.fnDraw(false);
                $("#btn-save").html('Submit');
                $("#btn-save").attr("disabled", false);
            },
            error: function(data) {
                console.log(data);
            }
        });
    });


    </script>
@endsection
