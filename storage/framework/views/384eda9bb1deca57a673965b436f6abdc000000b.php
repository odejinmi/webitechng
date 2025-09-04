<?php $__env->startSection('panel'); ?>

<!--  BEGIN CONTENT AREA  -->

 <div>
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-body">

<div id="content" class="main-content">
    <div class="layout-px-spacing">


        <div class="fq-header-wrapper mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 align-self-center order-md-0 order-1">
                        <div class="faq-header-content">
                            <h4 class="mb-4 mt-4"><?php echo e($pageTitle); ?></h4>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="faq container">

            <div class="faq-layouting layout-spacing">

                <div class="kb-widget-section">

                    <div class="row justify-content-center">
                        <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="col-xxl-2 col-xl-3 col-lg-3 mb-lg-0 col-md-6 mb-3">
                            <?php if(Route::is('user.sellgift') ): ?>
                            <a href="<?php echo e(route('user.selectgiftcardsell' , $gate->id)); ?>" class="nk-file-link">
                            <?php else: ?>
                            <a href="<?php echo e(route('user.selectgiftcardbuy' , $gate->id)); ?>" class="nk-file-link">
                            <?php endif; ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <center>
                                    <div class="card-icon mb-4">
                                        <img src="<?php echo e(asset('assets/images/giftcards')); ?>/<?php echo e($gate->image); ?>" width="100">
                                    </div>
                                    <h5 class="card-title mb-0"><?php echo e($gate->name); ?></h5>
                                    </center>
                                </div>
                            </div>
                        </a>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                    </div>

                </div>



            </div>
        </div>

    </div>
</div>
            </div>
         </div>
      </div>
   </div>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb'); ?>
<?php if(Route::is('user.sellgift') ): ?>
<a class="btn btn-sm btn-primary" href="<?php echo e(route('user.sellcardlog')); ?>"> <i class="ti ti-printer"></i> <?php echo app('translator')->get('Giftcard Log'); ?></a>
<?php else: ?>
<a class="btn btn-sm btn-primary" href="<?php echo e(route('user.buycardlog')); ?>"> <i class="ti ti-printer"></i> <?php echo app('translator')->get('Giftcard Log'); ?></a>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/satoshi/user/giftcard/giftcard.blade.php ENDPATH**/ ?>