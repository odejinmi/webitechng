<?php $__env->startSection('content'); ?>
<!--end::Authentication - Password Reset-->
<?php
$passwordContent = getContent('password.content', true);
?>
<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!--begin::Aside-->
    <div class="d-flex flex-lg-row-fluid">
        <!--begin::Content-->
        <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
            <!--begin::Image-->
            <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                src="<?php echo e(getImage('assets/images/frontend/password/' . @$passwordContent->data_values->image, '630x540')); ?>"
                alt="" />
            <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                src="<?php echo e(getImage('assets/images/frontend/password/' . @$passwordContent->data_values->image, '630x540')); ?>"
                alt="" />
            <!--end::Image-->
            <!--begin::Title-->
            <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">
                <?php echo e(__(@$passwordContent->data_values->heading)); ?>

            </h1>
            <!--end::Title-->

            <!--begin::Text-->
            <div class="text-gray-600 fs-base text-center fw-semibold">
                <?php echo e(__(@$passwordContent->data_values->sub_heading)); ?>

            </div>
            <!--end::Text-->
        </div>
        <!--end::Content-->
    </div>
    <!--begin::Aside-->

    <!--begin::Body-->
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
        <!--begin::Wrapper-->
        <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                <!--begin::Wrapper-->
                <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">

                    <!--begin::Form-->
                   <!--begin::Form-->
                   <form class="form w-100 verify-gcaptcha"  data-kt-redirect-url="<?php echo e(route('user.home')); ?>"  class="form w-100" novalidate="novalidate" id="kt_password_reset_form" method="POST"
                   action="<?php echo e(route('user.password.update')); ?>">
                   <?php echo csrf_field(); ?> 

                   <input type="hidden" name="email" value="<?php echo e($email); ?>">
                   <input type="hidden" name="token" value="<?php echo e($token); ?>">
                   <div class="text-center mb-10">
                       <img alt="Logo" class="mh-125px" src="<?php echo e(asset('assets/thirdparty/media/svg/misc/smartphone-2.svg')); ?>"/>
                   </div>
                       <!--begin::Heading-->
                       <div class="text-center mb-11">
                           <!--begin::Title-->
                           <h1 class="text-dark fw-bolder mb-3">
                               <?php echo app('translator')->get('Reset Password'); ?>
                           </h1>
                           <!--end::Title-->

                           <!--begin::Subtitle-->
                           <div class="text-gray-500 fw-semibold fs-6">
                              <?php echo app('translator')->get('Fill the form below to reset password'); ?>
                           </div>
                           <!--end::Subtitle--->
                       </div>
                       <!--begin::Heading-->  

                       <!--begin::Input group--->
                       <div class="fv-row mb-8">
                           <!--begin::Password-->
                           <label class="form-label">Enter New Password</label>
                           <input type="password" class="form-control bg-transparent" name="password"
                                placeholder="<?php echo app('translator')->get('Password'); ?>" required>
                            <?php if($general->secure_password): ?>
                                <div class="input-popup">
                                    <p class="error lower"><?php echo app('translator')->get('1 small letter minimum'); ?></p>
                                    <p class="error capital"><?php echo app('translator')->get('1 capital letter minimum'); ?></p>
                                    <p class="error number"><?php echo app('translator')->get('1 number minimum'); ?></p>
                                    <p class="error special"><?php echo app('translator')->get('1 special character minimum'); ?></p>
                                    <p class="error minimum"><?php echo app('translator')->get('6 character password'); ?></p>
                                </div>
                            <?php endif; ?>
                           <!--end::Password-->
                       </div> 
                       <br>
                       <div class="fv-row mb-8">
                        <!--begin::Password-->
                        <label class="form-label">Confirm New Password</label>

                        <input type="password" class="form-control bg-transparent" name="password_confirmation"
                             placeholder="<?php echo app('translator')->get('Confirm Password'); ?>" required> 
                        <!--end::Password-->
                    </div> 

                       <!--begin::Submit button-->
                       <div class="d-grid mb-10">
                           <button type="submit" class="btn btn-primary">

                               <!--begin::Indicator label-->
                               <span class="indicator-label">
                                   <?php echo app('translator')->get('Proceed'); ?></span>
                               <!--end::Indicator label--> 
                            </button>
                       </div>
                       <!--end::Submit button-->
 
                   </form>
                   <!--end::Form-->

                </div>
                <!--end::Wrapper--> 
            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Body-->
</div>
<!--end::Authentication - Password Reset-->
 
<?php $__env->stopSection(); ?>
 

<?php if($general->secure_password): ?>
    <?php $__env->startPush('script-lib'); ?>
        <script src="<?php echo e(asset('assets/global/js/secure_password.js')); ?>"></script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php echo $__env->make($activeTemplate . 'layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/auth/passwords/reset.blade.php ENDPATH**/ ?>