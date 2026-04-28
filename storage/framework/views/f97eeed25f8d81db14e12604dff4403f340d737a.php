<?php $__env->startSection('panel'); ?>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3><?php echo e($pageTitle); ?></h3>
                <a href="<?php echo e(route('admin.rnd.exchange.rate')); ?>" class="btn btn-info">
                    <i class="fas fa-exchange-alt"></i> Manage Exchange Rate
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php if($purchases->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>RMB Amount</th>
                                        <th>Exchange Rate</th>
                                        <th>Total Amount</th>
                                        <th>Vendor</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>#<?php echo e($purchase->id); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('admin.users.detail', $purchase->user_id)); ?>">
                                                    <?php echo e($purchase->user->fullname); ?>

                                                </a>
                                                <br>
                                                <small class="text-muted"><?php echo e($purchase->user->email); ?></small>
                                            </td>
                                            <td><?php echo e(number_format($purchase->rnd_amount, 8)); ?> RMB</td>
                                            <td><?php echo e(number_format($purchase->exchange_rate, 2)); ?></td>
                                            <td><?php echo e(number_format($purchase->total_amount, 8)); ?></td>
                                            <td><?php echo e($purchase->vendor_name); ?></td>
                                            <td><?php echo $purchase->status_badge; ?></td>
                                            <td><?php echo e(showDateTime($purchase->created_at)); ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="<?php echo e(route('admin.rnd.purchases.show', $purchase)); ?>"
                                                       class="btn btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <?php if($purchase->payment_proof): ?>
                                                        <a href="<?php echo e(route('admin.rnd.purchases.download.payment-proof', $purchase)); ?>"
                                                           class="btn btn-primary" title="Download Payment Proof">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if($purchase->receipt): ?>
                                                        <a href="<?php echo e(route('admin.rnd.purchases.download.receipt', $purchase)); ?>"
                                                           class="btn btn-success" title="Download Receipt">
                                                            <i class="fas fa-file-invoice"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            <?php echo e($purchases->links()); ?>

                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-coins fa-3x text-muted mb-3"></i>
                            <h4>No RMB Purchase Requests</h4>
                            <p class="text-muted">No RMB purchase requests have been submitted yet.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PhpstormProjects\webitechng\resources\views/admin/rnd_purchases/index.blade.php ENDPATH**/ ?>