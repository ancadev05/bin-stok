<div>
    <div class="page-header">
        <h4 class="page-title">Akun</h4>
    </div>

    @if (session('status'))
        <section>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </section>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-end mb-3">
            <a wire:navigate href="{{ route('users.create') }}" class="btn btn-sm btn-primary">+ Tambah</a>
        </div>
        <section class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $item)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->roles == 1 ? 'Admin' : 'Kasir' }}</td>
                                <td>
                                    <a wire:navigate href="{{ route('users.edit', $item->id) }}"
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
        </section>
    </div>
</div>
