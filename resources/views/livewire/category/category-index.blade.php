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

                <table class="table table-sm table-hover table-striped" id="basic-datatables">
                    <thead>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Total Produk</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->product->count() }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <a wire:navigate href="{{ route('category.edit', $item->id) }}"
                                        class="btn btn-xs btn-warning"><i class="far fa-edit"></i></a>
                                    {{-- <button wire:click="destroy({{ $item->id }})" onclick="delete()"
                                        class="btn btn-xs btn-danger"><i class="far fa-trash-alt"></i></button> --}}
                                    <button onclick="deleteCategory({{ $item->id }}, '{{ $item->name }}')"
                                        class="btn btn-xs btn-danger"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    @push('script')
        <script>
            function deleteCategory(id, name) {

                swal({
                    title: 'Yakin ingin hapus ' + name + ' ?',
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

                        Livewire.dispatch('destroy', {
                            id
                        });

                    } else {
                        swal.close();
                    }
                });
            }
        </script>
    @endpush
</div>
