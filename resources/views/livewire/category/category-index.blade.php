<div>
    <div class="page-header">
        <h4 class="page-title">Kategori Produk</h4>
    </div>

    <div class="page-category">
        <section class="card">
            <div class="card-header d-flex justify-content-end">
                <a wire:navigate href="{{ route('category.create') }}" class="btn btn-sm btn-primary"><i
                        class="fas fa-plus"></i> Tambah</a>
            </div>

            <div class="card-body">

                @if (session('status'))
                    <section>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </section>
                @endif

                <table class="table table-sm table-hover table-striped" id="basic-datatables">
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
                                    <a wire:navigate href="{{ route('category.edit', $item->id) }}"
                                        class="btn btn-xs btn-warning"><i class="far fa-edit"></i></a>
                                    <button wire:click="destroy({{ $item->id }})"
                                        onclick="delete()"
                                        class="btn btn-xs btn-danger"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <script>
        function delete() {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: 'Yes, delete it!',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        className: 'btn btn-danger'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    swal({
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        type: 'success',
                        buttons: {
                            confirm: {
                                className: 'btn btn-success'
                            }
                        }
                    });
                } else {
                    swal.close();
                }
            });
        }
    </script>
</div>
