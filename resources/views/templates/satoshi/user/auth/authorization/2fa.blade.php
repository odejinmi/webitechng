@extends(checkTemplate() . 'layouts.auth')
@section('content')
@php
$passwordContent = getContent('emailauth.content', true);
      $loginContent = getContent('login.content', true);
      $policyPages = getContent('privacy_policy.element', null, false, true);
@endphp

<div class="row g-0 justify-content-center gradient-bottom-right start-purple middle-indigo end-pink">
        <div
            class="col-md-6 col-lg-5 col-xl-5 position-fixed start-0 top-0 vh-100 overflow-y-hidden d-none d-lg-flex flex-lg-column">
            <div class="p-12 py-xl-10 px-xl-20"><a class="d-block"
                    href="#"><img src="{{ asset(checkTemplate(true) . 'agent/img/logos/logo-light.svg')}}" class="h-rem-10" alt="..."></a>
                <div class="mt-16">
                    <h1 class="ls-tight fw-bolder display-6 text-white mb-5">Google 2FA Verification
                    </h1>
                    <p class="text-white text-opacity-75 pe-xl-24">Please validate using your Google 2FA App</p>
                </div>
            </div>
            <div class="mt-autos"><img src="{{ asset(checkTemplate(true) . 'agent/img/people/frontlady.png')}}" class="img-fluid rounded-top-start-4" alt="...">
            </div>
        </div>
        <div
            class="col-12 col-md-12 col-lg-7 offset-lg-5 min-vh-100 overflow-y-auto d-flex flex-column justify-content-center position-relative bg-body rounded-top-start-lg-4 border-start-lg shadow-soft-5">
            <div class="w-md-50 mx-auto px-10 px-md-0 py-10">
                <div class="mb-10"><a class="d-inline-block d-lg-none mb-10"
                        href="#"><img src="{{ asset(checkTemplate(true) . 'agent/img/logos/logo-dark.svg')}}" class="h-rem-10" alt="..."></a>
                    <h4 class="ls-tight fw-bolder h3">@lang('A 6 digit verification code is available for use on your Goodle 2FA App. Please enter the code below and click on the continue button to proceed')</h4>

                </div>
                <form class="crancy-wc__form-main  verify-gcaptcha" novalidate="novalidate" id="login_form"
                                method="POST" action="{{ route('user.go2fa.verify') }}">
                                @csrf
                    <div class="mb-5"><label class="form-label" for="code">Code</label>
                      <input type="number" name="code" maxlength="6" class="form-control" id="value">
                    </div>

                    <div><button type="submit" class="btn btn-dark w-100">Proceed</button></div>
                </form>


            </div>
        </div>
    </div>


@endsection

@push('style')
