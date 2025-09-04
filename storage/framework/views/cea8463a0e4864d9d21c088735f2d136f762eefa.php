<?php $__env->startSection('content'); ?>

<?php
      $loginContent = getContent('login.content', true);
      $policyPages = getContent('privacy_policy.element', null, false, true);
?>
<div class="row g-0 justify-content-center gradient-bottom-right start-purple middle-indigo end-pink">
        <div
            class="col-md-6 col-lg-5 col-xl-5 position-fixed start-0 top-0 vh-100 overflow-y-hidden d-none d-lg-flex flex-lg-column">
            <div class="p-12 py-xl-10 px-xl-20"><a class="d-block"
                    href="#"><img src="<?php echo e(asset($activeTemplateTrue . 'agent/img/logos/logo-light.svg')); ?>" class="h-rem-10" alt="..."></a>
                <div class="mt-16">
                    <h1 class="ls-tight fw-bolder display-6 text-white mb-5"><?php echo e(__(@$loginContent->data_values->heading)); ?>

                    </h1>
                    <p class="text-white text-opacity-75 pe-xl-24"><?php echo e(__(@$loginContent->data_values->sub_heading)); ?></p>
                </div>
            </div>
            <div class="mt-autos"><img src="<?php echo e(asset($activeTemplateTrue . 'agent/img/people/frontlady.png')); ?>" class="img-fluid rounded-top-start-4" alt="...">
            </div>
        </div>
        <div
            class="col-12 col-md-12 col-lg-7 offset-lg-5 min-vh-100 overflow-y-auto d-flex flex-column justify-content-center position-relative bg-body rounded-top-start-lg-4 border-start-lg shadow-soft-5">
            <div class="w-md-50 mx-auto px-10 px-md-0 py-10">
                <div class="mb-10"><a class="d-inline-block d-lg-none mb-10"
                        href="#"><img src="<?php echo e(asset($activeTemplateTrue . 'agent/img/logos/logo-dark.svg')); ?>" class="h-rem-10" alt="..."></a>
                    <h1 class="ls-tight fw-bolder h3">Sign in to your account</h1>
                    
                </div>
                <form class="crancy-wc__form-main  verify-gcaptcha" novalidate="novalidate" id="login_form"
                                method="POST" action="<?php echo e(route('user.login')); ?>">
                                <?php echo csrf_field(); ?>
                    <div class="mb-5"><label class="form-label" for="email">Email address</label> 
                      <input type="text" name="username" class="form-control" id="username">
                    </div>
                    <div class="mb-5">
                        <div class="d-flex justify-content-between gap-2 mb-2 align-items-center">
                            <label class="form-label mb-0" for="password">Password</label> <a href="<?php echo e(route('user.password.request')); ?>"
                                class="text-sm text-muted text-primary-hover text-underline">Forgot password?</a></div>
                        <input type="password" class="form-control" name="password" id="password" autocomplete="current-password">
                    </div>
                    <div class="mb-5">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="check_example" id="check_example">
                            <label class="form-check-label" for="check_example">Keep me logged in</label></div>
                    </div>
                    <div><button type="submit" class="btn btn-dark w-100">Sign in</button></div>
                </form>
                <div class="py-5 text-center"><span class="text-xs text-uppercase fw-semibold">or</span></div>
                <div class="row g-2"> 
                    <div class="col-sm-12"><a href="<?php echo e(route('user.register')); ?>"
                            class="btn btn-neutral w-100"><span class="icon icon-sm pe-2"><img src="<?php echo e(asset($activeTemplateTrue . 'agent/img/social/google.svg')); ?>" alt="..."> </span>Signup With Email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        "use strict";

        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML =
                    '<span style="color:red;"><?php echo app('translator')->get('Captcha field is required.'); ?></span>';
                return false;
            }
            return true;
        }

        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
        (function($) {
            $('.captcha').remove();
            $('input[name=captcha]').attr('placeholder', `<?php echo app('translator')->get('Captcha'); ?>`);
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/templates/satoshi/user/auth/login.blade.php ENDPATH**/ ?>