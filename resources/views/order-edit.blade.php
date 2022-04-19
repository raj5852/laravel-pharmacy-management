@extends('admin.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Order Management</h1>
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

                <p><a href="{{ route('ordermanagement') }}">Order Management</a> / Edit Order</p>
                <br>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col col-md-6 ">
                                <i style="font-size:16px" class="fa">&#xf0ce;</i>

                                Edit Order
                            </div>
                            <div class="col col-md-6" align="right">
                            </div>
                        </div>

                    </div>
                    <div class="card-body">

                        <form action="">
                            @csrf
                            {{-- <input type="hidden" name="id" id="id" value="{{}}"> --}}
                            <div class="container">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Customer name" value="{{ $datas[0]->patientname }}" autocomplete="off">
                            </div>
                            <br>
                            <table class="table table-bordered" id="location-rack-management">
                                <thead>
                                    <tr>
                                        <th>Sr. </th>
                                        <th>Medicine name</th>
                                        <th>Expiry Dt.</th>

                                        <th>MRP</th>
                                        <th>Qty</th>
                                        <th>Total price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas[0]->orderdetail as  $key=>$value)
                                    <tr>
                                        <td>{{ $key+=1 }}</td>

                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->expiry }}</td>
                                        <td><input class="form-control" type="number" name="unitprice[]" value="{{ $value->unitprice }}"></td>
                                        <td><input class="form-control" type="number" id="quantity" name="quantity[]" value="{{ $value->quantity }}"></td>
                                        <td id="sumprice[]">{{ $value->qusumunit }} </td>
                                        <td><button class="btn btn-danger btn-sm">delete</button></td>
                                    </tr>

                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" align="right"><b>Total</b></td>
                                        <input type="hidden" name="Tl_amount" id="Tl_amount">
                                        <td colspan="2" id="order_total_amount"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                        <button id="demo" class="btn btn-info">click</button>

                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js-add')
    <script>
        $('#order-add').addClass('active');
        var x = $('#quantity').val();
            console.log(x)
        $("#demo").click(function(){

        })
    </script>
@endsection
