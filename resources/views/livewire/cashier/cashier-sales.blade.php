<div>
    <section class="mb-3">
        <a href="{{ route('cashier') }}" class="btn btn-sm btn-warning"><i class="fas fa-home"> </i> POS</a>
        <button wire:click="addOrder" class="btn btn-sm btn-primary"><i class="fas fa-plus"> </i> Order</button>
    </section>

    <section>
        <ul class="nav nav-tabs">
            @foreach ($sales as $item)
                <li class="nav-item">
                    <a class="nav-link {{ $item->id == $sale_id ? 'active' : '' }}"
                        href="{{ route('cashier.sales', $item->id) }}">{{ $item->sale_code }}</a>
                </li>
            @endforeach
        </ul>
    </section>

    <div class="page-category">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h5>Produk</h5>
                        <div class="d-flex">
                            <input wire:model.live="search" type="search" class="form-control mb-3" placeholder="Search">
                            <div id="reader" width="60px"></div>
                        </div>
                        <table class="table" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Gambar</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index => $item)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td class="text-center"><img src="{{ Storage::url($item->images) }}"
                                                alt="no-image" height="50px" class="rounded"></td>
                                        <td>{{ $item->product_code . ' - ' . $item->name }}</td>
                                        <td class="text-end">{{ number_format($item->selling_price) }}</td>
                                        <td>
                                            <button wire:click="addProduct({{ $item->id }})"
                                                class="btn btn-sm btn-primary"><i class="fas fa-plus"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-between">
                            <h5>Produk</h5>
                            <button wire:click="cancelTransaction({{ $sale_id }})"
                                class="btn btn-sm btn-danger">Batalkan Transaksi</button>
                        </div>
                        <table class="table" width="100%">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga Satuan</th>
                                    <th>Total</th>
                                    <th><button wire:click="resetProduct({{ $sale_id }})"
                                            class="btn btn-sm btn-warning"><i class="fas fa-sync-alt"> </i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_list as $index => $item)
                                    <tr>
                                        <td>{{ $item->product->product_code . ' - ' . $item->product->name }}</td>
                                        <td>{{ $item->total_products }} x
                                            {{ number_format($item->product->selling_price) }}</td>
                                        <td class="text-end pe-3">{{ number_format($item->total_price) }}</td>
                                        <td><button wire:click="deleteProduct({{ $item->id }})"
                                                class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2">Subtotal</td>
                                    <td class="text-end fw-bold">{{ number_format($sub_total) }}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <table width="100%">
                            <tr>
                                <td>Total</td>
                                <td class="text-end">3232</td>
                            </tr>
                            <tr>
                                <td>Diskon %</td>
                                <td class="text-end"><input type="number"
                                        class="form-control form-control-sm text-end">
                                </td>
                            </tr>
                            <tr>
                                <td>PPN %</td>
                                <td class="text-end">-</td>
                            </tr>
                            <tr>

                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div>
                                        <input type="radio" name="" id="" selected>
                                        <label for="">Tunai</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Bayar</td>
                                <td class="text-end"><input type="text" class="form-control">
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    @push('script')
        <script>
            $(window).on('load', function() {
                // menyembunyikan shidebar otomatis
                $('.gg-menu-right').click();
                $('.main-header').none();
            });
        </script>

        <script src="{{ asset('vendor/html5-qrcode.min.js') }}" type="text/javascript"></script>
        <script>
            function onScanSuccess(decodedText, decodedResult) {
                // handle the scanned code as you like, for example:
                console.log(`Code matched = ${decodedText}`, decodedResult);
            }

            function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning.
                // for example:
                console.warn(`Code scan error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    }
                },
                /* verbose= */
                false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        </script>
    @endpush
</div>
