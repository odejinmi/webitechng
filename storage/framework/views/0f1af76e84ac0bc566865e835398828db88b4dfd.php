
<?php $__env->startSection('panel'); ?>

<div class="product-list">
    <div class="card">
      <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center mb-9">
          <form class="position-relative">
            <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
              placeholder="Search Product">
            <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
          </form>
          <a class="fs-6 text-muted" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
            data-bs-title="Filter list"><i class="ti ti-filter"></i></a>
        </div>
        <div class="table-responsive border rounded">
          <table class="table align-middle text-nowrap mb-0">
            <thead>
              <tr>
              
                <th scope="col">City</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">ID</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $__empty_1 = true; $__currentLoopData = $citys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                
                <td>
                  <div class="d-flex align-items-center">
                    <img src="<?php echo e(getImage(imagePath()['city']['path'].'/'. $city->image,imagePath()['city']['size'])); ?>" class="rounded-circle" alt="..." width="56"
                      height="56">
                    <div class="ms-3">
                      <h6 class="fw-semibold mb-0 fs-4"><?php echo e($city->name); ?></h6>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="mb-0"><?php echo e($city->created_at); ?></p>
                </td>
                <td>
                    <?php if($city->status == 1): ?>
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
                  <h6 class="mb-0 fs-4"><?php echo e($city->id); ?></h6>
                </td>
                <td>
                  <?php $hasPermission = App\Models\Role::hasPermission(['admin.city.update'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <a class="fs-6 text-muted updateCity" href="javascript:void(0)" data-bs-toggle="tooltip"
                    data-id="<?php echo e($city->id); ?>"
                    data-name="<?php echo e($city->name); ?>"
                    data-status ="<?php echo e($city->status); ?>"
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
  
   
    <div id="cityModel" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Add City'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.city.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Name'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="<?php echo app('translator')->get("Enter Name"); ?>"  maxlength="80" required="">
                        </div>

                        <div class="form-group mb-3">
                            <label for="symbol" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Image'); ?></label>
                            <div class="custom-file">
                              <input type="file" name="image" class="form-control" id="customFileLangHTML">
                             </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Status'); ?> </label>
                            <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                data-toggle="toggle" data-on="<?php echo app('translator')->get('Enable'); ?>" data-off="<?php echo app('translator')->get('Disable'); ?>" name="status">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-paper-plane"></i><?php echo app('translator')->get('Create'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="updateCityModel" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Update City'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.city.update')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Name'); ?></label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="<?php echo app('translator')->get("Enter Name"); ?>"  maxlength="80" required="">
                        </div>

                        <div class="form-group mb-3">
                            <label for="symbol" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Image'); ?></label>
                            <div class="custom-file">
                              <input type="file" name="image" class="form-control" id="customFileLangHTML">
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
    <a href="javascript:void(0)" class="btn btn-sm btn-primary box--shadow1 text--small addCity" ><i class="fa fa-fw fa-paper-plane"></i><?php echo app('translator')->get('Add City'); ?></a>
<?php endif ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
    "use strict";
    $('.addCity').on('click', function() {
        $('#cityModel').modal('show');
    });
    
    $('.updateCity').on('click', function() {
        $('#updateCityModel').modal('show');

        var modal = $('#updateCityModel');''
        modal.find('input[name=id]').val($(this).data('id'));
        modal.find('input[name=name]').val($(this).data('name'));
        var data = $(this).data('status');
        if(data == 1){
            modal.find('input[name=status]').bootstrapToggle('on');
        }else{
            modal.find('input[name=status]').bootstrapToggle('off');
        }
        modal.modal('show');
    });

    $(document).on("change",".custom-file-input",function(){
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/city/index.blade.php ENDPATH**/ ?>