<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian</title>

    <style>
        body {
            font-family: sans-serif;
        }
        .table1 {
            color: #444;
            border-collapse: collapse;
            /* border-color: #ff0000 */
            width: 100%;
            border: 1px solid #a7a7a7;
        }

        .table1 tr th {
            background: #35A9DB;
            color: #fff;
            font-weight: normal;
        }

        .table1,
        th,
        td {
            padding: 5px 5px;
            /* text-align: center; */
        }

        .table1 tr:hover {
            background-color: #f5f5f5;
        }

        .table1 tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table1 .text-end {
            text-align: right;
        }

        .table1 .text-center {
            text-align: center;
        }

        .kop h3{
            margin: 0;
            padding: 0;
            text-align: center;
            color: #252525
        }
    </style>

</head>

<body>
    <div class="kop">
        <h3>{{ $company[0]->company_name }}</h3>
        <h3>Laporan Pembelian</h3>
        {{-- <h3>{{  }}</h3> --}}
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table1" width="100%" border="1" cellspacing="0">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode Transaksi</th>
                    <th>Supplayer</th>
                    <th>Total Item</th>
                    <th>Harga (Rp)</th>
                    <th>Discount</th>
                    <th>Total (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $index => $item)
                    <tr>
                        <td class="text-center">{{ ++$index }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                        <td>{{ $item->purchase_code }}</td>
                        <td>{{ $item->supplier_name }}</td>
                        <td class="text-center">{{ $item->purchaseDetails->sum('total_products') }}</td>
                        <td class="text-end">{{ number_format($item->total_price) }}</td>
                        <td class="text-center">{{ $item->discount }}%</td>
                        <td class="text-end">{{ number_format($item->discount_price) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="7" style="font-weight: bold">Total</td>
                    <td class="text-end" style="font-weight: bold">{{ number_format($total) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
