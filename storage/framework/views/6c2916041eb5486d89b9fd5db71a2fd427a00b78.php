<?php $__env->startSection('panel'); ?>
<?php $__env->startPush('style'); ?>

<?php $__env->stopPush(); ?>
<div class="row justify-content-center">
    <?php if(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.method') || request()->routeIs('admin.users.withdrawals') || request()->routeIs('admin.users.withdrawals.method')): ?>
    <div class="col-lg-4 col-md-6">
        <div class="card border-top border-success">
          <div class="card-body">
            <div class="d-flex no-block align-items-center">
              <div>
                <h2 class="fs-7"><?php echo e(__($general->cur_sym)); ?><?php echo e($withdrawals->where('status',1)->sum('amount')); ?></h2>
                <h6 class="fw-medium text-success mb-0"><?php echo app('translator')->get('Approved Withdrawal'); ?></h6>
              </div>
              <div class="ms-auto">
                <span class="text-success display-6"><i class="ti ti-check"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card border-top border-warning">
          <div class="card-body">
            <div class="d-flex no-block align-items-center">
              <div>
                <h2 class="fs-7"><?php echo e(__($general->cur_sym)); ?><?php echo e($withdrawals->where('status',2)->sum('amount')); ?></h2>
                <h6 class="fw-medium text-warning mb-0"><?php echo app('translator')->get('Pending Withdrawal'); ?></h6>
              </div>
              <div class="ms-auto">
                <span class="text-warning display-6"><i class="ti ti-loader"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card border-top border-danger">
          <div class="card-body">
            <div class="d-flex no-block align-items-center">
              <div>
                <h2 class="fs-7"><?php echo e(__($general->cur_sym)); ?><?php echo e($withdrawals->where('status',3)->sum('amount')); ?></h2>
                <h6 class="fw-medium text-danger mb-0"><?php echo app('translator')->get('Rejected Withdrawals'); ?></h6>
              </div>
              <div class="ms-auto">
                <span class="text-danger display-6"><i class="ti ti-x"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    <?php endif; ?>
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">

                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('Gateway | Trx'); ?></th>
                                <th><?php echo app('translator')->get('Initiated'); ?></th>
                                <th><?php echo app('translator')->get('User'); ?></th>
                                <th><?php echo app('translator')->get('Amount'); ?></th>
                                <th><?php echo app('translator')->get('Conversion'); ?></th>
                                <th><?php echo app('translator')->get('Status'); ?></th>
                                <th><?php echo app('translator')->get('Action'); ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                            $details = ($withdraw->withdraw_information != null) ? json_encode($withdraw->withdraw_information) : null;
                            ?>
                            <tr>
                                <td data-label="<?php echo app('translator')->get('Gateway | Trx'); ?>">
                                    <span class="font-weight-bold"><a href="<?php echo e(route('admin.withdraw.method',[$withdraw->method->id,'all'])); ?>"> <?php echo e(__(@$withdraw->method->name)); ?></a></span>
                                    <br>
                                    <small><?php echo e($withdraw->trx); ?></small>
                                </td>
                                <td data-label="<?php echo app('translator')->get('Initiated'); ?>">
                                    <?php echo e(showDateTime($withdraw->created_at)); ?> <br>  <?php echo e(diffForHumans($withdraw->created_at)); ?>

                                </td>

                                <td data-label="<?php echo app('translator')->get('User'); ?>">
                                    <span class="font-weight-bold"><?php echo e($withdraw->user->fullname); ?></span>
                                    <br>
                                    <span class="small"> <a href="<?php echo e(route('admin.users.detail', $withdraw->user_id)); ?>"><span>@</span><?php echo e($withdraw->user->username); ?></a> </span>
                                </td>


                                <td data-label="<?php echo app('translator')->get('Amount'); ?>">
                                   <?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($withdraw->amount )); ?> - <span class="text-danger" data-toggle="tooltip" data-original-title="<?php echo app('translator')->get('charge'); ?>"><?php echo e(showAmount($withdraw->charge)); ?> </span>
                                    <br>
                                    <strong data-toggle="tooltip" data-original-title="<?php echo app('translator')->get('Amount after charge'); ?>">
                                    <?php echo e(showAmount($withdraw->amount-$withdraw->charge)); ?> <?php echo e(__($general->cur_text)); ?>

                                    </strong>

                                </td>

                                <td data-label="<?php echo app('translator')->get('Conversion'); ?>">
                                   1 <?php echo e(__($general->cur_text)); ?> =  <?php echo e(showAmount($withdraw->rate)); ?> <?php echo e(__($withdraw->currency)); ?>

                                    <br>
                                    <strong><?php echo e(showAmount($withdraw->final_amount)); ?> <?php echo e(__($withdraw->currency)); ?></strong>
                                </td>



                                <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                    <?php if($withdraw->status == 2): ?>
                                    <span class="text--small badge font-weight-normal bg-warning"><?php echo app('translator')->get('Pending'); ?></span>
                                    <?php elseif($withdraw->status == 1): ?>
                                    <span class="text--small badge font-weight-normal bg-success"><?php echo app('translator')->get('Approved'); ?></span>
                                    <br><?php echo e(diffForHumans($withdraw->updated_at)); ?>

                                    <?php elseif($withdraw->status == 3): ?>
                                    <span class="text--small badge font-weight-normal bg-danger"><?php echo app('translator')->get('Rejected'); ?></span>
                                    <br><?php echo e(diffForHumans($withdraw->updated_at)); ?>

                                    <?php endif; ?>
                                </td>
                                <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                    <a href="<?php echo e(route('admin.withdraw.details', $withdraw->id)); ?>" class="btn btn-outline-primary ml-1 " data-toggle="tooltip" data-original-title="<?php echo app('translator')->get('Detail'); ?>">
                                       <?php echo app('translator')->get('Details'); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                          <td class="text-muted text-center" colspan="100%"><?php echo alert('danger',$emptyMessage); ?></td>
                        </tr>
                        <?php endif; ?>

                    </tbody>
                </table><!-- table end -->
            </div>
        </div>

        <div class="card-footer py-4">
            <?php echo e(paginateLinks($withdrawals)); ?>

        </div>
    </div><!-- card end -->
</div>
</div>

<?php $__env->stopSection(); ?>




<?php $__env->startPush('breadcrumb-plugins'); ?>

    <?php if(!request()->routeIs('admin.users.withdrawals') && !request()->routeIs('admin.users.withdrawals.method')): ?>

    <form action="<?php echo e(route('admin.withdraw.search', $scope ?? str_replace('admin.withdraw.', '', request()->route()->getName()))); ?>" method="GET" class="form-inline float-sm-right bg--white mb-2 ml-0 ml-xl-2 ml-lg-0">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('Trx number/Username'); ?>" value="<?php echo e($search ?? ''); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
    <form action="<?php echo e(route('admin.withdraw.dateSearch',$scope ?? str_replace('admin.withdraw.', '', request()->route()->getName()))); ?>" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input name="date" type="text" data-range="true" data-multiple-dates-separator=" - " data-language="en" class="datepicker-here form-control" data-position='bottom right' placeholder="<?php echo app('translator')->get('Min Date - Max date'); ?>" autocomplete="off" value="<?php echo e(@$dateSearch); ?>">
            <input type="hidden" name="method" value="<?php echo e(@$method->id); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/thirdparty/css/vendor/datepicker.min.css')); ?>">
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script-lib'); ?>
    <script src="<?php echo e(asset('assets/thirdparty/js/vendor/datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/thirdparty/js/vendor/datepicker.en.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            if (!$('.datepicker-here').val()) {
                $('.datepicker-here').datepicker();
            }
        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/withdraw/withdrawals.blade.php ENDPATH**/ ?>