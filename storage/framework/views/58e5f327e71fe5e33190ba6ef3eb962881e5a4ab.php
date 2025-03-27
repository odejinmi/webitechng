
<?php $__env->startSection('panel'); ?>
<!-- content @s -->
<!--begin::Container-->
<div id="kt_content_container" class=" container-xxl ">
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Stepper-->
            <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-body p-4">
                          <h4 class="fw-semibold mb-3"><?php echo app('translator')->get('Account Verification'); ?></h4>
                          <form action="" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>                    
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold"><?php echo app('translator')->get('Document Type'); ?></label>
                                  <select name="type"
                                  class="select2 form-control form-control-lg"
                                  style="width: 100%; height: 36px"
                                  >
                                  <option>Select</option>
                                  <option>Voters Card</option>
                                  <option>Drivers Licence</option>
                                  <option>Work ID Card</option>
                                  <option>International Passport</option>
                                  <option>Drivers Licence</option>
                                  <option>Passport Photograph</option>
                                  <option>Address Utility Bill</option>
                                  <option>NIN Card</option>
                                </select>
                                </div>
                                 
                               
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold"><?php echo app('translator')->get('Front View'); ?>*</label>
                                  <input type="file" class="form-control" name="front"  id="front">
                                </div>
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold"><?php echo app('translator')->get('Back View'); ?>*</label>
                                  <input type="file" class="form-control" name="back" id="back">
                                </div> 
                                
                                
                              <br>
                              <div class="mb-4">
                              <button type="submit" class="mt-4 btn btn-primary"><?php echo app('translator')->get('Submit'); ?></button>
                              </div>
                              </div>
                              <?php if($user->kyc_complete == 3 || $user->kyc_complete == 1): ?>
                              <div class="col-lg-6 d-flex align-items-stretch">
                                <div class="card w-100 position-relative overflow-hidden">
                                   
                                  <div class="card-body p-4"> 
                                    
                                    <div class="text-center">
                                       <p class="mb-0"><?php echo e(@$user->kyc->type); ?></p>
                                    <?php if($user->kyc_complete == 3): ?>
                                    <badge class="badge bg-warning"><?php echo app('translator')->get('Pending'); ?></badge>
                                    <?php elseif($user->kyc_complete == 1): ?>
                                    <badge class="badge bg-success"><?php echo app('translator')->get('Approved'); ?></badge>
                                    <?php elseif($user->kyc_complete == 2): ?>
                                    <badge class="badge bg-danger"><?php echo app('translator')->get('Rejected'); ?></badge>
                                    <?php echo app('translator')->get('Please proceed to reupload file'); ?>
                                    <?php endif; ?>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                      <img src="<?php echo e(asset('assets/images/kyc')); ?>/<?php echo e($user->username); ?>/front_kyc_image.png" alt="" class="img-fluid rounded-circle" width="120" height="120">
                                       <p class="mb-0"><?php echo app('translator')->get('Front View Image'); ?></p>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <img src="<?php echo e(asset('assets/images/kyc')); ?>/<?php echo e($user->username); ?>/back_kyc_image.png" alt="" class="img-fluid rounded-circle" width="120" height="120">
                                         <p class="mb-0"><?php echo app('translator')->get('Back View Image'); ?></p>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            <?php endif; ?>
                          </form>
                        </div>
                      </div>
                    </div>
            </div>
            <!--end::Stepper-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Container-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/kyc/index.blade.php ENDPATH**/ ?>