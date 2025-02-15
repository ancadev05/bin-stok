<div>
    <div class="page-header">
        <h4 class="page-title">Pembelian</h4>
    </div>

    <div class="card">
        <section class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    {{-- pembelian produk --}}
                    <section>
                        <form wire:submit.prevent="purchaseDetailsStore">
                            @csrf
                            <div class="mb-3 row">
                                <label for="purchase_code" class="col-sm-3 col-form-label text-end">Kode Transaksi</label>
                                <div class="col">
                                    <input type="text"
                                        class="form-control @error('purchase_code') is-invalid @enderror"
                                        id="purchase_code" wire:model="purchase_code" disabled>
                                    @error('purchase_code')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div wire:ignore.prevent class="mb-3 row">
                                <label for="product_id" class="col-sm-3 col-form-label text-end">Kode Produk</label>
                                <div class="col">
                                    <select wire:model="product_id" id="product_id"
                                        class="select2 form-select @error('product_id') is-invalid @enderror">
                                        <option value="" selected>-- Pilih Produk --</option>
                                        @foreach ($products as $item)
                                            <option value="{{ $item->id }}">
                                                {{ '(' . $item->product_code . ') - ' . $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('product_id')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="purchase_price" class="col-sm-3 col-form-label text-end">Harga
                                    Satuan</label>
                                <div class="col">
                                    <input type="number"
                                        class="form-control @error('purchase_price') is-invalid @enderror"
                                        id="purchase_price" wire:model="purchase_price">
                                    @error('purchase_price')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="total_products" class="col-sm-3 col-form-label text-end">Qty</label>
                                <div class="col">
                                    <input type="number"
                                        class="form-control @error('total_products') is-invalid @enderror"
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
                    <form wire:submit.prevent="purchaseProcess">
                        @csrf
                        <div class="mb-3 row">
                            <label for="supplier_name" class="col-sm-3 col-form-label text-end">Supplayer</label>
                            <div class="col">
                                <select wire:model="supplier_name" id="supplier_name"
                                    class="form-select @error('supplier_name') is-invalid @enderror">
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
                            <label for="payment_method" class="col-sm-3 col-form-label text-end">Metode
                                Pembayaran</label>
                            <div class="col">
                                <select wire:model="payment_method" id="payment_method" class="form-select">
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
                            {{-- <a wire:navigate href="{{ route('purchase') }}" type="button"
                            class="btn btn-sm btn-success me-2">Simpan</a> --}}
                            <button type="submit" class="btn btn-sm btn-primary">Proses</button>
                        </div>
                    </form>
                </div>
            </div>

            <hr>

            {{-- detail pembelian --}}
            <section class="mt-3">
                <div class="table-responsive">
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
                                        <button class="btn btn-xs btn-danger"
                                            wire:click="deleteProduct({{ $item->id }})"><i
                                                class="far fa-trash-alt"></i></button>
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
                </div>
                <div class="border p-2 mb-3">
                    <h3 class="fw-bold text-center">Total Bayar : Rp {{ number_format($discount_price) }}</h3>
                </div>
            </section>

            <hr>

        </section>
    </div>


    @push('script')
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    theme: "bootstrap"
                });

                $('.select2').on('change', function(e) {
                    @this.set('product_id', $(this).val());
                });

                livewire.on('failed', (event) => {
                    console.log('gagal');
                    
                });
            })
        </script>
    @endpush
</div>
