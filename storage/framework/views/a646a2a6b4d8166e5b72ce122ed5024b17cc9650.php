
<?php $__env->startSection('panel'); ?>
    <!-- File export -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <h5 class="mb-0"><?php echo e($pageTitle); ?></h5>
                    </div>
                    <div class="table-responsive">
                        <table id="file_export" class="table border table-striped table-bordered display text-nowrap">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th><?php echo app('translator')->get('Sr.No'); ?></th>
                                    <th><?php echo app('translator')->get('Card Id'); ?></th>
                                    <th><?php echo app('translator')->get('Card Type'); ?></th>
                                    <th><?php echo app('translator')->get('Card Brand'); ?></th>
                                    <th><?php echo app('translator')->get('Reference'); ?></th>
                                    <th><?php echo app('translator')->get('View'); ?></th>
                                    <th><?php echo app('translator')->get('Detail'); ?></th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>

                                <?php $__empty_1 = true; $__currentLoopData = $vcards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <strong><?php echo e($key+1); ?></strong>
                                    </td>
                                    <td>
                                        <?php if(isset($row->card_id)): ?><?php echo e($row->card_id); ?><?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(isset($row->card_type)): ?><?php echo e($row->card_type); ?><?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(isset($row->brand)): ?><?php echo e($row->brand); ?><?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(isset($row->reference)): ?><?php echo e($row->reference); ?><?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm btn-xs">View</a>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm btn-xs">Fund Card</a>
                                        <a href="" class="btn btn-danger btn-sm btn-xs">Withdraw</a>
                                        <a href="" class="btn btn-info btn-sm btn-xs">Freez</a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php echo emptyData2(); ?>

                                <?php endif; ?>
                                <!-- end row -->
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <?php if($vcards->hasPages()): ?>
                            <div class="card-footer">
                                <?php echo e($transactions->links()); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/virtual_card/view_cards.blade.php ENDPATH**/ ?>