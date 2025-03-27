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
    <?php $__currentLoopData = $barcodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barcode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="barcode">
            <strong><?php echo e($product->name); ?></strong>
            <img src="data:image/png;base64,<?php echo $barcode; ?>" alt="Barcode">
            <small><?php echo e($product->code); ?></small>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>

</html><?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views\livewire\barcode\print.blade.php ENDPATH**/ ?>