<?php $__env->startSection('content'); ?>
    <?php
        $bannerContent = getContent('banner.content', true);
    ?>
<!-- ============================ Hero Banner  Start================================== -->
<div class="image-cover hero-header gray-simple position-relative">
    <div class="container">

        <div class="row justify-content-center align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="elcoss-excort mt-xl-5 mt-md-4 wow animated fadeInLeft">
                    <div class="bg-primary text-light rounded-2 px-3 py-2 d-inline-flex font--medium mb-2"><span><?php echo app('translator')->get('Welcome To '); ?> <?php echo e($general->site_name); ?></span></div>
                    <h1 class="mb-4"><?php echo e(__(@$bannerContent->data_values->heading)); ?></h1>
                    <p class="fs-5 fw-light fs-mob"><?php echo e(__(@$bannerContent->data_values->sub_heading)); ?></p>
                    <div class="btn-groupss mt-5 mb-2">
                        <a href="JavaScript:Void(0);" class="d-inline-block mx-2 my-2"><img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'img/google-app.png')); ?>" width="140" alt="Google Play"></a>
                        <a href="JavaScript:Void(0);" class="d-inline-block mx-2 my-2"><img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'img/ios-app.png')); ?>" width="140" alt="IOS"></a>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 offset-lg-1 offset-xl-1">
                <div class="position-relative mt-md-0 mt-4 wow animated fadeInRight">
                    <img class="d-block position-relative z-2 img-fluid" src="<?php echo e(getImage('assets/images/frontend/banner/' . @$bannerContent->data_values->image, '630x540')); ?>" width="100%" alt="Dan">
                    <div class="bg-primary position-absolute z-1 start-0 bottom-0 w-100" style="height:85%; border-radius: 100rem 2rem 3rem 3rem;">
                        <div class="position-absolute top-0 start-5"><img src="<?php echo e(getImage('assets/images/provider/ikedc.png', '100x100')); ?>" class="img-fluid" width="50" alt="icon"></div>
                        <div class="position-absolute bottom-0 start-0"><img src="<?php echo e(getImage('assets/images/provider/decoder2.png', '100x100')); ?>" class="img-fluid" width="125" alt="icon"></div>
                        <div class="position-absolute bottom-0 end-0"><img src="<?php echo e(getImage('assets/images/provider/9mobile.png', '100x100')); ?>"class="img-fluid" width="50" alt="icon"></div>
                    </div>
                </div>
            </div>
        </div>
            
    </div>
</div>
<!-- ============================ Hero Banner End ================================== -->
 

    <?php if($sections->secs != null): ?>
        <?php $__currentLoopData = json_decode($sections->secs); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make($activeTemplate . 'sections.' . $sec, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/khaytech/home.blade.php ENDPATH**/ ?>