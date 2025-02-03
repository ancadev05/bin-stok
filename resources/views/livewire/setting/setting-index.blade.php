<div>
    <div class="pagetitle">
        <h1>Pengaturan</h1>
    </div>

    <section class="bg-white p-3 shadow-sm">
        <div class="mb-3 row">
            <label for="product_code" class="col-sm-2 col-form-label text-end">Nama Perusahaan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('product_code') is-invalid @enderror"
                    id="product_code" wire:model="product_code">
                @error('product_code')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="product_code" class="col-sm-2 col-form-label text-end">Telepon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('product_code') is-invalid @enderror"
                    id="product_code" wire:model="product_code">
                @error('product_code')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="product_code" class="col-sm-2 col-form-label text-end">Alamat</label>
            <div class="col-sm-10">
                <textarea wire:model="product_code" id="product_code" class="form-control"></textarea>
                @error('product_code')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="product_code" class="col-sm-2 col-form-label text-end">Logo Perusahaan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('product_code') is-invalid @enderror"
                    id="product_code" wire:model="product_code">
                @error('product_code')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="offset-2">
                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            </div>
        </div>
    </section>
</div>
