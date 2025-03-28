@extends($activeTemplate . 'layouts.app')
@section('panel')
    <!-- File export -->
    <div class="row">
        <div class="col-12">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Heading-->
                    <div class="card-px text-center pt-15 pb-15">
                        <!--begin::Alert-->

                        <!--begin::Notice-->
                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6">
                            <!--begin::Icon-->
                            <i class="ti ti-alert-circle fs-2tx text-warning me-4"><span class="path1"></span><span
                                    class="path2"></span><span class="path3"></span></i> <!--end::Icon-->

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1 ">
                                <!--begin::Content-->
                                <div class=" fw-semibold">
                                    <h4 class="text-gray-900 fw-bold">@lang('Digital Giftcards')</h4>

                                    <div class="fs-6 text-gray-700 ">@lang('Welcome to our digital giftcard trading portal where you can buy digital from over 700 service providers and 300+ countries across the world<br>
                                   <b> You can click on the trade log button at the top right corner of your screen to view your giftcard trading log</b>
                                    ')
                                        <br> <br>

                                        <!--begin::Action-->

                                        <a href="{{ route('user.giftcard.digital.shop') }}" class="btn btn-primary btn-md">
                                            @lang('Buy Digital Giftcard') </a>
                                        <br> <br>
                                        <!--end::Action-->
                                    </div>
                                </div>
                                <!--end::Content-->

                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Notice-->
                        <!--end::Alert-->
                    </div>
                    <!--end::Heading-->

                    <!--begin::Illustration-->
                    <div class="text-center pb-15 px-5">
                        <img src="{{ asset('assets/assets/dist/images/backgrounds/6134225.png') }}" alt="" class="mw-100 h-200px h-sm-325px" />
                    </div>
                    <!--end::Illustration-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
    @endsection

    @push('breadcrumb')
    <a class="btn bg-white text-primary" href="{{ route('user.giftcard.digital.history') }}"> <i class="ti ti-printer"></i> @lang('Giftcard Log')</a>
    @endpush
