<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            font-family: sans-serif;
        }

        .table {
            color: #444;
            border-collapse: collapse;
            /* border-color: #ff0000 */
            width: 100%;
            border: 1px solid #a7a7a7;
        }

        .table tr th {
            /* background: #35A9DB; */
            color: #444;
            font-weight: bold;
        }

        .table,
        th,
        td {
            padding: 5px 5px;
            /* text-align: center; */
        }

        .table .text-end {
            text-align: right;
        }

        .table .text-center {
            text-align: center;
        }

        .kop h3 {
            margin: 0;
            padding: 0;
            text-align: center;
            color: #252525
        }

        #company-logo {
            display: flex;
            align-items: center;
        }

        #company-logo img {
            margin-right: 10px
        }

        .fw-bold {
            font-weight: bold;
        }

        .text-end {
            text-align: right;
        }
    </style>

</head>

<body>

    <section class="row">

        <table width="100%">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>
                                <img src=".{{ Storage::url($company[0]->company_logo) }}" alt="" width="55px">
                            </td>
                            <td>
                                <div style="color: #444">
                                    <h2 style="margin: 0">{{ $company[0]->company_name }}</h2>
                                    <p style="margin: 0; font-size: 12px;">{{ $company[0]->address }}</p>
                                    <p style="margin: 0; font-size: 12px;">Email:
                                        {{ $company[0]->email . ', Telp. ' . $company[0]->telephone }}</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <div class="col offset-1">
                        <table class="table table-sm" style="font-size: 14px">
                            <tr>
                                <td colspan="2" class="fw-bold" style="font-weight: bold">PEMBELIAN</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">No #</td>
                                <td>: {{ $purchase->purchase_code }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tanggal</td>
                                <td>: {{ \Carbon\Carbon::parse($purchase->date)->format('d/m/Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </section>

    <hr>
    <section>
        <span style="font-size: 14px"><strong>Supplayer</strong> : {{ $purchase->supplier_name }}</span>
    </section>
    <div class="table-responsive">
        <table class="table table-sm table-bordered" style="font-size: 12px" border="1">
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
                @foreach ($purchase_details as $index => $item)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ '(' . $item->product->product_code . ') - ' . $item->product->name }}</td>
                        <td class="text-center">{{ $item->total_products }}</td>
                        <td class="text-end">{{ number_format($item->purchase_price) }}</td>
                        <td class="text-end">{{ number_format($item->total_price) }}</td>
                    </tr>
                @endforeach
                <tr class="fw-bold text-end">
                    <td colspan="4">Subtotal</td>
                    <td class="text-end">{{ number_format($purchase->total_price) }}</td=>
                </tr>
                <tr class="fw-bold text-end">
                    <td colspan="4">Diskon %</td>
                    <td class="text-end">{{ $purchase->discount }}</td>
                </tr>
                <tr class="fw-bold text-end">
                    <td colspan="4"><b>TOTAL</b></td>
                    <td>{{ number_format($purchase->discount_price) }}</td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div class="fw-bold">Ket.</div>
                        <div>{{ $purchase->description }}</div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table width="100%" style="margin-top: 70px;margin-right: 50px;">
            <tr class="text-end">
                <td><span style="margin-top: 60px; margin-right: 50px; color: #444;"><u>ttd.</u></span></td>
            </tr>
        </table>
    </div>
</body>

</html>
