<?php
    $serviceContent = getContent('service.content', true);
    $serviceElements = getContent('service.element', null, false, true);
?>
<section>
    <div class="container">
        
        <div class="row justify-content-between align-items-center mb-5">
        
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="position-relative exloi">
                    <div class="exloi-caption">
                        <div class="label text-primary bg-light-primary d-inline-flex rounded-4 mb-2 font--medium"><span><?php echo app('translator')->get('Our Services'); ?></span></div>
                        <h2 class="mb-3 lh-base"><?php echo e(__(@$serviceContent->data_values->heading)); ?></h2>
                        <p class="mb-0 fs-5 fw-light"><?php echo e(__(@$serviceContent->data_values->sub_heading)); ?></p>
                        <div class="clixs-serv mt-4">
                            <div class="row px-3 py-4">
                                <div class="col-sm-12 ps-0">
                                    <?php $__empty_1 = true; $__currentLoopData = $serviceElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="d-flex align-items-start mb-3">
                                        <span class="text-primary px-3 py-2 rounded-2 bg-light-primary fs-2 mb-4">
                                            <?php echo @$item->data_values->icon ?>
                                        </span>
                                        <div class="ps-3">
                                            <h5><?php echo e(__(@$item->data_values->title)); ?></h5>
                                            <p><?php echo e(__(@$item->data_values->content)); ?></p>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php echo e(__($emptyMessage)); ?>

                                    <?php endif; ?> 
                                     
                                </div>
                                <!-- End Col -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
                <div class="position-relative mt-md-0 mt-4">
                    <img src="<?php echo e(getImage('assets/images/frontend/service/' . @$serviceContent->data_values->image, '630x540')); ?>" class="img-fluid" alt="">
                </div>
            </div>
        
        </div> 
        
    </div>
</section>
 
     <!-- =========== services Section End =========== -->
 <?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/sections/service.blade.php ENDPATH**/ ?>