<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
</script>
<?php if(session()->has('notify')): ?>
    <?php $__currentLoopData = session('notify'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>
            "use strict"; 
            if('<?php echo e($msg[0]); ?>' == 'success')
            {
                Toastify({
                text: "<?php echo e(__($msg[1])); ?>",
                className: "info",
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                }
                }).showToast(); 
            }
            if('<?php echo e($msg[0]); ?>' == 'error')
            {
                Toastify({
                text: "<?php echo e(__($msg[1])); ?>",
                className: "info",
                style: {
                    background: "linear-gradient(to right, #D22B2B, #000000)",
                }
                }).showToast();
            }
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

        Toastify({
        text: "<?php echo e(__($error)); ?>",
        className: "info",
        style: {
            background: "linear-gradient(to right, #D22B2B, #000000)",
        }
        }).showToast(); 
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>

<?php endif; ?>
<script>
    "use strict";
    function notify(status,message) {
     //   toastr.[status](message, [status]);
    }
</script>

<?php /**PATH /home/ltecyxtc/public_html/core/resources/views/partials/toast.blade.php ENDPATH**/ ?>