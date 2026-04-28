<?php $__env->startSection('title', $pageTitle); ?>

<?php $__env->startSection('panel'); ?>
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3><?php echo e($pageTitle); ?></h3>
                <a href="<?php echo e(route('user.rnd.purchases.index')); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Purchase Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Request ID:</strong> #<?php echo e($purchase->id); ?></p>
                            <p><strong>RND Amount:</strong> <?php echo e(number_format($purchase->rnd_amount, 8)); ?> RND</p>
                            <p><strong>Exchange Rate:</strong> <?php echo e(number_format($purchase->exchange_rate, 2)); ?></p>
                            <p><strong>Total Amount:</strong> <?php echo e(number_format($purchase->total_amount, 8)); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Vendor Name:</strong> <?php echo e($purchase->vendor_name); ?></p>
                            <p><strong>Status:</strong> <?php echo $purchase->status_badge; ?></p>
                            <p><strong>Created:</strong> <?php echo e(showDateTime($purchase->created_at)); ?></p>
                            <p><strong>Updated:</strong> <?php echo e(showDateTime($purchase->updated_at)); ?></p>
                        </div>
                    </div>

                    <?php if($purchase->vendor_payment_details): ?>
                        <div class="mt-3">
                            <p><strong>Vendor Payment Details:</strong></p>
                            <div class="bg-light p-3 rounded">
                                <?php echo e($purchase->vendor_payment_details); ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($purchase->admin_note): ?>
                        <div class="mt-3">
                            <p><strong>Admin Note:</strong></p>
                            <div class="bg-light p-3 rounded">
                                <?php echo e($purchase->admin_note); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Documents</h5>
                </div>
                <div class="card-body">
                    <?php if($purchase->payment_proof): ?>
                        <div class="mb-3">
                            <p><strong>Payment Proof:</strong></p>
                            <img src="<?php echo e(getFile('rnd_payment_proof', $purchase->payment_proof)); ?>"
                                 alt="Payment Proof"
                                 class="img-fluid rounded"
                                 style="max-height: 200px; cursor: pointer;"
                                 onclick="window.open(this.src, '_blank')">
                        </div>
                    <?php endif; ?>

                    <?php if($purchase->receipt): ?>
                        <div class="mb-3">
                            <p><strong>Receipt:</strong></p>
                            <img src="<?php echo e(getFile('rnd_receipt', $purchase->receipt)); ?>"
                                 alt="Receipt"
                                 class="img-fluid rounded"
                                 style="max-height: 200px; cursor: pointer;"
                                 onclick="window.open(this.src, '_blank')">
                            <br>
                            <a href="<?php echo e(route('user.rnd.purchases.download.receipt', $purchase)); ?>"
                               class="btn btn-sm btn-success mt-2">
                                <i class="fas fa-download"></i> Download Receipt
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Status Flow</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Processing</span>
                        <i class="fas <?php echo e($purchase->status == 'processing' ? 'fa-check-circle text-success' : 'fa-circle text-muted'); ?>"></i>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Pending Approval</span>
                        <i class="fas <?php echo e(in_array($purchase->status, ['pending', 'approved']) ? 'fa-check-circle text-success' : 'fa-circle text-muted'); ?>"></i>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span><?php echo e($purchase->status == 'approved' ? 'Approved' : ($purchase->status == 'declined' ? 'Declined' : 'Completed')); ?></span>
                        <i class="fas <?php echo e(in_array($purchase->status, ['approved', 'declined']) ? 'fa-check-circle text-' . ($purchase->status == 'approved' ? 'success' : 'danger') : 'fa-circle text-muted'); ?>"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PhpstormProjects\webitechng\resources\views/user/rnd_purchases/show.blade.php ENDPATH**/ ?>