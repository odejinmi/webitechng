<?php $__env->startSection('panel'); ?>
<div class="row justify-content-center">
    <div class="col-lg-6 text-center">
      <h2 class="fw-bolder mb-0 fs-8 lh-base"><?php echo app('translator')->get('Below, find below our asset trading pricing plan'); ?></h2>
    </div>
  </div>
  
  <div class="row">
    
    <?php $__currentLoopData = $coins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-sm-6 col-lg-4">
      <div class="card">
        <div class="card-body pt-6"> 
          <span class="fw-bolder text-uppercase fs-2 d-block mb-7"><?php echo e($data->name); ?></span>
          <div class="my-4">
            <img src="<?php echo e(url('/')); ?>/assets/images/coins/<?php echo e($data->image); ?>" alt="" class="img-fluid" width="80" height="80">
          </div>
          <div class="d-flex mb-3">
             <h4 class="fw-bolder fs-6 ms-2 mb-0"><?php echo e($data->symbol); ?></h4>
          </div>
          <ul class="list-unstyled mb-7">
            <li class="d-flex align-items-center gap-2 py-2">
              <i class="ti ti-check text-primary fs-4"></i>
              <span class="text-dark">Min Amount: <?php echo e(number_format($data->minimum_amount,2)); ?>USD</span>
            </li>
            <li class="d-flex align-items-center gap-2 py-2">
              <i class="ti ti-check text-primary fs-4"></i>
              <span class="text-dark">Max Amount: <?php echo e(number_format($data->maximum_amount,2)); ?>USD</span>
            </li>
            <li class="d-flex align-items-center gap-2 py-2">
                <?php if($data->buy_rate > 0): ?>
                <i class="ti ti-check text-success fs-4"></i>
                <?php else: ?>
                <i class="ti ti-x text-danger fs-4"></i>
                <?php endif; ?>
              <span class="text-dark"><?php echo app('translator')->get('Buy Rate'); ?>: <?php echo e(number_format($data->buy_rate,2)); ?><?php echo e($general->cur_text); ?></span>
            </li>
            <li class="d-flex align-items-center gap-2 py-2">
                <?php if($data->sell_rate > 0): ?>
                <i class="ti ti-check text-success fs-4"></i>
                <?php else: ?>
                <i class="ti ti-x text-danger fs-4"></i>
                <?php endif; ?>
              <span class="text-dark"><?php echo app('translator')->get('Sell Rate'); ?>: <?php echo e(number_format($data->sell_rate,2)); ?><?php echo e($general->cur_text); ?></span>
            </li>
            <li class="d-flex align-items-center gap-2 py-2">
              <?php if($data->swap_rate > 0): ?>
              <i class="ti ti-check text-primary fs-4"></i>
              <?php else: ?>
              <i class="ti ti-x text-danger fs-4"></i>
              <?php endif; ?>
              <span class="text-dark"><?php echo app('translator')->get('Swap Rate'); ?>: <?php echo e(number_format($data->swap_rate,2)); ?><?php echo e($general->cur_text); ?></span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     
  </div>
<?php $__env->stopSection(); ?>

    <?php $__env->startPush('breadcrumb-plugins'); ?>

    <?php $__env->stopPush(); ?>
    <?php $__env->startPush('script'); ?>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/assets/crypto/rates.blade.php ENDPATH**/ ?>