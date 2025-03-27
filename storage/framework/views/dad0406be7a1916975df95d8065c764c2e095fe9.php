<?php $__env->startSection('content'); ?>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body pt-5">
                <a href="#" class="text-nowrap w-100 logo-img text-center d-block mb-4">
                    <img width="100" src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" width="180" alt="">
                </a>
                <div class="mb-5 text-center">
                  <p><?php echo app('translator')->get('Please check your email and enter the verification code you got in your email.'); ?></p>
                  <h6 class="fw-bolder"></h6>
                </div>
                <form class="space-y-5" action="<?php echo e(route('admin.password.verify.code')); ?>" method="POST" class="login-form">
                <?php echo csrf_field(); ?>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label fw-semibold"><?php echo app('translator')->get('Type your 6 digits security code'); ?></label>
                    <div class="d-flex align-items-center gap-2 gap-sm-3">
                      <input type="text" name="r1" class="form-control" placeholder="">
                      <input type="text" name="r2" class="form-control" placeholder="">
                      <input type="text" name="r3"  class="form-control" placeholder="">
                      <input type="text" name="r4"  class="form-control" placeholder="">
                      <input type="text" name="r5"  class="form-control" placeholder="">
                      <input type="text" name="r6"  class="form-control" placeholder="">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 mb-4"><?php echo app('translator')->get('Verify My Account'); ?></button>
                  <div class="d-flex align-items-center">
                    <p class="fs-4 mb-0 text-dark"><?php echo app('translator')->get('Didn\'t get the code'); ?>?</p>
                    <a class="text-primary fw-medium ms-2" href="<?php echo e(route('admin.password.reset')); ?>"><?php echo app('translator')->get('Resend'); ?></a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 

     
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
 <?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/admin/auth/passwords/code_verify.blade.php ENDPATH**/ ?>