<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('SL'); ?></th>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($categories->firstItem() + $loop->index); ?></td>
                                        <td><?php echo e(__($category->name)); ?></td>
                                        <td>
                                            <?php
                                                echo $category->statusBadge;
                                            ?>
                                        </td>
                                        <td>
                                            <?php $hasPermission = App\Models\Role::hasPermission(['admin.category.store*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                                            <button type="button" class="btn btn-sm btn-primary cuModalBtn" data-resource="<?php echo e($category); ?>" data-modal_title="<?php echo app('translator')->get('Update Category'); ?>">
                                                <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                            </button>
                                            <?php endif ?>
                                            
                                            <?php if($category->status == Status::DISABLE): ?>
                                            <?php $hasPermission = App\Models\Role::hasPermission(['admin.category.status*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                <button type="button" class="btn btn-sm btn-success confirmationBtn" data-action="<?php echo e(route('admin.category.status', $category->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to enable this category?'); ?>">
                                                    <i class="la la-eye"></i><?php echo app('translator')->get('Enable'); ?>
                                                </button>
                                            <?php endif ?>
                                            <?php $hasPermission = App\Models\Role::hasPermission(['admin.category.delete'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                <button type="button" class="btn btn-sm btn-danger confirmationBtn" data-action="<?php echo e(route('admin.category.delete', $category->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to delete this category?'); ?>">
                                                    <i class="la la-eye-slash"></i><?php echo app('translator')->get('Delete'); ?>
                                                </button>
                                            <?php endif ?>
                                            <?php else: ?>
                                            <?php $hasPermission = App\Models\Role::hasPermission(['admin.category.status*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                <button type="button" class="btn btn-sm btn-warning confirmationBtn" data-action="<?php echo e(route('admin.category.status', $category->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to disable this category?'); ?>">
                                                    <i class="la la-eye-slash"></i><?php echo app('translator')->get('Disable'); ?>
                                                </button>
                                            <?php endif ?>
                                            <?php endif; ?> 
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
                <?php if($categories->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo e(paginateLinks($categories)); ?>

                    </div>
                <?php endif; ?>
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
                <form action="<?php echo e(route('admin.category.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Name'); ?></label>
                            <input type="text" class="form-control" name="name">
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
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php $hasPermission = App\Models\Role::hasPermission(['admin.category.store*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
    <button type="button" class="btn btn-sm btn-primary me-2 h-45 cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add New'); ?>">
        <i class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?>
    </button>
    <?php endif ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/category/index.blade.php ENDPATH**/ ?>