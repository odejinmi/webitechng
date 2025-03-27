<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12 ">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Escrow Number'); ?></th>
                                    <th><?php echo app('translator')->get('Title'); ?></th>
                                    <th><?php echo app('translator')->get('Buyer'); ?></th>
                                    <th><?php echo app('translator')->get('Seller'); ?></th>
                                    <th><?php echo app('translator')->get('Amount'); ?></th>
                                    <th><?php echo app('translator')->get('Type'); ?></th>
                                    <th><?php echo app('translator')->get('Charge'); ?></th>
                                    <th><?php echo app('translator')->get('Charge Payer'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $__empty_1 = true; $__currentLoopData = $escrows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $escrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>

                                        <td><?php echo e($escrow->escrow_number); ?></td>
                                        <td><?php echo e(__($escrow->title)); ?></td>
                                        <td>
                                            <?php if($escrow->buyer): ?>
                                                <span class="fw-bold d-block"><?php echo e(__(@$escrow->buyer->fullname)); ?></span>

                                                <span class="small">
                                                    <a href="<?php echo e(route('admin.users.detail', $escrow->buyer->id)); ?>">
                                                        <span>@</span><?php echo e(__(@$escrow->buyer->username)); ?>

                                                    </a>
                                                </span>
                                            <?php else: ?>
                                                <?php echo e($escrow->invitation_mail); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($escrow->seller): ?>
                                                <span class="fw-bold d-block"><?php echo e(__($escrow->seller->fullname)); ?></span>
                                                <span class="small">
                                                    <a href="<?php echo e(route('admin.users.detail', $escrow->seller->id)); ?>">
                                                        <span>@</span><?php echo e(__($escrow->seller->username)); ?>

                                                    </a>
                                                </span>
                                            <?php else: ?>
                                                <?php echo e($escrow->invitation_mail); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($general->cur_sym); ?><?php echo e(showAmount($escrow->amount)); ?></td>
                                        <td><?php echo e($escrow->category->name); ?></td>
                                        <td><?php echo e($general->cur_sym); ?><?php echo e(showAmount($escrow->charge)); ?></td>
                                        <td>
                                            <?php if($escrow->charge_payer == Status::CHARGE_PAYER_SELLER): ?>
                                                <span class="badge bg-primary"><?php echo app('translator')->get('Seller'); ?></span>
                                            <?php elseif($escrow->charge_payer == Status::CHARGE_PAYER_BUYER): ?>
                                                <span class="badge bg-dark"><?php echo app('translator')->get('Buyer'); ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-success"><?php echo app('translator')->get('50%-50%'); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo $escrow->escrowStatus ?>
                                        </td>
                                        <td>
                                            <?php $hasPermission = App\Models\Role::hasPermission(['admin.escrow.details*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                                            <a href="<?php echo e(route('admin.escrow.details', $escrow->id)); ?>" class="btn btn-sm btn-outline--primary">
                                                <i class="las la-desktop"></i> <?php echo app('translator')->get('Details'); ?>
                                            </a>
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

                <?php if($escrows->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo e(paginateLinks($escrows)); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Title / Category name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Title / Category name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/escrow/index.blade.php ENDPATH**/ ?>