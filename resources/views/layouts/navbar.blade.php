<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{route('dashboard')}}">
          <img src="/img/logo_sv.png" alt="" style="margin-left: 30px;">
          <img src="/img/simaskot.png" alt="" style="width: 160px; height: auto;">
        </a>
      </div>

      
      
      
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize"
      style="z-index: 1;">
      <span class="icon-menu"></span>
    </button>
        <ul class="navbar-nav mr-lg-2">
         
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          
            
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              Halo, {{ auth()->user()->nama }}
              {{-- <img src="{{asset('img/undraw_profile.svg')}}" /> {{ auth()->user()->nama }} ({{ auth()->user()->role->role }}) --}}
            </a>
            
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="{{ route('profil') }}">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="{{ route('logout') }}">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
            
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
</nav>

