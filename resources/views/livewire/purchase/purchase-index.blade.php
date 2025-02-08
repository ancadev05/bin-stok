<div>
    <div class="page-header">
        <h4 class="page-title">Transaksi Pembelian Harian</h4>
    </div>

    <section class="card">

        <div class="card-header d-flex justify-content-end">
            <button wire:click="purchaseCreate" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Buat Transaksi Pembelian</button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr class="text-center">
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
                        @foreach ($purchases as $index => $item)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                                <td>{{ $item->purchase_code }}</td>
                                <td class="text-center">{{ $item->purchaseDetails->sum('total_products') }}</td>
                                <td class="text-end">{{ number_format($item->total_price) }}</td>
                                <td class="text-center">{{ $item->discount }}%</td>
                                <td class="text-end">{{ number_format($item->discount_price) }}</td>
                                <td class="text-center">
                                    @if ($item->status == "Pending")
                                        <span class="badge text-bg-warning">{{ $item->status }}</span>
                                    @else
                                        <span class="badge text-bg-success">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a wire:navigate href="{{ route('purchase.show', $item->id) }}"
                                        class="btn btn-xs btn-secondary"><i class="far fa-eye"></i></a>
                                    <button wire:confirm="Yakin ingin hapus {{ $item->purchase_code }}"
                                        wire:click="purchaseDestroy({{ $item->id }})"
                                        class="btn btn-xs btn-danger"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="alert alert-secondary">
                <small><i>Menghapus transaksi akan mempengaruhi jumlah stok!</i></small>
            </div>
        </div>
    </section>
</div>
