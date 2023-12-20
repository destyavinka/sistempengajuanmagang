    <!-- partial:partials/_navbar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="{{route('dashboard')}}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
          @if(auth()->user()->level=="Super Admin")
          <li class="nav-item">
            <a class="nav-link" href="/user">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">User</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/role">
              <i class="mdi mdi-account-convert menu-icon"></i>
              <span class="menu-title">Role</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/unit">
              <i class="mdi mdi-sitemap menu-icon"></i>
              <span class="menu-title">Unit</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/skema">
              <i class="mdi mdi-transition-masked menu-icon"></i>
              <span class="menu-title">Skema</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/instansi">
              <i class="mdi mdi-domain menu-icon"></i>
              <span class="menu-title">Instansi Magang</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/periode">
              <i class="mdi mdi-alarm menu-icon"></i>
              <span class="menu-title">Periode Magang</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/penyelenggara">
              <i class="mdi mdi-domain menu-icon"></i>
              <span class="menu-title">Penyelenggara Serkom</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/jenis_sertifikasi">
              <i class="mdi mdi-certificate menu-icon"></i>
              <span class="menu-title">Tingkat Sertifikasi</span>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="/pengajuan_magang">
              <i class="mdi mdi-file-document menu-icon"></i>
              <span class="menu-title">Pengajuan Magang</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/riwayat_magang">
              <i class="mdi mdi-calendar-clock menu-icon"></i>
              <span class="menu-title">Riwayat Magang</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/pengajuan_serkom">
              <i class="mdi mdi-file-document menu-icon"></i>
              <span class="menu-title">Pengajuan Serkom</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/riwayat_serkom">
              <i class="mdi mdi-calendar-clock menu-icon"></i>
              <span class="menu-title">Riwayat Serkom</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/pekertian">
              <i class="mdi mdi-file-document menu-icon"></i>
              <span class="menu-title">Pekerti</span>
            </a>
          </li>
          @if(auth()->user()->level=="Super Admin" || auth()->user()->level=="Dekan" )
          <li class="nav-item">
            <a class="nav-link" href="/reportdata">
              <i class="mdi mdi-file-document menu-icon"></i>
              <span class="menu-title">Report Data</span>
            </a>
          </li>
          @endif
          @if(auth()->user()->level!="Super Admin")
          <li class="nav-item">
            <a class="nav-link" href="/profil">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Edit Profil</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/password">
              <i class="mdi mdi-lock menu-icon"></i>
              <span class="menu-title">Ubah Password</span>
            </a>
          </li>
          @endif
        </ul>
    </nav>


