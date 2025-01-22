<div>
    <div class="pagetitle">
        <h1>Daftar Produk</h1>
    </div>
    <section class="bg-white p-2 shadow-sm">
        <div class="d-flex justify-content-end mb-2">
            <a wire:navigate href="{{ route('product.create') }}" class="btn btn-sm btn-primary">+ Tambah</a>
        </div>

        <hr>

        <table class="table table-sm table-hover table-striped datatable">
            <thead>
                <th>No</th>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Merek</th>
                <th>Stok</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($products as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->product_code }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->brand }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>
                            <a wire:navigate href="{{ route('product.edit', $item->id) }}" class="btn badge text-bg-warning"><i class="bi bi-pencil-square"></i></a>
                            <button wire:click="destroy({{ $item->id }})" wire:confirm="Yakin inign hapus {{ $item->name }}" class="btn badge btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
