<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('login') }}" class="brand-link text-center font-weight-bold">
      {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-normal">Manajemen Personalia</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="mt-3 pb-3 mb-3 d-flex">
        
      </div>
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Cari Halaman" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw nav-icon"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item  {{ Request::is('admin/dashboard*') ? 'menu-open' : '' }}">
            
            <a class="nav-link" href="">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          
          @if (Auth::user()->roles == 'admin')
          
          <li class="nav-item">
            <a href="{{ route('approval-izin.index') }}" class="nav-link {{ Request::is('approval-izin*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Approval Izin</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('penggajian.index') }}" class="nav-link {{ Request::is('penggajian*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>Penggajian Karyawan</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('setting*') ? 'menu-open' : '' }}">
            <a class="nav-link {{ Request::is('setting*') ? 'active' : '' }}" href="">
              <i class="fas fa-tools nav-icon"></i>
              <p>
                Setting
                {{-- <span class="right badge badge-danger">New</span> --}}
                <i class="right fas fa-angle-left nav-icon"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('master-jabatan.index') }}" class="nav-link {{ Request::is('setting/master-jabatan') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon nav-icon"></i>
                  <p>Master Jabatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('master-divisi.index') }}" class="nav-link {{ Request::is('setting/master-divisi') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon nav-icon"></i>
                  <p>Master Divisi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('master-personalia.index') }}" class="nav-link {{ Request::is('setting/master-personalia') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon nav-icon"></i>
                  <p>Master Personalia</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('master-user.index') }}" class="nav-link {{ Request::is('setting/master-user') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon nav-icon"></i>
                  <p>Master User</p>
                </a>
              </li>
            </ul>
          </li>
          @else
          <li class="nav-item">
            <a href="{{ route('absensi.index') }}" class="nav-link {{ Request::is('absensi*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>Absensi</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('izin.index') }}" class="nav-link {{ Request::is('izin*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-hourglass-end"></i>
              <p>Izin</p>
            </a>
          </li>
              
          <li class="nav-item">
            <a href="{{ route('riwayat-penggajian.index') }}" class="nav-link {{ Request::is('riwayat-penggajian*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-history"></i>
              <p>Riwayat Penggajian</p>
            </a>
          </li>
          @endif

          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>