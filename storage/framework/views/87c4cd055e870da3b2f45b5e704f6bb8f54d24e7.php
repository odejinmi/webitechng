<?php $__env->startSection('panel'); ?>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3><?php echo e($pageTitle); ?></h3>
                <a href="<?php echo e(route('admin.rnd.purchases.index')); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Requests
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Update Exchange Rate</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.rnd.exchange.rate.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="rate">Current Exchange Rate</label>
                            <div class="input-group">
                                <input type="number"
                                       step="0.00000001"
                                       min="0.00000001"
                                       class="form-control"
                                       id="rate"
                                       name="rate"
                                       value="<?php echo e($currentRate); ?>"
                                       required>
                                <div class="input-group-append">
                                    <span class="input-group-text">per RMB</span>
                                </div>
                            </div>
                            <small class="text-muted">1 RMB = <span id="rate_display"><?php echo e($currentRate); ?></span></small>
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes (Optional)</label>
                            <textarea class="form-control"
                                      id="notes"
                                      name="notes"
                                      rows="3"
                                      placeholder="Add a note about this rate change"></textarea>
                        </div>

                        <div class="alert alert-info">
                            <strong>Current Rate:</strong> 1 RMB = <?php echo e($currentRate); ?>

                            <br>
                            <small>This rate will be used for all new RMB purchase requests.</small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-sync"></i> Update Rate
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Rate Changes</h5>
                </div>
                <div class="card-body">
                    <?php if($rateHistory->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Rate</th>
                                        <th>Updated By</th>
                                        <th>Notes</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $rateHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(number_format($rate->rate, 2)); ?></td>
                                            <td>
                                                <?php if($rate->updatedBy): ?>
                                                    <?php echo e($rate->updatedBy->name); ?>

                                                <?php else: ?>
                                                    System
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($rate->notes ?? '-'); ?></td>
                                            <td><?php echo e(showDateTime($rate->created_at)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-history fa-2x text-muted mb-2"></i>
                            <p class="text-muted">No rate changes recorded yet.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(document).ready(function() {
    $('#rate').on('input', function() {
        $('#rate_display').text($(this).val());
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PhpstormProjects\webitechng\resources\views/admin/rnd_purchases/exchange_rate.blade.php ENDPATH**/ ?>