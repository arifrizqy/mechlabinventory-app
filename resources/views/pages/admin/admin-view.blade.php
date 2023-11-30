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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between">
                        <h1 class="h3 mb-4 text-gray-800">Admin List</h1>
                        <div>
                            <a href="admin-list/create" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </span>
                                <span class="text">Tambah Admin</span>
                            </a>
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('partials.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    {{-- Scroll to Top & Logout Modal --}}
    @include('partials.scroll-to-top-and-logout')

    {{-- JavaScript - Library --}}
    @include('partials.script')

</body>
@endsection