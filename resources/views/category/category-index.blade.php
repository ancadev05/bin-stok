@extends('template-dashboard.main')

@section('content')
    <div class="pagetitle">
        <h1>Kategori Produk</h1>
    </div>

    <section class="bg-white p-2 shadow-sm">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-kategori">+ Tambah</button>
        </div>

        <hr>

        <table class="table table-sm table-hover table-striped">
            <thead>
                <th>No</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Laptop Bekas</td>
                    <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Laptop Bekas</td>
                    <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Laptop Bekas</td>
                    <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Laptop Bekas</td>
                    <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    {{-- tambah kategori --}}
    <!-- Modal -->
    <div class="modal fade" id="tambah-kategori" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3 row">
                            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="kategori">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    {{-- /tambah kategori --}}
@endsection
