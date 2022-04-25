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
                        <h1 class="m-0">সকল বাকি অর্ডার</h1>
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

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col col-md-6 ">
                                <i style="font-size:16px" class="fa">&#xf0ce;</i>

                                সকল বাকি অর্ডার
                            </div>
                            <div class="col col-md-6" align="right">

                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="baki-order">
                            <thead>
                                <tr>
                                    <th>Order No.</th>
                                    <th>Patient Name</th>
                                    <th>Order Amount</th>
                                    <th>Payment Type</th>
                                    <th>বাকি আছে</th>
                                    <th>Added On</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <!-- boostrap company model -->
                <div class="modal fade" id="order-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="RackModel"></h4>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('remainingeditsubmit') }}"  >
                                    @csrf
                                    <input type="hidden" name="getId" id="id" >
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Order No.</th>
                                                <th>Patient Name</th>
                                                <th>Order Amount</th>
                                                <th>Payment Type</th>
                                                <th>বাকি আছে</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th id="orderId"></th>
                                                <th id="name"></th>
                                                <th id="orderAmount"></th>
                                                <th>
                                                    <select name="paymentType[]" id="">
                                                        <option value="বাকি">বাকি</option>
                                                        <option value="নগদ">নগদ</option>
                                                    </select>
                                                </th>
                                                <th id="baki"></th>
                                            </tr>
                                        </tbody>

                                    </table>
                                    <input type="submit" class="btn btn-success">
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
    <script>
        $(document).ready(function() {
            $('#order-add').addClass('active')

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#baki-order').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('remainingorders') }}",
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
                        data: 'bike',
                        name: 'bike'
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

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('remainingedit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {

                    $('#order-modal').modal('show');
                    $('#id').val(res.id);
                    $('#orderId').html(res.id)
                    $('#name').html(res.patientname)
                    $('#orderAmount').html(res.amount)
                    $('#baki').html(res.bike)
                    console.log(res);


                }
            });
            // console.log('sa')
        }
    </script>
@endsection
