<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kulakan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
        }

        .details,
        .items {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .details td,
        .items th,
        .items td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .details td {
            background-color: #f9f9f9;
        }

        .items th {
            background-color: #f1f1f1;
            font-weight: bold;
        }

        .items td {
            text-align: center;
        }

        .footer {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Kulakan - Habisa Store</h2>
        <p>{{ $selectedWholesale->formatted_date }}</p>
    </div>

    <table class="details">
        <tr>
            <td><strong>Supplier:</strong></td>
            <td>{{ $selectedWholesale->supplier->name }}</td>
        </tr>
    </table>

    <table class="items">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($selectedWholesale->wholesaleItems as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="text-align: left;">{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="footer">
        <p>Dicetak pada: {{ now()->format('d-m-Y H:i:s') }}</p>
    </div> --}}
</body>

</html>
