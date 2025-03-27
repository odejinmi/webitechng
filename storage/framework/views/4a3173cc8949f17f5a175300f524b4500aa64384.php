
<?php $__env->startSection('panel'); ?>
   <!-- Transaction Log -->
 <div class="col-lg-12 d-flex align-items-strech">
  <div class="card w-100">
    <div class="card-body">
      <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
        <div class="mb-3 mb-sm-0">
          <h5 class="card-title fw-semibold"><?php echo app('translator')->get('Fund Card'); ?></h5>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="card">
          <div class="card-body p-4">
            <form action="<?php echo e(route('user.post_fund.card', $vcards->card_id)); ?>" method="POST">
              <?php echo csrf_field(); ?>                
              <div class="row">
                <!-- Document Type Field -->
                <div class="col-sm-6">
                  <div class="mb-4">
                    <label class="form-label fw-semibold"><?php echo app('translator')->get('Amount'); ?></label>
                    <input type="number" class="form-control" name="amount" required="">
                  </div>
                </div>
                <div class="col-sm-6" style="margin-top:12px">
                  <button type="submit" class="mt-4 btn btn-primary"><?php echo app('translator')->get('Submit'); ?></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?> 
<?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/virtual_card/fund_card.blade.php ENDPATH**/ ?>