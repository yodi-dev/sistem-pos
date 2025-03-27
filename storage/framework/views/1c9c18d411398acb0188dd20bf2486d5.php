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
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>


<body>
    <?php echo e($slot); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>

</html>
<?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views\layouts\print.blade.php ENDPATH**/ ?>