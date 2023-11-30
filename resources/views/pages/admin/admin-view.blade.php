@extends('app')

@section('body-content')
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('partials.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('partials.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content - Table -->
                <div class="container-fluid" id="TableData">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between">
                        <h1 class="h3 mb-4 text-gray-800">Admin List</h1>
                        <div>
                            <button type="button" class="btn btn-primary btn-icon-split" onclick="showForm()">
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </span>
                                <span class="text">Tambah Admin</span>
                            </button>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Admin Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($admin as $adm)
                                        @php
                                        $i = 1;
                                        @endphp
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $adm->username }}</td>
                                            <td>{{ $adm->password }}</td>
                                            <td>
                                                <form class="mt-1" action="{{ route('admin-list.edit', $adm->id) }}" method="GET">
                                                    <button class="btn btn-sm btn-warning">
                                                        <span class="text">Ubah</span>
                                                    </button>
                                                </form>
                                                <form class="mt-1" action="{{ route('admin-list.destroy', $adm->id) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger btn-icon-split">
                                                        <span class="icon text-white-50">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </span>
                                                        <span class="text">Hapus</span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Page Content - Table -->

                <!-- Begin Page Content - Form -->
                <div class="container-fluid d-none" id="FormCreateUpdate">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between">
                        <h1 class="h3 mb-4 text-gray-800">Form Admin</h1>
                        <div>
                            <button type="button" class="btn btn-danger btn-icon-split" onclick="hideForm()">
                                <span class="icon text-white-50">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                </span>
                                <span class="text">Kembali</span>
                            </button>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Admin</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('admin-list.store') }}">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-sm btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                        </span>
                                        <span class="text">Simpan</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- End of Page Content - Form -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('partials.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    {{-- Scroll to Top --}}
    @include('partials.scroll-to-top')

    {{-- Logout Modal --}}
    @include('partials.logout-modal')

    {{-- JavaScript - Library --}}
    @include('partials.script')

</body>
@endsection