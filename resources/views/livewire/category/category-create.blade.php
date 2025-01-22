<div>
    <div class="pagetitle mb-3">
        <h1>Tambah Kategori Produk</h1>
    </div>
    <section class="card p-3">
        <form wire:submit="store">
            @csrf
            <div class="modal-body">
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label text-end">Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            wire:model="name" autofocus>
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
            <div class="">
                <a wire:navigate href="{{ route('category') }}" class="btn btn-sm btn-secondary">Batal</a>
                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            </div>
        </form>
    </section>
</div>
