<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Transaksi</title>
    <style>
        body {
            font-family: monospace;
            font-size: 12px;
            width: 58mm;
            margin: 0;
        }

        .nota-header {
            text-align: center;
        }

        .nota-table {
            width: 100%;
            border-collapse: collapse;
        }

        .nota-table td {
            padding: 4px 0;
        }

        .nota-footer {
            margin-top: 10px;
            text-align: center;
        }

        @media print {
            @page {
                size: 58mm auto;
                /* Custom ukuran kertas */
                margin: 0;
                /* Hilangkan margin */
            }

            body {
                width: 58mm;
                /* Cocokkan lebar konten */
            }
        }
    </style>
    @livewireStyles
</head>


<body>
    {{ $slot }}
    @livewireScripts
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
