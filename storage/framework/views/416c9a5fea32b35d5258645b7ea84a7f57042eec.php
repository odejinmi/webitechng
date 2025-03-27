<?php $__env->startSection('panel'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')); ?>">
<?php $__env->stopPush(); ?>

    <div class="header-nav">
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Loan No.| Plan','btn' => 'btn-primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Loan No.| Plan','btn' => 'btn-primary']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        
    </div>
    <br>
    <div class="table-responsive">
        <table
          id="file_export"
          class="table border table-striped table-bordered display text-nowrap"
        >
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('S.N.'); ?></th>
                    <th><?php echo app('translator')->get('Loan No. | Plan'); ?></th>
                    <th><?php echo app('translator')->get('Amount'); ?></th>
                    <th><?php echo app('translator')->get('Installment Amount'); ?></th>
                    <th><?php echo app('translator')->get('Installment'); ?></th>
                    <th><?php echo app('translator')->get('Next Installment'); ?></th>
                    <th><?php echo app('translator')->get('Paid'); ?></th>
                    <th><?php echo app('translator')->get('Status'); ?></th>
                    <th><?php echo app('translator')->get('Action'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e(__($loop->index + $loans->firstItem())); ?></td>

                        <td>
                            <div>
                                <span><?php echo e(__($loan->loan_number)); ?></span>
                                <br>
                                <small class="text--base"><?php echo e(__($loan->plan->name)); ?></small>
                            </div>
                        </td>

                        <td>
                            <div>
                                <span><?php echo e($general->cur_sym . showAmount($loan->amount)); ?></span>
                                <br>
                                <small class="text--base">
                                    <?php echo e($general->cur_sym . showAmount($loan->payable_amount)); ?> <?php echo app('translator')->get('Need to pay'); ?>
                                </small>
                            </div>
                        </td>

                        <td>
                            <div>
                                <span><?php echo e($general->cur_sym . showAmount($loan->per_installment)); ?></span>
                                <br>
                                <small class="text--base">
                                    <?php echo app('translator')->get('In Every'); ?> <?php echo e(__($loan->installment_interval)); ?> <?php echo app('translator')->get('Days'); ?>
                                </small>
                            </div>
                        </td>

                        <td>
                            <div>
                                <span> <?php echo app('translator')->get('Total'); ?> : <?php echo e(__($loan->total_installment)); ?></span>
                                <br>
                                <small class="text--base">
                                    <?php echo app('translator')->get('Given'); ?> : <?php echo e(__($loan->given_installment)); ?>

                                </small>
                            </div>
                        </td>
                        <td>
                            <?php if($loan->nextInstallment): ?>
                                <?php echo e(showDateTime($loan->nextInstallment->installment_date, 'd M, Y')); ?>

                            <?php endif; ?>
                        </td>

                        <td>
                            <div>
                                <span><?php echo e($general->cur_sym . showAmount($loan->paid_amount)); ?></span>
                                <br>
                                <span class="text--warning">
                                    <?php $remainingAmount = $loan->payableAmount - $loan->paid_amount;  ?>
                                    <small> <?php echo e($general->cur_sym . showAmount($remainingAmount)); ?> <?php echo app('translator')->get('Remaining'); ?></small>
                                </span>
                            </div>
                        </td>

                        <td>
                            <div>
                                <?php echo $loan->statusBadge; ?>
                                <?php if($loan->status == 3): ?>
                                    <span class="admin-feedback" data-feedback="<?php echo e(__($loan->admin_feedback)); ?>">
                                        <i class="la la-info-circle"></i>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </td>

                        <td>
                            <a class="btn btn-primary btn--sm <?php if(!$loan->nextInstallment): echo 'disabled'; endif; ?>" href="<?php echo e(route('user.loan.instalment.logs', $loan->loan_number)); ?>">
                                <i class="las la-wallet"></i> <?php echo app('translator')->get('Installments'); ?>
                            </a>
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
    <?php if($loans->hasPages()): ?>
        <div class="mt-4">
            <?php echo e(paginateLinks($loans)); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            $('.admin-feedback').on('click', function() {
                var modal = $('#adminFeedback');
                modal.find('.modal-body').text($(this).data('feedback'));
                modal.modal('show');
            });

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('bottom-menu'); ?>
    <div class="col-12 order-lg-3 order-4">
        <div class="d-flex nav-buttons flex-align gap-md-3 gap-2">
            <a href="<?php echo e(route('user.loan.plans')); ?>" class="btn btn-outline--base"><?php echo app('translator')->get('Loan Plans'); ?></a>
            <a href="<?php echo e(route('user.loan.list')); ?>" class="btn btn--base active"><?php echo app('translator')->get('My Loan List'); ?></a>
        </div>
    </div>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('modal'); ?>
    <!-- Modal -->
    <div class="modal fade" id="adminFeedback">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Reason of Rejection'); ?>!</h5>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn--dark" data-bs-dismiss="modal" type="button"><?php echo app('translator')->get('Close'); ?></button>
                </div>
            </div>
        </div>
    </div>
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
 
<?php $__env->stopPush(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>  

    <div class="col-12 order-lg-3 order-4">
        <div class="d-flex nav-buttons flex-align gap-md-3 gap-2">
            <a href="<?php echo e(route('user.loan.plans')); ?>" class="btn btn-info active"><?php echo app('translator')->get('Loan Plans'); ?></a>
        </div>
    </div>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('style'); ?>
    <style>
        .btn[type=submit] {
            height: unset !important;
        }

        .btn {
            padding: 12px 1.875rem;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/loan/list.blade.php ENDPATH**/ ?>