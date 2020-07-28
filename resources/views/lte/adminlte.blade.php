<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Pinjam Ruang Diskominfo Jatim</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Date Time Picker -->
  <link rel="stylesheet" href="{{ asset('air-datepicker\dist\css\datepicker.css') }}">

  <style>
    .cropcenter img {
      object-fit: none; /* Do not scale the image */
      object-position: center; /* Center the image within the element */
      width: 100%;
      max-height: 250px;
      margin-bottom: 1rem;
    }
</style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
    @include('lte/header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    @include('lte/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard Pinjam Ruang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('admin')}}">Page</a></li>
              <?php $segments = ''; ?>
              @foreach(Request::segments() as $segment)
                  <?php $segments .= '/'.$segment; ?>
                  <li class="breadcrumb-item active">
                      {{$segment}}
                  </li>
              @endforeach
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @yield('content')

          <!-- /.col-md-6 -->

          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  <!-- /.content-wrapper -->

  @include('lte/footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Deskripsi Aplikasi</h5>
      <p>Web Admin Pinjam Ruang Diskominfo Jatim untuk memanajemen pegawai yang ingn meminjam ruangan</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <div id="sidebar-overlay"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('air-datepicker\dist\js\datepicker.js') }}"></script>
<script src="{{ asset('air-datepicker\dist\js\i18n\datepicker.en.js') }}"></script>
</body>
</html>
