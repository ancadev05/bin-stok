<div>
    <div class="pagetitle">
        <h1>Data Supplayer</h1>
    </div>
    <section class="bg-white p-2 shadow-sm">
        <div class="d-flex justify-content-end mb-2">
            <a wire:navigate href="{{ route('supplier.create') }}" class="btn btn-sm btn-primary">+ Tambah</a>
        </div>

        <hr>

        <table class="table table-sm table-hover table-striped datatable">
            <thead>
                <th>No</th>
                <th>Supplayer</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($suppliers as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->phone_number }}</td>
                        <td>
                            <a wire:navigate href="{{ route('supplier.edit', $item->id) }}" class="btn badge text-bg-warning"><i class="bi bi-pencil-square"></i></a>
                            <button wire:click="destroy({{ $item->id }})" wire:confirm="Yakin inign hapus {{ $item->name }}" class="btn badge btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
