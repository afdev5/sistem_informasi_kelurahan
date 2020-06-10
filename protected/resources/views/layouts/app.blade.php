<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Kelurahan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="shortcut icon" href="{{ asset('assets/dist/img/logo.png') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/dist/img/logo.png') }}" type="image/x-icon">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assets/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/_all-skins.min.css') }}">
  <!-- Datatable -->
  <link href="{{ asset('assets/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>IK</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>S I K</b></span>
      <!-- <img src="{{ asset('assets/dist/img/logo.png') }}" alt="Logo Image" width="50" height="50" class="logo-lg mt-2"> -->
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('assets/dist/img/logo.png') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->nama }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('assets/dist/img/logo.png') }}" class="img-circle" alt="User Image">

                <p>
                {{ Auth::user()->nama }}
                  <!-- <small>Member since Nov. 2012</small> -->
                </p>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
              </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('user.edit', Auth::user()->id) }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                     @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                      @else
                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">Sign out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                      @endguest
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('assets/dist/img/logo.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->nama }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        @if(Auth::user()->level == 1)
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i> <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('kecamatan.index') }}"><i class="fa fa-map"></i> Kecamatan</a></li>
            <li><a href="{{ route('kelurahan.index') }}"><i class="fa fa-map-o"></i> Kelurahan</a></li>
            <li><a href="{{ route('user.index') }}"><i class="ion ion-person"></i> Admin Kelurahan</a></li>
          </ul>
        </li>
        @else
        <li class="treeview">
          <a href="#">
            <i class="fa fa-map-o"></i> <span>Informasi Kelurahan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('profile_kelurahan.index') }}"><i class="fa fa-newspaper-o"></i> Profil Kelurahan</a></li>
            <li><a href="{{ route('struktur_kelurahan.index') }}"><i class="fa fa-sitemap"></i> Struktur Jabatan</a></li>
            <li><a href="{{ route('info_kelurahan.index') }}"><i class="fa fa-info-circle"></i> Informasi Kelurahan</a></li>
            <li><a href="{{ route('kegiatan_kelurahan.index') }}"><i class="fa fa-file-photo-o"></i> Kegiatan Kelurahan</a></li>
            <li><a href="{{ route('wilayah.index') }}"><i class="fa fa-sticky-note-o"></i> Batas Wilayah Kelurahan</a></li>
          </ul>
        </li>
        @endif
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Penduduk</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{ route('penduduk.index') }}"><i class="fa fa-users"></i> Data Penduduk</a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-map-o"></i> <span>Statistik Penduduk</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ route('statistik.pendidikan') }}"><i class="fa fa-circle"></i> Pendidikan</a></li>
              <li><a href="{{ route('statistik.agama') }}"><i class="fa fa-circle"></i> Agama</a></li>
              <li><a href="{{ route('statistik.usia') }}"><i class="fa fa-circle"></i> Umur</a></li>
              <li><a href="{{ route('statistik.jk') }}"><i class="fa fa-circle"></i> Jenis Kelamin</a></li>
              <li><a href="{{ route('statistik.kawin') }}"><i class="fa fa-circle"></i> Status Perkawinan</a></li>
            </ul>
          </li>
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; KKN UNIMA 'TI' 2019 -<a href="https://tomohon.go.id"> Dinas Komunikasi Dan Informatika Kota Tomohon</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <!-- <div class="control-sidebar-bg"></div> -->
  </div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('assets/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="{{ asset('assets/DataTables-1.10.16/js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('assets/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dist/js/demo.js') }}"></script>
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/chart.js/Chart.js') }}"></script>
@yield('js')
</body>
</html>
