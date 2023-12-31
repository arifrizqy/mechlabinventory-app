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

                <!-- Begin Page Content - Table Visitor -->
                <div class="container-fluid" id="TableData">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between">
                        <h1 class="h3 mb-4 text-gray-800">Visitors</h1>
                        <div>
                            <button type="button" class="btn btn-primary btn-icon-split" onclick="showForm()">
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </span>
                                <span class="text">Tambah Visitor</span>
                            </button>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Visitor Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIM</th>
                                            <th>Nama Lengkap</th>
                                            <th>Nomor Telephone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIM</th>
                                            <th>Nama Lengkap</th>
                                            <th>Nomor Telephone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($visitor as $vst )


                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $vst->id }}</td>
                                            <td>{{ $vst->name }}</td>
                                            <td>{{ $vst->telp }}</td>
                                            <td>
                                                <form action="{{ route('visitors.edit', $vst->id) }}" method="GET">
                                                    @csrf
                                                    <button class="btn btn-sm btn-warning btn-icon-split">
                                                        <span class="icon text-white-50">
                                                            <i class="fa fa-pen" aria-hidden="true"></i>
                                                        </span>
                                                        <span class="text">Ubah</span>
                                                    </button>

                                                </form>
                                                <form class="mt-1" action="{{ route('visitors.destroy', $vst->id) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <input type="number" name="id" value="{{ $vst->id }}" class="d-none">
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
                <!-- End of Page Content - Table Visitor -->

                <!-- Begin Page Content - Form Visitor -->
                <div class="container-fluid d-none" id="FormCreateUpdate">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between">
                        <h1 class="h3 mb-4 text-gray-800">Tambah Visitor</h1>
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
                            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Visitor</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('visitors.store') }}">

                                @csrf
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label for="nim" class="form-label">NIM</label>
                                        <input type="number" class="form-control" oninput="checkLength(this)" name="id" id="nim" maxlength="12">
                                    </div>
                                    <div class="col-4">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="name" id="nama">
                                    </div>
                                    <div class="col-4">
                                        <label for="telp" class="form-label">No Telepon / WhatsApp </label>
                                        <input type="number" class="form-control" oninput="checkLengthTlp(this)" name="telp" id="telp" maxlength="13">
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
                <!-- End of Page Content - Form Visitor -->

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
