
<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $event_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eventtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td data-label="<?php echo app('translator')->get('Name'); ?>">
                                        <?php echo e(__($eventtype->name)); ?>

                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                        <?php if($eventtype->status == 1): ?>
                                            <span class="badge bg-success"><?php echo app('translator')->get('Enable'); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-danger"><?php echo app('translator')->get('Disable'); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                        <?php $hasPermission = App\Models\Role::hasPermission(['admin.event.type.update'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary ml-1 updateProperty"
                                            data-id="<?php echo e($eventtype->id); ?>"
                                            data-name="<?php echo e($eventtype->name); ?>"
                                            data-status ="<?php echo e($eventtype->status); ?>"
                                        ><i class="ti ti-edit"></i></a>
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
                <div class="card-footer py-4">
                    <?php echo e(paginateLinks($event_type)); ?>

                </div>
            </div>
        </div>
    </div>

    <div id="propertyModel" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Add Event Type'); ?></h5>
                     
                </div>
                <form action="<?php echo e(route('admin.event.type.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Name'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="<?php echo app('translator')->get("Enter Name"); ?>"  maxlength="80" required="">
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

    <div id="updatePropertyModel" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Update Event Type'); ?></h5>
                    
                </div>
                <form action="<?php echo e(route('admin.event.type.update')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Name'); ?></label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="<?php echo app('translator')->get("Enter Name"); ?>"  maxlength="80" required="">
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
<?php $hasPermission = App\Models\Role::hasPermission(['admin.event.type.store'])  ? 1 : 0;
            if($hasPermission == 1): ?>
    <a href="javascript:void(0)" class="btn btn-sm btn-primary box--shadow1 text--small addProperty" ><i class="fa fa-fw fa-paper-plane"></i><?php echo app('translator')->get('Add Event Type'); ?></a>
<?php endif ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
    "use strict";
    $('.addProperty').on('click', function() {
        $('#propertyModel').modal('show');
    });
    
    $('.updateProperty').on('click', function() {
        $('#updatePropertyModel').modal('show');

        var modal = $('#updatePropertyModel');
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
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/event/type.blade.php ENDPATH**/ ?>