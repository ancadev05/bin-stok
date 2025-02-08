<div>
    <div class="page-header">
        <h4 class="page-title">Data Supplayer</h4>
    </div>

    <div class="card">

        <div class="card-header d-flex justify-content-end">
            <a wire:navigate href="{{ route('supplier.create') }}" class="btn btn-sm btn-primary"><i
                    class="fas fa-plus"></i> Tambah</a>
        </div>

        <div class="card-body">
            @if (session('status'))
                <section>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </section>
            @endif

            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped">
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
                                    <a wire:navigate href="{{ route('supplier.edit', $item->id) }}"
                                        class="btn btn-xs btn-warning"><i class="far fa-edit"></i></a>
                                    <button wire:click="destroy({{ $item->id }})"
                                        wire:confirm="Yakin inign hapus {{ $item->name }}"
                                        class="btn btn-xs btn-danger"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
