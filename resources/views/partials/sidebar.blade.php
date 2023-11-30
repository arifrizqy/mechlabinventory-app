<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3">MechLabInventory</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <!-- Nav Item - Master Data -->
    <li class="nav-item {{ ($title === 'List Admin') || ($title === 'Visitors') || ($title === 'Items') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-database" aria-hidden="true"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master Data:</h6>
                <a class="collapse-item {{ ($title === 'List Admin') ? 'active' : '' }}" href="/admin-list">Admin List</a>
                <a class="collapse-item {{ ($title === 'Visitors') ? 'active' : '' }}" href="/visitors">Visitors</a>
                <a class="collapse-item {{ ($title === 'Items') ? 'active' : '' }}" href="/items">Item</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Peminjaman & Pengembalian -->
    <li class="nav-item {{ ($title === 'Pinjam - Pengembalian') ? 'active' : '' }}">
        <a class="nav-link" href="/pinjam-pengembalian">
            {{-- <i class="fas fa-fw fa-tachometer-alt"></i> --}}
            <span>Pinjam &amp; Pengembalian</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
