<?php $__env->startSection('panel'); ?>

<div class="product-list">
    <div class="card">
      <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center mb-9">
          <form class="position-relative">
            <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
              placeholder="Search Fee">
            <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
          </form>
          <a class="fs-6 text-muted" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
            data-bs-title="Filter list"><i class="ti ti-filter"></i></a>
        </div>
        <div class="table-responsive border rounded">
          <table class="table align-middle text-nowrap mb-0">
            <thead>
              <tr>
              
                <th scope="col">Network</th>
                <th scope="col">Min</th>
                <th scope="col">Max</th>
                <th scope="col">Fee</th>
                <th scope="col">Date Updated</th>
                <th scope="col">Status</th> 
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $__empty_1 = true; $__currentLoopData = $log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                
                <td>
                  <div class="d-flex align-items-center">
                    <img src="<?php echo e(url('/')); ?>/assets/images/provider/<?php echo e($data->network); ?>.jpeg" class="rounded-circle" alt="..." width="56"
                      height="56">
                    <div class="ms-3">
                      <h6 class="fw-semibold mb-0 fs-4"><?php echo e($data->name); ?></h6>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="mb-0"><?php echo e($data->min); ?></p>
                </td>
                <td>
                  <p class="mb-0"><?php echo e($data->max); ?></p>
                </td>
                <td>
                  <p class="mb-0"><?php echo e($data->fee); ?>%</p>
                </td>
                <td>
                  <p class="mb-0"><?php echo e($data->created_at); ?></p>
                </td>
                <td>
                    <?php if($data->status == 1): ?>
                    <div class="d-flex align-items-center">
                        <span class="text-bg-success p-1 rounded-circle"></span>
                        <p class="mb-0 ms-2">Active</p>
                      </div>
                    <?php else: ?>
                    <div class="d-flex align-items-center">
                        <span class="text-bg-danger p-1 rounded-circle"></span>
                        <p class="mb-0 ms-2">Inactive</p>
                      </div>
                    <?php endif; ?>
                </td> 
                <td>
                  <?php $hasPermission = App\Models\Role::hasPermission(['admin.city.update'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <a class="fs-6 text-muted updateFee" href="javascript:void(0)" data-bs-toggle="tooltip"
                    data-id="<?php echo e($data->id); ?>"
                    data-network="<?php echo e($data->network); ?>"
                    data-min="<?php echo e($data->min); ?>"
                    data-max="<?php echo e($data->max); ?>"
                    data-fee="<?php echo e($data->fee); ?>"
                    data-status ="<?php echo e($data->status); ?>"
                    data-bs-placement="top" data-bs-title="Edit"><i class="ti ti-dots-vertical"></i></a>
                  <?php endif ?>
                    
                
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                </tr>
              <?php endif; ?>
               
            </tbody>
          </table>
           
        </div>

      </div>
    </div>
  </div>
  
   
    <div id="FeeModel" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Add New Fee'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.bills.airtime2cashFees.add')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="network" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Network'); ?></label>
                            <select type="text" class="form-control form-control-lg" name="network" id="network" required="">
                              <option>airtel</option>
                              <option>glo</option>
                              <option>mtn</option>
                              <option>9mobile</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                          <label for="min" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Minimum Amount'); ?></label>
                          <div class="">
                            <input type="text" name="min" class="form-control" id="min" required>
                           </div>
                      </div>
                      <div class="form-group mb-3">
                          <label for="max" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Maximum Amount'); ?></label>
                          <div class="">
                            <input type="text" name="max" class="form-control" id="max" required>
                           </div>
                      </div>
                      <div class="form-group mb-3">
                          <label for="fee" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Fee'); ?> <b>(%)</b></label>
                          <div class="">
                            <input type="text" name="fee" class="form-control" id="fee" required>
                           </div>
                      </div>

                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-paper-plane"></i><?php echo app('translator')->get('Add Fee'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="updateFeeModel" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Update Network Fee'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.bills.airtime2cashFees.update')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="modal-body">
                       

                    <div class="form-group mb-3">
                      <label for="network" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Network'); ?></label>
                      <div class="">
                        <input type="text" disabled name="network" class="form-control" id="network">
                       </div>
                  </div><div class="form-group mb-3">
                    <label for="min" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Minimum Amount'); ?></label>
                    <div class="">
                      <input type="text" name="min" class="form-control" id="min" required>
                     </div>
                </div>
                  <div class="form-group mb-3">
                      <label for="max" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Maximum Amount'); ?></label>
                      <div class="">
                        <input type="text" name="max" class="form-control" id="max" required>
                       </div>
                  </div>
                  <div class="form-group mb-3">
                      <label for="fee" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Fee'); ?> <b>(%)</b></label>
                      <div class="">
                        <input type="text" name="fee" class="form-control" id="fee" required>
                       </div>
                  </div>
 

                        <div class="form-group mb-3">
                            <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Status'); ?> </label>
                            <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                data-toggle="toggle" data-on="<?php echo app('translator')->get('Enable'); ?>" data-off="<?php echo app('translator')->get('Disabled'); ?>" name="status">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-paper-plane"></i><?php echo app('translator')->get('Update'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<?php $hasPermission = App\Models\Role::hasPermission(['admin.city.store'])  ? 1 : 0;
            if($hasPermission == 1): ?>
    <a href="javascript:void(0)" class="btn btn-sm btn-primary box--shadow1 text--small addFee" ><i class="fa fa-fw fa-plus"></i><?php echo app('translator')->get('Add New Fee'); ?></a>
<?php endif ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
    "use strict";
    $('.addFee').on('click', function() {
        $('#FeeModel').modal('show');
    });
    
    $('.updateFee').on('click', function() {
        $('#updateFeeModel').modal('show');

        var modal = $('#updateFeeModel');''
        modal.find('input[name=id]').val($(this).data('id'));
        modal.find('input[name=network]').val($(this).data('network'));
        modal.find('input[name=min]').val($(this).data('min'));
        modal.find('input[name=max]').val($(this).data('max'));
        modal.find('input[name=fee]').val($(this).data('fee'));
        var data = $(this).data('status');
        if(data == 1){
            modal.find('input[name=status]').bootstrapToggle('on');
        }else{
            modal.find('input[name=status]').bootstrapToggle('off');
        }
        modal.modal('show');
    });
 
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/admin/bills/airtime2cash/settings.blade.php ENDPATH**/ ?>