@extends('template-dashboard.main')

@section('content')
    <div class="pagetitle">
        <h1>Kategori Produk</h1>
    </div>

    <section class="bg-white p-2 shadow-sm">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-sm btn-primary">+ Tambah</button>
        </div>

        <hr>

        <table class="table table-sm table-hover table-striped datatable">
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
@endsection
