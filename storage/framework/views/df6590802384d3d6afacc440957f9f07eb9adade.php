<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
         

        <div class="col-xl-12 col-lg-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 border-bottom pb-2"><?php echo app('translator')->get('Profile Information'); ?></h5>

                    <form action="<?php echo e(route('admin.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>



                        <div class="row">

                            <div class="col-xl-6 col-lg-12 col-md-6">

                                <div class="form-group">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <h5 class="mb-0"><?php echo app('translator')->get('Avatar'); ?></h5>
                                            </div>

                                            <div class="text-center">
                                                <img src="<?php echo e(getImage(getFilePath('adminProfile') . '/' . $admin->image, getFileSize('adminProfile'))); ?>"
                                                    alt="image" class="rounded-circle" width="200" />
                                            </div>
                                        </div>
                                    </div>
 
                                </div>

                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label><?php echo app('translator')->get('Name'); ?></label>
                                    <input class="form-control" type="text" name="name" value="<?php echo e($admin->name); ?>"
                                        required>
                                </div>

                                <div class="form-group mb-3">
                                    <label><?php echo app('translator')->get('Email'); ?></label>
                                    <input class="form-control" type="email" name="email" value="<?php echo e($admin->email); ?>"
                                        required>
                                </div>

                                <div class="form-group mb-3">
                                    <label><?php echo app('translator')->get('Avatar'); ?></label>

                                    <input type="file" class="form-control profilePicUpload" name="image"
                                        id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                     <small class="mt-2  "><?php echo app('translator')->get('Supported files'); ?>: <b><?php echo app('translator')->get('jpeg'); ?>,
                                            <?php echo app('translator')->get('jpg'); ?>.</b> <?php echo app('translator')->get('Image will be resized into 400x400px'); ?> </small>
                                </div>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary h-45 w-100"><?php echo app('translator')->get('Submit'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('admin.password')); ?>" class="btn btn-sm btn-outline-primary"><i
            class="ti ti-key"></i><?php echo app('translator')->get('Password Setting'); ?></a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/profile.blade.php ENDPATH**/ ?>