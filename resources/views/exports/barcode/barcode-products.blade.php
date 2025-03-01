<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>barcode-products</title>

    <style>
        @media print {
            .no-print {
                display: none;
            }
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <button onclick="window.close()" class="no-print"><< Kembali</button>
    <h3>Barcode Produk</h3>

    <table border="1" width="100%">
        <tr>
            @foreach ($products as $item)
                <td class="text-center">{!! Milon\Barcode\Facades\DNS1DFacade::getBarcodeSVG(strval($item->product_code), 'C93', 1,35) !!}</td>
                @if ($no++ % 4 == 0)
        <tr></tr>
        @endif
        @endforeach
        </tr>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.print();
        });
    </script>
</body>

</html>
