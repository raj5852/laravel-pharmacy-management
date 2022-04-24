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
                        <h1 class="m-0">Order Managment</h1>
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
                @if (session()->has('message'))
                    <div class="container">
                        <div class="alert alert-info ">

                            {{ session()->get('message') }}
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col col-md-6 ">
                                <i style="font-size:16px" class="fa">&#xf0ce;</i>

                                Order Managment
                            </div>
                            <div class="col col-md-6" align="right">
                                <a class="btn btn-success" href="{{ route('orderadd') }}"> Add Order</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="order-management">
                            <thead>
                                <tr>
                                    <th>Order No.</th>
                                    <th>Patient Name</th>
                                    <th>Order Amount</th>
                                    <th>Payment Type</th>
                                    <th>Added On</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                        </table>
                    </div>
                    {{-- modal start --}}

                    <div class="modal fade" id="myModal">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Order Edit</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>



                    </div>


                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js-add')
    <script src="{{ asset('js/dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#order-management').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ordermanagement') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'patientname',
                        name: 'patientname'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'type',
                        name: 'type'
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


       
    </script>

@endsection
