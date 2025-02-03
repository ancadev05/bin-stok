<div>
    <button wire:click="purchaseCreate" class="btn btn-sm btn-primary">Buat Transaksi Pembelian</button>

    <section class="bg-white p-2 shadow-sm mt-3">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Kode Pembelian</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $index => $item)
                    <tr>
                        <td>{{ ++$index }}</td>
                        {{-- <td>{{ Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}</td> --}}
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->purchase_code }}</td>
                        <td>{{ $item->total_price }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <button wire:click="purchaseDestroy({{ $item->id }})" class="btn badge text-bg-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
