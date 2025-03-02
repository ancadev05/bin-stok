<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $sale->sale_code }}</title>
    <link href="{{ asset('assets/img/logo-biner.png') }}" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('kaiadmin/css/bootstrap.min.css') }}" />

    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>

</head>

<body>
    <div class="pt-3">
        <section class="row">

            <div class="col-6">
                <div class="d-flex align-items-center border-bottom pb-3">
                    <img src="{{ Storage::url($company->company_logo) }}" alt="" width="55px">
                    <div class="d-flex flex-column ms-3" style="font-size: 12px">
                        <h5 class="fw-bold m-0 p-0">{{ $company->company_name }}</h4>
                            <small>{{ $company->address }}</small>
                            <small>Email: {{ $company->email . ', Telp. ' . $company->telephone }}</small>
                    </div>
                </div>
            </div>
            <div class="col offset-1">
                <table class="table table-sm" style="font-size: 14px">
                    <tr>
                        <td colspan="2" class="fw-bold">PENJUALAN</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">No #</td>
                        <td>: {{ $sale->sale_code }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Tanggal</td>
                        <td>: {{ \Carbon\Carbon::parse($sale->date)->format('d/m/Y') }}</td>
                    </tr>
                </table>
            </div>
        </section>

        <hr>

        <section class="d-flex justify-content-between">
            <span style="font-size: 14px"><strong>Costumer</strong> : {{ $sale->costumer }}</span>
            <span style="font-size: 14px"><strong>Admin/Kasir</strong> : {{ $sale->user->name }}</span>
        </section>

        {{-- detail pembelian --}}
        <section class="mt-3">
            <table class="table table-sm table-bordered" style="font-size: 12px">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga (Rp)</th>
                        <th>Jumlah (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sale_details as $index => $item)
                        <tr>
                            <td class="text-center">{{ ++$index }}</td>
                            <td>{{ '(' . $item->product->product_code . ') - ' . $item->product->name }}</td>
                            <td class="text-center">{{ $item->total_products }}</td>
                            <td class="text-end">{{ number_format($item->sale_price) }}</td>
                            <td class="text-end">{{ number_format($item->total_price) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Subtotal</td>
                        <td class="text-end fw-bold">{{ number_format($sale->total_price) }}</td=>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Diskon %</td>
                        <td class="text-end fw-bold">{{ $sale->discount }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">TOTAL</td>
                        <td class="text-end fw-bold">{{ number_format($sale->discount_price) }}</td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <div class="fw-bold">Ket.</div>
                            <div>{{ $sale->description }}</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section style="font-size: 12px" class="d-flex justify-content-end pe-5 pt-3">
            <div class="d-flex flex-column align-items-center me-5">
                <p class="mb-5">ttd.</p>
                <span class="mt-2">--------</span>
            </div>
        </section>


        <div class="no-print">
            <div class="d-flex justify-content-center mt-3">
                <button onclick="window.close()" class="btn btn-sm btn-danger me-2"><i class="fas fa-print"> </i> Kembali</button>
                <button onclick="printWindow()" class="btn btn-sm btn-info"><i class="fas fa-print"> </i> Cetak</button>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };

        function printWindow() {
            window.print();
        }
    </script>
</body>

</html>
