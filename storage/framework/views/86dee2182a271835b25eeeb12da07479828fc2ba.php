<?php $__env->startSection('panel'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')); ?>">
<?php $__env->stopPush(); ?>
            <!-- File export -->
                      <!-- Row -->
          <div class="row">
            <!-- Column -->
            <div class="col-sm-12 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-row">
                    <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-success">
                      <i class="ti ti-credit-card fs-6"></i>
                    </div>
                    <div class="ms-3 align-self-center">
                      <h4 class="mb-0 fs-5"><?php echo app('translator')->get('Invoice Amount'); ?></h4>
                      <span class="text-muted"></span>
                    </div>
                    <div class="ms-auto align-self-center">
                      <h2 class="fs-7 mb-0"><?php echo e(showAmount($invoice->amount)); ?> <?php echo e(__($general->cur_text)); ?></h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-sm-12 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-row">
                    <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-info">
                      <i class="ti ti-credit-card fs-6"></i>
                    </div>
                    <div class="ms-3 align-self-center">
                      <h4 class="mb-0 fs-5"><?php echo app('translator')->get('Total Payment'); ?></h4>
                      <span class="text-muted"></span>
                    </div>
                    <div class="ms-auto align-self-center">
                      <h2 class="fs-7 mb-0"><?php echo e(showAmount($invoicetotal)); ?> <?php echo e(__($general->cur_text)); ?></h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Column --> 
            
 
    
                <div class="col-12"> 

                  <!-- ---------------------
                              start File export
                          ---------------- -->
                  <div class="card">
                    <div class="card-body">
                      <div>
                        <label><?php echo app('translator')->get('Invoice Link'); ?></label>
                        <div class="input-group">
                          <input type="text"id="referralURL"
                              value="<?php echo e(url('/')); ?>/user/invoice/pay/<?php echo e(($invoice->trx)); ?>" readonly
                              class="form-control" placeholder="Right Side"
                              aria-describedby="basic-addon2">
                          <button onclick="myFunction()" class="btn btn-primary" type="button">
                            <a class="ti ti-link text-white"></a>
                          </button>
                      </div>
                      <hr>
                      <div class="mb-2">
                        <h5 class="mb-0"><?php echo e($pageTitle); ?></h5>
                      </div>
                      <p class="card-subtitle mb-3">
                        <?php echo app('translator')->get('A table showing all the '); ?> <?php echo e($pageTitle); ?> <?php echo app('translator')->get('on your account. You can export transaction record'); ?>
                      </p>
                      <div class="table-responsive">
                        <table
                          id="file_export"
                          class="table border table-striped table-bordered display text-nowrap"
                        >
                          <thead>
                            <!-- start row -->
                            <tr>
                                <th><?php echo app('translator')->get('TRX'); ?></th>
                                <th><?php echo app('translator')->get('Payer'); ?></th>
                                <th class="text-center"><?php echo app('translator')->get('Date'); ?></th>
                                <th class="text-center"><?php echo app('translator')->get('Amount'); ?></th>   
                            </tr>
                            <!-- end row -->
                          </thead>
                          <tbody>
                             
                            <?php $__empty_1 = true; $__currentLoopData = @$log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                            $deposit = App\Models\Deposit::whereTrx($data->trx)->first();
                            ?>
                                    <tr>
                                      <td> 
                                          <span class=""><?php echo e(__($data->trx)); ?></span> 
                                      </td>
                                      <td> 
                                        <span class="text-primary"><?php echo app('translator')->get('Name'); ?>: <?php echo e(__(explode("|", $deposit->val_1)[0])); ?> <?php echo e(__(explode("|", $deposit->val_1)[1])); ?></span> <br>
                                        <span class="text-primary"><?php echo app('translator')->get('Email'); ?>: <?php echo e(__(explode("|", $deposit->val_1)[2])); ?></span> <br>
                                        <span class="text-primary"><?php echo app('translator')->get('Phone'); ?>: <?php echo e(__(explode("|", $deposit->val_1)[3])); ?></span> 
                                      </td>

                                        <td class="text-center">
                                            <?php echo e(showDateTime($data->created_at)); ?><br><?php echo e(diffForHumans($data->created_at)); ?>

                                        </td> 
                                        <td class="text-center"> 
                                            <strong><?php echo e(showAmount($data->amount)); ?> <?php echo e(__($general->cur_text)); ?></strong>                                        
                                        </td> 
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php echo emptyData(); ?>

                                <?php endif; ?>
                            <!-- end row -->
                            <!-- end row -->
                          </tbody>
                          <tfoot>
                            <tr>
                              <th><?php echo app('translator')->get('TRX'); ?></th>
                              <th><?php echo app('translator')->get('Payer'); ?></th>
                              <th class="text-center"><?php echo app('translator')->get('Date'); ?></th>
                              <th class="text-center"><?php echo app('translator')->get('Amount'); ?></th>  
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <?php if($log->hasPages()): ?>
                    <div class="card-footer">
                        <?php echo e($log->links()); ?>

                    </div>
                    <?php endif; ?>
                    </div>
                  </div>
                  <!-- ---------------------
                              end File export
                          ---------------- -->
  
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('user.invoice.edit',$invoice->trx)); ?>" class="btn btn-primary btn-sm"><?php echo app('translator')->get('Edit Invoice'); ?></a>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('assets/assets/dist/libs/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/assets/dist/js/datatable/datatable-advanced.init.js')); ?>"></script>
 <script>
  function myFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/
            document.execCommand("copy");
            SlimNotifierJs.notification('success', 'Invoice Link Copied');

        }
 </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/vendor/invoice/invoice_payment_log.blade.php ENDPATH**/ ?>