<div>
    <div class="page-header">
        <h4 class="page-title">Edit Supplayer</h4>
    </div>

    <div class="page-category">
        <section class="card">
            <div class="card-body">
                <form wire:submit="update">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-2 col-form-label text-end">Nama Supplayer</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" wire:model="name" autofocus>
                                @error('name')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="address" class="col-sm-2 col-form-label text-end">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    id="address" wire:model="address">
                                @error('address')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="phone_number" class="col-sm-2 col-form-label text-end">No. Telepon</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control @error('phone_number') is-invalid @enderror"
                                    id="phone_number" wire:model="phone_number">
                                @error('phone_number')
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
                            <a wire:navigate href="{{ route('supplier') }}" class="btn btn-sm btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
