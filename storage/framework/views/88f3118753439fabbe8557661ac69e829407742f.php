<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--lg table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('S.N.'); ?></th>
                                    <th><?php echo app('translator')->get('Loan No.'); ?> | <?php echo app('translator')->get('Plan'); ?></th>
                                    <th><?php echo app('translator')->get('User'); ?></th>
                                    <th><?php echo app('translator')->get('Amount'); ?></th>
                                    <th><?php echo app('translator')->get('Installment Amount'); ?></th>
                                    <th><?php echo app('translator')->get('Installment'); ?></th>
                                    <th><?php echo app('translator')->get('Created'); ?> | </br>
                                        <?php echo app('translator')->get('Next Installment'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                         <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e(__($loop->index + $loans->firstItem())); ?></td>
                                        <td>
                                            <span class="fw-bold"><?php echo e(__($loan->loan_number)); ?></span>
                                            <span class="d-block text--info"><?php echo e(__($loan->plan->name)); ?></span>
                                        </td>
                                        <td>
                                            <span class="fw-bold d-block"><?php echo e($loan->user->account_number); ?></span>
                                            <span class="small">
                                                <?php $hasPermission = App\Models\Role::hasPermission('admin.users.detail')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                    <a href="<?php echo e(route('admin.users.detail', $loan->user_id)); ?>"><span>@</span><?php echo e($loan->user->username); ?></a>
                                                <?php else: ?>
                                                    <span>@</span><?php echo e($loan->user->username); ?>

                                                <?php endif ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span><?php echo e($general->cur_sym . showAmount($loan->amount)); ?></span>
                                            <span class="d-block text--info">
                                                <?php echo e($general->cur_sym . showAmount($loan->payable_amount)); ?> <?php echo app('translator')->get('Receivable'); ?>
                                            </span>
                                        </td>

                                        <td>
                                            <span><?php echo e($general->cur_sym . showAmount($loan->per_installment)); ?></span>
                                            <span class="d-block text--info">
                                                <?php echo app('translator')->get('Per'); ?> <?php echo e($loan->installment_interval); ?> <?php echo app('translator')->get('days'); ?>
                                            </span>
                                        </td>

                                        <td>
                                            <span><?php echo app('translator')->get('Total'); ?> : <?php echo e($loan->total_installment); ?></span>
                                            <span class="d-block text--info"><?php echo app('translator')->get('Given'); ?> : <?php echo e($loan->given_installment); ?></span>
                                        </td>

                                        <td>
                                            <span class="d-block"><?php echo e(showDateTime($loan->created_at, 'd M, Y')); ?></span>
                                            <?php if($loan->nextInstallment): ?>
                                                <span class="text--info"> <?php echo e(showDateTime($loan->nextInstallment->installment_date, 'd M, Y')); ?></span>
                                            <?php else: ?>
                                                <span class="text--info"><?php echo app('translator')->get('N\A'); ?></span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php echo $loan->status_badge; ?>
                                        </td>

                                             <td>
                                                <div class="button--group">
                                                         <a class="btn btn-sm btn-primary" href="<?php echo e(route('admin.loan.details', $loan->id)); ?>">
                                                            <i class="las la-desktop"></i> <?php echo app('translator')->get('Details'); ?>
                                                        </a>
                                                          <a class="btn btn-sm btn-success" href="<?php echo e(route('admin.loan.installments', $loan->id)); ?>">
                                                            <i class="las la-history"></i> <?php echo app('translator')->get('Installments'); ?>
                                                        </a>
                                                </div>
                                            </td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($loans->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo e(paginateLinks($loans)); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['dateSearch' => 'yes','placeholder' => 'Loan No.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dateSearch' => 'yes','placeholder' => 'Loan No.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/loan/index.blade.php ENDPATH**/ ?>