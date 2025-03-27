<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
          

        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 border-bottom pb-2"><?php echo app('translator')->get('Change Password'); ?></h5>

                    <form action="<?php echo e(route('admin.password.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="form-group mb-3">
                            <label><?php echo app('translator')->get('Password'); ?></label>
                            <input class="form-control" type="password" name="old_password" required>
                        </div>

                        <div class="form-group mb-3">
                            <label><?php echo app('translator')->get('New Password'); ?></label>
                            <input class="form-control" type="password" name="password" required>
                        </div>

                        <div class="form-group mb-3">
                            <label><?php echo app('translator')->get('Confirm Password'); ?></label>
                            <input class="form-control" type="password" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-outline-primary w-100 btn-lg h-45"><?php echo app('translator')->get('Submit'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('admin.profile')); ?>" class="btn btn-sm btn-outline-primary"><i
            class="las la-user"></i><?php echo app('translator')->get('Profile Setting'); ?></a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/admin/password.blade.php ENDPATH**/ ?>