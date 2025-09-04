<?php $__env->startSection('panel'); ?>
   <!-- Transaction Log -->
 <div class="col-lg-12 d-flex align-items-strech">
  <div class="card w-100">
    <div class="card-body">
      <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
        <div class="mb-3 mb-sm-0">
          <h5 class="card-title fw-semibold"><?php echo app('translator')->get('Create Customer'); ?></h5>
        </div>
        <?php if(!empty($customer)): ?>
          <div class="mb-3 mb-sm-0">
            <a href="<?php echo e(url('/user/create/card')); ?>" class="btn btn-primary">Create New Card</a>
            <a href="<?php echo e(url('/user/list/card')); ?>" class="btn btn-info">View Cards</a>
          </div>
        <?php endif; ?>
      </div>
      <div class="col-lg-9">
        <div class="card">
          <div class="card-body p-4">
            <?php if(!empty($customer)): ?>
              <div class="row">
                <div class="col-sm-6">
                    <p><strong>First Name:</strong> <?php if(isset($customer->first_name)): ?><?php echo e($customer->first_name); ?><?php endif; ?></p>
                </div>
                <div class="col-sm-6">
                    <p><strong>Last Name:</strong> <?php if(isset($customer->last_name)): ?><?php echo e($customer->last_name); ?><?php endif; ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                    <p><strong>Email:</strong> <?php if(isset($customer->customer_email)): ?><?php echo e($customer->customer_email); ?><?php endif; ?></p>
                </div>
                <div class="col-sm-6">
                    <p><strong>Phone number:</strong> <?php if(isset($customer->phone_number)): ?><?php echo e($customer->phone_number); ?><?php endif; ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                    <p><strong>Date of Birth:</strong> <?php if(isset($customer->date_of_birth)): ?><?php echo e($customer->date_of_birth); ?><?php endif; ?></p>
                </div>
                <div class="col-sm-6">
                    <p><strong>House number:</strong> <?php if(isset($customer->house_number)): ?><?php echo e($customer->house_number); ?><?php endif; ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                    <p><strong>Customer Id:</strong> <?php if(isset($customer->bitvcard_customer_id)): ?><?php echo e($customer->bitvcard_customer_id); ?><?php endif; ?></p>
                </div>
              </div>
            <?php else: ?>
              <form action="<?php echo e(route('user.create.customer.add')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <!-- <?php if(session('success')): ?>
                  <div class="alert alert-success">
                      <?php echo e(session('success')); ?>

                  </div>
                <?php endif; ?>    -->
                <div class="row">
                    <div class="col-sm-6">
                      <label for="house_number" class="form-label fw-semibold"><?php echo app('translator')->get('House Number'); ?></label>
                      <input type="text" class="form-control" name="house_number">
                    </div>
                      <div class="col-sm-6">
                          <label for="phone_number" class="form-label fw-semibold"><?php echo app('translator')->get('Phone Number'); ?>*</label>
                          <input type="text" class="form-control" name="phone_number">
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="date_of_birth" class="form-label fw-semibold"><?php echo app('translator')->get('Date of Birth YYYY-MM-DD'); ?></label>
                      <input type="text" class="form-control" name="date_of_birth">
                    </div>
                     <div class="col-sm-6">
                      <label for="idImage" class="form-label fw-semibold"><?php echo app('translator')->get('Id Image'); ?>*</label>
                      <input type="text" class="form-control" name="idImage" value="<?php echo e(asset('assets/images/kyc')); ?>/<?php echo e(auth()->user()->username); ?>/front_kyc_image.png" readonly>

                    </div>
                    <div class="col-sm-6">
                        <label for="line" class="form-label fw-semibold"><?php echo app('translator')->get('Address'); ?>*</label>
                        <input type="text" class="form-control" name="line">
                    </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <label for="userPhoto" class="form-label fw-semibold"><?php echo app('translator')->get('User Photo'); ?></label>
                         <input type="text" class="form-control" name="userPhoto" value="<?php echo e(asset('assets/images/kyc')); ?>/<?php echo e(auth()->user()->username); ?>/back_kyc_image.png" readonly>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="mb-4">
                        <label for="zip_code" class="form-label fw-semibold"><?php echo app('translator')->get('Zip Code'); ?>*</label>
                        <input type="text" class="form-control" name="zip_code">
                      </div>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <button typ="submit" class="btn btn-primary">Create CardHolder</button>
                  </div>
              </form>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/satoshi/user/virtual_card/create.blade.php ENDPATH**/ ?>