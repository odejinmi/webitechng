<?php $__env->startSection('content'); ?>
    <?php
        $policyPages = getContent('privacy_policy.element', null, false, true);
        
        $registerContent = getContent('register.content', true);
    ?>
    <!--begin::Authentication - Sign-UP -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                <!--begin::Image-->
                <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                    src="<?php echo e(getImage('assets/images/frontend/register/' . @$registerContent->data_values->image, '630x540')); ?>"
                    alt="" />
                <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                    src="<?php echo e(getImage('assets/images/frontend/register/' . @$registerContent->data_values->image, '630x540')); ?>"
                    alt="" />
                <!--end::Image-->
                <!--begin::Title-->
                <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">
                    <?php echo e(__(@$registerContent->data_values->heading)); ?>

                </h1>
                <!--end::Title-->

                <!--begin::Text-->
                <div class="text-gray-600 fs-base text-center fw-semibold">
                    <?php echo e(__(@$registerContent->data_values->sub_heading)); ?>

                </div>
                <!--end::Text-->
            </div>
            <!--end::Content-->
        </div>
        <!--begin::Aside-->

        <!--begin::Body-->
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
            <!--begin::Card-->
            <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                <!--begin::Wrapper-->
                <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                    <a class="navbar-brand" href="<?php echo e(route('home')); ?>"><img
                            src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" width="50" class="logo"
                            alt="logo"></a>

                    <!--begin::Form-->
                    <form class="form w-100 verify-gcaptcha" novalidate="novalidate" method="POST"
                        action="<?php echo e(route('user.register')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php if(isset($reference)): ?>
                            <input type="text" hidden name="referBy" class="form-control" id="referenceBy"
                                value="<?php echo e($reference); ?>" placeholder="<?php echo app('translator')->get('Reference BY'); ?>" readonly />
                        <?php endif; ?>
                        <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-dark fw-bolder mb-3">
                                <?php echo app('translator')->get('Sign Up'); ?>
                            </h1>
                            <!--end::Title-->

                            <!--begin::Subtitle-->
                            <div class="text-gray-500 fw-semibold fs-6">
                                <?php echo app('translator')->get('Fill the form below to create an account'); ?>
                            </div>
                            <!--end::Subtitle--->
                        </div>
                        <!--begin::Heading-->


                        <!--begin::Input group--->
                        <div class="fv-row mb-8">
                            <!--begin::Username-->
                            <input type="text" onkeyup="this.value = this.value.toLowerCase();" placeholder="Username (lowercase letters only)"name="username" value="<?php echo e(old('username')); ?>" required autocomplete="off" class="form-control bg-transparent" />
                            <!--end::Username-->
                        </div>
                        
                         <!--begin::Input group--->
                        <div class="fv-row mb-8">
                             <input type="text"
                                    class="form-control bg-transparent"
                                    name="nin"
                                    id="nin"
                                    placeholder="Enter Your NIN"
                                    maxlength="11"
                                    pattern="\d{11}" 
                                    title="Your NIN must be 11 digits"
                                    required />
                        </div>
        
        
                        <!--begin::Input group--->
                        <div class="fv-row mb-8">
                            <!--begin::Email-->
                            <input type="email" placeholder="Email" placeholder="<?php echo app('translator')->get('Your Email'); ?>" name="email"
                                value="<?php echo e(old('email')); ?>" autocomplete="off" class="form-control bg-transparent" />
                            <!--end::Email-->
                        </div>

                        <!--begin::Input group--->
                        <div class="fv-row mb-8 ">
                            <!--begin::Country-->
                           <div class="fv-row mb-8">
    <select name="country" class="form-select form-control select2 bg-transaparent" data-control="select2" data-placeholder="Select an option">
        <option data-mobile_code="+234" value="Nigeria" data-code="NG">Nigeria</option>
    </select>
</div>

                            <!--end::Country-->
                        </div>

                        <!--begin::Input group--->
                        <div class="fv-row mb-8">
                            <!--begin::Phone-->
                            <input type="hidden" name="mobile_code">
                            <input type="hidden" name="country_code">
                            <input type="number" name="mobile" value="<?php echo e(old('mobile')); ?>" autocomplete="off"
                                class="form-control bg-transparent" placeholder="<?php echo app('translator')->get('Your Phone Number'); ?>" required>
                            <!--end::Phone-->
                        </div>

                        <!--begin::Input group-->
                        <div class="fv-row mb-8" data-kt-password-meter="true">
                            <!--begin::Wrapper-->
                            <div class="mb-1">
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input class="form-control bg-transparent" type="password" placeholder="Password"
                                        name="password" autocomplete="off" />

                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                        data-kt-password-meter-control="visibility">
                                        <i class="fa fa-eye-slash fs-2"></i> <i class="fa fa-eye fs-2 d-none"></i> </span>
                                </div>
                                <!--end::Input wrapper-->
                                <?php if($general->secure_password): ?>
                                    <div class="input-popup">
                                        <p class="error lower"><?php echo app('translator')->get('1 small letter minimum'); ?></p>
                                        <p class="error capital"><?php echo app('translator')->get('1 capital letter minimum'); ?></p>
                                        <p class="error number"><?php echo app('translator')->get('1 number minimum'); ?></p>
                                        <p class="error special"><?php echo app('translator')->get('1 special character minimum'); ?></p>
                                        <p class="error minimum"><?php echo app('translator')->get('6 character password'); ?></p>
                                    </div>

                                    <!--begin::Meter-->
                                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                <?php endif; ?>
                                <!--end::Meter-->
                            </div>
                            <!--end::Wrapper-->

                        </div>
                        <!--end::Input group--->

                        <!--end::Input group--->
                        <div class="fv-row mb-8">
                            <!--begin::Repeat Password-->
                            <input type="text" placeholder="Repeat Password" name="password_confirmation" type="password"
                                autocomplete="off" class="form-control bg-transparent" />
                            <!--end::Repeat Password-->
                        </div>
                        <!--end::Input group--->
                        <div class="fv-row mb-3">
                            <?php if (isset($component)) { $__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243 = $component; } ?>
<?php $component = App\View\Components\Captcha::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('captcha'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Captcha::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243)): ?>
<?php $component = $__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243; ?>
<?php unset($__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243); ?>
<?php endif; ?>
                        </div>
                        <?php if($general->agree): ?>
                            <!--begin::Accept-->
                            <div class="fv-row mb-8">
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="agree"
                                        <?php if(old('agree')): echo 'checked'; endif; ?> name="agree" />
                                    <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">
                                        I Accept the
                                        <?php $__currentLoopData = $policyPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $policy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a class="ms-1 link-primary"
                                                href="<?php echo e(route('policy.pages', [slug($policy->data_values->title), $policy->id])); ?>"
                                                target="_blank"><?php echo e(__($policy->data_values->title)); ?></a>
                                            <?php if(!$loop->last): ?>
                                                ,
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </span>
                                </label>
                            </div>
                            <!--end::Accept-->
                        <?php endif; ?>

                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">
                                    <?php echo app('translator')->get('Sign up'); ?></span>
                                <!--end::Indicator label-->
                            </button>
                        </div>
                        <!--end::Submit button-->

                        <!--begin::Sign up-->
                        <div class="text-gray-500 text-center fw-semibold fs-6">
                            <?php echo app('translator')->get('Already have an account?'); ?>

                            <a href="<?php echo e(route('user.login')); ?>" class="link-primary fw-semibold">
                                <?php echo app('translator')->get('Sign in'); ?>
                            </a>
                        </div>
                        <!--end::Sign up-->
                    </form>
                    <!--end::Form-->

                </div>
                <!--end::Wrapper-->

            </div>
            <!--end::Card-->
        </div>
        <!--end::Body-->

    </div>
    <!--end::Authentication - Sign-in-->


<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
    <style>
        .country-code .input-group-text {
            background: #fff !important;
        }

        .country-code select {
            border: none;
        }

        .country-code select:focus {
            border: none;
            outline: none;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php if($general->secure_password): ?>
    <?php $__env->startPush('script-lib'); ?>
        <script src="<?php echo e(asset('assets/global/js/secure_password.js')); ?>"></script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>
<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        (function($) {
            <?php if($mobileCode): ?>
                $(`option[data-code=<?php echo e($mobileCode); ?>]`).attr('selected', '');
            <?php endif; ?>
            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            $('.checkUser').on('focusout', function(e) {
                var url = '<?php echo e(route('user.checkUser')); ?>';
                var value = $(this).val();
                var token = '<?php echo e(csrf_token()); ?>';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/auth/register.blade.php ENDPATH**/ ?>