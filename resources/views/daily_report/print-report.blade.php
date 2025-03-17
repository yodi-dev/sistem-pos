<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Harian</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            /* padding: 20px; */
            width: 100%;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            color: #555;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }

        .table th {
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
        }

        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }

        p {
            color: #555;
            font-size: 12px;
        }

        footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Laporan Harian</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Pemasukkan</th>
                    <th>Pengeluaran</th>
                    <th>Tabungan</th>
                    <th>Saldo QRIS</th>
                    <th>Saldo</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $report->formatted_report_date }}</td>
                        <td>Rp. {{ number_format($report->total_income, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($report->total_outcome, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($report->savings, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($report->qris_balance, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($report->balance, 0, ',', '.') }}</td>
                        <td>{{ $report->notes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <footer>
            <p>Oleh Habiba Store | dicetak pada {{ now()->format('d M Y H:i') }}</p>
        </footer>
    </div>
</body>

</html>
