<div>
    <div class="pagetitle">
        <h1>Kategori Produk</h1>
    </div>
    <section class="bg-white p-2 shadow-sm">
        <div class="d-flex justify-content-end mb-2">
            <a wire:navigate href="{{ route('category.create') }}" class="btn btn-sm btn-primary">+ Tambah</a>
        </div>

        <hr>

        <table class="table table-sm table-hover table-striped datatable">
            <thead>
                <th>No</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($categories as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <a wire:navigate href="{{ route('category.edit', $item->id) }}" class="btn badge text-bg-warning"><i class="bi bi-pencil-square"></i></a>
                            <button wire:click="destroy({{ $item->id }})" wire:confirm="Yakin inign hapus {{ $item->name }}" class="btn badge btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
