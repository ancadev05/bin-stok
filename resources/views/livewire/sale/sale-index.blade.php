<div>
    <div class="page-header">
        <h4 class="page-title">Transaksi Penjualan Harian</h4>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <button wire:click="saleCreate" class="btn btn-sm btn-primary">Buat Transaksi Penjualan</button>
        </div>
        <section class="card-body">
            <table class="table table-sm" id="basic-datatables">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Kode Transaksi</th>
                        <th>Total Item</th>
                        <th>Harga (Rp)</th>
                        <th>Discount</th>
                        <th>Total (Rp)</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                            <td>{{ $item->sale_code }}</td>
                            <td class="text-center">{{ $item->salesDetails->sum('total_products') }}</td>
                            <td class="text-end">{{ number_format($item->total_price) }}</td>
                            <td class="text-center">{{ $item->discount }}</td>
                            <td class="text-end">{{ number_format($item->discount_price) }}</td>
                            <td class="text-center">
                                @if ($item->status == 'Pending')
                                    <span class="badge text-bg-warning">{{ $item->status }}</span>
                                @else
                                    <span class="badge text-bg-success">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a wire:navigate href="{{ route('sale.show', $item->id) }}"
                                        class="btn btn-xs btn-secondary"><i class="far fa-eye"></i></a>
                                    <button wire:confirm="Yakin ingin hapus {{ $item->purchase_code }}"
                                        wire:click="saleDestroy({{ $item->id }})" class="btn btn-xs btn-danger"><i
                                            class="far fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="alert alert-secondary mt-4">
                <small><i>Menghapus transaksi akan mempengaruhi jumlah stok!</i></small>
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
