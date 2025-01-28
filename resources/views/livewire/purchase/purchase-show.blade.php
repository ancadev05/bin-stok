<div>
    <div class="pagetitle">
        <h1>Pembelian</h1>
    </div>

    <section class="bg-white p-2 shadow-sm">
        {{-- kop --}}
        <section class="row">

            <div class="col">
                <div class="d-flex flex-column">
                    <h5 class="fw-bold m-0 p-0">CV. Wana Satria Komputindo</h5>
                    <span>Jl. Monumen Emmy Saelan No. 9C</span>
                </div>
            </div>
            <div class="col offset-3">
                <table class="table table-sm">
                    <tr>
                        <td colspan="2" class="fw-bold">PEMBELIAN</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">No #</td>
                        <td>: {{ $purchase->purchase_code }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Tanggal</td>
                        <td>: {{ \Carbon\Carbon::parse($purchase->date)->format('d/m/Y') }}</td>
                    </tr>
                </table>
            </div>
        </section>

        <hr>

        <section>
            <span><strong>Supplayer</strong> : {{ $purchase->supplier_name }}</span>
        </section>

        {{-- detail pembelian --}}
        <section class="mt-3">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga Beli (Rp)</th>
                        <th>Jumlah (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchase_details as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ '(' . $item->product->product_code . ') - ' . $item->product->name }}</td>
                            <td class="text-center">{{ $item->total_products }}</td>
                            <td class="text-end">{{ number_format($item->purchase_price) }}</td>
                            <td class="text-end">{{ number_format($item->total_price) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end">Subtotal</td>
                        <td class="text-end">{{ number_format($purchase->total_price) }}</td=>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end">Diskon %</td>
                        <td class="text-end">{{ $purchase->discount }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">TOTAL</td>
                        <td class="text-end fw-bold">{{ number_format($purchase->discount_price) }}</td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <div class="fw-bold">Ket.</div>
                            <div>{{ $purchase->description }}</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <hr>

        <div class="d-flex justify-content-end">
            <a wire:navigate href="{{ route('purchase') }}" class="btn btn-sm btn-danger">Kembali</a>
        </div>

    </section>
</div>
