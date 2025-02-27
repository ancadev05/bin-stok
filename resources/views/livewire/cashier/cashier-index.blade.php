<div>
    <section class="mb-3">
        <button wire:click="addOrder" class="btn btn-sm btn-primary"><i class="fas fa-plus"> </i> Order</button>
    </section>

    <section>
        <ul class="nav nav-tabs">
            @foreach ($sales as $item)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cashier.sales', $item->id) }}">{{ $item->sale_code }}</a>
                </li>
            @endforeach
        </ul>
    </section>

    {{-- <div class="card"> --}}
        {{-- <div class="card-body"> --}}
            <div class="d-flex flex-wrap">
                @foreach ($products as $item)
                    <div class="card m-3" style="width: 10rem;">
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $item->stock }}</span>
                        <img src="{{ Storage::url($item->images) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->brand .'-'. $item->name }}</h5>
                            <p class="text-secondary">Rp{{ number_format($item->selling_price) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        {{-- </div> --}}
    {{-- </div> --}}

    @push('script')
        <script>
            $(window).on('load', function() {
                // menyembunyikan shidebar otomatis
                $('.gg-menu-right').click();
                $('.main-header').none();
            });
        </script>
    @endpush
</div>
