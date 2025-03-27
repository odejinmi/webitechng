<div class="card b-radius--10">
    <div class="card-body p-0">
        <div class="table-responsive--md table-responsive">
            <table class="table table--light style--two">

                <?php $isNotFdr = !request()->routeIs('admin.fdr.installments');?>
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('S.N.'); ?></th>
                        <th><?php echo app('translator')->get('Installment Date'); ?></th>
                        <th><?php echo app('translator')->get('Given On'); ?></th>
                        <?php if($isNotFdr): ?>
                            <th><?php echo app('translator')->get('Delay'); ?></th>
                            <th><?php echo app('translator')->get('Charge'); ?></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $installments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $installment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e(__($loop->index + $installments->firstItem())); ?></td>

                            <td class="<?php echo e(!$installment->given_at && $installment->installment_date < today() ? 'text--danger' : ''); ?>">
                                <?php echo e(showDateTime($installment->installment_date, 'd M, Y')); ?>

                            </td>

                            <td>
                                <?php if($installment->given_at): ?>
                                    <?php echo e(showDateTime($installment->given_at, 'd M, Y')); ?>

                                <?php else: ?>
                                    <?php echo app('translator')->get('Not yet'); ?>
                                <?php endif; ?>
                            </td>

                            <?php if($isNotFdr): ?>
                                <td>
                                    <?php if($installment->given_at): ?>
                                        <?php echo e($installment->given_at->diffInDays($installment->installment_date)); ?> <?php echo app('translator')->get('Day'); ?>
                                    <?php else: ?>
                                        ...
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php echo e($general->cur_sym); ?><?php echo e(showAmount($installment->delay_charge)); ?>

                                </td>
                            <?php endif; ?>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if($installments->hasPages()): ?>
        <div class="card-footer py-4">
            <?php echo e(paginateLinks($installments)); ?>

        </div>
    <?php endif; ?>
</div>

<?php $__env->startPush('style'); ?>
    <style>
        .list-group {
            gap: 1rem;
        }

        .list-group-item {
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            border: 0;
            padding: 0;
        }

        .caption {
            font-size: 0.8rem;
            color: #b7b7b7;
        }

        .value {
            font-size: 1rem;
            color: #787d85;
            font-weight: 500;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/partials/installments_table.blade.php ENDPATH**/ ?>