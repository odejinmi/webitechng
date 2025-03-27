<div class="row justify-content-center">
    <div class="col-lg-6 text-center">
      <h2 class="fw-bolder mb-0   lh-base"><?php echo app('translator')->get('Flexible Loan & Mortgage Plans Tailored to Fit Your Pocket!'); ?></h2>
    </div>
  </div>
   
  <div class="row">
    <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-sm-6 col-lg-4">
      <div class="card">
        <div class="card-body">
          <span class="fw-bolder text-uppercase fs-2 d-block mb-7"><?php echo e(__(@$plan->name)); ?></span>
          <div class="my-4">
            <img src="<?php echo e(asset('assets/assets/dist/images/backgrounds/silver.png')); ?>" alt="" class="img-fluid" width="80" height="80">
          </div>
          <h4 class="fw-bolder  mb-3">
            <?php echo e(getAmount($plan->per_installment)); ?>%      <span class="text-small">&nbsp;/ <?php echo e($plan->installment_interval); ?> <?php echo app('translator')->get('Days'); ?></span>        
          </h4>
          
          <ul class="list-unstyled mb-7">
            <li class="d-flex align-items-center gap-2 py-2">
              <i class="ti ti-cash text-primary fs-4"></i>
              <span class="text-dark"><?php echo app('translator')->get('Minimum'); ?>: <?php echo e(__($general->cur_sym)); ?><?php echo e(__(showAmount($plan->minimum_amount))); ?></span>
            </li>
            <li class="d-flex align-items-center gap-2 py-2">
              <i class="ti ti-cash text-primary fs-4"></i>
              <span class="text-dark"><?php echo app('translator')->get('Maximum'); ?>: <?php echo e(__($general->cur_sym)); ?><?php echo e(__(showAmount($plan->maximum_amount))); ?></span>
            </li>
            <li class="d-flex align-items-center gap-2 py-2">
              <i class="ti ti-cash text-muted fs-4"></i>
              <span class="text-muted"><?php echo app('translator')->get('Per Installment'); ?>: <?php echo e(__(getAmount($plan->per_installment))); ?>%</span>
            </li>
            <li class="d-flex align-items-center gap-2 py-2">
              <i class="ti ti-cash text-muted fs-4"></i>
              <span class="text-muted"><?php echo app('translator')->get('Payment Interval'); ?>: <?php echo e(__($plan->installment_interval)); ?> <?php echo app('translator')->get('Days'); ?></span>
            </li>
            <li class="d-flex align-items-center gap-2 py-2">
              <i class="ti ti-cash text-muted fs-4"></i>
              <span class="text-muted"><?php echo app('translator')->get('Total Instalment'); ?>: <?php echo e(__($plan->total_installment)); ?></span>
            </li>
          </ul>
          <button data-id="<?php echo e($plan->id); ?>" data-minimum="<?php echo e($general->cur_sym); ?><?php echo e(showAmount($plan->minimum_amount)); ?>" data-maximum="<?php echo e($general->cur_sym); ?><?php echo e(showAmount($plan->maximum_amount)); ?>" class="btn loanBtn btn btn-primary fw-bolder rounded-2 py-6 w-100 text-capitalize">Select <?php echo e($plan->name); ?></button>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     
  </div>
 
<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            $('.loanBtn').on('click', (e) => {
                var modal = $('#loanModal');
                let data = e.currentTarget.dataset;
                modal.find('.min-limit').text(`Minimum Amount ${data.minimum}`);
                modal.find('.max-limit').text(`Maximum Amount ${data.maximum}`);
                let form = modal.find('form')[0];
                form.action = `<?php echo e(route('user.loan.apply', '')); ?>/${data.id}`;
                modal.modal('show');
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

    <div class="modal fade custom--modal" id="loanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" method="post">
                    <?php if(auth()->guard()->check()): ?>
                        <div class="modal-header">
                            <h5 class="modal-title method-name" id="exampleModalLabel"><?php echo app('translator')->get('Apply for Loan'); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="" class="required"><?php echo app('translator')->get('Amount'); ?></label>
                                <div class="input-group custom-input-group">
                                    <input type="number" step="any" name="amount" class="form-control form--control" placeholder="<?php echo app('translator')->get('Enter An Amount'); ?>" required>
                                    <span class="input-group-text"> <?php echo e($general->cur_text); ?> </span>
                                </div>
                                <p><small class="text--danger min-limit"></small></p>
                                <p><small class="text--danger max-limit"></small></p>
                            </div>
                            <button type="submit" class="btn btn-primary w-100"><?php echo app('translator')->get('Confirm'); ?></button>
                        </div>
                    <?php else: ?>
                        <div class="modal-body">
                            <div class="text-center"><i class="la la-times-circle text--danger la-6x" aria-hidden="true"></i></div>
                            <h3 class="text-center mt-3"><?php echo app('translator')->get('You are not logged in!'); ?></h3>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal" aria-label="Close"><?php echo app('translator')->get('Close'); ?></button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
<?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/partials/loan_plans.blade.php ENDPATH**/ ?>