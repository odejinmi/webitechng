<?php $__env->startSection('panel'); ?>
    <!-- File export -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-2">
                    <h5 class="mb-0"><?php echo e($pageTitle); ?></h5>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="body">
                        <div id="card-design" class="p-4 d-flex text-white flex-column mx-auto mb-4" style="max-width:300px;border-radius: .55em; background: #2a43aa;">
                            <div class="mb-4 d-flex flex-row justify-content-between">
                                <span class="h5">LTECHNG</span>
                                <span>
                                    $<?php echo e(number_format($cardDetails['balance'] ?? 0, 2)); ?>

                                </span>
                            </div>
                         <span style="font-size: 23px;">
                            <?php echo e(isset($cardDetails['card_number']) ? chunk_split($cardDetails['card_number'], 4, '  ') : 'N/A'); ?>

                        </span>
                            <div class="d-flex flex-row justify-content-between">
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row">
                                        <span class="mr-2" style="font-size:8px;"><?php echo e(__('VALID')); ?><br><?php echo e(__('TILL')); ?></span>
                                        <div class="align-self-center"><?php echo e($cardDetails['expiry'] ?? 'N/A'); ?></div>
                                    </div>
                                    <div>
                                       <?php echo e($cardDetails['card_holder_name'] ?? 'N/A'); ?>

                                    </div>
                                </div>
                                <img class="align-self-end mb-2" src="https://strowallet.com/assets/visa.png" alt="" width="15%" height="15%">
                            </div>
                        </div>
                        <div class="card">

                            <div class="body d-flex flex-column">
                                <div class="d-flex flex-row">
                                    <div>
    <p><strong><?php echo e(__('Card Number:')); ?></strong> <?php echo e($cardDetails['card_number'] ?? 'N/A'); ?></p>
    <p><strong><?php echo e(__('CVV:')); ?></strong> <?php echo e($cardDetails['cvv'] ?? 'N/A'); ?></p>
    <p><strong><?php echo e(__('Card Type:')); ?></strong> <?php echo e($cardDetails['card_type'] ?? 'N/A'); ?></p>
    <p><strong><?php echo e(__('Valid Until:')); ?></strong> <?php echo e($cardDetails['expiry'] ?? 'N/A'); ?></p>
    <p><strong><?php echo e(__('Card Brand:')); ?></strong> <?php echo e($cardDetails['card_brand'] ?? 'N/A'); ?></p>
    <p><strong><?php echo e(__('Card Status:')); ?></strong> <?php echo e($cardDetails['card_status'] ?? 'N/A'); ?></p>
    <p><strong><?php echo e(__('Reference:')); ?></strong> <?php echo e($cardDetails['reference'] ?? 'N/A'); ?></p>
    <p><strong><?php echo e(__('Street:')); ?></strong> 3401 N. Miami, Ave. Ste 230</p>
    <p><strong><?php echo e(__('State:')); ?></strong> Florida</p>
    <p><strong><?php echo e(__('City:')); ?></strong> Miami</p>
    <p><strong><?php echo e(__('Zip:')); ?></strong> 33127</p>
    <p><strong><?php echo e(__('Country:')); ?></strong> USA</p>
    <p><strong><?php echo e(__('Date of Creation:')); ?></strong> <?php echo e($cardDetails['card_created_date'] ?? 'N/A'); ?></p>
</div>

                            </div>
                            <div class="footer">


                            </div>
                        </div>
                           <?php if(session('success')): ?>
                                <div class="alert alert-success">
                                    <?php if(is_array(session('success'))): ?>
                                        <?php echo implode('<br>', session('success')); ?>

                                    <?php else: ?>
                                        <?php echo e(session('success')); ?>

                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php if(session('error')): ?>
                                <div class="alert alert-danger">
                                    <?php if(is_array(session('error'))): ?>
                                        <?php echo implode('<br>', session('error')); ?>

                                    <?php else: ?>
                                        <?php echo e(session('error')); ?>

                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <h5><strong>Fund Card</strong></h5>
                                    <form action="<?php echo e(route('user.post_fund.card', $vcards->card_id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="amount">Amount in USD </label>
                                                    <input type="number" class="form-control" id="amount" name="amount" required>
                                                    Rate #<?php echo e($general->virtualcard_usd_rate); ?> = $1
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-primary" style="margin-top:20px">Add Funds</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h6>Transaction History</h6>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Method</th>
                                                <th>Narrative</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php if(isset($cardTransactions->response->card_transactions)): ?>
                                                <?php $__currentLoopData = $cardTransactions->response->card_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e(date('Y-m-d H:i:s', strtotime($transaction->createdAt))); ?></td>
                                                        <td><?php echo e($transaction->type); ?></td>
                                                        <td><?php echo e($transaction->method); ?></td>
                                                        <td><?php echo e($transaction->narrative); ?></td>
                                                        <td>$<?php echo e(number_format(($transaction->centAmount ?? 0) / 100, 2)); ?></td>
                                                        <td><?php echo e($transaction->status); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6">No transactions found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/satoshi/user/virtual_card/detail.blade.php ENDPATH**/ ?>