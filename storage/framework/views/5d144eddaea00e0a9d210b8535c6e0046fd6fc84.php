<?php $__env->startSection('panel'); ?>
    <div class="row gy-4">
        <div class="col-sm-5 col-lg-3">
            <div class="card custom--card">
                <div class="card-header bg--primary">
                    <h6 class="card-title text--white"><?php echo app('translator')->get('Loan Summary'); ?></h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span class="value"><?php echo e($loan->loan_number); ?></span>
                            <span class="caption"><?php echo app('translator')->get('Loan Number'); ?></span>
                        </li>

                        <li class="list-group-item">
                            <span class="value"><?php echo e($loan->plan->name); ?></span>
                            <span class="caption"><?php echo app('translator')->get('Plan'); ?></span>
                        </li>

                        <li class="list-group-item">
                            <span class="value"><?php echo e($general->cur_sym); ?><?php echo e(showAmount($loan->amount)); ?></span>
                            <span class="caption"><?php echo app('translator')->get('Loan Amount'); ?></span>
                        </li>

                        <li class="list-group-item">
                            <span class="value text--base"><?php echo e($general->cur_sym); ?><?php echo e(showAmount($loan->per_installment)); ?></span>
                            <span class="caption"><?php echo app('translator')->get('Per Installment'); ?></span>
                        </li>

                        <li class="list-group-item">
                            <span class="value"><?php echo e($loan->total_installment); ?></span>
                            <span class="caption"><?php echo app('translator')->get('Total Installment'); ?></span>
                        </li>

                        <li class="list-group-item">
                            <span class="value"><?php echo e($loan->given_installment); ?></span>
                            <span class="caption"><?php echo app('translator')->get('Given Installment'); ?></span>
                        </li>

                        <li class="list-group-item">
                            <span class="value text--warning"><?php echo e($general->cur_sym . showAmount($loan->payable_amount)); ?></span>
                            <span class="caption"><?php echo app('translator')->get('Receivable'); ?></span>
                        </li>

                        <?php if(getAmount($loan->charge_per_installment)): ?>
                            <li class="list-group-item">
                                <span class="value"><?php echo e($general->cur_sym); ?><?php echo e(showAmount($loan->charge_per_installment)); ?> /<?php echo app('translator')->get('Day'); ?></span>
                                <span class="caption"><?php echo app('translator')->get('Delay Charge'); ?></span>
                                <small class="text--warning"><?php echo app('translator')->get('Charge will be applied if an installment delayed for'); ?> <?php echo e($loan->delay_value); ?> <?php echo app('translator')->get(' or more days'); ?></small>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-sm-7 col-lg-9">
            <?php echo $__env->make('admin.partials.installments_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $hasPermission = App\Models\Role::hasPermission('admin.loan.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.back','data' => ['route' => ''.e(route('admin.loan.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('back'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => ''.e(route('admin.loan.index')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php $__env->stopPush(); ?>
<?php endif ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/loan/installments.blade.php ENDPATH**/ ?>