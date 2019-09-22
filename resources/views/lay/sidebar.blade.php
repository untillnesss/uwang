    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Lap<sup>uwang</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item @if(Route::currentRouteName() == 'dashboard') active @endif">
        <a class="nav-link" href="{{route('dashboard')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        @if (Session::get('userLogin')->idLevel != 3)

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            MENU LAPORAN
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item @if(Route::currentRouteName() == 'laporan') active @endif">
            <a class="nav-link" href="{{route('laporan')}}"><i class="fas fa-file fa-fw"></i><span>Daftar Laporan</span></a>
        </li>

        <li class="nav-item @if(Route::currentRouteName() == 'pemaspenge') active @endif">
            <a class="nav-link" href="{{route('pemaspenge')}}"><i class="fas fa-arrow-up fa-fw"></i><span>Masuk & Keluar</span></a>
        </li>

        @if (Session::get('userLogin')->idLevel == 1)
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            MENU PREFERENSI
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item @if(Route::currentRouteName() == 'anggota') active @endif">
            <a class="nav-link" href="{{route('anggota')}}"><i class="fas fa-users fa-fw"></i><span>Anggota</span></a>
        </li>

        <li class="nav-item" onclick="saranBug()">
            <a class="nav-link" href="#"><i class="fas fa-bug fa-fw"></i><span>Saran & Lapor Bug</span></a>
        </li>
        @endif

        @endif
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
