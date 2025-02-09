<div>
    <div class="page-header">
        <h4 class="page-title">Tambah Produk</h4>
    </div>

    <div class="page-category">
        <section class="card">
            <div class="card-body">
                <form wire:submit="store">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="category_id" class="col-sm-2 col-form-label text-end">Kategori</label>
                            <div class="col-sm-10">
                                <select wire:model="category_id" id="" class="form-select">
                                    <option value="">--Pilih Kategori--</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="product_code" class="col-sm-2 col-form-label text-end">Kode Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('product_code') is-invalid @enderror"
                                    id="product_code" wire:model="product_code">
                                <small style="font-size: 12px" class="text-secondary"><i>Jika kode produk kosong, maka
                                        akan digenerate otomatis!</i></small>
                                @error('product_code')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-2 col-form-label text-end">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" wire:model="name">
                                @error('name')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="brand" class="col-sm-2 col-form-label text-end">Merek</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('brand') is-invalid @enderror"
                                    id="brand" wire:model="brand">
                                @error('brand')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="specifications" class="col-sm-2 col-form-label text-end">Spesifikasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('specifications') is-invalid @enderror"
                                    id="specifications" wire:model="specifications">
                                @error('specifications')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="cost" class="col-sm-2 col-form-label text-end">HPP</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control @error('cost') is-invalid @enderror"
                                    id="cost" wire:model="cost">
                                @error('cost')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="selling_price" class="col-sm-2 col-form-label text-end">Harga Jual</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control @error('selling_price') is-invalid @enderror"
                                    id="selling_price" wire:model="selling_price">
                                @error('selling_price')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="min_stock" class="col-sm-2 col-form-label text-end">Stok Minimal</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control @error('min_stock') is-invalid @enderror"
                                    id="min_stock" wire:model="min_stock">
                                @error('min_stock')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="gambar" class="col-sm-2 col-form-label text-end">Gambar</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('gambar') is-invalid @enderror"
                                    id="gambar" wire:model="gambar">
                                @error('gambar')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="description" class="col-sm-2 col-form-label text-end">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description" wire:model="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-2">
                            <a wire:navigate href="{{ route('product') }}" class="btn btn-sm btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            <button type="button" wire:click="saveNew" class="btn btn-sm btn-warning">Simpan +
                                Baru</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
