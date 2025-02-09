<div>
    <div class="page-header">
        <h4 class="page-title">Penjualan</h4>
    </div>

    <div class="page-category">

        <section class="card">
            <div class="card-body">
                <form wire:submit="saleDetailsStore">
                    @csrf
                    <div class="mb-3 row">
                        <label for="sale_code" class="col-sm-2 col-form-label text-end">Kode Transaksi</label>
                        <div class="col">
                            <input type="text" class="form-control @error('sale_code') is-invalid @enderror"
                                wire:model="sale_code" disabled>
                            @error('sale_code')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div wire:ignore class="mb-3 row">
                        <label for="product_id" class="col-sm-2 col-form-label text-end">Kode Produk</label>
                        <div class="col">
                            <select wire:model.live="product_id"
                                class="form-select @error('product_id') is-invalid @enderror select2">
                                <option value="">-- Pilih Produk --</option>
                                @foreach ($products as $item)
                                    <option value="{{ $item->id }}">
                                        {{ '(' . $item->product_code . ') - ' . $item->name }}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <span style="font-size: 12px" class="text-secondary">Ready {{ $max_stock }}
                            stok</span>
                    </div>


                    <div class="mt-3">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td class="text-end align-middle">
                                    <label for="total_products">Qty</label>
                                </td>
                                <td>
                                    <input wire:model.live="total_products" id="total_products" type="number"
                                        class="form-control" min="{{ $min_stock }}" max="{{ $max_stock }}">
                                </td>
                                <td class="text-end align-middle">
                                    <label for="sale_price">Harga</label>
                                </td>
                                <td>
                                    <input wire:model="sale_price" id="sele_price" type="text" class="form-control"
                                        readonly>
                                </td>
                                <td class="text-end align-middle">
                                    <label for="total_price">Total</label>
                                </td>
                                <td>
                                    <input wire:model="total_price" id="total_price" type="text" class="form-control"
                                        readonly>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-secondary"><b>+</b></button>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><span style="font-size: 12px" class="text-secondary">Ready {{ $max_stock }}
                                        stok</span></td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </section>

        {{-- detail pembelian --}}
        <section class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Produk</th>
                                <th>Harga (Rp)</th>
                                <th>Qty</th>
                                <th>Total (Rp)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale_details as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ '(' . $item->product->product_code . ') - ' . $item->product->name }}</td>
                                    <td class="text-end">{{ number_format($item->sale_price) }}</td>
                                    <td class="text-center">{{ $item->total_products }}</td>
                                    <td class="text-end">{{ number_format($item->total_price) }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-danger"
                                            wire:click="deleteProduct({{ $item->id }})"><i
                                                class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="fw-bold">
                                <td colspan="4" class="text-end">Subtotal</td>
                                <td class="text-end">{{ number_format($subtotal) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="card">
            <div class="card-body">
            {{-- penjualan produk --}}
            <div class="col-6">
                <form wire:submit="saleProcess">
                    @csrf
                    <div class="mb-3 row">
                        <label for="costumer" class="col-sm-3 col-form-label text-end">Nama Pelanggang</label>
                        <div class="col">
                            <input wire:model="costumer" type="text"
                                class="form-control @error('costumer') is-invalid @enderror">
                            @error('costumer')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="date" class="col-sm-3 col-form-label text-end">Date</label>
                        <div class="col">
                            <input type="date" class="form-control @error('date') is-invalid @enderror"
                                id="date" wire:model="date">
                            @error('date')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="discount" class="col-sm-3 col-form-label text-end">Diskon %</label>
                        <div class="col">
                            <input type="number" class="form-control @error('discount') is-invalid @enderror"
                                id="discount" wire:model.live="discount" min="0" max="100">
                            @error('discount')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="payment_method" class="col-sm-3 col-form-label text-end">Metode Pembayaran</label>
                        <div class="col">
                            <select wire:model="payment_method" id="payment_method" class="form-select">
                                <option value="">--</option>
                                <option value="Tunai">Tunai</option>
                                <option value="Non Tunai">Non Tunai</option>
                            </select>
                            @error('payment_method')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="description" class="col-sm-3 col-form-label text-end">Ket</label>
                        <div class="col">
                            <textarea wire:model="description" id="" class="form-control"></textarea>
                            @error('description')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button wire:click="saleUndo" type="button"
                            class="btn btn-sm btn-danger me-2">Batal</button>
                        <a wire:navigate href="{{ route('sale') }}" type="button"
                            class="btn btn-sm btn-success me-2">Simpan</a>
                        <button type="submit" class="btn btn-sm btn-primary">Proses</button>
                    </div>
                </form>
            </div>
        </div>


        </section>
    </div>

    <script>
        $(document).ready(function() {
            $('.select2').select2();

            $('.select2').on('change', function(e) {
                @this.set('product_id', $(this).val());
            });
        })
    </script>

</div>
