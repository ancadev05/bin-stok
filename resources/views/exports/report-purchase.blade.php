<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Kode Transaksi</th>
            <th>Total Item</th>
            <th>Harga (Rp)</th>
            <th>Discount</th>
            <th>Total (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($purchases as $index => $item)
            <tr>
                <td>{{ ++$index }}</td>
                <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                <td>{{ $item->purchase_code }}</td>
                <td>{{ $item->purchaseDetails->sum('total_products') }}</td>
                <td>{{ $item->total_price }}</td>
                <td>{{ $item->discount }}%</td>
                <td>{{ $item->discount_price }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6" class="fw-bold">Total</td>
            <td style="font-weight: bold">{{ $total }}</td>
        </tr>
    </tbody>
</table>
