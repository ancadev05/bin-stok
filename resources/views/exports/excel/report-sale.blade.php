<table>
    <tr>
        <td>LAPORAN PENJUALAN</td>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Kode Transaksi</th>
            <th>Pelanggan</th>
            <th>Total Item</th>
            <th>Harga (Rp)</th>
            <th>Discount</th>
            <th>Total (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sales as $index => $item)
            <tr>
                <td>{{ ++$index }}</td>
                <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                <td>{{ $item->purchase_code }}</td>
                <td>{{ $item->costumer }}</td>
                <td>{{ $item->salesDetails->sum('total_products') }}</td>
                <td>{{ $item->total_price }}</td>
                <td>{{ $item->discount }}%</td>
                <td>{{ $item->discount_price }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="7" style="font-weight: bold">Total</td>
            <td style="font-weight: bold">{{ $total }}</td>
        </tr>
    </tbody>
</table>
