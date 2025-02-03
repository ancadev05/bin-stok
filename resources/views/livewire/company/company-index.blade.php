<div>
    <div class="pagetitle">
        <h1>Pengaturan</h1>
    </div>

    @if (session('status'))
        <section>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </section>
    @endif

    <section class="bg-white p-3 shadow-sm">
        <table class="table table-sm">
            <tr>
                <td>Nama Perusahan</td>
                <td>: {{ $company->company_name }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $company->address }}</td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>: {{ $company->telephone }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>: {{ $company->email }}</td>
            </tr>
            <tr>
                <td>Website</td>
                <td>: {{ $company->website }}</td>
            </tr>
            <tr>
                <td>Logo</td>
                <td>:
                    <img src="{{ Storage::url($company->company_logo) }}" alt="" width="100px">
                    {{-- <img src="{{ asset('storage/logo/' . $company->company_logo) }}" alt="" width="100px"> --}}
                </td>
            </tr>
        </table>

        <div class="d-flex justify-content-end mt-3">
            <a wire:navigate href="{{ route('company.edit', $company->id) }}" class="btn btn-sm btn-warning"><i
                    class="bi bi-pencil-square"></i> Edit</a>
        </div>
    </section>
</div>
