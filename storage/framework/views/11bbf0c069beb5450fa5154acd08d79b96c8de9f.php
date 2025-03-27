
<?php $__env->startSection('panel'); ?>
 <!-- content @s
-->
<!--begin::Container-->
<div id="kt_content_container" class=" container-xxl ">
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Stepper-->
            <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">


                
                    <!--begin::Step 2-->
                    <div data-kt-stepper-element="scontent">
                        <div class="row justify-content-center gy-4">
                            <div class="col-lg-8">
                                <div class="card custom--card">
                                    <div class="card-header">
                                        <h5 class="card-title"><?php echo app('translator')->get('Confirm Payment'); ?></h5>
                                    </div>
                                    <div class="card-body ">
                                        <form action="" method="POST" class="text-centers"  enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <ul class="list-group text-center">
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <?php echo app('translator')->get('Account Type '); ?>:
                                                    <strong> <?php echo e(__($account->account->name)); ?></strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <?php echo app('translator')->get('Account Details '); ?>:
                                                    <strong> <?php echo e(__($account->account->details)); ?></strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <?php echo app('translator')->get('Account Currency '); ?>:
                                                    <strong> <?php echo e(__($account->account->currency)); ?></strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <?php echo app('translator')->get('Transaction Amount '); ?>:
                                                    <strong><?php echo e(showAmount($account->amount)); ?> <?php echo e(__($account->account->currency)); ?></strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <?php echo app('translator')->get('Transaction Fee '); ?>:
                                                    <strong> <?php echo e(__($account->account->fee)); ?>%</strong>
                                                </li>

                                                <li class="list-group-item d-flex justify-content-between">
                                                    <?php echo app('translator')->get('Transaction Rate '); ?>:
                                                    <strong>1 <?php echo e(__($account->account->currency)); ?> = <?php echo e(showAmount($account->rate)); ?>

                                                        <?php echo e(__($general->cur_text)); ?></strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <?php echo app('translator')->get('You will get '); ?>:
                                                    <strong><?php echo e(showAmount($account->pay)); ?> <?php echo e(__($general->cur_text)); ?></strong>
                                                </li>
                                            </ul>
                                            <br>
                                            <div class="alert alert-primary" role="alert">
                                                <strong>Hello - </strong> <?php echo app('translator')->get('Please make payment into the account details above and upload a proof of payment along. Our system will validate your payment and act accordingly'); ?>
                                              </div>
                                            <div class="form-group">
                                                <label class="form-label mb-3"><?php echo app('translator')->get('Upload Proof Of Payment '); ?></label>
                                                <input type="file" name="proof" class="form-control">

                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-lg btn-primary" type="button" id="submit"><?php echo app('translator')->get('Proceed'); ?>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Step 2-->



                     
            </div>
            <!--end::Stepper-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Container-->
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/vendor/request_account/confirm.blade.php ENDPATH**/ ?>