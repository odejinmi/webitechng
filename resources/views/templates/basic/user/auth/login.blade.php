@extends($activeTemplate . 'layouts.auth')

@section('content')

@php
      $loginContent = getContent('login.content', true);
@endphp
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                <!--begin::Image-->
                <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                    src="{{ getImage('assets/images/frontend/login/' . @$loginContent->data_values->image, '630x540') }}" alt="" />
                <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                    src="{{ getImage('assets/images/frontend/login/' . @$loginContent->data_values->image, '630x540') }}" alt="" />
                <!--end::Image-->
                <!--begin::Title-->
                <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">
                    {{ __(@$loginContent->data_values->heading) }}
                </h1> 
                <!--end::Title-->

                <!--begin::Text-->
                <div class="text-gray-600 fs-base text-center fw-semibold">
                    {{ __(@$loginContent->data_values->sub_heading) }} 
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
                        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" width="50" class="logo" alt="logo"></a>
                        <!--begin::Form-->
                        <form class="form w-100 verify-gcaptcha"  data-kt-redirect-url="{{route('user.home')}}"  class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST"
                        action="{{ route('user.login') }}">
                        @csrf 
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">
                                    @lang('Sign In')
                                </h1>
                                <!--end::Title-->

                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">
                                   @lang('Fill the form below to login to your account')
                                </div>
                                <!--end::Subtitle--->
                            </div>
                            <!--begin::Heading-->  

                            <!--begin::Input group--->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="text" name="username" class="form-control bg-transparent mb-3" value="{{ old('username') }}" autocomplete="off" placeholder="@lang('Username or Email')" required>
                                <!--end::Email-->
                            </div>
                            <br>

                            <!--end::Input group--->
                            <div class="fv-row mb-3">
                                <!--begin::Password-->
                                <input type="password" placeholder="@lang('Password')" name="password" autocomplete="off"
                                    class="form-control bg-transparent  mb-3" />
                                <!--end::Password-->
                            </div>
                            <!--end::Input group--->

                            <div class="fv-row mb-3">
                                <x-captcha />
                            </div>

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <!--begin::Link-->
                                <a href="{{ route('user.password.request') }}" class="link-primary">
                                    @lang('Forgot Password ')?
                                </a>
                                <!--end::Link-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">

                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">
                                        @lang('Sign In')</span>
                                    <!--end::Indicator label-->

                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">
                                        Please wait... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                    <!--end::Indicator progress--> </button>
                            </div>
                            <!--end::Submit button-->

                            <!--begin::Sign up-->
                            <div class="text-gray-500 text-center fw-semibold fs-6">
                                @lang('Don\'t have an account')

                                <a href="{{ route('user.register') }}" class="link-primary">
                                    @lang('Sign up')
                                </a>
                            </div>
                            <!--end::Sign up-->
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
    <!--end::Authentication - Sign-in-->

    </section>
@endsection

@push('script')
    <script>
        "use strict";

        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML =
                    '<span style="color:red;">@lang('Captcha field is required.')</span>';
                return false;
            }
            return true;
        }

        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
        (function($) {
            $('.captcha').remove();
            $('input[name=captcha]').attr('placeholder', `@lang('Captcha')`);
        })(jQuery);
    </script>
@endpush
