<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e('Habiba Store'); ?></title>

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="bg-base-300 dark:bg-base-100 flex items-center justify-center min-h-screen">
    <?php echo e($slot); ?>

</body>

</html>
<?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views/layouts/guest.blade.php ENDPATH**/ ?>