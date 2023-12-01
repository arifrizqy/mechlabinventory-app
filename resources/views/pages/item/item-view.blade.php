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

                <!-- Begin Page Content - Item Table -->
                <div class="container-fluid" id="TableData">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between">
                        <h1 class="h3 mb-4 text-gray-800">Items</h1>
                        <div>
                            <button type="button" class="btn btn-primary btn-icon-split" onclick="showForm()">
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </span>
                                <span class="text">Tambah Item</span>
                            </button>
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
                                            <td class="d-flex flex-column justify-content-between">
                                                <div>
                                                    <span class="badge py-1 px-3 text-white bg-success }}">
                                                        Tersedia
                                                    </span> : {{ $itm->stock }}
                                                </div>
                                                <div>
                                                    <span class="badge py-1 px-3 text-white {{ $itm->borrowed > 0 ? 'd-none' : 'bg-info' }}">
                                                        Dipinjam
                                                    </span> : {{ $itm->borrowed }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <button type="button" class="btn btn-sm btn-info btn-icon-split ms-2" data-toggle="modal" data-target="#modalDetail" id="button-detail" onclick="showDetailItem('{{ $itm->code_item }}')">
                                                        <span class="icon text-white-50">
                                                            <i class="fa fa-info" aria-hidden="true"></i>
                                                        </span>
                                                        <span class="text">Detail</span>
                                                    </button>
                                                    <form class="mt-1" action="{{ route('items.edit', $itm->code_item ) }}" method="GET">
                                                        @csrf
                                                        <button  class="btn btn-sm btn-warning btn-icon-split">
                                                            <span class="icon text-white-50">
                                                                <i class="fa fa-pen" aria-hidden="true"></i>
                                                            </span>
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
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Page Content - Item Table -->

                <!-- Begin Page Content - Form Item -->
                <div class="container-fluid d-none" id="FormCreateUpdate">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between">
                        <h1 class="h3 mb-4 text-gray-800">Tambah Item</h1>
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
                            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Item</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('items.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <label for="image" class="form-label">Foto</label>
                                        <input class="form-control  @error('image') is-invalid
                                                @enderror" type="file" id="image" name="image"  onchange="previewImage()">
                                        <img class="img-preview img-fluid mb-2 col-sm-4 ">
                                    </div>
                                    <div class="col-3">
                                        <label for="Code" class="form-label">Code</label>
                                        <input type="text" class="form-control" oninput="checkLength(this)" name="id" id="Code" maxlength="12" required>
                                    </div>
                                    <div class="col-3">
                                        <label for="nama" class="form-label">Nama barang</label>
                                        <input type="text" class="form-control" name="description" id="nama" required>
                                    </div>
                                    <div class="col-3">
                                        <label for="nama" class="form-label">Stock</label>
                                        <input type="number" class="form-control" name="stock" id="nama" >
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
                    <h5 class="modal-title" id="exampleModalLabel">Detail Barang</h5>
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
        function showDetailItem(codeItem) {
            // Di sini, Anda dapat menggunakan AJAX untuk mengambil data dari server
            // Misalnya, URL /item/detail digunakan untuk mengambil detail item berdasarkan ID
            $.ajax({
            url: '/items/' + codeItem,
            type: 'GET',
            // success: function(response) {
            //     console.log(response);
            // }

            success: function(response) {
                $('#bodyDetail').html(
                    `<div class="d-flex">
                            <img class="rounded shadow-sm" src="{{ asset('storage/itemPost/${response.itemDetail.image}') }}" alt="Image not available">
                            <div class="w-100">
                                <div class="d-flex">
                                    <div class="w-100 ml-3">
                                        <div class="row">
                                            <div class="col-3">Code Item</div>
                                            <div class="col-1">:</div>
                                            <div class="col-8">${response.itemDetail.code_item}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">Nama Barang</div>
                                            <div class="col-1">:</div>
                                            <div class="col-8">${response.itemDetail.description}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-3">Stok Barang</div>
                                            <div class="col-1">:</div>
                                            <div class="col-8">${response.itemDetail.stock}</div>
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

    <script>
        function previewImage() {
         const image = document.querySelector('#image');
         const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
     }
    </script>

</body>
@endsection
