<?php $__env->startSection('panel'); ?>
<?php $__env->startPush('style'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')); ?>">
    <?php $__env->stopPush(); ?>
    <!-- File export -->
    <div class="row">
        <div class="col-12">

            <div class="show-filter mb-3 text-end">
                <button class="btn btn-primary showFilterBtn btn-sm" type="button"><i class="ti ti-search"></i>
                    <?php echo app('translator')->get('Filter'); ?></button>
            </div>
            <div class="card responsive-filter-card mb-4">
                <div class="card-body mb-4">
                    <form action="">
                        <div class="d-flex flex-wrap gap-4">
                            <div class="flex-grow-1">
                                <label><?php echo app('translator')->get('TRX'); ?></label>
                                <input class="form-control" name="search" type="text" value="<?php echo e(request()->search); ?>">
                            </div>
                            <div class="flex-grow-1">
                                <label><?php echo app('translator')->get('Type'); ?></label>
                                <select class="form-control" name="trx_type">
                                    <option value=""><?php echo app('translator')->get('All'); ?></option>
                                    <option value="+" <?php if(request()->trx_type == '+'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Plus'); ?></option>
                                    <option value="-" <?php if(request()->trx_type == '-'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Minus'); ?></option>
                                </select>
                            </div>
                            <div class="flex-grow-1">
                                <label><?php echo app('translator')->get('Remark'); ?></label>
                                <select class="form-control" name="remark">
                                    <option value=""><?php echo app('translator')->get('Any'); ?></option>
                                    <?php $__currentLoopData = $remarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $remark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($remark->remark); ?>" <?php if(request()->remark == $remark->remark): echo 'selected'; endif; ?>>
                                            <?php echo e(__(keyToTitle($remark->remark))); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="flex-grow-1">
                                <label><?php echo app('translator')->get('Date'); ?></label>
                                <input class="datepicker-here form-control" name="date" data-range="true" data-multiple-dates-separator=" - " data-language="en" data-position='bottom right' type="text" value="<?php echo e(request()->date); ?>" placeholder="<?php echo app('translator')->get('Start date - End date'); ?>" autocomplete="off">
                            </div>
                            <div class="flex-grow-1 align-self-end">
                                <button class="btn btn-primary w-100 h-45"><i class="ti ti-search"></i>
                                    <?php echo app('translator')->get('Filter'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ---------------------
                              start File export
                          ---------------- -->
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <h5 class="mb-0"><?php echo e($pageTitle); ?></h5>
                    </div>
                    <p class="card-subtitle mb-3">
                        <?php echo app('translator')->get('A table showing all the '); ?> <?php echo e($pageTitle); ?> <?php echo app('translator')->get('on your account. You can export transaction record'); ?>
                    </p>
                    <div class="table-responsive">
                        <table id="file_export" class="table border table-striped table-bordered display text-nowrap">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th><?php echo app('translator')->get('Trx'); ?></th>
                                    <th><?php echo app('translator')->get('Transacted'); ?></th>
                                    <th><?php echo app('translator')->get('Amount'); ?></th>
                                    <th><?php echo app('translator')->get('Post Balance'); ?></th>
                                    <th><?php echo app('translator')->get('Detail'); ?></th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>

                                <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <strong><?php echo e($trx->trx); ?></strong>
                                    </td>

                                    <td>
                                        <?php echo e(showDateTime($trx->created_at)); ?><br><?php echo e(diffForHumans($trx->created_at)); ?>

                                    </td>

                                    <td class="budget">
                                        <span
                                            class="fw-bold <?php if($trx->trx_type == '+'): ?> text--success <?php else: ?> text--danger <?php endif; ?>">
                                            <?php echo e($trx->trx_type); ?> <?php echo e(showAmount($trx->amount)); ?>

                                            <?php echo e($general->cur_text); ?>

                                        </span>
                                    </td>

                                    <td class="budget">
                                        <?php echo e(showAmount($trx->post_balance)); ?> <?php echo e(__($general->cur_text)); ?>

                                    </td>

                                    <td class="break_line"><?php echo e(__($trx->details)); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php echo emptyData2(); ?>

                                <?php endif; ?>
                                <!-- end row -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?php echo app('translator')->get('Trx'); ?></th>
                                    <th><?php echo app('translator')->get('Transacted'); ?></th>
                                    <th><?php echo app('translator')->get('Amount'); ?></th>
                                    <th><?php echo app('translator')->get('Post Balance'); ?></th>
                                    <th><?php echo app('translator')->get('Detail'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-footer">
                        <?php if($transactions->hasPages()): ?>
                            <div class="card-footer">
                                <?php echo e($transactions->links()); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- ---------------------
                              end File export
                          ---------------- -->


<?php $__env->stopSection(); ?>
<?php $__env->startPush('style-lib'); ?>
    <link href="<?php echo e(asset('assets/thirdparty/css/vendor/datepicker.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-lib'); ?>
<script src="<?php echo e(asset('assets/assets/dist/libs/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/dist/js/datatable/datatable-advanced.init.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/thirdparty/js/vendor/datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/thirdpary/js/vendor/datepicker.en.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            if (!$('.datepicker-here').val()) {
                $('.datepicker-here').datepicker();
            }
        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/transactions.blade.php ENDPATH**/ ?>