<?php $__env->startSection('panel'); ?>
    <?php $__env->startPush('style'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')); ?>">
    <?php $__env->stopPush(); ?>
    <!-- File export -->
    <div class="row">
        <div class="col-12">
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
                                    <th><?php echo app('translator')->get('Gateway'); ?></th>
                                    <th><?php echo app('translator')->get('Amount'); ?></th>
                                    <th><?php echo app('translator')->get('Charge'); ?></th>
                                    <th><?php echo app('translator')->get('Rate'); ?></th>
                                    <th><?php echo app('translator')->get('Receivable'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Time'); ?></th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>

                                <?php $__empty_1 = true; $__currentLoopData = @$withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td data-label="#<?php echo app('translator')->get('Trx'); ?>"><?php echo e($data->trx); ?></td>
                                        <td data-label="<?php echo app('translator')->get('Gateway'); ?>"><?php echo e(__($data->method->name)); ?></td>
                                        <td data-label="<?php echo app('translator')->get('Amount'); ?>">
                                            <strong><?php echo e(showAmount($data->amount)); ?> <?php echo e(__($general->cur_text)); ?></strong>
                                        </td>
                                        <td data-label="<?php echo app('translator')->get('Charge'); ?>" class="text-danger">
                                            <?php echo e(showAmount($data->charge)); ?> <?php echo e(__($general->cur_text)); ?>

                                        </td>
                                        <td data-label="<?php echo app('translator')->get('Rate'); ?>">
                                            <?php echo e(showAmount($data->rate)); ?> <?php echo e(__($data->currency)); ?>

                                        </td>
                                        <td data-label="<?php echo app('translator')->get('Receivable'); ?>" class="text--base">
                                            <strong><?php echo e(showAmount($data->final_amount)); ?>

                                                <?php echo e(__($data->currency)); ?></strong>
                                        </td>
                                        <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                            <?php if($data->status == 2): ?>
                                                <span class="badge bg-warning"><?php echo app('translator')->get('Pending'); ?></span>
                                            <?php elseif($data->status == 1): ?>
                                                <span class="badge bg-success"><?php echo app('translator')->get('Completed'); ?></span>
                                                <button class="btn btn-info btn-rounded  badge approveBtn"
                                                    data-admin_feedback="<?php echo e($data->admin_feedback); ?>"><i
                                                        class="fa fa-info"></i></button>
                                            <?php elseif($data->status == 3): ?>
                                                <span class="badge bg-danger"><?php echo app('translator')->get('Rejected'); ?></span>
                                                <button class="btn btn-info btn-rounded badge approveBtn"
                                                    data-admin_feedback="<?php echo e($data->admin_feedback); ?>"><i
                                                        class="fa fa-info"></i></button>
                                            <?php endif; ?>

                                        </td>
                                        <td data-label="<?php echo app('translator')->get('Time'); ?>">
                                            <?php echo e(showDateTime($data->created_at)); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php echo emptyData2(); ?>

                                <?php endif; ?>
                                <!-- end row -->
                                <!-- end row -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?php echo app('translator')->get('Trx'); ?></th>
                                    <th><?php echo app('translator')->get('Gateway'); ?></th>
                                    <th><?php echo app('translator')->get('Amount'); ?></th>
                                    <th><?php echo app('translator')->get('Charge'); ?></th>
                                    <th><?php echo app('translator')->get('Rate'); ?></th>
                                    <th><?php echo app('translator')->get('Receivable'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Time'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-footer">
                        <?php echo e($withdraws->links()); ?>

                    </div>
                </div>
            </div>
            <!-- ---------------------
                                  end File export
                              ---------------- -->




            
            <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo app('translator')->get('Details'); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="withdraw-detail"></div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger"
                                data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php $__env->stopSection(); ?>

        <?php $__env->startPush('breadcrumb-plugins'); ?>
            <a href="<?php echo e(route('user.withdraw')); ?>" class="btn btn-outline-primary">
                <i class="las la-plus"></i>
                <?php echo app('translator')->get('Request Payout'); ?>
            </a>
        <?php $__env->stopPush(); ?>
        <?php $__env->startPush('script'); ?>
            <script src="<?php echo e(asset('assets/assets/dist/libs/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/assets/dist/js/datatable/datatable-advanced.init.js')); ?>"></script>

            <script>
                (function($) {
                    "use strict";
                    $('.approveBtn').on('click', function() {
                        var modal = $('#detailModal');
                        var feedback = $(this).data('admin_feedback');
                        feedback = feedback ? feedback : 'Data Not Found';
                        modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                        modal.modal('show');
                    });
                })(jQuery);
            </script>
        <?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/withdraw/log.blade.php ENDPATH**/ ?>