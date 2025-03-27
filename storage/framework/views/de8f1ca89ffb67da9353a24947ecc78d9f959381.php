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

                        <table
                        id="file_export"
                        class="table border table-striped table-bordered display text-nowrap"
                      >                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('Escrow Number'); ?></th>
                                <th><?php echo app('translator')->get('Title'); ?></th>
                                <th><?php echo app('translator')->get('Buyer - Seller'); ?></th>
                                <th><?php echo app('translator')->get('Amount'); ?></th>
                                <th><?php echo app('translator')->get('Category'); ?></th>
                                <th><?php echo app('translator')->get('Charge'); ?></th>
                                <th><?php echo app('translator')->get('Charge Payer'); ?></th>
                                <th><?php echo app('translator')->get('Status'); ?></th>
                                <th><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $escrows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $escrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($escrow->escrow_number); ?></td>
                                    <td><?php echo e(__($escrow->title)); ?></td>
                                    <td>
                                        <?php echo app('translator')->get('I\'m'); ?> <?php if($escrow->buyer_id == auth()->user()->id): ?>
                                            <?php echo app('translator')->get('buying from'); ?>
                                            <?php echo e(__(@$escrow->seller->username ?? $escrow->invitation_mail)); ?>

                                        <?php else: ?>
                                            <?php echo app('translator')->get('selling to'); ?>
                                            <?php echo e(__(@$escrow->buyer->username ?? $escrow->invitation_mail)); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo e($general->cur_sym); ?><?php echo e(showAmount($escrow->amount)); ?></td>
                                    <td><?php echo e(@$escrow->category->name ?? 'N/A'); ?></td>
                                    <td>
                                        <?php echo e($general->cur_sym); ?><?php echo e(showAmount($escrow->charge)); ?></td>
                                    <td>
                                        <?php if($escrow->charge_payer == Status::CHARGE_PAYER_SELLER): ?>
                                            <span class="badge bg-primary text-white"><?php echo app('translator')->get('Seller'); ?></span>
                                        <?php elseif($escrow->charge_payer == Status::CHARGE_PAYER_BUYER): ?>
                                            <span class="badge bg-info text-white"><?php echo app('translator')->get('Buyer'); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-success text-white"><?php echo app('translator')->get('50%-50%'); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo $escrow->escrowStatus ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('user.escrow.details', $escrow->id)); ?>" class="btn btn-sm btn-primary btn-sm detailBtn "><i class="ni ni-desktop"></i> <?php echo app('translator')->get('Details'); ?></a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="100%" class="text-center"><?php echo e(__($emptyMessage)); ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if($escrows->hasPages()): ?>
                    <div class="mt-5">
                        <?php echo e($escrows->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
 

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Search by Trx']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Search by Trx']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
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

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/vendor/escrow/index.blade.php ENDPATH**/ ?>