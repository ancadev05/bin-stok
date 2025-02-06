<div>
    <button wire:click="purchaseCreate" class="btn btn-sm btn-primary">Buat Transaksi Pembelian</button>

    <section class="bg-white p-2 shadow-sm mt-3">
        <h5 class="">Daftar Transaksi Pembelian Harian</h5>
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
                        <td class="text-center"><span class="badge text-bg-success">{{ $item->status }}</span></td>
                        <td class="text-center">
                            <a wire:navigate href="{{ route('purchase.show' , $item->id) }}" class="btn btn-secondary badge"><i class="bi bi-eye"></i></a>
                            @if ($item->status == 'Pending')
                                <a wire:navigate href="{{ route('purchase.edit', $item->id) }}" class="btn badge btn-warning"><i class="bi bi-pencil-square"></i></a>
                            @endif
                            <button wire:confirm="Yakin ingin hapus {{ $item->purchase_code }}" wire:click="purchaseDestroy({{ $item->id }})" class="btn badge btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="alert alert-secondary">
            <small><i>Menghapus transaksi akan mempengaruhi jumlah stok!</i></small>
        </div>
    </section>
</div>
