<form
    <?php echo e($attributes->whereDoesntStartWith('class')); ?>

    <?php echo e($attributes->class(['grid grid-flow-row auto-rows-min gap-3'])); ?>

>

    <?php echo e($slot); ?>


    <!--[if BLOCK]><![endif]--><?php if($actions): ?>
        <!--[if BLOCK]><![endif]--><?php if(!$noSeparator): ?>
            <hr class="my-3" />
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <div class="flex justify-end gap-3">
            <?php echo e($actions); ?>

        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</form><?php /**PATH C:\Users\asus\Herd\sistem-pos\storage\framework\views/761c2dfe926439bb440c4fb21469711d.blade.php ENDPATH**/ ?>