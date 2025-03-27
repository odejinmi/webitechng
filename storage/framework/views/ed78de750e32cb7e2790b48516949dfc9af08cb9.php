<?php $__env->startSection('panel'); ?>
    <div class="body-wrappser">

        <div class="product-list">
            <div class="card">
                <div class="card-body p-3">
                    <div class="table-responsive border rounded">
                        <table class="table align-middle text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                        </div>
                                    </th>
                                    <th scope="col">Products</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Types</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $type = App\Models\Giftcardtype::whereCardId($data->id)->count();
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="<?php echo e(asset('assets/images/giftcards')); ?>/<?php echo e($data->image); ?>"
                                                    class="rounded-circle" alt="..." width="56" height="56">
                                                <div class="ms-3">
                                                    <h6 class="fw-semibold mb-0 fs-4"><?php echo e($data->name); ?></h6>
                                                    <p class="mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if($data->status == 1): ?>
                                                    <span class="text-bg-success p-1 rounded-circle"></span>
                                                    <p class="mb-0 ms-2">Active</p>
                                                <?php else: ?>
                                                    <span class="text-bg-danger p-1 rounded-circle"></span>
                                                    <p class="mb-0 ms-2">Inactive</p>
                                                <?php endif; ?>

                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0 fs-4"><?php echo e($type); ?></h6>
                                        </td>
                                        <td>
                                             <div class="btn-group mb-2">
                                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.editcardType')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                    <li><a class="dropdown-item"
                                                            href="<?php echo e(route('admin.editcardType', $data->id)); ?>"><?php echo app('translator')->get('Manage'); ?></a>
                                                    </li>
                                                    <hr>
                                                    <?php endif ?>

                                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.editcard')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                    <li><a class="dropdown-item"
                                                        href="<?php echo e(route('admin.editcard', $data->id)); ?>"><?php echo app('translator')->get('Edit'); ?></a>
                                                    </li>
                                                    <?php endif ?>
                                                    <?php if($data->status != 1): ?>
                                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.activatecard')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="<?php echo e(route('admin.activatecard', $data->id)); ?>"><?php echo app('translator')->get('Activate'); ?></a>
                                                        </li>
                                                    <?php endif ?>
                                                    <?php else: ?>
                                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.deactivatecard')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="<?php echo e(route('admin.deactivatecard', $data->id)); ?>"><?php echo app('translator')->get('Deactivate'); ?></a>
                                                        </li>
                                                    <?php endif ?>
                                                    <?php endif; ?>
                                                    <?php $hasPermission = App\Models\Role::hasPermission('admin.deletecard')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="<?php echo e(route('admin.deletecard', $data->id)); ?>"><?php echo app('translator')->get('Delete'); ?></a>
                                                    </li>
                                                    <?php endif ?>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>

    <div class="modal fade" id="createcard" tabindex="-1" aria-labelledby="bs-example-modal-lg" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Extra Large modal
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form role="form" method="POST" action="<?php echo e(route('admin.storecard')); ?>" name="editForm"
                    enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-body">
                        <div class="form-group col-md-12 mb-4">
                            <label class="input-item-label text-exlight">Giftcard Name:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Currency  Name"
                                    value="<?php echo e(old('name')); ?>" name="name">

                            </div>

                        </div>
                        <div class="form-group col-md-12 mb-4">
                            <label class="input-item-label text-exlight"> Giftcard Image:</label>
                            <input type="file" class="form-control" name="photo">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button"
                            class="btn bg-danger-subtle text-danger font-medium waves-effect text-start"
                            data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Create Giftcard</button>
                    </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php $__env->stopSection(); ?>


    <?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php $hasPermission = App\Models\Role::hasPermission('admin.storecard')  ? 1 : 0;
            if($hasPermission == 1): ?>
        <a class="btn btn-sm btn-primary" href="#" data-bs-toggle="modal"
            data-bs-target="#createcard"><?php echo app('translator')->get('Add New Giftcard'); ?></a>
    <?php endif ?>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/giftcard/index.blade.php ENDPATH**/ ?>