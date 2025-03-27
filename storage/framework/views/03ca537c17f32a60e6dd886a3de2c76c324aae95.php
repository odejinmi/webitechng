

<?php $__env->startSection('content'); ?>
    <!-- page-wrapper start -->
    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme">
        <?php echo $__env->yieldContent('panel'); ?>
    </div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/layouts/store.blade.php ENDPATH**/ ?>