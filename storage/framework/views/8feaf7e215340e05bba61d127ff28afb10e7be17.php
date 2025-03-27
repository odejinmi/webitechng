<?php $__env->startSection('panel'); ?>
    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo e(route('admin.charge.global')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>
                                    <?php echo app('translator')->get('Charge Cap'); ?>
                                    <code class="text-primary">(<?php echo app('translator')->get('Keep 0 for no charge cap'); ?>)</code>
                                </label>
                                <div class="input-group ">
                                    <input type="number" step="any" class="form-control" name="charge_cap" value="<?php echo e(getAmount($general->charge_cap)); ?>" required>
                                    <span class="input-group-text"><?php echo e(__($general->cur_text)); ?></span>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>
                                    <?php echo app('translator')->get('Fixed Charge'); ?>
                                    
                                </label>
                                <div class="input-group ">
                                    <input type="number" step="any" class="form-control" name="fixed_charge" value="<?php echo e(getAmount($general->fixed_charge)); ?>" required>
                                    <span class="input-group-text"><?php echo e(__($general->cur_text)); ?></span>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>
                                    <?php echo app('translator')->get('Percent Charge'); ?>
                                   
                                </label>
                                <div class="input-group ">
                                    <input type="number" step="any" class="form-control" name="percent_charge" value="<?php echo e(getAmount($general->percent_charge)); ?>" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary h-45 w-100"><?php echo app('translator')->get('Update'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('SL'); ?></th>
                                    <th><?php echo app('translator')->get('Minimum'); ?></th>
                                    <th><?php echo app('translator')->get('Maximum'); ?></th>
                                    <th><?php echo app('translator')->get('Fixed Charge'); ?></th>
                                    <th><?php echo app('translator')->get('Percent Charge'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $charges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $charge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td>
                                            <?php echo e(showAmount($charge->minimum)); ?>

                                            <?php echo e($general->cur_text); ?>

                                        </td>
                                        <td>
                                            <?php echo e(showAmount($charge->maximum)); ?>

                                            <?php echo e($general->cur_text); ?>

                                        </td>
                                        <td>
                                            <?php echo e(showAmount($charge->fixed_charge)); ?>

                                            <?php echo e($general->cur_text); ?>

                                        </td>
                                        <td>
                                            <?php echo e(showAmount($charge->percent_charge)); ?>%
                                        </td>
                                        <td>
                                            <?php $hasPermission = App\Models\Role::hasPermission(['admin.charge.store'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                                            <button type="button" class="btn btn-sm btn-primary cuModalBtn" data-resource="<?php echo e($charge); ?>" data-modal_title="<?php echo app('translator')->get('Update Charge Range'); ?>" data-has_status="1">
                                                <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                            </button>
                                            <?php endif ?>
                                            <?php $hasPermission = App\Models\Role::hasPermission(['admin.charge.remove'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                                            <button type="button" class="btn btn-sm btn-danger confirmationBtn" data-question="<?php echo app('translator')->get('Are you sure to remove this charge range?'); ?>" data-action="<?php echo e(route('admin.charge.remove', $charge->id)); ?>">
                                                <i class="las la-trash"></i>
                                                <?php echo app('translator')->get('Remove'); ?>
                                            </button>
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
    </div>

    <!-- Create Update Modal -->
    <div class="modal fade" id="cuModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.charge.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label><?php echo app('translator')->get('Minimum Amount'); ?> </label>
                            <div class="input-group ">
                                <input type="number" step="any" class="form-control" name="minimum" required>
                                <span class="input-group-text"><?php echo e(__($general->cur_text)); ?></span>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label><?php echo app('translator')->get('Maximum Amount'); ?> </label>
                            <div class="input-group ">
                                <input type="number" step="any" class="form-control" name="maximum" required>
                                <span class="input-group-text"><?php echo e(__($general->cur_text)); ?></span>

                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label><?php echo app('translator')->get('Fixed Charge'); ?> </label>
                            <div class="input-group ">
                                <input type="number" step="any" class="form-control" name="fixed_charge" required>
                                <span class="input-group-text"><?php echo e(__($general->cur_text)); ?></span>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label><?php echo app('translator')->get('Percent Charge'); ?> </label>
                            <div class="input-group ">
                                <input type="number" step="0.01" class="form-control" name="percent_charge" required>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b = $component; } ?>
<?php $component = App\View\Components\ConfirmationModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ConfirmationModal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b)): ?>
<?php $component = $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b; ?>
<?php unset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <div class="d-inline">
        <div class="input-group ">
            <input type="text" name="search_table" class="form-control bg--white" placeholder="<?php echo app('translator')->get('Search'); ?>...">
            <button class="btn btn-primary input-group-text"><i class="fa fa-search"></i></button>
        </div>
    </div>
    <!-- Modal Trigger Button -->
    <?php $hasPermission = App\Models\Role::hasPermission(['admin.charge.store'])  ? 1 : 0;
            if($hasPermission == 1): ?>
    <button type="button" class="btn btn-sm btn-primary me-2 h-45 cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add Charge Range'); ?>">
        <i class="las la-plus"></i>
        <?php echo app('translator')->get('Add New'); ?>
    </button>
    <?php endif ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/admin/escrow/charges.blade.php ENDPATH**/ ?>