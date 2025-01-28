<div>
    <div class="pagetitle">
        <h1>Pembelian</h1>
    </div>

    <section class="bg-white p-2 shadow-sm">
        <div class="row mb-3">
            <div class="col-6">
                {{-- pembelian produk --}}
                <section>
                    <form wire:submit="purchaseDetailsStore">
                        @csrf
                        <div class="mb-3 row">
                            <label for="purchase_code" class="col-sm-3 col-form-label text-end">Kode Transaksi</label>
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
                            <div class="col">
                                <select wire:model="product_id" id="product_id" class="select2 form-select">
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
                        </div>
                        <div class="mb-3 row">
                            <label for="purchase_price" class="col-sm-3 col-form-label text-end">Harga Satuan</label>
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
                        <div class="row">
                            <div class="col offset-3">
                                <button type="submit" class="btn btn-sm btn-secondary">Tambah</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>

            <div class="col-6 border-start">
                <form wire:submit="purchaseProcess">
                    @csrf
                    <div class="mb-3 row">
                        <label for="supplier_name" class="col-sm-3 col-form-label text-end">Supplayer</label>
                        <div class="col">
                            <select wire:model="supplier_name" id="supplier_name" class="form-select">
                                <option value="">-- Pilih Supplayer --</option>
                                @foreach ($suppliers as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('supplier_name')
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
                            <textarea wire:model="description" id="description" class="form-control"></textarea>
                            @error('description')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button wire:click="purchaseUndo" type="button"
                            class="btn btn-sm btn-danger me-2">Batal</button>
                        <a wire:navigate href="{{ route('purchase') }}" type="button"
                            class="btn btn-sm btn-success me-2">Simpan</a>
                        <button type="submit" class="btn btn-sm btn-primary">Proses</button>
                    </div>
                </form>
            </div>
        </div>

        <hr>

        {{-- detail pembelian --}}
        <section class="mt-3">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga Beli (Rp)</th>
                        <th>Total (Rp)</th>
                        <th>Aksi</th>
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
                            <td class="text-center">
                                <button class="btn badge text-bg-danger"
                                    wire:click="deleteProduct({{ $item->id }})"><i
                                        class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-end">Subtotal</td>
                        <td class="text-end fw-bold">{{ number_format($subtotal) }}</td=>
                        <td class="text-end"></td>
                    </tr>
                </tbody>
            </table>
            <div class="border p-2 mb-3">
                <h3 class="fw-bold text-center">Total Bayar : Rp {{ number_format($discount_price) }}</h3>
            </div>

            {{-- <section>
                <div class="alert alert-info">Pembelian yang sudah di proses tidak bisa dibatalkan atau dihapus!</div>
            </section> --}}
        </section>

        <hr>

    </section>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('.select2').on('change', function(e) {
                @this.set('product_id', $(this).val());
            });
        });

        document.addEventListener('livewire:load', function() {
            // $('.select2').select2();
            initializeSelect2();

            window.livewire.on('select2', () => {
                $('.select2').select2();
            });

            function initializeSelect2() {
                $('.select2').select2();
                $('.select2').on('change', function(e) {
                    @this.set('selectedValue', $(this).val());
                });
            }
        });

        // window.livewire.on('select2', () => {
        //     $('.select2').select2();
        // });
    </script>
</div>
