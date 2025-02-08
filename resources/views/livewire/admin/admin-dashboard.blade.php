<div>
    <div class="page-header">
        <h4 class="page-title">Dashboard</h4>
    </div>

    <div class="page-category">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Total Produk</h1>
                        <h3>{{ $products }}</h3>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Pembelian Hari Ini</h1>
                        <h3>{{ 'Rp ' . number_format($purchases) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Penjualan Hari Ini</h1>
                        <h3>{{ 'Rp ' . number_format($sales) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
