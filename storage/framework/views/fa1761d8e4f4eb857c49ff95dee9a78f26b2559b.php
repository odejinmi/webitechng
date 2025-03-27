<?php $__env->startSection('panel'); ?>
<div class="tab-pane fsade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab" tabindex="0">
    <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
      <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center"><?php echo app('translator')->get('Downlines'); ?> <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2"><?php echo e(count($ref)); ?></span></h3>
    </div>
    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $ref; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class=" col-md-6 col-xl-4">
        <div class="card">
          <div class="card-body p-4 d-flex align-items-center gap-3">
            <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . $data->image, getFileSize('userProfile'))); ?>" alt="" class="rounded-circle" width="40" height="40">
            <div>
              <h5 class="fw-semibold mb-0"><?php echo e(@$data->username); ?></h5>
              <span class="fs-2 d-flex align-items-center"><i class="ti ti-calendar text-dark fs-3 me-1"></i><?php echo e(diffForHumans($data->created_at)); ?></span>
            </div>
           </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <?php echo emptyData2(); ?>

      <?php endif; ?>
       
    </div>
  </div>
 
   <!-- Transaction Log -->
   <div class="col-lg-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
          <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold"><?php echo app('translator')->get('Referral Earning Transaction'); ?></h5>
          </div> 
        </div>
        <div class="table-respon2sive">
          <table class="table align-middle text-nowrap mb-0">
            <thead>
              <tr class="text-muted fw-semibold">
                <th scope="col" class="ps-0"><?php echo app('translator')->get('TRX'); ?></th>
                <th scope="col"><?php echo app('translator')->get('TRX ID'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Amount'); ?></th>
                <th scope="col"><?php echo app('translator')->get('Balance'); ?></th>
              </tr>
            </thead>
            <tbody class="border-top">
                <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                <td class="ps-0">
                  <div class="d-flex align-items-center">
                    <div class="me-2 pe-1">
                      <?php if($data->trx_type == '-'): ?>
                      <div class="p-6 bg-light-danger rounded me-6 d-flex align-items-center justify-content-center">
                          <i class="ti ti-wallet-off text-danger fs-6"></i>
                        </div>
                      <?php else: ?>
                      <div class="p-6 bg-light-success rounded me-6 d-flex align-items-center justify-content-center">
                          <i class="ti ti-wallet text-success fs-6"></i>
                        </div>
                      <?php endif; ?>
                    </div>
                    <div>
                      <h6 class="fw-semibold mb-1"><?php echo e($data->remark); ?></h6>
                      <p class="fs-2 mb-0 text-muted"><?php echo e(diffForHumans($data->created_at)); ?></p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="mb-0 fs-3"><?php echo e($data->trx); ?></p>
                </td>
                <td>
                  <span class="badge fw-semibold py-1 w-85 <?php if($data->trx_type == '-'): ?> bg-light-primary text-danger <?php else: ?> bg-light-success text-success <?php endif; ?>"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($data->fee)); ?></span>
                </td>
                <td>
                  <p class="fs-3 text-dark mb-0"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($data->post_balance)); ?></p>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <?php echo emptyData(); ?>

              <?php endif; ?>
               
            </tbody>
          </table>
        </div>
        <?php if($transactions->hasPages()): ?>
                    <div class="card-footer">
                        <?php echo e($transactions->links()); ?>

                    </div>
        <?php endif; ?>
             
      </div>
    </div>
  </div>

              
                

    
<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?> 

<?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/ref.blade.php ENDPATH**/ ?>