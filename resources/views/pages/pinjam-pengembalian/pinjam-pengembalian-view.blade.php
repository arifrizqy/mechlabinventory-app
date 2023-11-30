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

                <!-- Begin Page Content - Table Pinjam -->
                <div class="container-fluid" id="TableData">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between">
                        <h1 class="h3 mb-4 text-gray-800">Pinjam &amp; Pengembalian</h1>
                        <div>
                            <button type="button" class="btn btn-primary btn-icon-split" onclick="showForm()">
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </span>
                                <span class="text">Pinjam Barang</span>
                            </button>
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
                                                        <span class="icon text-white-50">
                                                            <i class="fa fa-pen" aria-hidden="true"></i>
                                                        </span>
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
                <!-- End of Page Content - Form Pinjam -->

                <!-- Begin Page Content - Form Pinjam -->
                <div class="container-fluid d-none" id="FormCreateUpdate">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between">
                        <h1 class="h3 mb-4 text-gray-800">Form Peminjaman Barang</h1>
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
                            <h6 class="m-0 font-weight-bold text-primary">Form Pinjam</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('pinjam-pengembalian.store') }}">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-5">
                                        <label for="visitor" class="form-label">Nama Peminjam</label><br>
                                        <select class="custom-select" id="visitor" name="nim" required>
                                            <option value="">Pilih Visitor:</option>
                                            @foreach ($visitor as $vst)
                                            <option value="{{ $vst->id }}">{{ $vst->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-7" id="barangPinjam">
                                        <label for="namaBarang" class="form-label">Nama Barang</label>
                                        <div class="input-group mb-3 brg-pinjam">
                                            <select class="custom-select" name="barang" aria-label="Example select with button addon" required>
                                                <option value="">Pilih Barang:</option>
                                                @foreach ($pinjamForm as $pjm)
                                                <option value="{{$pjm->code_item }}">{{ $pjm->description }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <input type="number" class="form-control rounded-0" value="1" name="qty" min="1" required>
                                                <button class="btn btn-outline-info" type="button" onclick="addSelectOpt()">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <button class="btn btn-outline-danger" type="button" disabled>
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
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
                <!-- End of Page Content - Form Pinjam -->

            </div>
            <!-- End of Main Content -->

            <button onclick="debug()">Console</button>

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
                    $('#bodyDetail').html(`
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-3">NIM</div> :
                                <div class="col-8">${response.dataVisitor.id}</div>
                            </div>
                            <div class="row">
                                <div class="col-3">Nama</div> :
                                <div class="col-8">${response.dataVisitor.name}</div>
                            </div>
                            <div class="row">
                                <div class="col-3">No. Telp.</div> :
                                <div class="col-8">${response.dataVisitor.telp}</div>
                            </div>
                            <div class="row">
                                <div class="col-3">Tgl. Pinjam</div> :
                                <div class="col-8">${response.dataPinjam.created_at}</div>
                            </div>
                            <div class="row">
                                <div class="col-3">Barang</div> :
                            </div>
                            <table class="table mt-2">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kode Brg.</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Qty.</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>${response.dataItemVisitor.code_item}</td>
                                        <td>${response.dataItemVisitor.description}</td>
                                        <td>3</td>
                                        <td>
                                            <div class="badge py-1 px-3 ${response.dataPinjam.status == 1 ? 'bg-success' : 'bg-danger'}">
                                                <span class="text-white">${response.dataPinjam.status == 1 ? 'Sudah Dikembalikan' : 'Belum Dikembalikan'}</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    `);
                }
            });
        };

        function debug() {
            $('.brg-pinjam').each(function() {
                console.log($(this).children()[0].value);
                console.log($(this).children().children()[3].value);
            });
        }

        function randId(length) {
            const charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let randomID = '';

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * charset.length);
                randomID += charset[randomIndex];
            }

            return randomID;
        }

        function addSelectOpt() {
            const id = randId(2);
            $('#barangPinjam').append(`
                <div class="input-group mb-3 brg-pinjam" id="selectOpt${id}">
                    <select class="custom-select" name="barang" aria-label="Example select with button addon" required>
                        <option value="">Pilih Barang:</option>
                        @foreach ($pinjamForm as $pjm)
                        <option value="{{$pjm->code_item }}">{{ $pjm->description }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <input type="number" class="form-control rounded-0" value="1" name="qty" min="1" required>
                        <button class="btn btn-outline-info" type="button" onclick="addSelectOpt()">
                            <i class="fa fa-plus"></i>
                        </button>
                        <button class="btn btn-outline-danger" type="button" onclick="removeSelectOpt('selectOpt${id}')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            `);
        }

        function removeSelectOpt(selector) {
            $(`#${selector}`).remove();
        }
    </script>

</body>
@endsection
