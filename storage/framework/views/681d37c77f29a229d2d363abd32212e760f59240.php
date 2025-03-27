<?php $__env->startSection('content'); ?>
<section>
    <div class="container">
        <form  class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" action="" method="post">
            <?php echo csrf_field(); ?>
        <div class="row justify-content-center">
        
            <div class="col-xl-6 col-lg-6">
                <div class="gray-simple rounded-2 py-3 px-3">
                    <h1 class="fs-2 pb-3"><?php echo app('translator')->get('Invoice Payment'); ?></h1>
                    <p>Purpose: <?php echo e($invoice->purpose); ?></p>
                    <h3 class="d-flex align-items-center fs-6 lh-base font--bold"><span class="square--20 font--medium circle bg-primary text-light me-2">1</span><?php echo app('translator')->get("Payer's Details"); ?></h3>
                   
                    <div class="row g-4 pb-4 pb-md-5 mb-3 mb-md-1">
                        <div class="col-sm-6">
                            <label class="form-label fs-base">First Name</label>
                            <input class="form-control form-control-lg" name="firstname" type="text" placeholder="First Name">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fs-base">Last Name</label>
                            <input class="form-control form-control-lg" name="lastname" type="text" placeholder="Last Name">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fs-base">Email</label>
                            <div class="position-relative"><i class="fa-regular fa-envelope position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                                <input class="form-control form-control-lg ps-5" name="email" type="email" placeholder="Email address">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fs-base">Phone</label>
                            <div class="position-relative"><i class="fa-solid fa-phone position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                                <input class="form-control form-control-lg ps-5" name="phone" type="tel" placeholder="+1 ___ ___ __">
                            </div>
                        </div>
                         
                    </div>
                    
                    <h3 class="d-flex align-items-center fs-6 lh-base font--bold"><span class="square--20 font--medium circle bg-primary text-light me-2">2</span><?php echo app('translator')->get('Payment Method'); ?></h3>
                    <?php $__empty_1 = true; $__currentLoopData = $gatewayCurrency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="form-check bg-white rounded-2 p-3 ps-4 mb-4">
                        <input class="form-check-input" type="radio" value="<?php echo e($data); ?>" <?php echo e(old('methodId') == $data->id ? ' checked' : ''); ?> name="methodId" id="<?php echo e($data->id); ?>">
                        <label class="form-check-label d-flex justify-content-between" for="<?php echo e($data->id); ?>"><span><span class="d-block font--medium mb-1"><?php echo e(__($data->name)); ?></span><span class="text-body"><?php echo e($general->cur_sym); ?><?php echo e(showAmount($invoice->amount)); ?></span></span><img width="40" src="<?php echo e(getImage(imagePath()['gateway']['path'].'/'. $data->method->image,imagePath()['gateway']['size'])); ?>" alt="" class="img-fluid ms-auto"> </label>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php echo emptyData(); ?>

                    <?php endif; ?> 
                     
                    
                    <div class="d-none d-lg-block pt-5 mt-n3">
                        <div class="form-check mb-4">
                            <input class="form-check-input" required type="radio" name="agree" type="checkbox" checked="" id="save-info">
                            <label class="form-check-label" for="save-info"><span class="text-muted">Your personal information will be used to process this payment, to support your experience on this site and for other purposes described in the </span><a class="fw-medium" href="#">privacy policy</a></label>
                        </div>
                        <button class="btn btn-lg btn-primary px-xl-5" type="submit">Place An Order</button>
                    </div>
                    
                </div>
            </div>
            
             
        </div>
        
        <div class="d-lg-none pb-2 mt-2 mt-lg-0 pt-4 pt-lg-5 row">
            <div class="col-xl-12 col-lg-12">
                <div class="d-lg-none pb-2 mt-2 mt-lg-0 pt-4 pt-lg-5">
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" checked="" id="save-info2">
                        <label class="form-check-label" for="save-info2"><span class="text-muted">Your personal information will be used to process your order, to support your experience on this site and for other purposes described in the </span><a class="fw-medium" href="shop-checkout.html#">privacy policy</a></label>
                    </div>
                    <button class="btn btn-lg btn-primary w-100 w-sm-auto" type="submit">Place an order</button>
                </div>
            </div>
        </div>
    </form>
            
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/invoice.blade.php ENDPATH**/ ?>