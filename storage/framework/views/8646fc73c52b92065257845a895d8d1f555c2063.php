<?php $__env->startSection('panel'); ?>
    <!-- File export -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold"><?php echo e($pageTitle); ?></h5>
                        </div>
                    </div>
<div class="col-sm-6" style="text-align: right;">
    <p style="margin-bottom: 5px;">Create a Card Holder first, then proceed to create a new card</p>
    <a href="<?php echo e(url('/user/create/customer')); ?>" class="btn btn-info">Create CardHolder</a>
    <a href="<?php echo e(url('/user/create/card')); ?>" class="btn btn-primary">Create New Card</a>
</div>

                </div>
                <div class="row" style="margin-top:10px">
                    <div class="col-sm-12">
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
                                            <a href="<?php echo e(url('/user/view/card/'.$row->id)); ?>" class="btn btn-primary btn-sm btn-xs">View</a>
                                        </td>
                                        <td>
                                         <!--   <a href="<?php echo e(url('/user/fund/card/'.$row->id)); ?>" class="btn btn-primary btn-sm btn-xs">Fund Card</a>-->
                                            <a href="<?php echo e(url('/user/withdraw/card/'.$row->id)); ?>" class="btn btn-danger btn-sm btn-xs">Withdraw</a>

                                                <a href="<?php echo e(url('/user/freez/card/'.$row->id)); ?>" class="btn btn-info btn-sm btn-xs">Freeze</a>

                                                <a href="<?php echo e(url('/user/unfreez/card/'.$row->id)); ?>" class="btn btn-warning btn-sm btn-xs">UnFreeze</a>

                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <?php echo emptyData2(); ?>

                                    <?php endif; ?>
                                    <!-- end row -->
                                </tbody>
                            </table>
                        </div>
                    </div>
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
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/satoshi/user/virtual_card/list_cards.blade.php ENDPATH**/ ?>