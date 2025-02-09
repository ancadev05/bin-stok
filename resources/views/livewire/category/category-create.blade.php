<div>
    <div class="page-header mb-3">
        <h4 class="page-title">Tambah Kategori Produk</h4>
    </div>

    <section class="card">
        <div class="card-body">
            <form wire:submit="store">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label text-end">Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" wire:model="name" autofocus>
                            @error('name')
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
                        <a wire:navigate href="{{ route('category') }}" class="btn btn-sm btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        <button type="button" wire:click="saveNew" class="btn btn-sm btn-warning">Simpan +
                            Baru</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
