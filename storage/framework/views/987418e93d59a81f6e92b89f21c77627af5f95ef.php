<?php

$featureContent = getContent('feature.content', true);
    $featureElements = getContent('feature.element', null, false, true);
?>
<!-- =========== features Section Start =========== -->
<section class="pt-0 mt-3 gray-simple">
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-10 col-md-12 col-sm-12 mb-5 wow animated fadeInUp">
                <div class="sec-heading center">
                    <br>
                    <div class="d-inline-flex px-4 py-1 rounded-5 text-info bg-light-info font--medium mb-2"><span><?php echo app('translator')->get('Our Features'); ?></span></div>
                    <h2><?php echo e(__(@$featureContent->data_values->heading)); ?></h2>
                    <p class="text-slate-500"><?php echo e(__(@$featureContent->data_values->sub_heading)); ?></p>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center gy-xl-5 gy-lg-4 gy-5 gx-xl-5 gx-lg-4 gx-3">
            <?php $__empty_1 = true; $__currentLoopData = $featureElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="killar-benifits-wrap text-center wow animated fadeInUp">
                    <div class="px-4 py-4 d-inline-flex align-items-center justify-content-center fs-1 bg-light-primary text-primary rounded-circle">
                        <?php echo @$item->data_values->icon ?>
                    </div>
                    <div class="benifits-title mt-3 mb-3">
                        <h4 class="fs-5"><?php echo e(@$item->data_values->title); ?></h4>	
                    </div>
                    <div class="benifits-desc">
                        <p class="mb-0"><?php echo e(@$item->data_values->content); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php echo emptyData; ?>

            <?php endif; ?>
             
        </div>
        
    </div>
</section>
<div class="clearfix"></div>
  
<!-- =========== features Section End =========== -->
 <?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/sections/feature.blade.php ENDPATH**/ ?>