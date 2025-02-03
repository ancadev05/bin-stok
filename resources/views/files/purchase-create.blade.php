<div>
    <div class="pagetitle">
        <h1>Pembelian</h1>
    </div>

    <section class="bg-white p-2 shadow-sm">
        <div class="row">
            <div class="col-6">
                {{-- pembelian produk --}}
                <section>
                    <form wire:submit="purchaseDetailsStore">
                        @csrf
                        <div class="mb-3 row">
                            <label for="purchase_code" class="col-sm-3 col-form-label text-end">Kode Pembelian</label>
                            <div class="col">
                                <input type="text" class="form-control @error('purchase_code') is-invalid @enderror"
                                    id="purchase_code" wire:model="purchase_code" disabled>
                                @error('purchase_code')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="product_id" class="col-sm-3 col-form-label text-end">Kode Produk</label>
                            <div class="col d-flex">
                                <select wire:model="product_id" id="product_id" class="form-select">
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach ($products as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="purchase_price" class="col-sm-3 col-form-label text-end">Harga Beli</label>
                            <div class="col">
                                <input type="number" class="form-control @error('purchase_price') is-invalid @enderror"
                                    id="purchase_price" wire:model="purchase_price">
                                @error('purchase_price')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="total_products" class="col-sm-3 col-form-label text-end">Qty</label>
                            <div class="col">
                                <input type="number" class="form-control @error('total_products') is-invalid @enderror"
                                    id="total_products" wire:model="total_products">
                                @error('total_products')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-primary offset-3" wire:click="render">Tambah</button>
                        </div>
                    </form>
                </section>

                <hr>


            </div>

            <div class="col-6">
                <div class="mb-3 row">
                    <label for="name" class="col-sm-3 col-form-label text-end">Supplayer</label>
                    <div class="col d-flex">
                        <select name="" id="" class="form-select">
                            <option value="">-- Pilih Supplayer --</option>
                            @foreach ($suppliers as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('name')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="date" class="col-sm-3 col-form-label text-end">Date</label>
                    <div class="col">
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                            wire:model="date">
                        @error('date')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="discount" class="col-sm-3 col-form-label text-end">Diskon</label>
                    <div class="col">
                        <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount"
                            wire:model="discount">
                        @error('discount')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="payment_method" class="col-sm-3 col-form-label text-end">Metode Bayar</label>
                    <div class="col">
                        <input type="date" class="form-control @error('payment_method') is-invalid @enderror" id="payment_method"
                            wire:model="payment_method">
                        @error('payment_method')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>


        {{-- detail pembelian --}}
        <section class="mt-3">
            <table class="table table-sm">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga Beli</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($purchase_details as $index => $item)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $item->purchase->product->name }}</td>
                            <td class="text-end">{{ number_format($item->purchase_price) }}</td>
                            <td class="text-center">{{ $item->total_products }}</td>
                            <td class="text-end">{{ number_format($item->total_price) }}</td>
                            <td class="text-center">
                                <button class="btn badge text-bg-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
            <div class="border p-2 mb-3">
                <h3 class="fw-bold text-center">Total Bayar : {{ $total_price }}</h3>
            </div>

            <section>
                <div class="alert alert-info">Pembelian yang sudah di proses tidak bisa dibatalkan atau dihapus!</div>
            </section>
        </section>

        <button wire:click="batalkanPembelian" class="btn btn-sm btn-danger">Batal</button>
        <button wire:click="" class="btn btn-sm btn-primary">Proses</button>
    </section>
</div>
