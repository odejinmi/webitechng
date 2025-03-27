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
                        >
                          <thead>
                            <!-- start row -->
                            <tr>
                                <th><?php echo app('translator')->get('Asset'); ?></th>
                                <th class="text-center"><?php echo app('translator')->get('Initiated'); ?></th>
                                <th class="text-center"><?php echo app('translator')->get('TRX'); ?></th>
                                 <th class="text-center"><?php echo app('translator')->get('Conversion | Rate'); ?></th>
                                 <th class="text-center"><?php echo app('translator')->get('Value'); ?></th>
                                <th class="text-center"><?php echo app('translator')->get('Status'); ?></th>
                            </tr>
                            <!-- end row -->
                          </thead>
                          <tbody>
                             
                            <?php $__empty_1 = true; $__currentLoopData = @$log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <span class="fw-bold"> 
                                              
                                              <span
                                                    class="text-primary"><?php echo e(__($deposit->product_name)); ?><small> (<?php echo e(__($deposit->asset->symbol)); ?>)</small></span>
                                            </span> 
                                            <br>
                                            <span class="symbol symbol-40px me-6">
                                              <span class="symbol-label bg-light-primary">
                                                  <i class="ti ti-image fs-2x text-warning"><img src="<?php echo e(url('/')); ?>/assets/images/coins/<?php echo e($deposit->asset->image); ?>" width="30" class="path1"/></i>
                                              </span>
                                              
                                          </span> 
                                        </td>

                                        <td class="text-center">
                                            <?php echo e(showDateTime($deposit->created_at)); ?><br><?php echo e(diffForHumans($deposit->created_at)); ?>

                                        </td>

                                        <td class="text-center">
                                            <?php echo e(($deposit->deposit_code)); ?>

                                        </td>
                                       
                                        <td class="text-center">
                                           <small> <?php echo e(showAmount($deposit->payment)); ?><?php echo e(__($general->cur_text)); ?></small>
                                            <br> 
                                            <strong><?php echo e(showAmount($deposit->price)); ?> <?php echo e(__($general->cur_text)); ?></strong>                                        
                                        </td>
                                        <td class="text-center">
                                          <?php echo e(__($deposit->value)); ?><?php echo e(__(@$deposit->asset->symbol)); ?>

                                        </td> 
                                        <td class="text-center">
                                           <label class='badge text-white  <?php if($deposit->status == 'success'): ?> bg-success <?php else: ?> bg-danger <?php endif; ?>'> <?php echo $deposit->status ?></label>
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
                                <th><?php echo app('translator')->get('Product | ID'); ?></th>
                                <th class="text-center"><?php echo app('translator')->get('Initiated'); ?></th>
                                <th class="text-center"><?php echo app('translator')->get('TRX'); ?></th>
                                <th class="text-center"><?php echo app('translator')->get('Conversion | Value'); ?></th>
                                <th class="text-center"><?php echo app('translator')->get('Rate'); ?></th>
                                <th class="text-center"><?php echo app('translator')->get('Status'); ?></th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <?php if($log->hasPages()): ?>
                    <div class="card-footer">
                        <?php echo e($log->links()); ?>

                    </div>
                    <?php endif; ?>
                    </div>
                  </div>
                  <!-- ---------------------
                              end File export
                          ---------------- -->
  
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

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/assets/crypto/buycrypto/buy_log.blade.php ENDPATH**/ ?>