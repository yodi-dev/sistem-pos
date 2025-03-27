<div>
    <div class="nota-header">
        <h2>Nama Toko</h2>
        <p>Alamat Toko: Jalan XYZ No. 123</p>
        <p>Telp: 0812-3456-7890</p>
    </div>
    <hr>
    <table class="nota-table">
        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item['name']); ?></td>
                <td><?php echo e($item['quantity']); ?> x <?php echo e(number_format($item['price'], 0, ',', '.')); ?></td>
                <td><?php echo e(number_format($item['subtotal'], 0, ',', '.')); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    <hr>
    <p>Total: <strong>Rp <?php echo e(number_format($total, 0, ',', '.')); ?></strong></p>
    <div class="nota-footer">
        <p>Terima kasih atas kunjungan Anda!</p>
    </div>
</div><?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views\livewire\transaction\print-nota.blade.php ENDPATH**/ ?>