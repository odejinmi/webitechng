<?php $__env->startSection('panel'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')); ?>">
<?php $__env->stopPush(); ?>
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
                              <th><?php echo app('translator')->get('TRX ID'); ?></th>
                              <th><?php echo app('translator')->get('Customer'); ?></th>
                              <th><?php echo app('translator')->get('Network'); ?></th>
                              <th><?php echo app('translator')->get('Code'); ?></th>
                              <th><?php echo app('translator')->get('Amount'); ?></th>
                              <th><?php echo app('translator')->get('Value'); ?></th>
                              <th><?php echo app('translator')->get('Fee'); ?></th>
                              <th><?php echo app('translator')->get('Status'); ?></th>
                              <th><?php echo app('translator')->get('Date'); ?></th>
                              <th></th>
                          </tr>
                          <!-- end row -->
                      </thead>
                      <tbody>

                          <?php $__empty_1 = true; $__currentLoopData = @$log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                              <tr>
                                <td><?php echo e($item->trx); ?></td>
                                <td><?php echo e($item->user->username); ?></td>
                                  <td class="break_line">
                                    <center> <img src="<?php echo e(url('/')); ?>/assets/images/provider/<?php echo e($item->product_name); ?>.jpeg" class="rounded-circle" alt="..." width="56"
                                        height="56">
                                    </center></td>
                                  <td class="break_line">
                                      <?php echo e(__($item->val_2)); ?></td>
                                      <td><?php echo e($general->cur_sym); ?><?php echo e(number_format($item->price, 2)); ?></td>
                                      <td><?php echo e($general->cur_sym); ?><?php echo e(number_format($item->payment, 2)); ?></td>
                                      <td><?php echo e($general->cur_sym); ?><?php echo e(number_format($item->val_1, 2)); ?></td>
                                  <td>
                                      <div class="td-content">
                                          <?php if($item->status == 1): ?>
                                              <span
                                                  class="badge bg-success">Approved</span>
                                          <?php elseif($item->status == 0): ?>
                                              <span
                                                  class="badge bg-warning">Pending</span>
                                          <?php elseif($item->status == 2): ?>
                                              <span
                                                  class="badge bg-danger">Declined</span>
                                          <?php endif; ?>
                                      </div>
                                  </td>
                                  <td><?php echo e(showDateTime($item->created_at)); ?></td>
                                  <td>
                                    <?php if($item->status == 0): ?>
                                    <a href="<?php echo e(route('admin.bills.airtime2cash.approve',$item->trx)); ?>" class="btn btn-sm btn-success">Approve</a>
                                    <a href="<?php echo e(route('admin.bills.airtime2cash.decline',$item->trx)); ?>" class="btn btn-sm btn-danger">Decline</a>
                                    <?php endif; ?>
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
                              <th><?php echo app('translator')->get('TRX ID'); ?></th>
                              <th><?php echo app('translator')->get('Customer'); ?></th>
                              <th><?php echo app('translator')->get('Network'); ?></th>
                              <th><?php echo app('translator')->get('Code'); ?></th>
                              <th><?php echo app('translator')->get('Amount'); ?></th>
                              <th><?php echo app('translator')->get('Value'); ?></th>
                              <th><?php echo app('translator')->get('Fee'); ?></th>
                              <th><?php echo app('translator')->get('Status'); ?></th>
                              <th><?php echo app('translator')->get('Date'); ?></th>
                              <th></th>
                          </tr>
                      </tfoot>
                  </table>
              </div>
              <div class="card-footer">
                  <?php if($log->hasPages()): ?>
                      <div class="card-footer">
                          <?php echo e(paginateLinks($log)); ?>

                      </div>
                  <?php endif; ?>
              </div>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/bills/airtime2cash/airtime_cash_log.blade.php ENDPATH**/ ?>