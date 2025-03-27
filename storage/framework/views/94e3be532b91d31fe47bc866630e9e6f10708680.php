<?php $__env->startSection('content'); ?>

<section>
    <div class="container">
        
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-7 col-lg-7 col-md-11 mb-3">
                <div class="sec-heading text-center">
                    <div class="label text-success bg-light-success d-inline-flex rounded-4 mb-2 font--medium"><span><?php echo app('translator')->get('Choose Rate'); ?></span></div>
                    <h2 class="mb-1"><?php echo app('translator')->get('Our Competitive Rates'); ?></h2>
                    <p class="test-muted fs-6"><?php echo app('translator')->get('Please find below our juicy rates'); ?></p>
                  </div>
            </div>
        </div>
        
        <div class="row justify-content-center g-lg-4 g-md-2 g-4">
            <?php $__currentLoopData = $coins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card border-0 gray-simple rounded-4 p-lg-4 p-3">
                    <div class="prcs-headlines text-center py-3">
                        <h4 class="mb-1"><?php echo e($data->name); ?></h4>
                        <p class="mb-0"><?php echo e($data->symbol); ?></p>
                    </div>
                    <div class="prcs-currency text-center py-3">
                        <div class="my-4">
                            <img src="<?php echo e(url('/')); ?>/assets/images/coins/<?php echo e($data->image); ?>" alt="" class="img-fluid" width="80" height="80">
                          </div>
                    </div>
                    <div class="prcs-body bg-white py-4 px-lg-4 px-md-2 px-4 rounded-3">
                        <div class="prcs-list mb-3">
                            <ul class="p-0 m-0">
                                <li class="py-2 font--medium"><i class="fa-regular fa-circle-check text-primary me-2"></i>Min Amount: <?php echo e(number_format($data->minimum_amount,2)); ?>USD</li>
                                <li class="py-2 font--medium"><i class="fa-regular fa-circle-check text-primary me-2"></i>Max Amount: <?php echo e(number_format($data->maximum_amount,2)); ?>USD</li>
                                <li class="py-2 font--medium"><i class="fa-regular  <?php if($data->buy_rate > 0): ?> fa-circle-check text-primary <?php else: ?>  fa fa-x text-danger <?php endif; ?> me-2"></i><?php echo app('translator')->get('Buy Rate'); ?>: <?php echo e(number_format($data->buy_rate,2)); ?><?php echo e($general->cur_text); ?></li>
                                <li class="py-2 font--medium"><i class="fa-regular  <?php if($data->sell_rate > 0): ?> fa-circle-check text-primary <?php else: ?>  fa fa-x text-danger <?php endif; ?> me-2"></i><?php echo app('translator')->get('Sell Rate'); ?>: <?php echo e(number_format($data->sell_rate,2)); ?><?php echo e($general->cur_text); ?></li>
                                <li class="py-2 font--medium"><i class="fa-regular   <?php if($data->swap_rate > 0): ?> fa-circle-check text-primary <?php else: ?>  fa fa-x text-danger <?php endif; ?>  me-2"></i><?php echo app('translator')->get('Swap Rate'); ?>: <?php echo e(number_format($data->swap_rate,2)); ?><?php echo e($general->cur_text); ?></li>
                            </ul>
                        </div> 
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             
        </div>
        
    </div>
</section>
  
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/rates.blade.php ENDPATH**/ ?>