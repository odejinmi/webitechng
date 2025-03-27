<?php $__env->startSection('panel'); ?>
    <div class="row gy-4">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                     
                    <ul class="list-group">
                        <li class="list-group-item d-flex align-items-center">
                            <span class="fw-bold"><?php echo e($loan->loan_number); ?></span>
                            <span><?php echo app('translator')->get('Loan Number'); ?></span>
                        </li>

                        <li class="list-group-item d-flex align-items-center">
                            <span class="fw-bold"><?php echo e($loan->plan->name); ?></span>
                            <span><?php echo app('translator')->get('Plan'); ?></span>
                        </li>

                        <li class="list-group-item d-flex align-items-center">
                            <span class="fw-bold"><?php echo e(showAmount($loan->amount)); ?> <?php echo e($general->cur_text); ?></span>
                            <span><?php echo app('translator')->get('Loan Amount'); ?></span>
                        </li>

                        <li class="list-group-item d-flex align-items-center">
                            <span class="fw-bold text--base"><?php echo e(showAmount($loan->per_installment)); ?> <?php echo e($general->cur_text); ?></span>
                            <span><?php echo app('translator')->get('Per Installment'); ?></span>
                        </li>

                        <li class="list-group-item d-flex align-items-center">
                            <span class="fw-bold"><?php echo e($loan->total_installment); ?></span>
                            <span><?php echo app('translator')->get('Total Installment'); ?></span>
                        </li>

                        <li class="list-group-item d-flex align-items-center">
                            <span class="fw-bold"><?php echo e($loan->given_installment); ?></span>
                            <span><?php echo app('translator')->get('Given Installment'); ?></span>
                        </li>

                        <li class="list-group-item d-flex align-items-center">
                            <span class="fw-bold text--warning"><?php echo e($general->cur_sym . showAmount($loan->payable_amount)); ?></span>
                            <span><?php echo app('translator')->get('Needs to Pay'); ?></span>
                        </li>

                        <?php if(getAmount($loan->charge_per_installment)): ?>
                        <li class="list-group-item d-flex align-items-center">
                            <span class="fw-bold"><?php echo e(showAmount($loan->charge_per_installment)); ?> <?php echo e($general->cur_text); ?> /<?php echo app('translator')->get('Day'); ?></span>
                                <span><?php echo app('translator')->get('Delay Charge'); ?></span>
                                <small class="text--danger mt-2"><?php echo app('translator')->get('Charge will be applied if an installment delayed for'); ?> <?php echo e($loan->delay_value); ?> <?php echo app('translator')->get(' or more days'); ?></small>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-8 card">
            <?php echo $__env->make($activeTemplate . 'partials.installment_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('bottom-menu'); ?>
    <div class="col-12 order-lg-3 order-4">
        <div class="d-flex nav-buttons flex-align gap-md-3 gap-2">
            <a href="<?php echo e(route('user.loan.plans')); ?>" class="btn btn-outline--base"><?php echo app('translator')->get('Loan Plans'); ?></a>
            <a href="<?php echo e(route('user.loan.list')); ?>" class="btn btn--base active"><?php echo app('translator')->get('My Loan List'); ?></a>
        </div>
    </div>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/loan/installments.blade.php ENDPATH**/ ?>