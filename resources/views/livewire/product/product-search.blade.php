<div>
    <div class="page-category">

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table>
                        <tr>
                            <td width="150px">Kategori</td>
                            <td>:</td>
                            <td>{{ $product->category->name }}</td>
                        </tr>
                        <tr>
                            <td>Kode Produk</td>
                            <td>:</td>
                            <td>{{ $product->product_code }}</td>
                        </tr>
                        <tr>
                            <td>Nama Produk</td>
                            <td>:</td>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <td>Merek</td>
                            <td>:</td>
                            <td>{{ $product->brand }}</td>
                        </tr>
                        <tr>
                            <td>Spesifikasi</td>
                            <td>:</td>
                            <td>{{ $product->specifications}}</td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td>:</td>
                            <td>{{ $product->stock }}</td>
                        </tr>
                        <tr>
                            <td>HPP</td>
                            <td>:</td>
                            <td>Rp. {{ number_format($product->cost) }}</td>
                        </tr>
                        <tr>
                            <td>Harga Jual</td>
                            <td>:</td>
                            <td>Rp. {{ number_format($product->selling_price) }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>:</td>
                            <td>{{ $product->description }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <section class="card">
            <div class="card-header">
                <h4>Riwayat Pembelian Produk</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Transaksi</th>
                                <th>IN ({{ $purchases->count() }})</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->purchase->date)->format('d/m/Y') }}</td>
                                    <td>{{ $item->purchase->purchase_code }}</td>
                                    <td>{{ $item->total_products }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="card">
            <div class="card-header">
                <h4>Riwayat Penjualan Produk</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Transaksi</th>
                                <th>OUT ({{ $sales->count() }})</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->sale->date)->format('d/m/Y') }}</td>
                                    <td>{{ $item->sale->sale_code }}</td>
                                    <td>{{ $item->total_products }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        
        <section class="d-flex justify-content-end">
            <a wire:navigate href="{{ route('product') }}" class="btn btn-sm btn-danger"><i class="fas fa-reply"> </i> Kembali</a>
        </section>
    </div>
</div>
