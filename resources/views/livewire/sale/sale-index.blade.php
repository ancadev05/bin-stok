<div>
    <button wire:click="saleCreate" class="btn btn-sm btn-primary">Buat Transaksi Penjualan</button>

    <section class="bg-white p-2 shadow-sm mt-3">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Kode Transaksi</th>
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
                        <td class="text-end pe-5">{{ number_format($item->discount_price) }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
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
    </section>
</div>
