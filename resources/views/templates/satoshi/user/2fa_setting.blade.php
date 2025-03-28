@extends($activeTemplate . 'layouts.app')
@section('panel')
    @include($activeTemplate . 'partials.settings')


    <div class="" id="id4" role="tabpanel">

        <div class="crancy-paymentm crancy__item-group">
            <div class="d-wnone" data-kt-element="apps">
                <!--begin::Heading-->
                <h3 class="text-dark fw-bold mb-7">
                    @if (auth()->user()->ts)
                        @lang('Disabled Google 2FA')
                    @else
                        @lang('Enable Google 2FA')
                    @endif
                </h3>
                <!--end::Heading-->
                @if (!auth()->user()->ts)
                    <!--begin::Description-->
                    <div class="alert alert-info rounded border-info border border-dashed mb-9 p-6 mb-3">
                        @lang('Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device') <a class="text--base"
                            href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
                            target="_blank">Download</a>

                        <!--begin::QR code image-->
                        <div class="pt-5 text-center">

                            <img src="{{ QR($secret) }}" alt="" class="mw-150px" />
                        </div>
                        <!--end::QR code image-->
                    </div>
                    <!--end::Description-->



                    <!--begin::Notice-->
                    <div class="alert alert-warning rounded border-warning border border-dashed mb-9 p-6">
                        <!--begin::Icon-->
                        <i class="ti ti-alert-circle fs-2tx text-warning me-4"><span class="path1"></span><span
                                class="path2"></span><span class="path3"></span></i> <!--end::Icon-->

                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-grow-1 ">
                            <!--begin::Content-->
                            <div class=" fw-semibold">

                                <div class="fs-6 text-gray-700 ">If you having trouble using the QR code, select manual
                                    entry on your app, and enter your username and the code: <div
                                        class="fw-bold text-dark pt-2">{{ $secret }}</div>
                                </div>
                            </div>
                            <!--end::Content-->

                        </div>
                        <!--end::Wrapper-->
                    </div>
                @endif
                @if (auth()->user()->ts)
                    <!--begin::Form-->
                    <form class="form" action="{{ route('user.twofactor.disable') }}" method="POST">
                        @csrf


                        <div class="form-group mb-3">
                            <label class="form-label">@lang('Setup Key')</label>
                            <div class="input-group">
                                <input type="text" name="key" value="{{ $secret }}"
                                    class="form-control form--control referralURL" readonly>
                                <button type="button" class="btn btn-primary input-group-text copytext" id="copyBoard"> <i
                                        class="ti ti-copy"></i> </button>
                            </div>
                        </div>
                        <!--begin::Input group-->
                        <div class="mb-10 fv-row">
                            <label>@lang('Google Authenticatior OTP')</label>
                            <input type="text" name="code" class="form-control form-control-lg form-control-solid"
                                placeholder="Enter authentication code" name="code" />
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="d-flex flex-center">
                            <button type="reset" data-kt-element="apps-cancel" class="btn btn-light me-3">
                                @lang('Cancel')
                            </button>
                            <button type="submit" data-kt-element="apps-submit" class="btn btn-primary">
                                <span class="indicator-label">
                                    @lang('Submit')
                                </span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                @else
                    <!--begin::Form-->
                    <br>
                    <form class="form" action="{{ route('user.twofactor.enable') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label class="form-label">@lang('Setup Key')</label>
                            <div class="input-group" id="copyBoard">
                                <input type="text" name="key" value="{{ $secret }}"
                                    class="form-control form--control referralURL" readonly>

                            </div>
                        </div>

                        <!--begin::Input group-->
                        <div class="mb-10 fv-row">
                            <label>@lang('Google Authenticatior OTP')</label>
                            <input type="text" name="code" class="form-control form-control-lg form-control-solid"
                                placeholder="Enter authentication code" name="code" />
                        </div>
                        <!--end::Input group-->


                        <br>
                        <!--begin::Actions-->
                        <div class="d-flex flex-center">
                            <button type="submit" data-kt-element="apps-submit" class="btn btn-primary">
                                <span class="indicator-label">
                                    @lang('Submit')
                                </span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                @endif
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('#copyBoard').click(function() {
                var copyText = document.getElementsByClassName("referralURL");
                copyText = copyText[0];
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                /*For mobile devices*/
                document.execCommand("copy");
                copyText.blur();
                this.classList.add('copied');
                SlimNotifierJs.notification('success', 'Copied', '2FA Code Copied Successfuly', 3000);

                setTimeout(() => this.classList.remove('copied'), 1500);
            });
        })(jQuery);
    </script>
@endpush
