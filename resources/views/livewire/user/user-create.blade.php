<div>
    <div class="page-header">
        <h4 class="page-title">Tambah Akun</h4>
    </div>

    <div class="page-category">
        <section class="card">
            <div class="card-body">
                <form wire:submit="store">
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label text-end">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" wire:model="name">
                            @error('name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label text-end">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" wire:model="email">
                            @error('email')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label text-end">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" wire:model="password">
                            @error('password')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-2">
                            <a wire:navigate href="{{ route('users') }}" class="btn btn-sm btn-secondary">Batal</a>
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
