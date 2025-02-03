<div>
    <div wire:ignore.self class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='store()'>
                    <div class="modal-body">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
