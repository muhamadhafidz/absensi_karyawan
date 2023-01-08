<!DOCTYPE html>
<html lang="en">
<head>
  <title>Absensi Karyawan</title>
  <link rel="icon" type="image/png" href="">
    <!--     Fonts and icons     -->
    @include('admin.includes.font')
    <!-- CSS Files -->
    @stack('before-style')
    @include('admin.includes.style')
    @stack('after-style')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    {{-- sidebar --}}
    @include('admin.includes.sidebar')
    {{-- end sidebar --}}
    <div class="content-wrapper">
        @include('admin.includes.navbar')


        <section class="content">
        @yield('content')
        </section>
        <!-- End Navbar -->
    </div>

@include('admin.includes.footer')
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

</body>
@stack('before-script')
@include('admin.includes.script')
@stack('after-script')
@include('sweetalert::alert')

</html>
