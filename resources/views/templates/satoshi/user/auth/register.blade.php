@extends($activeTemplate . 'layouts.auth')

@section('content')
    @php
        $registerContent = getContent('login.content', true);
        $policyPages = getContent('privacy_policy.element', null, false, true);
    @endphp
    <div class="row g-0 justify-content-center gradient-bottom-right start-purple middle-indigo end-pink">
        <div
            class="col-md-6 col-lg-5 col-xl-5 position-fixed start-0 top-0 vh-100 overflow-y-hidden d-none d-lg-flex flex-lg-column">
            <div class="p-12 py-xl-10 px-xl-20"><a class="d-block" href="#"><img
                        src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" class="h-rem-10"
                        alt="..."></a>
                <div class="mt-16">
                    <h1 class="ls-tight fw-bolder display-6 text-white mb-5">
                        {{ __(@$registerContent->data_values->heading) }}
                    </h1>
                    <p class="text-white text-opacity-75 pe-xl-24">{{ __(@$registerContent->data_values->sub_heading) }}</p>
                </div>
            </div>
            <div class="mt-autos"><img src="{{asset( $activeTemplateTrue . 'agent/img/people/frontlady.png') }}"
                    class="img-fluid rounded-top-start-4" alt="...">
            </div>
        </div>
        <div
            class="col-12 col-md-12 col-lg-7 offset-lg-5 min-vh-100 overflow-y-auto d-flex flex-column justify-content-center position-relative bg-body rounded-top-start-lg-4 border-start-lg shadow-soft-5">
            <div class="w-md-50 mx-auto px-10 px-md-0 py-10">
                <div class="mb-10"><a class="d-inline-block d-lg-none mb-10" href="#"><img
                            src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" class="h-rem-10"
                            alt="..."></a>
                    <h1 class="ls-tight fw-bolder h3">Sign Up</h1>

                </div>
                <form class="crancy-wc__form-main verify-gcaptcha" novalidate="novalidate" method="POST"
                    action="{{ route('user.register') }}">
                    @csrf
                    @isset($reference)
                        <input type="text" hidden name="referBy" class="form-control" id="referenceBy"
                            value="{{ $reference }}" placeholder="@lang('Reference BY')" readonly />
                    @endisset
                    <div class="row g-5">

                        <div class="col-sm-6"><label class="form-label">Firstname</label> <input type="text"
                                class="form-control" name="first_name" value="{{ old('first_name') }}">
                        </div>
                        <div class="col-sm-6"><label class="form-label">Lastname</label> <input type="text"
                                class="form-control" name="last_name" value="{{ old('last_name') }}">
                        </div>

                        <div class="col-sm-6"><label class="form-label">Username</label> <input type="text"
                                class="form-control" name="username" value="{{ old('username') }}">
                        </div>
                        <div class="col-sm-6"><label class="form-label">Mobile</label> <input type="number" name="mobile"
                                value="{{ old('mobile') }}" class="form-control">

                            <input type="hidden" name="mobile_code">
                            <input type="hidden" name="country_code">
                        </div>
                        <div class="col-sm-12"><label class="form-label">Email address</label> <input type="email"
                                name="email" class="form-control">
                        </div>
                        <div class="col-sm-12"><label class="form-label">NIN</label> <input type="number"
                                name="nin" class="form-control">
                        </div>
                        <div class="col-sm-6"><label class="form-label">Password</label> <input name="password"
                                maxlength="8" type="password" class="form-control">
                        </div>
                        <div class="col-sm-6"><label class="form-label">Confirmed Password</label> <input name="password_confirmation"
                                maxlength="8" type="password" class="form-control">
                        </div>
                        <div class="col-sm-6"><label class="form-label">Transaction PIN</label> <input name="pin"
                                maxlength="8" type="number" class="form-control">
                        </div>
                        <div class="col-sm-6">
    <label class="form-label">Select Country</label>
    <select name="country" class="form-select crancy__item-input bg-transparent" data-control="select2" data-placeholder="Select an option">
        <option data-mobile_code="+234" value="Nigeria" data-code="NG">Nigeria</option>
    </select>
</div>


                        <!--<div class="col-sm-6"><label class="form-label">State</label> <input name="state" type="text" class="form-control">-->
                        <!--</div>-->

                        <!--<div class="col-sm-6"><label class="form-label">Address</label> <input name="address" type="text" class="form-control">-->
                        <!--</div>-->
                        <!--<div class="col-sm-6"><label class="form-label">City</label> <input name="city" type="text" class="form-control">-->
                        <!--</div>-->
                        <!--<div class="col-sm-6"><label class="form-label">NIN</label> <input name="nin" type="number" class="form-control">-->
                        <!--</div>-->

                        @if ($general->agree)
                            <!--begin::Accept-->
                            <div class="fv-row mb-8">
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="agree"
                                        @checked(old('agree')) name="agree" />
                                    <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">
                                        I Accept the
                                        @foreach ($policyPages as $policy)
                                            <a class="ms-1 link-primary"
                                                href="{{ route('policy.pages', [slug($policy->data_values->title), $policy->id]) }}"
                                                target="_blank">{{ __($policy->data_values->title) }}</a>
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </span>
                                </label>
                            </div>
                            <!--end::Accept-->
                        @endif

                        <div class="col-sm-12"><button type="submit" class="btn btn-dark w-100">Sign up</button></div>
                    </div>
                </form>

                <div class="py-5 text-center"><span class="text-xs text-uppercase fw-semibold"></span></div>
                <!-- Google Login Button -->
                <div class="d-grid">
                    <a href="{{ route('user.google.login') }}" class="btn btn-danger">
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
                    <div class="col-sm-12"><a href="{{ route('user.login') }}" class="btn btn-neutral w-100"><span
                                class="icon icon-sm pe-2"> </span>Login With Email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

@push('script')
    <script>
        "use strict";
        (function($) {
            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif
            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
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
@endpush
