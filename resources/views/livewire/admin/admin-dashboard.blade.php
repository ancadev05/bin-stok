<div>
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Produk</h1>
                    {{ $products }}
                </div>
            </div>
        </div>
        
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Pembelian Hari Ini</h1>
                    <h3>{{ 'Rp '.number_format($purchases) }}</h3>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Penjualan Hari Ini</h1>
                    <h3>{{ 'Rp '.number_format($sales) }}</h3>
                </div>
            </div>
        </div>
    </div>

</div>
