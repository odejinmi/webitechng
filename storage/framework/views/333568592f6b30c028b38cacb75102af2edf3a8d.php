<?php $__env->startSection('content'); ?>
    <?php echo $__env->make(checkTemplate() . 'partials.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="flex-lg-fill overflow-x-auto ps-lg-1 vstack vh-lg-100 position-relative">
        <?php echo $__env->make(checkTemplate() . 'partials.topnav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="flex-fill overflow-y-lg-auto scrollbar bg-body rounded-top-4 rounded-top-start-lg-4 rounded-top-end-lg-0 border-top border-lg shadow-2">
        <main class="container-fluid px-3 py-5 p-lg-6 p-xxl-8">
            <div class="mb-6 mb-xl-10">
                <div class="row g-3 align-items-center">
                    <div class="col">
                        <h1 class="ls-tight"><?php echo e(@$pageTitle); ?></h1>
                    </div>
                    <div class="col">
                        <div class="hstack gap-2 justify-content-end">
                            <a href="<?php echo e(route('user.deposit.history')); ?>" class="btn btn-sm btn-neutral d-sm-inline-flex"><span>Deposit</span></a>
                            <a href="<?php echo e(route('user.withdraw')); ?>" class="btn d-inline-flex btn-sm btn-dark"><span>Payout</span></a>
                                <?php echo $__env->yieldPushContent('breadcrumb'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php echo $__env->yieldContent('panel'); ?>

        </main>
    </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(checkTemplate() . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/templates/satoshi/layouts/app.blade.php ENDPATH**/ ?>