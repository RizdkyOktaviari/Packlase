<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('welcome')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Packclese<sup>Admin</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Navigation
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" href="#transaksi" role="button"
        aria-expanded="false" aria-controls="multiCollapseExample1">
            <i class="fas fa-fw fa-folder"></i>
            <span>Transaksi</span>
        </a>
        <div id="transaksi" class="collapse multi-collapse" >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transaksi</h6>
                <a class="collapse-item" href="{{route('index-transaksi')}}">List Semua Transaksi</a>
                <a class="collapse-item" href="{{route('jenisTransaction-transaksi', ['id' => '1'])}}">List Transaksi Laundry</a>
                <a class="collapse-item" href="{{route('jenisTransaction-transaksi', ['id' => '2'])}}">List Transaksi Bersihin</a>
                <a class="collapse-item" href="{{route('jenisTransaction-transaksi', ['id' => '3'])}}">List Transaksi Paketin</a>
                <a class="collapse-item" href="{{route('jenisTransaction-transaksi', ['id' => '4'])}}">List Transaksi Titipin</a>
                <a class="collapse-item" href="{{route('trashed-transaksi')}}">List Sampah Transaksi</a>

            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" href="#multiCollapseExample1" role="button"
        aria-expanded="false" aria-controls="multiCollapseExample1">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pengguna / User</span>
        </a>
        <div id="multiCollapseExample1" class="collapse multi-collapse" >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pengguna</h6>
                <a class="collapse-item" href="{{route('index-user')}}">List Pengguna</a>

            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" type="button" data-toggle="collapse" data-target="#multiCollapseExample2"
        aria-expanded="false" aria-controls="multiCollapseExample2">
            <i class="fas fa-fw fa-folder"></i>
            <span>Jenis Layanan</span>
        </a>
        <div id="multiCollapseExample2" class="collapse multi-collapse" >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Jenis Layanan</h6>
                <a class="collapse-item" href="{{route('Home-JenisLayanan')}}">List Jenis Layanan</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" type="button" data-toggle="collapse" data-target="#multiCollapseExample4"
        aria-expanded="false" aria-controls="multiCollapseExample4">
            <i class="fas fa-fw fa-folder"></i>
            <span>Layanan</span>
        </a>
        <div id="multiCollapseExample4" class="collapse multi-collapse" >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Layanan</h6>
                <a class="collapse-item" href="{{route('Home-Layanan')}}">List Layanan</a>
                <a class="collapse-item" href="{{route('Create-Layanan')}}">Tambah Layanan</a>
                <a class="collapse-item" href="{{route('Trashed-Layanan')}}">Trashed Layanan</a>

            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" type="button" data-toggle="collapse" data-target="#vouchercollaps"
        aria-expanded="false" aria-controls="vouchercollaps">
            <i class="fas fa-fw fa-folder"></i>
            <span>Voucher</span>
        </a>
        <div id="vouchercollaps" class="collapse multi-collapse" >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Voucher</h6>
                <a class="collapse-item" href="{{route('index-voucher')}}">List Voucher</a>
                <a class="collapse-item" href="{{route('create-voucher')}}">Tambah Voucher</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" type="button" data-toggle="collapse" data-target="#multiCollapseExample3"
        aria-expanded="false" aria-controls="multiCollapseExample3">
            <i class="fas fa-fw fa-folder"></i>
            <span>Komentar</span>
        </a>
        <div id="multiCollapseExample3" class="collapse multi-collapse" >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Komentar</h6>
                <a class="collapse-item" href="{{route('index-komentar')}}">List Komentar Pengguna</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
