<?php
    $faqContent = getContent('faq.content', true);
    $faqElements = getContent('faq.element', null, false, true);
?>
<!-- ============================ FAQ's Start ================================== -->
<section class="gray-simple">
    <div class="container">
        
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-7 col-lg-7 col-md-11 mb-3">
                <div class="sec-heading text-center">
                    <div class="label text-success bg-light-success d-inline-flex rounded-4 mb-2 font--medium"><span><?php echo app('translator')->get('Check Our FAQ\'s'); ?></span></div>
                    <h2 class="mb-1"><?php echo e(__(@$faqContent->data_values->heading)); ?></h2>
                    <p class="test-muted fs-6"><?php echo e(__(@$faqContent->data_values->sub_heading)); ?></p>
                  </div>
            </div>
        </div>
        
        <div class="row justify-content-between align-items-start g-4">
                <div class="accordion" id="PanelsStayOpen">
                    <?php $__empty_1 = true; $__currentLoopData = $faqElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne<?php echo e($item->id); ?>" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne<?php echo e($item->id); ?>">
                                <?php echo e(__(@$item->data_values->question)); ?>

                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne<?php echo e($item->id); ?>" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <?php echo e(__(@$item->data_values->answer)); ?>

                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php echo emptyData(); ?>

                    <?php endif; ?>
                </div>
        </div>
        
    </div>
</section>
<div class="clearfix"></div>
<!-- ============================ FAQ's End ================================== -->


 <?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/sections/faq.blade.php ENDPATH**/ ?>