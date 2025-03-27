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
                        src="{{ asset($activeTemplateTrue . 'agent/img/logos/logo-light.svg') }}" class="h-rem-10"
                        alt="..."></a>
                <div class="mt-16">
                    <h1 class="ls-tight fw-bolder display-6 text-white mb-5">
                        {{ __(@$registerContent->data_values->heading) }}
                    </h1>
                    <p class="text-white text-opacity-75 pe-xl-24">{{ __(@$registerContent->data_values->sub_heading) }}</p>
                </div>
            </div>
            <div class="mt-autos"><img src="{{ asset($activeTemplateTrue . 'agent/img/people/frontlady.png') }}"
                    class="img-fluid rounded-top-start-4" alt="...">
            </div>
        </div>
        <div
            class="col-12 col-md-12 col-lg-7 offset-lg-5 min-vh-100 overflow-y-auto d-flex flex-column justify-content-center position-relative bg-body rounded-top-start-lg-4 border-start-lg shadow-soft-5">
            <div class="w-md-50 mx-auto px-10 px-md-0 py-10">
                <div class="mb-10"><a class="d-inline-block d-lg-none mb-10" href="#"><img
                            src="{{ asset($activeTemplateTrue . 'agent/img/logos/logo-dark.svg') }}" class="h-rem-10"
                            alt="..."></a>
                    <h1 class="ls-tight fw-bolder h3">Sign in to your account</h1>

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
                        <div class="col-sm-6"><label class="form-label">Password</label> <input name="password"
                                maxlength="8" type="password" class="form-control">
                        </div>
                        <div class="col-sm-6"><label class="form-label">Transaction PIN</label> <input name="pin"
                                maxlength="8" type="number" class="form-control">
                        </div>
                        <div class="col-sm-6"><label class="form-label">Select Country</label>
                            <select name="country" class="form-select crancy__item-input bg-transaparent"
                                data-control="select2" id="" data-placeholder="Select an option">
                                @foreach ($countries as $key => $country)
                                    <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}"
                                        data-code="{{ $key }}">
                                        {{ __($country->country) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6"><label class="form-label">State</label> <input name="state" type="text" class="form-control">
                        </div> 

                        <div class="col-sm-6"><label class="form-label">Address</label> <input name="address" type="text" class="form-control">
                        </div> 
                        <div class="col-sm-6"><label class="form-label">City</label> <input name="city" type="text" class="form-control">
                        </div> 

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
