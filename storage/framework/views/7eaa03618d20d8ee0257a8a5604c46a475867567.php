<?php $__env->startSection('panel'); ?>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><?php echo app('translator')->get('Transaction Bonus Settings'); ?></h5>
                </div>
                <form action="<?php echo e(route('admin.bonus.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="table-responsive--md">
                            <table class="table table--light style--two">
                                <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Transaction Type'); ?></th>
                                    <th><?php echo app('translator')->get('Bonus Percentage'); ?></th>
                                    <th><?php echo app('translator')->get('Bonus Amount'); ?></th>
                                    <th><?php echo app('translator')->get('Bonus Type'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $bonuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bonus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo e(ucfirst($bonus->transaction_type)); ?></strong>
                                            <input type="hidden" name="bonuses[<?php echo e($loop->index); ?>][id]" value="<?php echo e($bonus->id); ?>">
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" step="0.01" min="0" max="100"
                                                       class="form-control"
                                                       name="bonuses[<?php echo e($loop->index); ?>][bonus_percentage]"
                                                       value="<?php echo e($bonus->bonus_percentage); ?>" required>
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" step="0.01"
                                                       class="form-control"
                                                       name="bonuses[<?php echo e($loop->index); ?>][bonus_amount]"
                                                       value="<?php echo e($bonus->bonus_amount); ?>" required>
                                            </div>
                                        </td>
                                        <td>
                                            <select class="form-select bonus-type-select"
                                                    name="bonuses[<?php echo e($loop->index); ?>][bonus_type]"
                                                    data-width="100%"
                                                    data-size="large"
                                                    data-onstyle="-success"
                                                    data-offstyle="-danger">
                                                <option value= "0" <?php if($bonus->bonus_type == 0): ?> selected <?php endif; ?>>Percentage</option>
                                                <option value="1" <?php if($bonus->bonus_type == 1): ?> selected <?php endif; ?>>Fixed Amount</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="hidden" name="bonuses[<?php echo e($loop->index); ?>][is_active]" value="0">
                                            <input type="checkbox"
                                                   data-width="100%"
                                                   data-size="large"
                                                   data-onstyle="-success"
                                                   data-offstyle="-danger"
                                                   data-bs-toggle="toggle"
                                                   data-on="Active"
                                                   data-off="Inactive"
                                                   name="bonuses[<?php echo e($loop->index); ?>][is_active]"
                                                   value="1"
                                                   <?php if($bonus->is_active): ?> checked <?php endif; ?>>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn--primary w-100"><?php echo app('translator')->get('Update Settings'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-sm btn--primary box--shadow1 text--small">
        <i class="la la-fw la-backward"></i> <?php echo app('translator')->get('Go Back'); ?>
    </a>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function ($) {
            "use strict";
            $('select[name=type]').on('change', function() {
                $('.search-fields').addClass('d-none');
                const selectedValue = $(this).val();
                $(`.search-fields[data-type="${selectedValue}"]`).removeClass('d-none');
            }).change();
        })(jQuery);

        $('.bonus-type-select').select2({
            minimumResultsForSearch: Infinity,
            theme: 'bootstrap',
            width: '100%'
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PhpstormProjects\webitechng\resources\views/admin/bonus/index.blade.php ENDPATH**/ ?>