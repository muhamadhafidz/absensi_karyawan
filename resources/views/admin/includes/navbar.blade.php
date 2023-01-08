<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="pagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          
          <a class="dropdown-item" href="#" data-route="{{ route('ubah-password', Auth::user()->id) }}" 
                                      
            onclick="event.preventDefault(); edituser(this)">Ubah Password
          </a>
          <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
          
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->
@include('admin.includes.edit-password')
@push('after-script')
    <script>
      function edituser(edit)
        {
            var route = $(edit).data('route');

            $('#form-edit-password').attr('action', route);
            $('#edit-password').modal('show');
        }
        function logout(){
            Swal.fire({
            title: 'Yakin mengakhiri sesi ini?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin, logout sekarang!'
            }).then((result) => {
            if (result.isConfirmed) {
                $('#logout-form').submit();
            }
            });
        }

        function password(){
            Swal.fire({
              input: 'password',
              inputLabel: 'Masukan password superadmin ',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Konfirmasi'
            }).then((result) => {
              // alert(result);
              if (result.isConfirmed) {
                $('#psw').val(result.value);
                $('#logout-form-admin').submit();
              }
          });
        }
    </script>
@endpush