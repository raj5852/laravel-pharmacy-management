@extends('admin.layouts.app')
@section('css-add')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
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
                <p> <a href="{{ route('ordermanagement') }}">Order Management</a> / Add Order</p>
                <br>

                <div class="card mb-4">

                    <div class="card-body">
                        <form action="{{ route('medicineSubmit') }}" method="post" id="form-submit">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <label for="patient_name">Customer Name</label>

                                        <input class="form-control" id="patient_name" type="text"
                                            placeholder="Enter Customer Name " name="patient" required>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floation mb-3">
                                        <label for="rack">Medicine Select</label><br>

                                        <select style="width: 500px!important;" class="livesearch form-control"
                                            name="medicine" id="rack" required></select>



                                    </div>
                                    <br>

                                    <button id="btn-save" class="btn btn-success">
                                        <i style="font-size:16px" class="fa">&#xf067;</i>
                                        Add
                                        Medicine

                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <label for="quantity">Quantity</label>

                                        <input class="form-control" id="quantity" type="number" placeholder="Quantity"
                                            name="quantity" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- id="table_submit" --}}
                        <form method="POST" action="{{ route('medicineSubmit') }}">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th id="aaaa">Medicine</th>

                                            <th>Exipry Date</th>
                                            <th>Quantity</th>
                                            <th>Rack Number</th>
                                            <th>Unit Price</th>
                                            <th>Total Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="order_item_area">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" align="right"><b>Total</b></td>
                                            <input type="hidden" name="Tl_amount" id="Tl_amount">
                                            <td colspan="2" id="order_total_amount"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <label for="">Payment Type</label>
                            <select class="payment_type" name="payment_type">
                                <option value="নগদ">নগদ</option>
                                <option value="বাকি">বাকি</option>
                                <option value="Others">Others</option>
                            </select>
                            <div class="col-md-6">
                                <input style="display: none" type="number" name="baki_message" class="form-control"
                                    id="baki_message" placeholder="Pay amount" value="0">
                            </div>
                            <textarea style="display: none" name="other_details" id="other_details" cols="50" rows="3"
                                placeholder="Write something (optional)"></textarea>

                            <div class="mt-4 mb-0">
                                <input type="hidden" name="order_total_amount" id="hidden_order_total_amount" value="">
                                <input type="submit" id="table-add" name="add_order" class="btn btn-success" value="Add">
                            </div>

                        </form>

                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js-add')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('.livesearch').select2({
            placeholder: 'Select Medicine ',
            ajax: {
                url: '/ordermedicine-search',
                dataType: 'json',
                delay: 50,
                method: 'post',
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#order-add').addClass('active');





        });
        var i = 0;

        var arr = [];

        $("#form-submit").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $("#btn-save").attr("disabled", true);

            $.ajax({
                type: 'POST',
                url: "{{ route('medicineadd') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {

                    ++i;
                    console.log(data)

                    $("#btn-save").attr("disabled", false);
                    if (data.no) {
                        alert(data.no);
                    } else {

                        if (jQuery.inArray(data[1].id, arr) !== -1) {
                            alert('This item has been added.')
                        } else {


                            $("#order_item_area").append(
                                '<tr> <input type="hidden" name="patient[]" value=' + $(
                                    '#patient_name')
                                .val() + ' > <input type="hidden"  name="ids[]" value=' +
                                data[1].id + '><td>' + data[1].name + '</td><td>' + data[1]
                                .expairdate +
                                '</td><td>' + data[0] +
                                '</td> <input type="hidden"  name="quantitys[]" value=' + data[0] +
                                '> <td>' + data[1].rack + '</td><td>' +
                                data[1].saleprice +
                                '</td> <input type="hidden" name="unantunit[]" value=' + data[2] +
                                '> <td  id="card">' + data[2] +
                                '</td><td><button id=' + data[1].id +
                                '  class="btn btn-warning delete-row">Delete</button></td>	</tr>'
                            );
                            arr.push(data[1].id);

                            if (arr.length === 0) {

                                $("#table-add").attr("disabled", true);
                            } else {
                                $("#table-add").attr("disabled", false);
                            }

                        }

                    }

                    money_sum();
                },

            });

        })
        $(document).on('click', '.delete-row', function() {
            $(this).parents("tr").remove();
            money_sum();

            var removeItem = $(this).attr('id');
            arr = jQuery.grep(arr, function(value) {
                return value != removeItem;
            });
            if (arr.length === 0) {

                $("#table-add").attr("disabled", true);
            } else {
                $("#table-add").attr("disabled", false);
            }

        })

        function money_sum() {
            var sum_total_data = 0;

            $("tr #card").each(function(index, value) {
                getEachRow = parseFloat($(this).text());
                sum_total_data += getEachRow
            });

            // document.getElementById('total').innerHTML = sum_total_data;
            $('#order_total_amount').text(sum_total_data);
            $("#Tl_amount").val(sum_total_data);
        }


        //table btn disabled
        if (arr.length === 0) {

            $("#table-add").attr("disabled", true);
        } else {
            $("#table-add").attr("disabled", false);
        }



        $('.payment_type').change(function() {
            // alert($(this).children('option:selected').val())
            var x = $(this).children('option:selected').val();
            if (x == 'বাকি') {
                $("#other_details").css("display", "none");
                $("#baki_message").css("display", "block");
            }
            if (x == 'Others') {
                $("#baki_message").css("display", "none");

                $("#other_details").css("display", "block");
            }
            if (x == 'নগদ') {
                $("#baki_message").css("display", "none");

                $("#other_details").css("display", "none");
            }
        })
        
    </script>
@endsection
