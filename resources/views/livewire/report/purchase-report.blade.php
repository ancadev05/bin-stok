<div>
    <div class="page-header">
        <h4 class="page-title">Daftar Penjualan</h4>
    </div>

    <div class="card">
        <section class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kode Transaksi</th>
                            <th>Total Item</th>
                            <th>Harga (Rp)</th>
                            <th>Discount</th>
                            <th>Total (Rp)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $index => $item)
                            <tr>
                                <td class="text-center">{{ ++$index }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                                <td>{{ $item->purchase_code }}</td>
                                <td class="text-center">{{ $item->purchaseDetails->sum('total_products') }}</td>
                                <td class="text-end">{{ number_format($item->total_price) }}</td>
                                <td class="text-center">{{ $item->discount }}%</td>
                                <td class="text-end">{{ number_format($item->discount_price) }}</td>
                                <td class="text-center">
                                    <a wire:navigate href="{{ route('purchase.show', $item->id) }}"
                                        class="btn btn-xs btn-secondary"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
