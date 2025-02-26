<div>
    <section class="mb-3">
        <button wire:click="addOrder" class="btn btn-sm btn-primary"><i class="fas fa-plus"> </i> Order</button>
    </section>

    <section>
        <ul class="nav nav-tabs">
            @foreach ($sales as $item)
                <li class="nav-item">
                    <a class="nav-link {{ $item->id == $sale_id ? 'active' : '' }}" href="{{ route('cashier.sales', $item->id) }}">{{ $item->sale_code }}</a>
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
                        <input wire:model.live="search" type="search" class="form-control mb-3" placeholder="Search">
                        <table class="" width="100%">
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
                                        <td class="text-center"><img src="{{ Storage::url($item->images) }}" alt="no-image"
                                                height="50px" class="rounded"></td>
                                        <td>{{ $item->product_code . ' - ' . $item->name }}</td>
                                        <td class="text-end">{{ number_format($item->selling_price) }}</td>
                                        <td>
                                            <button wire:click="addProduct({{ $item->id }})" class="btn btn-sm btn-primary"><i
                                                    class="fas fa-plus"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <h5>Produk</h5>
                        <table class="" width="100%">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_list as $index => $item)
                                    <tr>
                                        <td>{{ $item->product_code . ' - ' . $item->name }}</td>
                                        <td>2</td>
                                        <td class="text-end pe-3">{{ number_format($item->selling_price) }}</td>
                                        <td class="text-end pe-3">{{ number_format($item->selling_price * 2) }}</td>
                                        <td><button wire:click="remove({{ $item->id }})"
                                                class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2">Subtotal</td>
                                    <td class="text-end">{{ number_format(32432432) }}</td>
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
                                <td class="text-end"><input type="number" class="form-control form-control-sm text-end">
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
    @endpush
</div>
