<script src="<?php echo e(asset('assets/global/js/slim_notifier.js')); ?>"></script>
<?php if(session()->has('notify')): ?>
    <?php $__currentLoopData = session('notify'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>
            "use strict";
            SlimNotifierJs.notification('<?php echo e($msg[0]); ?>', '<?php echo e(__($msg[0])); ?>', '<?php echo e(__($msg[1])); ?>', 15000);
        </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<script>
</script>
<?php if(isset($errors) && $errors->any()): ?>
    <?php
        $collection = collect($errors->all());
        $errors = $collection->unique();
    ?>

    <script>
        "use strict";
        <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        SlimNotifierJs.notification('error', 'Oops', '<?php echo e(__($error)); ?>', 15000);
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>

<?php endif; ?>
<script>
    "use strict";
    function notify(status,message) {
        SlimNotifierJs.notification([status], 'Hello', message, 15000);
    }
</script>

<?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/partials/notify.blade.php ENDPATH**/ ?>