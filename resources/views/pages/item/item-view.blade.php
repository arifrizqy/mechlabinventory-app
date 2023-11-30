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
                        <h1 class="h3 mb-4 text-gray-800">Items</h1>
                        <div>
                            <a href="/items/create" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </span>
                                <span class="text">Tambah Item</span>
                            </a>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Item Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Item</th>
                                            <th>Nama Item</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Item</th>
                                            <th>Nama Item</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($items as $itm )

                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $itm->code_item }}</td>
                                            <td>{{ $itm->description }}</td>
                                            <td>
                                                <div class="badge py-1 px-3 {{ $itm->isBorrowed === 1 ? 'bg-danger' : 'bg-success' }}">
                                                    <span class="text-white">
                                                        {{ $itm->isBorrowed === 1 ? 'Dipinjam' : 'Tersedia' }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <form class="mt-1" action="{{ route('items.edit', $itm->code_item ) }}" method="GET">
                                                    @csrf
                                                    <button  class="btn btn-sm btn-warning">
                                                        <span class="text">Ubah</span>
                                                    </button>
                                                </form>
                                                <form class="mt-1" action="{{ route('items.destroy', $itm->code_item) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    {{-- <input type="number" name="id" value="{{ $itm->code_item }}" class="d-none"> --}}
                                                    <button  class="btn btn-sm btn-danger btn-icon-split" onclick="return confirm('Are you sure?')">
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

    {{-- Scroll to Top --}}
    @include('partials.scroll-to-top')

    {{-- Logout Modal --}}
    @include('partials.logout-modal')

    {{-- JavaScript - Library --}}
    @include('partials.script')

</body>
@endsection
