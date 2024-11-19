<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cetak Barcode</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .barcode {
            width: 87%;
            height: auto;
            padding: 10px;
            text-align: center;
            border: 2px solid #aaaaaa;
        }

        .barcode img {
            width: 100%;
            height: 10mm;
            margin: 5px 0 5px;
        }

        /* Aturan untuk cetak */
        @media print {
            body {
                margin: 0;
            }

            .barcode-container {
                page-break-inside: avoid;
                /* Hindari potongan antar halaman */
            }
        }

        @page {
            size: 50mm 30mm;
            margin: 0;
        }
    </style>
</head>

<body>
    @foreach ($barcodes as $barcode)
        <div class="barcode">
            <strong>{{ $product->name }}</strong>
            <img src="data:image/png;base64,{!! $barcode !!}" alt="Barcode">
            <small>{{ $product->code }}</small>
        </div>
    @endforeach
</body>

</html>
