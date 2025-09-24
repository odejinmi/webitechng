<?php $__env->startSection('content'); ?>

<?php
      $loginContent = getContent('login.content', true);
      $policyPages = getContent('privacy_policy.element', null, false, true);
?>
<div class="row g-0 justify-content-center gradient-bottom-right start-purple middle-indigo end-pink">
        <div
            class="col-md-6 col-lg-5 col-xl-5 position-fixed start-0 top-0 vh-100 overflow-y-hidden d-none d-lg-flex flex-lg-column">
            <div class="p-12 py-xl-10 px-xl-20"><a class="d-block"
                    href="#"><img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" class="h-rem-10" alt="..."></a>
                <div class="mt-16">
                    <h1 class="ls-tight fw-bolder display-6 text-white mb-5"><?php echo e(__(@$loginContent->data_values->heading)); ?>

                    </h1>
                    <p class="text-white text-opacity-75 pe-xl-24"><?php echo e(__(@$loginContent->data_values->sub_heading)); ?></p>
                </div>
            </div>
            <div class="mt-autos"><img src="<?php echo e(asset( $activeTemplateTrue . 'agent/img/people/frontlady.png')); ?>" class="img-fluid rounded-top-start-4" alt="...">
            </div>
        </div>
        <div
            class="col-12 col-md-12 col-lg-7 offset-lg-5 min-vh-100 overflow-y-auto d-flex flex-column justify-content-center position-relative bg-body rounded-top-start-lg-4 border-start-lg shadow-soft-5">
            <div class="w-md-50 mx-auto px-10 px-md-0 py-10">
                <div class="mb-10"><a class="d-inline-block d-lg-none mb-10"
                        href="#"><img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" class="h-rem-10" alt="..."></a>
                    <h1 class="ls-tight fw-bolder h3">Sign in to your account</h1>

                </div>
                <form class="crancy-wc__form-main  verify-gcaptcha" novalidate="novalidate" id="login_form"
                                method="POST" action="<?php echo e(route('user.login')); ?>">
                                <?php echo csrf_field(); ?>
                    <div class="mb-5"><label class="form-label" for="email">Email address/Username</label>
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
                    <div><button type="submit" class="btn w-100" style="background-color: #6f42c1; color: white;">Sign in</button></div>

                </form>

                <div class="py-5 text-center"><span class="text-xs text-uppercase fw-semibold"></span></div>
                <!-- Google Login Button -->
                <div class="d-grid">
                    <a href="<?php echo e(route('user.google.login')); ?>" class="btn btn-danger">
                        <svg width="18" height="18" viewBox="0 0 24 24" class="me-2">
                            <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        Continue with Google
                    </a>
                </div>

                <div class="py-5 text-center"><span class="text-xs text-uppercase fw-semibold">or</span></div>
                <div class="row g-2">
                    <div class="col-sm-12"><a href="<?php echo e(route('user.register')); ?>"
                            class="btn btn-neutral w-100"><span class="icon icon-sm pe-2"><img src="<?php echo e(asset( $activeTemplateTrue . 'agent/img/social/google.svg')); ?>" alt="..."> </span>Signup With Email</a>
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