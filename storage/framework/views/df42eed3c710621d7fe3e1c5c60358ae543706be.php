<?php
    $partnersContent = getContent('partners.content', true);
    $partnersElements = getContent('partners.element', null, false, true);
?>
    <!-- =========== clients Section Start =========== -->
    <section class="bg-primary position-relative">
        <div class="container">
        
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-7 col-lg-7 col-md-11 mb-3">
                    <div class="sec-heading text-center light wow animated fadeInUp">
                        <div class="label text-light bg-warning d-inline-flex rounded-4 mb-2 font--medium"><span><?php echo app('translator')->get('Our Partners'); ?></span></div>
                        <h2 class="mb-1"><?php echo e(__(@$partnersContent->data_values->heading)); ?></h2>
                        <p class="test-muted fs-6"><?php echo e(__(@$partnersContent->data_values->sub_heading)); ?></p>
                      </div>
                </div>
            </div>
            
            <div class="row justify-content-center row-cols-3 row-cols-md-5 row-cols-lg-6 g-md-4 g-3">
                <?php $__empty_1 = true; $__currentLoopData = $partnersElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?> 
                <div class="col">
                    <div class="card border-0 rounded-4 px-4 py-4">
                        <div class="position-relative text-center wow animated fadeInUp">
                            <img src="<?php echo e(getImage('assets/images/frontend/partners/' . @$item->data_values->image, '30x30')); ?>" class="img-fluid" alt="">
                        </div>
                    </div>
                </div> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php echo emptyData(); ?>

                <?php endif; ?> 
                 
            </div>
            
        </div>
        
        <div class="ht-80"></div>
        <div class="position-absolute start-0 bottom-0 w-100 overflow-hidden mb-n1" style="padding-bottom: 6.2%; color:#ffffff;">
            <svg class="position-absolute start-0 bottom-0 w-100 h-200" viewBox="0 0 3000 185.4" xmlns="http://www.w3.org/2000/svg">
                <path fill="currentColor" d="M3000,0v185.4H0V0c496.4,115.6,996.4,173.4,1500,173.4S2503.6,115.6,3000,0z"></path>
            </svg>
        </div>
    </section>
    <div class="clearfix"></div>
 
  <!-- =========== clients Section End =========== -->
 <?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/itechng/core/resources/views/templates/basic/sections/partners.blade.php ENDPATH**/ ?>