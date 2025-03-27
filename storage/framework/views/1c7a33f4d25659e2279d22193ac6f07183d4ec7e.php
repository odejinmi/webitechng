<?php
    $actionContent = getContent('action.content', true);
?> 
<section class="position-relative">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-7 col-lg-7 col-md-11 mb-3">
                <div class="sec-heading text-center wow animated fadeInUp">
                    <div class="label text-primary bg-light-primary d-inline-flex rounded-4 mb-2 font--medium"><span><?php echo app('translator')->get('Our Action'); ?></span></div>
                    <h2 class="mb-1"><?php echo e(__(@$actionContent->data_values->heading)); ?></h2>
                    <p class="test-muted fs-6"><?php echo e(__(@$actionContent->data_values->sub_heading)); ?></p>
                  </div>
            </div>
        </div> 
        <div class="row align-items-center justify-content-center mt-5">
            <div class="col-xl-7 col-lg-7 col-md-11 mb-3 text-center wow animated fadeInUp">
                <a href="<?php echo e(@$actionContent->data_values->button_url); ?>" class="btn btn-outline-primary btn-sm rounded-5"><?php echo e(@$actionContent->data_values->button); ?></a>
            </div>
        </div>
    </div>
</section>
 
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/sections/action.blade.php ENDPATH**/ ?>