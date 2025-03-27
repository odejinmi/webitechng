<?php $__env->startSection('panel'); ?>
    <?php $__env->startPush('style'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')); ?>">
    <?php $__env->stopPush(); ?>
    <!-- File export -->
    <div class="row">
        <!-- Weekly Stats -->
        <div class="col-lg-12 d-flex align-items-strech">
          <div class="card w-100">
            <div class="card-body">
              <h5 class="card-title fw-semibold"><?php echo app('translator')->get('Card Status'); ?></h5>
              <p class="card-subtitle mb-0">
                
              </p>
              <div id="stats" class="my-4">
                <?php if($reply['data']['status'] == 'active'): ?>
                <span class="badge bg-success text-white"><?php echo e(strToUpper($reply['data']['status'])); ?></span>
                <span class="badge bg-success text-white"><?php echo e(strToUpper($reply['data']['pin'])); ?></span>
                <?php else: ?>
                <span class="badge bg-warning text-white"><?php echo e(strToUpper($reply['data']['status'])); ?></span>
                <?php endif; ?>
              </div>
              <hr>
              <div class="position-relative">
                <div
                  class="d-flex align-items-center justify-content-between mb-7"
                >
                  <div class="d-flex">
                    <div
                      class="p-6 bg-primary-subtle rounded me-6 d-flex align-items-center justify-content-center"
                    >
                      <i class="ti ti-credit-card text-primary fs-6"></i>
                    </div>
                    <div>
                      <h6 class="mb-1 fs-4 fw-semibold"><?php echo app('translator')->get('Card Pan'); ?></h6>
                      <p class="fs-3 mb-0"><?php echo e($reply['data']['pan']); ?></p>
                    </div>
                  </div> 
                </div>
                <div
                  class="d-flex align-items-center justify-content-between mb-7"
                >
                  <div class="d-flex">
                    <div
                      class="p-6 bg-success-subtle rounded me-6 d-flex align-items-center justify-content-center"
                    >
                      <i class="ti ti-calendar text-success fs-6"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fs-4 fw-semibold"><?php echo app('translator')->get('Expiry Month'); ?></h6>
                        <p class="fs-3 mb-0"><?php echo e($reply['data']['expiry_month']); ?></p>
                    </div>
                  </div> 
                </div>
                <div
                class="d-flex align-items-center justify-content-between mb-7"
                >
                  <div class="d-flex">
                    <div
                      class="p-6 bg-danger-subtle rounded me-6 d-flex align-items-center justify-content-center"
                    >
                      <i class="ti ti-calendar text-danger fs-6"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fs-4 fw-semibold"><?php echo app('translator')->get('Expiry Year'); ?></h6>
                        <p class="fs-3 mb-0"><?php echo e($reply['data']['expiry_year']); ?></p>
                    </div>
                  </div> 
                </div>
                <div
                  class="d-flex align-items-center justify-content-between"
                >
                  <div class="d-flex">
                    <div
                      class="p-6 bg-info-subtle rounded me-6 d-flex align-items-center justify-content-center"
                    >
                      <i class="ti ti-calendar text-info fs-6"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fs-4 fw-semibold"><?php echo app('translator')->get('Card CVV'); ?></h6>
                        <p class="fs-3 mb-0"><?php echo e($reply['data']['cvv']); ?></p>
                    </div>
                  </div> 
                </div>
              </div>
              <hr>
              <?php if($reply['data']['status'] != 'active'): ?>
              <a href="<?php echo e(route('admin.bills.virtualcard.status.activate',$reply['data']['id'])); ?>" class="btn btn-success btn-sm"><i class="ti ti-check"></i> <?php echo app('translator')->get('Unfreeze'); ?></a>

                <?php else: ?>

              <a href="<?php echo e(route('admin.bills.virtualcard.status.block',$reply['data']['id'])); ?>" class="btn btn-danger btn-sm"><i class="ti ti-alert-circle"></i> <?php echo app('translator')->get('Block '); ?></a>
                <a href="<?php echo e(route('admin.bills.virtualcard.status.deactivate',$reply['data']['id'])); ?>" class="btn btn-warning btn-sm"><i class="ti ti-alert-circle"></i> <?php echo app('translator')->get('Freeze'); ?></a>
              <a  data-bs-toggle="modal" data-bs-target="#pin-modal" data-bs-whatever="@getbootstrap" href="#" class="btn btn-primary btn-sm"><i class="ti ti-lock"></i> <?php echo app('translator')->get('Pin'); ?></a>
              <a  data-bs-toggle="modal" data-bs-target="#fund-modal" data-bs-whatever="@getbootstrap" href="#" class="btn btn-success btn-sm"><i class="ti ti-wallet"></i> <?php echo app('translator')->get('Fund'); ?></a>
             <?php endif; ?>
            </div>
          </div>
        </div>
        <!-- Top Performers --> 
      </div>
             

      <div class="modal fade" id="pin-modal" tabindex="-1" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
              <h4 class="modal-title" id="exampleModalLabel1">
                Update Card PIN
              </h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  class="" novalidate="novalidate" action="<?php echo e(route('admin.bills.virtualcard.status.password',$reply['data']['id'])); ?>" method="post">
                <?php echo csrf_field(); ?>
            <div class="modal-body">
                <div class="mb-3">
                  <label for="recipient-name" class="control-label">Old Card Pin:</label>
                  <input type="password" name="old_pin" class="form-control" id="old_pin" />
                </div> 
                <div class="mb-3">
                  <label for="recipient-name" class="control-label">New Card Pin:</label>
                  <input type="number" name="new_pin" class="form-control" id="new_pin" />
                </div> 

                <div class="mb-3">
                    <label for="recipient-name" class="control-label">Account Transaction Password:</label>
                    <input type="password" name="password" class="form-control" id="password" />
                  </div> 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-danger-subtle text-danger font-medium"
                data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-success">
                Change Pin
              </button>
            </div>
        </form>
          </div>
        </div>
      </div>
      
      <div class="modal fade" id="fund-modal" tabindex="-1" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
              <h4 class="modal-title" id="exampleModalLabel1">
                Fund Card Balance
              </h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  class="" novalidate="novalidate" action="<?php echo e(route('admin.bills.virtualcard.fund.balance',$reply['data']['id'])); ?>" method="post">
                <?php echo csrf_field(); ?>
            <div class="modal-body">
                <div class="mb-3">
                  <label for="recipient-name" class="control-label">Amount <small>(<?php echo e($reply['data']['currency']); ?>)</small>:</label>
                  <input type="number" name="amount" class="form-control" placeholder="0.00<?php echo e($reply['data']['currency']); ?>" id="old_pin" />
                </div> 
                 

                <div class="mb-3">
                    <label for="recipient-name" class="control-label">Account Transaction Password:</label>
                    <input type="password" name="password" class="form-control" id="password" />
                  </div> 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-danger-subtle text-danger font-medium"
                data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-success">
                Change Pin
              </button>
            </div>
        </form>
          </div>
        </div>
      </div>

        <?php $__env->stopSection(); ?>

        <?php $__env->startPush('breadcrumb-plugins'); ?>
      
        <?php $__env->stopPush(); ?>


        <?php $__env->startPush('script'); ?>

        <?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/admin/bills/virtualcard/details.blade.php ENDPATH**/ ?>