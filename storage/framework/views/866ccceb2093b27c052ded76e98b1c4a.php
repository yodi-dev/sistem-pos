<div>
    <div class="mb-6">
        <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
            <div role="alert" class="alert alert-neutral mb-3 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span><?php echo e(session('message')); ?></span>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('report.temporary-report');

$__html = app('livewire')->mount($__name, $__params, 'lw-2407071180-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        <div class="divider"></div>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('report.report-table');

$__html = app('livewire')->mount($__name, $__params, 'lw-2407071180-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>

</div>
<?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views/livewire/report/report-manager.blade.php ENDPATH**/ ?>