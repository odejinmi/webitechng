<?php $__env->startSection('panel'); ?>
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3><?php echo e($pageTitle); ?></h3>
                <a href="<?php echo e(route('user.rnd.purchases.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Buy RND
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
                                        <th>RND Amount</th>
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
                                            <td><?php echo e(number_format($purchase->rnd_amount, 8)); ?> RND</td>
                                            <td><?php echo e(number_format($purchase->exchange_rate, 2)); ?></td>
                                            <td><?php echo e(number_format($purchase->total_amount, 8)); ?></td>
                                            <td><?php echo e($purchase->vendor_name); ?></td>
                                            <td><?php echo $purchase->status_badge; ?></td>
                                            <td><?php echo e(showDateTime($purchase->created_at)); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('user.rnd.purchases.show', $purchase)); ?>"
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <?php if($purchase->receipt): ?>
                                                    <a href="<?php echo e(route('user.rnd.purchases.download.receipt', $purchase)); ?>"
                                                       class="btn btn-sm btn-success">
                                                        <i class="fas fa-download"></i> Receipt
                                                    </a>
                                                <?php endif; ?>
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
                            <h4>No RND Purchase Requests</h4>
                            <p class="text-muted">You haven't made any RND purchase requests yet.</p>
                            <a href="<?php echo e(route('user.rnd.purchases.create')); ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Buy RND
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PhpstormProjects\webitechng\resources\views/user/rnd_purchases/index.blade.php ENDPATH**/ ?>