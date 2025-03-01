<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $sale->sale_code }}</title>
    <link href="{{ asset('assets/img/logo-biner.png') }}" rel="icon" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('kaiadmin/css/bootstrap.min.css') }}" />

    <style>
        p {
            font-size: 11px;
        }

        hr {
            margin: 1px;
        }

        table {
            font-size: 11px;
        }

        .struk {
            width: 75mm;
            margin: auto;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="struk">
        <div class="d-flex flex-column">
            <img src="{{ Storage::url($company->company_logo) }}" alt="" width="20px" class="m-auto my-2">
            <h6 class="text-center m-0">{{ $company->company_name }}</h6>
            <p class="text-center m-0">{{ $company->address }}</p>
            <p class="text-center m-0">{{ $company->telephone }}</p>
        </div>
        <hr>

        <table class="w-100">
            <tr>
                <td>Tgl.</td>
                <td>: {{ date('d-m-Y h:i:s') }}</td>
                <td>Pembayaran</td>
                <td>: {{ $sale->payment_method }}</td>
            </tr>
            <tr>
                <td>Ref.</td>
                <td>: {{ $sale->sale_code }}</td>
                <td>Kasir</td>
                <td>: {{ $sale->user->name }}</td>
            </tr>
        </table>
        <hr>
        <table class="w-100">
            <tr>
                <td class="fw-bold">No</td>
                <td class="fw-bold">Nama Barang</td>
                <td class="fw-bold">Harga Satuan</td>
                <td class="text-end fw-bold">Total</td>
            </tr>
            @foreach ($sales_details as $index => $item)
                <tr>
                    <td>{{ ++$index }}</td>
                    <td>{{ $item->product->product_code . '-' . $item->product->name }}</td>
                    <td>{{ $item->total_products . ' x ' . number_format($item->product->selling_price) }}</td>
                    <td class="text-end">{{ number_format($item->total_price) }}</td>
                </tr>
            @endforeach
        </table>
        <hr>
        <table class="w-100">
            <tr>
                <td>Sub Total</td>
                <td class="text-end fw-bold">{{ number_format($sale->total_price) }}</td>
            </tr>
            <tr>
                <td>Discount %</td>
                <td class="text-end fw-bold">{{ $sale->discount }}</td>
            </tr>
        </table>
        <hr>
        <table class="w-100">
            <tr>
                <td>Total</td>
                <td class="text-end fw-bold">{{ number_format($sale->discount_price) }}</td>
            </tr>
            <tr>
                <td>Bayar</td>
                <td class="text-end fw-bold">{{ number_format($sale->pay) }}</td>
            </tr>
            <tr>
                <td>Kembalian</td>
                <td class="text-end fw-bold">{{ number_format($sale->change) }}</td>
            </tr>
        </table>
        <hr>
        <p class="text-center mt-3">=== TERIMAKASIH ATAS KUNJUNGAN ANDA ===</p>
    </div>

    <div class="no-print">
        <div class="d-flex justify-content-center mt-3">
            <button onclick="window.close()" class="btn btn-sm btn-danger me-2"><i class="fas fa-print"> </i> Kembali</button>
            <button onclick="printWindow()" class="btn btn-sm btn-info"><i class="fas fa-print"> </i> Cetak</button>
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
