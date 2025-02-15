<div>
    <div class="page-header">
        <h4 class="page-title">Daftar Produk</h4>
    </div>

    <div class="page-category">


        <section class="card">
            <div class="card-header d-flex justify-content-end mb-2">
                <a wire:navigate href="{{ route('product.create') }}" class="btn btn-sm btn-primary"><i
                        class="fas fa-plus"></i> Tambah</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-striped" id="basic-datatables">
                        <thead>
                            <th>No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Merek</th>
                            <th>HPP (Rp)</th>
                            <th>Harga Jual (Rp)</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $item)
                                <tr class="">
                                    <td class="{{ $item->min_stock >= $item->stock ? 'text-bg-danger' : '' }}">
                                        {{ ++$key }}</td>
                                    <td class="{{ $item->min_stock >= $item->stock ? 'text-bg-danger' : '' }}">
                                        {{ $item->product_code }}</td>
                                    <td class="{{ $item->min_stock >= $item->stock ? 'text-bg-danger' : '' }}">
                                        {{ $item->name }}</td>
                                    <td class="{{ $item->min_stock >= $item->stock ? 'text-bg-danger' : '' }}">
                                        {{ $item->brand }}</td>
                                    <td class="{{ $item->min_stock >= $item->stock ? 'text-bg-danger' : '' }} text-end">
                                        {{ number_format($item->cost) }}</td>
                                    <td
                                        class="{{ $item->min_stock >= $item->stock ? 'text-bg-danger' : '' }} text-end">
                                        {{ number_format($item->selling_price) }}</td>
                                    <td
                                        class="text-center {{ $item->min_stock >= $item->stock ? 'text-bg-danger' : '' }}">
                                        {{ $item->stock }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a wire:navigate href="{{ route('product.search', $item->id) }}"
                                                class="btn btn-xs btn-secondary"><i class="far fa-eye"></i></a>
                                            <a wire:navigate href="{{ route('product.edit', $item->id) }}"
                                                class="btn btn-xs btn-warning"><i class="far fa-edit"></i></a>
                                            <button wire:click="destroy({{ $item->id }})"
                                                wire:confirm="Yakin inign hapus {{ $item->name }}"
                                                class="btn btn-xs btn-danger"><i class="far fa-trash-alt"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="alert alert-secondary mt-4">
                    <small><i>Produk merah sudah mencapai stok minimal!</i></small>
                </div>
            </div>
        </section>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('#basic-datatables').DataTable();
            })
        </script>
    @endpush
</div>
