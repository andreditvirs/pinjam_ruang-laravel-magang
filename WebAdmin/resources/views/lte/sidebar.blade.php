<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{URL::to('admin')}}" class="brand-link">
      <img src="{{ asset("storage/site/logo.jpg")}}" alt="Pinjam Ruang Diskominfo Jatim Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Pinjam Ruang</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset("storage/".Auth::user()->foto)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info mr-1">
        <a href="{{ URL::to('admin')}}" class="d-block">{{ Auth::user()->username }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{URL::to('admin')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Beranda
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('bookings')}}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Peminjaman
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('departments')}}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Bidang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('rooms')}}" class="nav-link">
              <i class="nav-icon fas fa-window-maximize"></i>
              <p>
                Ruangan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('position_in_departments')}}" class="nav-link">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Jabatan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('users')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pegawai
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="document.getElementById('logout').submit();">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p>
                Keluar
              </p>
            </a>
          </li>
          <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>