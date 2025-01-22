<div>
    <div class="pagetitle mb-3">
        <h1>Edit Kategori Produk</h1>
    </div>
    <section class="card p-3">
        <form wire:submit="update">
            @csrf
            <div class="modal-body">
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label text-end">Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            wire:model="name">
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
                </div>
            </div>
        </form>
    </section>
</div>
