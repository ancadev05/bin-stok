<div>
    <div class="page-header">
        <h4 class="page-title">Edit Pengaturan</h4>
    </div>

    <div class="page-category">
        <section class="card">
            <div class="card-body">
                <form wire:submit="update" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label for="company_name" class="col-sm-2 col-form-label text-end">Nama Perusahaan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                                id="company_name" wire:model="company_name" autofocus>
                            @error('company_name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="address" class="col-sm-2 col-form-label text-end">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                                id="address" wire:model="address" autofocus>
                            @error('address')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telephone" class="col-sm-2 col-form-label text-end">Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('telephone') is-invalid @enderror"
                                id="telephone" wire:model="telephone" autofocus>
                            @error('telephone')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label text-end">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" wire:model="email" autofocus>
                            @error('email')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="website" class="col-sm-2 col-form-label text-end">Website</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('website') is-invalid @enderror"
                                id="website" wire:model="website" autofocus>
                            @error('website')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="company_logo" class="col-sm-2 col-form-label text-end">Logo</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control @error('company_logo') is-invalid @enderror"
                                id="company_logo" wire:model="company_logo" autofocus>
                            @error('company_logo')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                            @if ($company_logo)
                                <img src="{{ $company_logo->temporaryUrl() }}" width="150px" class="mt-3">
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-2">
                            <a wire:navigate href="{{ route('company') }}" class="btn btn-sm btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
