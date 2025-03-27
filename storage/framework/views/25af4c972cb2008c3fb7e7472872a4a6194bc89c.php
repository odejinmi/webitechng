<?php $__env->startSection('panel'); ?>
    <div class="row gy-4">
        <div class="col-xl-4 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span class="fw-bold"><?php echo app('translator')->get('Account No.'); ?></span>
                            <?php $hasPermission = App\Models\Role::hasPermission('admin.users.detail')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                <a class="fw-bold" href="<?php echo e(route('admin.users.detail', $loan->user_id)); ?>"><?php echo e(@$loan->user->account_number); ?></a>
                            <?php else: ?>
                                <?php echo e(@$loan->user->account_number); ?>

                            <?php endif ?>
                        </li>

                        <li class="list-group-item">
                            <span class="fw-bold"><?php echo app('translator')->get('Plan'); ?></span>
                            <span><?php echo e(__(@$loan->plan->name)); ?></span>
                        </li>

                        <li class="list-group-item">
                            <span class="fw-bold"><?php echo app('translator')->get('Date of Application'); ?></span>
                            <span><?php echo e(showDateTime($loan->created_at, 'd M, Y, h:i A')); ?></span>
                        </li>

                        <li class="list-group-item">
                            <span class="fw-bold"><?php echo app('translator')->get('Loan Number'); ?></span>
                            <span><?php echo e($loan->loan_number); ?></span>
                        </li>

                        <li class="list-group-item">
                            <span class="fw-bold"><?php echo app('translator')->get('Amount'); ?> </span>
                            <span class="fw-bold text--warning"><?php echo e(showAmount($loan->amount)); ?> <?php echo e(__($general->cur_text)); ?></span>
                        </li>

                        <li class="list-group-item">
                            <span class="fw-bold"><?php echo app('translator')->get('Per Installment'); ?></span>
                            <span><?php echo e(showAmount($loan->per_installment)); ?> <?php echo e(__($general->cur_text)); ?></span>
                        </li>

                        <li class="list-group-item">
                            <span class="fw-bold"><?php echo app('translator')->get('Total Installment'); ?></span>
                            <span><?php echo e($loan->total_installment); ?></span>
                        </li>

                        <li class="list-group-item">
                            <span class="fw-bold"><?php echo app('translator')->get('Given Installment'); ?></span>
                            <span><?php echo e($loan->given_installment); ?></span>
                        </li>

                        <li class="list-group-item">
                            <span class="fw-bold"><?php echo app('translator')->get('Total Payable'); ?></span>
                            <span><?php echo e(showAmount($loan->payable_amount)); ?> <?php echo e(__($general->cur_text)); ?></span>
                        </li>

                        <?php $profit = $loan->payable_amount - $loan->amount; ?>

                        <li class="list-group-item">
                            <span class="fw-bold"><?php echo app('translator')->get('Profit'); ?></span>
                            <span class="fw-bold <?php echo e($profit < 0 ? 'text--danger' : 'text--success'); ?>">
                                <?php echo e(showAmount($profit)); ?> <?php echo e(__($general->cur_text)); ?>

                            </span>
                        </li>

                        <li class="list-group-item">
                            <span class="fw-bold"><?php echo app('translator')->get('Status'); ?></span>
                            <?php echo $loan->status_badge; ?>
                        </li>
                    </ul>

                    <?php if($loan->status == Status::LOAN_REJECTED && $loan->admin_feedback): ?>
                        <h6 class="mt-3"> <i class="fa fa-info-circle text--danger" aria-hidden="true"></i> <?php echo app('translator')->get('Reason of Rejection'); ?></h6>
                        <p class="mt-2"><?php echo e($loan->admin_feedback); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-8 mb-30">

            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="card-title border-bottom pb-2"><?php echo app('translator')->get('Loan Form Submitted by User'); ?></h5>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.view-form-data','data' => ['data' => $loan->application_form]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('view-form-data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($loan->application_form)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                    <?php if($loan->status == Status::LOAN_PENDING): ?>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.loan.approve')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <button class="btn btn-success confirmationBtn" data-action="<?php echo e(route('admin.loan.approve', $loan->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to approve this loan?'); ?>">
                                        <i class="fas la-check"></i> <?php echo app('translator')->get('Approve'); ?>
                                    </button>
                                <?php endif ?>

                                <?php $hasPermission = App\Models\Role::hasPermission('admin.loan.reject')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                    <button class="btn btn-danger ms-1 rejectBtn" data-action="<?php echo e(route('admin.loan.reject', $loan->id)); ?>">
                                        <i class="fas fa-ban"></i> <?php echo app('translator')->get('Reject'); ?>
                                    </button>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php $hasPermission = App\Models\Role::hasPermission('admin.loan.approve')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <?php if (isset($component)) { $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b = $component; } ?>
<?php $component = App\View\Components\ConfirmationModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ConfirmationModal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b)): ?>
<?php $component = $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b; ?>
<?php unset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b); ?>
<?php endif; ?>
    <?php endif ?>

    <div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Confirmation Alert'); ?></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Reason of Rejection'); ?></label>
                            <textarea name="reason" maxlength="255" class="form-control" rows="5" required><?php echo e(old('message')); ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .list-group-item {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            $('.rejectBtn').on('click', function() {
                var modal = $('#rejectModal');
                modal.find('form')[0].action = $(this).data('action');
                modal.modal('show');
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/loan/details.blade.php ENDPATH**/ ?>