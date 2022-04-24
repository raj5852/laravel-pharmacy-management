@extends('admin.layouts.app')
@section('css-add')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/dataTables.min.css') }}" rel="stylesheet">
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
                        <h1 class="m-0">Medicine Purchase Management</h1>
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

                                Medicine Purchase Management
                            </div>
                            <div class="col col-md-6" align="right">
                                <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Add Medicine</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="location-rack-management">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Medicine Name</th>
                                    <th>Company</th>
                                    <th>Quantity</th>
                                    <th>Rack Number</th>
                                    <th>Supplier Name</th>
                                    <th>Price per Unit</th>
                                    <th>Sale Price</th>
                                    <th>Total Cost</th>
                                    <th>Expiry Date</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                {{-- modal --}}
                <div class="modal fade" id="medicine-modal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 id="MedicineTitle" class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="javascript:void(0)" id="MedicineForm">
                                    <input type="hidden" name="id" id="id" minlength="8" required>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floation mb-3">
                                                <label for="name">Medicine Name:</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    placeholder="Medicine Name" autocomplete="off" required>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floation mb-3">
                                                <label for="company">Company</label>
                                                <input type="text" name="company" id="company" class="form-control"
                                                    placeholder="Company Name" autocomplete="off" required>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floation mb-3">
                                                <label for="quantity">Medicine Quantity:</label>
                                                <input type="number" name="quantity" id="quantity" class="form-control"
                                                    placeholder="Medicine Quantity"  autocomplete="off" min="0" step=".01"  required>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floation mb-3">
                                                <label for="rack">Medicine Rack</label>


                                                        <select style="width: 370px!important;" class="livesearch form-control " name="rack" id="rack" ></select>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floation mb-3">
                                                <label for="supplier">Supplier name:</label>
                                                <input type="text" name="supplier" id="supplier" class="form-control"
                                                    placeholder="Supplier Name"  autocomplete="off"  required>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floation mb-3">
                                                <label for="priceperunit">price per unit</label>
                                                <input type="number" min="0" name="priceperunit" id="priceperunit"
                                                    class="form-control"  autocomplete="off" placeholder="Medicine price per unit:" step=".01" required>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-floation mb-3">
                                                <label for="sale">Sale per price:</label>
                                                <input type="number" min="0" name="sale" id="sale" class="form-control"
                                                    placeholder="Sale price" step=".01" autocomplete="off" required>

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floation mb-3">
                                                <label for="cost">Total cost</label>
                                                <input type="number" min="0" name="cost" id="cost" class="form-control"
                                                    placeholder="Total cost:" step=".01" autocomplete="off" required>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floation mb-3">
                                                <label for="datepicker">Products expiry date</label>
                                                <input type="date" id="datepicker" name="datepicker" class="form-control"
                                                    placeholder="Expiry date" autocomplete="off"  required>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        {{-- <button class="btn btn-success" type="submit">Save</button> --}}
                                        <input id="btn-save" type="submit" name="submit" class="btn btn-success"
                                            value="Save">
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>


                        </div>
                    </div>

                </div>

                {{-- end modal --}}


                {{-- modal 2 --}}
                <div class="modal fade" id="perchase-modal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 id="perchaseTitle" class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="javascript:void(0)" id="perchaseForm">
                                    <input type="hidden" name="id" id="id-perchase" minlength="8" required>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floation mb-3">
                                                <label for="name_perchase">Medicine Name:</label>
                                                <input type="text" name="name" id="name_perchase" class="form-control"
                                                    placeholder="Medicine Name" required>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floation mb-3">
                                                <label for="company_perchase">Company</label>
                                                <input type="text" name="company" id="company_perchase"
                                                    class="form-control" placeholder="Company Name" required>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floation mb-3">
                                                <label for="quantity_perchase">Medicine Quantity:</label>
                                                <input type="number" min="0" name="quantity" id="quantity_perchase"
                                                    class="form-control" placeholder="Medicine Quantity" step=".01" autocomplete="off" required>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floation mb-3">
                                                <label for="rack_perchase">Medicine Rack</label>
                                                <input type="text" name="rack" id="rack_perchase" class="form-control"
                                                autocomplete="off" required>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floation mb-3">
                                                <label for="supplier_perchase">Supplier name:</label>
                                                <input type="text" name="supplier" id="supplier_perchase"
                                                    class="form-control" placeholder="Supplier Name"  autocomplete="off" required>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floation mb-3">
                                                <label for="priceperunit_perchase">price per unit</label>
                                                <input type="number" min="0" name="priceperunit" id="priceperunit_perchase"
                                                    class="form-control" placeholder="Medicine price per unit:" step=".01"autocomplete="off"  required>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-floation mb-3">
                                                <label for="sale_perchase">Sale per price:</label>
                                                <input type="number" min="0" name="sale" id="sale_perchase" class="form-control"
                                                    placeholder="Sale price" step=".01" autocomplete="off" required>

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floation mb-3">
                                                <label for="cost_perchase">Total cost</label>
                                                <input type="number" min="0" name="cost" id="cost_perchase" class="form-control"
                                                    placeholder="Total cost:" step=".01" autocomplete="off" required>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floation mb-3">
                                                <label for="datepicker_perchase">Products expiry date</label>
                                                <input type="date" id="datepicker_perchase" name="datepicker"
                                                    class="form-control" placeholder="Expiry date" autocomplete="off" required>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        {{-- <button class="btn btn-success" type="submit">Save</button> --}}
                                        <input id="btn-save-perchase" type="submit" name="submit" class="btn btn-success"
                                            value="Purchase">
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>


                        </div>
                    </div>

                </div>

                {{-- end modal 2 --}}



            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js-add')
    <script src="{{ asset('js/dataTables.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('.livesearch').select2({
            placeholder: 'Select Rack',
            ajax: {
                url: '/medicine-table-search',
                dataType: 'json',
                delay: 50,
                method:'post',
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.name
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
            $('#location-rack-management').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('medicinepurchas') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },


                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'company',
                        name: 'company'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },

                    {
                        data: 'rack',
                        name: 'rack'
                    },

                    {
                        data: 'supplier',
                        name: 'supplier'
                    },
                    {
                        data: 'priceparunit',
                        name: 'priceparunit'
                    },
                    {
                        data: 'saleprice',
                        name: 'saleprice'
                    },
                    {
                        data: 'totalcost',
                        name: 'totalcost'
                    },
                    {
                        data: 'expairdate',
                        name: 'expairdate'
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
        })

        function add() {
            $('#MedicineTitle').html("Add Medicine");
            $('#MedicineForm').trigger('reset');
            $('#medicine-modal').modal('show');
            $('#id').val('');
            $("#btn-save").prop("value", "Add");


        }
        $('#MedicineForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $("#btn-save").attr("disabled", true);

            $.ajax({
                type: 'POST',
                url: "{{ route('medicinestore') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#medicine-modal").modal('hide');
                    var oTable = $('#location-rack-management').dataTable();
                    oTable.fnDraw(false);

                    $("#btn-save").attr("disabled", false);

                },

            });


        })

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('medicineedit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#MedicineTitle').html("Edit Medicine");
                    $('#medicine-modal').modal('show');
                    $("#btn-save").prop("value", "Update");
                    $('#id').val(res.id);
                    $('#name').val(res.name);
                    $('#company').val(res.company);
                    $('#quantity').val(res.quantity);
                    $('#rack').val(res.rack);
                    $('#supplier').val(res.supplier);
                    $('#priceperunit').val(res.priceparunit);
                    $('#sale').val(res.saleprice);
                    $('#cost').val(res.totalcost);
                    $("#datepicker").val(res.expairdate)
                    // console.log(res)
                    $("#name").prop('disabled', false);
                    $("#company").prop('disabled', false);
                    $("#rack").prop('disabled', false);
                    // $("#supplier").prop('disabled', false);
                    // $("#name").prop('disabled', false);

                }
            });

        }

        function deleteFunc(id) {
            if (confirm("Delete Record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ route('medicinedelete') }}",
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

        function Purchase(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('medicineedit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#perchaseTitle').html("Reperchase");
                    $("#perchaseTitle").css("color", "green");
                    $('#perchase-modal').modal('show');




                    $('#id-perchase').val(res.id);
                    $('#name_perchase').val(res.name);
                    $('#company_perchase').val(res.company);
                    $('#rack_perchase').val(res.rack);


                    $("#name_perchase").prop('disabled', true);
                    $("#company_perchase").prop('disabled', true);
                    $("#rack_perchase").prop('disabled', true);

                }
            });
        }

        $("#perchaseForm").submit(function(e) {
            e.preventDefault();
            var formDataperchase = new FormData(this);
            $("#btn-save-perchase").attr("disabled", true);

            $.ajax({
                type: 'POST',
                url: "{{ route('medicineperchase') }}",
                data: formDataperchase,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#perchase-modal").modal('hide');
                    var oTable = $('#location-rack-management').dataTable();
                    oTable.fnDraw(false);

                    $("#btn-save-perchase").attr("disabled", false);

                    console.log(data);

                },

            });


        })
    </script>
@endsection
