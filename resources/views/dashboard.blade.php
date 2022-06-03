  @extends('admin.layouts.app')

  @section('content')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
              <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-sm-6">
                          <h1 class="m-0">Dashboard</h1>
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
                  
                  <div class="row">
                      <div class="col-xl-3 col-md-6">
                          <div class="card bg-primary text-white mb-4">
                              <div class="card-body">
                                  <h2 class="text-center">{{$instock}}</h2>
                                  <h5 class="text-center">In Stock Medicine</h5>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-md-6">
                          <div class="card bg-warning text-white mb-4">
                              <div class="card-body">
                                  <h2 class="text-center">{{ $outofStoclk }}</h2>
                                  <h5 class="text-center">Out of Stock Medicine</h5>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-md-6">
                          <div class="card bg-danger text-white mb-4">
                              <div class="card-body">
                                  <h2 class="text-center"><span style="font-family: DejaVu Sans;">৳</span>&nbsp;{{$totalpurchase}}
                                  </h2>
                                  <h5 class="text-center">Total Purchase</h5>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-md-6">
                          <div class="card bg-success text-white mb-4">
                              <div class="card-body">
                                  <h2 class="text-center"><span style="font-family: DejaVu Sans;">৳</span>&nbsp;{{$sale}}
                                  </h2>
                                  <h5 class="text-center">Total Sale</h5>
                              </div>
                          </div>
                      </div>

                  </div>

              </div><!-- /.container-fluid -->
          </div>
          <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
  @endsection
