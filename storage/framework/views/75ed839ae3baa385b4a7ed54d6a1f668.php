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
        <p><?php echo e($selectedWholesale->formatted_date); ?></p>
    </div>

    <table class="details">
        <tr>
            <td><strong>Supplier:</strong></td>
            <td><?php echo e($selectedWholesale->supplier->name); ?></td>
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
            <?php $__currentLoopData = $selectedWholesale->wholesaleItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td style="text-align: left;"><?php echo e($item->product->name); ?></td>
                    <td><?php echo e($item->quantity); ?></td>
                    <td><?php echo e($item->unit); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    
</body>

</html>
<?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views/wholesale/print.blade.php ENDPATH**/ ?>