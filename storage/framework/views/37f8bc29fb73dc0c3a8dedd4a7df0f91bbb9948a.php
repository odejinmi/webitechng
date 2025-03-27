<div class="row gy-3">
    <div class="col-lg-12">
        <div class="custom--card">
            <div class="card-body p-0">
                <div class="table-responsive--md">
                    <table class="custom--table table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('S.N.'); ?></th>
                                <th><?php echo app('translator')->get('Installment Date'); ?></th>
                                <th><?php echo app('translator')->get('Given On'); ?></th>
                                <th><?php echo app('translator')->get('Delay'); ?></th>
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
                                            <small><?php echo app('translator')->get('Not yet'); ?></small>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if($installment->given_at): ?>
                                            <?php echo e($installment->given_at->diffInDays($installment->installment_date)); ?> <?php echo app('translator')->get('Day'); ?>
                                        <?php else: ?>
                                            ...
                                        <?php endif; ?>
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
            <?php if($installments->hasPages()): ?>
                <div class="card-footer py-2">
                    <?php echo e(paginateLinks($installments)); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->startPush('style'); ?>
    <style>
        .list-group {
            gap: 0.8rem;
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
            color: #b1b1b1;
            line-height: 1;
        }

        .value {
            color: #686a81;
            font-weight: 500;
            line-height: 1.8;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/partials/installment_table.blade.php ENDPATH**/ ?>