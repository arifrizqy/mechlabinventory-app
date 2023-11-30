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
                        <h1 class="h3 mb-4 text-gray-800">Pinjam &amp; Pengembalian</h1>
                        <div>
                            <a href="/pinjam-pengembalian/create" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </span>
                                <span class="text">Pinjam Barang</span>
                            </a>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Table Pinjam & Pengembalian</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Peminjam</th>
                                            <th>Nama Barang</th>
                                            <th>Status</th>
                                            <th>Tgl. Pinjam</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Peminjam</th>
                                            <th>Nama Barang</th>
                                            <th>Status</th>
                                            <th>Tgl. Pinjam</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($pinjam as $pjm )
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $pjm->visitor->name }}</td>
                                            <td>{{ $pjm->item->description }}</td>
                                            <td>
                                                <div class="badge py-1 px-3 {{ $pjm->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                    <span class="text-white">
                                                        {{ $pjm->status == 1 ? 'Sudah Kembali' : 'belum dikembalikan'; }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>{{ $pjm->created_at}}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-info btn-icon-split ms-2" data-toggle="modal" data-target="#modalDetail" id="button-detail" onclick="showDetailPinjam({{ $pjm->id }})">
                                                    <span class="icon text-white-50">
                                                        <i class="fa fa-info" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="text">Detail</span>
                                                </button>
                                                <form class="mt-1" action="{{ route('pinjam-pengembalian.update', $pjm->id) }}" method="POST">
                                                    @method('put')
                                                    @csrf
                                                    <button class="btn btn-sm btn-warning btn-icon-split ms-2" onclick="return confirm(`Are you sure? 'Sudah Mengembalikan'`)">
                                                        <span class="text">Ubah Status</span>
                                                    </button>

                                                </form>

                                                <form class="mt-1" action="{{ route('pinjam-pengembalian.destroy', $pjm->id) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger btn-icon-split" onclick="return confirm('Are you sure?')">
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

    {{-- Modal Detail --}}
    <div class="modal fade" id="modalDetail" data-backdrop="static" data-keyboard="false" role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Peminjaman</h5>
                </div>
                <div class="modal-body" id="bodyDetail">
                    {{-- Data akan ditampilkan menggunakan JavaScript - AJAX dibawah --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End of Modal Detail --}}

    {{-- Scroll to Top --}}
    @include('partials.scroll-to-top')

    {{-- Logout Modal --}}
    @include('partials.logout-modal')

    {{-- JavaScript - Library --}}
    @include('partials.script')

    <script>
        function showDetailPinjam(itemId) {
            // Di sini, Anda dapat menggunakan AJAX untuk mengambil data dari server
            // Misalnya, URL /item/detail digunakan untuk mengambil detail item berdasarkan ID
            $.ajax({
            url: '/pinjam-pengembalian/' + itemId,
            type: 'GET',
            success: function(response) {
                $('#bodyDetail').html(
                    `<div class="d-flex">
                            <img class="rounded shadow-sm" src="{{ asset('img/image-not-available.png') }}" alt="Image not available">
                            <div class="w-100">
                                <div class="d-flex">
                                    <div class="w-100 ml-3">
                                        <div class="row">
                                            <div class="col-3">NIM</div>
                                            <div class="col-1">:</div>
                                            <div class="col-8">${response.dataVisitor.id}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">Nama</div>
                                            <div class="col-1">:</div>
                                            <div class="col-8">${response.dataVisitor.name}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">No. Telp.</div>
                                            <div class="col-1">:</div>
                                            <div class="col-8">${response.dataVisitor.telp}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">Status</div>
                                            <div class="col-1">:</div>
                                            <div class="col-8">
                                                <div class="badge py-2 px-4 ${response.dataPinjam.status == 1 ? 'bg-success' : 'bg-danger'}">
                                                    <span class="text-white">${response.dataPinjam.status == 1 ? 'Sudah Dikembalikan' : 'Belum Dikembalikan'}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">Tgl. Pinjam</div>
                                            <div class="col-1">:</div>
                                            <div class="col-8">${response.dataPinjam.created_at}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">Barang</div>
                                            <div class="col-1">:</div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col-6">Kode Brg.</div>
                                                    <div class="col-6">Nama Brg.</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">${response.dataPinjam.item_id}</div>
                                                    <div class="col-6">${response.dataItemVisitor.description}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`
                );
            }
            });
        };
    </script>

</body>
@endsection
