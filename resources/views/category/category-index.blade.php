@extends('template-dashboard.main')

{{-- @push('style')
    @livewireStyles
@endpush --}}

{{-- @push('script')
    @livewireScripts
    
    <script>
        Livewire.on('modal-close', () => {
            $('#tambah-kategori').modal('hide');
        });
    </script>

    <script>
        Livewire.on('post-created', () => {
            $('#tambah-kategori').modal('hide');
        });
    </script>
@endpush --}}

@section('content')
    <div class="pagetitle">
        <h1>Kategori Produk</h1>
    </div>

    {{-- @livewire('category.category-index')
    @livewire('category.category-create') --}}

@endsection
