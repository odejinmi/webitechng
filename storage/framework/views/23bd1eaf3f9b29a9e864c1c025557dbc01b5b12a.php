<?php $__env->startSection('content'); ?>

<center>
    <!--begin::Title-->
    <h1 class="fw-bolder text-gray-900 mb-5">
        <?php echo app('translator')->get('Your account is deactivated'); ?>
    </h1>
    <!--end::Title-->

    <!--begin::Text-->
    <div class="fw-semibold fs-6 text-gray-500 mb-8">
        <?php echo e(__($user->ban_reason)); ?>

    </div>
    <!--end::Text-->

    <!--begin::Link-->
    <div class="mb-11">
        <a href="<?php echo e(route('user.logout')); ?>" class="btn btn-sm btn-primary"><?php echo app('translator')->get('Logout'); ?></a>
    </div>
    <!--end::Link-->
</center>


<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/satoshi/user/auth/authorization/ban.blade.php ENDPATH**/ ?>