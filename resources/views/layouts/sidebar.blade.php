    <!-- partial:partials/_navbar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" href="{{route('barang')}}">
              <i class="mdi mdi-box-shadow menu-icon"></i>
              <span class="menu-title">Barang</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('kategori')}}">
              <i class="mdi mdi-adjust menu-icon"></i>
              <span class="menu-title">Kategori</span>
            </a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link" href="{{route('unit')}}">
              <i class="mdi mdi-sitemap menu-icon"></i>
              <span class="menu-title">Unit</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('pengajuan_magang')}}">
              <i class="mdi mdi-file-document menu-icon"></i>
              <span class="menu-title">Pengajuan Magang</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('magang')}}">
              <i class="mdi mdi-calendar-clock menu-icon"></i>
              <span class="menu-title">Riwayat Magang</span>
            </a>
          </li>
        </ul>
    </nav>


