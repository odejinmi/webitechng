<?php $__env->startSection('content'); ?>

<?php
      $passwordContent = getContent('login.content', true);
      $policyPages = getContent('privacy_policy.element', null, false, true);
?>
<div class="row g-0 justify-content-center gradient-bottom-right start-purple middle-indigo end-pink">
        <div
            class="col-md-6 col-lg-5 col-xl-5 position-fixed start-0 top-0 vh-100 overflow-y-hidden d-none d-lg-flex flex-lg-column">
            <div class="p-12 py-xl-10 px-xl-20"><a class="d-block"
                    href="#"><img src="<?php echo e(asset( $activeTemplateTrue . 'agent/img/logos/logo-light.svg')); ?>" class="h-rem-10" alt="..."></a>
                <div class="mt-16">
                    <h1 class="ls-tight fw-bolder display-6 text-white mb-5"><?php echo e(__(@$passwordContent->data_values->heading)); ?>

                    </h1>
                    <p class="text-white text-opacity-75 pe-xl-24"><?php echo e(__(@$passwordContent->data_values->sub_heading)); ?></p>
                </div>
            </div>
            <div class="mt-autos"><img src="<?php echo e(asset( $activeTemplateTrue . 'agent/img/people/frontlady.png')); ?>" class="img-fluid rounded-top-start-4" alt="...">
            </div>
        </div>
        <div
            class="col-12 col-md-12 col-lg-7 offset-lg-5 min-vh-100 overflow-y-auto d-flex flex-column justify-content-center position-relative bg-body rounded-top-start-lg-4 border-start-lg shadow-soft-5">
            <div class="w-md-50 mx-auto px-10 px-md-0 py-10">
                <div class="mb-10"><a class="d-inline-block d-lg-none mb-10"
                        href="#"><img src="<?php echo e(asset( $activeTemplateTrue . 'agent/img/logos/logo-dark.svg')); ?>" class="h-rem-10" alt="..."></a>
                    <h1 class="ls-tight fw-bolder h3">Forgot Password</h1>

                </div>
                <form class="crancy-wc__form-main  verify-gcaptcha" novalidate="novalidate" id="login_form"
                                method="POST" action="<?php echo e(route('user.password.email')); ?>">
                                <?php echo csrf_field(); ?>
                    <div class="mb-5"><label class="form-label" for="email">Email address or Username</label>
                      <input type="text" name="value" class="form-control" id="value">
                    </div>

                    <div><button type="submit" class="btn btn-dark w-100">Proceed</button></div>
                </form>
                                <div class="py-5 text-center"><span class="text-xs text-uppercase fw-semibold"></span></div>

                <div class="row g-2">
                    <div class="col-sm-12"><a href="<?php echo e(route('user.login')); ?>"
                            class="btn btn-neutral w-100"><span class="icon icon-sm pe-2"> </span>< Back</a>
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

<?php echo $__env->make($activeTemplate . 'layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/templates/satoshi/user/auth/passwords/email.blade.php ENDPATH**/ ?>