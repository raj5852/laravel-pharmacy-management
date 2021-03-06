<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pharmacy management</title>
    <link rel = "icon" href="{{ asset('dist/img/title.jpg') }}"
        type = "image/x-icon">
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset("plugins/fontawesome-free/css/all.min.css")}}">
  @yield('css-add')
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset("dist/css/adminlte.min.css")}}">
</head>
<body>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            @include('admin.layouts.header')
            @include('admin.layouts.sidebar')
            @yield('content')
            @include('admin.layouts.footer')
        </div>
        <!-- jQuery -->
<script src="{{asset("plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("dist/js/adminlte.min.js")}}"></script>
@yield('js-add')
    </body>
</body>
</html>
