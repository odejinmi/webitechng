<?php $__env->startSection('content'); ?>
<?php echo $__env->make($activeTemplate . 'partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section>
    <div class="container">
        <div class="row align-items-center justify-content-center mt-4">
            <div class="col-xl-7 col-lg-7 col-md-11 mb-3">
                <div class="sec-heading text-center">
                    <div class="label text-success bg-light-success d-inline-flex rounded-4 mb-2 font-medium">
                        <span><?php echo app('translator')->get('Choose Rate'); ?></span>
                    </div>
                    <h2 class="mb-1"><?php echo app('translator')->get('Our Competitive Rates'); ?></h2>
                    <p class="text-muted fs-6"><?php echo app('translator')->get('Please find below our juicy rates'); ?></p>
                    <p class="text-muted fs-6"><?php echo app('translator')->get('Click on coin to show rate'); ?></p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center g-lg-4 g-md-2 g-4">
            <?php $__currentLoopData = $coins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $isMinimized = in_array($data->name, ['Ethereum', 'Bitcoin', 'Bitcoin Cash', 'Litecoin', 'USD TRC 20']);
            ?>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card rate-card border-0 gray-simple rounded-4 p-lg-4 p-3 shadow-sm position-relative overflow-hidden">
                    <div class="prcs-headlines text-center py-3" onclick="toggleDetails('<?php echo e($data->id); ?>')" style="cursor: pointer;">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="<?php echo e(url('/')); ?>/assets/images/coins/<?php echo e($data->image); ?>" alt="" class="img-fluid me-2" width="40" height="40">
                            <h4 class="mb-0"><?php echo e($data->name); ?></h4>
                        </div>
                    </div>
                    <div class="prcs-body bg-white py-4 px-lg-4 px-md-2 px-4 rounded-3 <?php if($isMinimized): ?> d-none <?php endif; ?>" id="details-<?php echo e($data->id); ?>">
                        <div class="prcs-list mb-3">
                            <ul class="p-0 m-0">
                                <li class="py-2 font-medium">
                                    <i class="fa-regular fa-circle-check text-primary me-2"></i>
                                    Min Amount: <?php echo e(number_format($data->minimum_amount,2)); ?>USD
                                </li>
                                <li class="py-2 font-medium">
                                    <i class="fa-regular fa-circle-check text-primary me-2"></i>
                                    Max Amount: <?php echo e(number_format($data->maximum_amount,2)); ?>USD
                                </li>
                                <li class="py-2 font-medium">
                                    <i class="fa-regular <?php if($data->buy_rate > 0): ?> fa-circle-check text-primary <?php else: ?> fa fa-x text-danger <?php endif; ?> me-2"></i>
                                    <?php echo app('translator')->get('Buy Rate'); ?>: <?php echo e(number_format($data->buy_rate,2)); ?><?php echo e($general->cur_text); ?>

                                </li>
                                <li class="py-2 font-medium">
                                    <i class="fa-regular <?php if($data->sell_rate > 0): ?> fa-circle-check text-primary <?php else: ?> fa fa-x text-danger <?php endif; ?> me-2"></i>
                                    <?php echo app('translator')->get('Sell Rate'); ?>: <?php echo e(number_format($data->sell_rate,2)); ?><?php echo e($general->cur_text); ?>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="row justify-content-center g-lg-4 g-md-2 g-4">
            <?php $__currentLoopData = $giftcards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card rate-card border-0 gray-simple rounded-4 p-lg-4 p-3 shadow-sm position-relative overflow-hidden">
                    <div class="prcs-headlines text-center py-3" onclick="toggleDetails('<?php echo e($data->id); ?>')" style="cursor: pointer;">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="<?php echo e(asset('assets/images/giftcards')); ?>/<?php echo e($data->image); ?>" alt="" class="img-fluid me-2" width="40" height="40">
                            <h4 class="mb-0"><?php echo e($data->name); ?></h4>
                        </div>
                    </div>
                    <?php $__empty_1 = true; $__currentLoopData = $data->types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="prcs-body bg-white py-4 px-lg-4 px-md-2 px-4 rounded-3" id="details-<?php echo e($data->id); ?>-<?php echo e($type->id); ?>">
                        <div class="prcs-list mb-3">
                            <ul class="p-0 m-0">
                                <li class="py-2 font-medium">
                                    <i class="fa-regular fa-circle-check text-primary me-2"></i>
                                    <div class="text-center fw-bold"><b><?php echo e($type->name); ?></b></div>
                                </li>
                                <li class="py-2 font-medium">
                                    <i class="fa-regular fa-circle-check text-primary me-2"></i>
                                    Sell Rate: <?php echo e(number_format($type->sell_rate,2)); ?><?php echo e($general->cur_text); ?>

                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="alert alert-danger">
                        There is no card type at the moment.
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Roboto', sans-serif;
}
.sec-heading h2 {
    font-family: 'Roboto', sans-serif;
    font-weight: 700;
}
.sec-heading p {
    font-family: 'Roboto', sans-serif;
    font-weight: 400;
}
.rate-card {
    transition: transform 0.3s, box-shadow 0.3s;
}
.rate-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}
.prcs-headlines h4, .prcs-headlines p {
    font-family: 'Roboto', sans-serif;
    font-weight: 500;
}
.prcs-list li {
    font-family: 'Roboto', sans-serif;
    font-weight: 400;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Additional JavaScript effects can be added here if needed
});

function toggleDetails(id) {
    const details = document.getElementById('details-' + id);
    if (details.classList.contains('d-none')) {
        details.classList.remove('d-none');
    } else {
        details.classList.add('d-none');
    }
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/rates.blade.php ENDPATH**/ ?>