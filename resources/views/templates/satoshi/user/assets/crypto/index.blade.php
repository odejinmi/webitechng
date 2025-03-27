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
                                    <h4 class="text-gray-900 fw-bold">@lang('Trade Crypto')</h4>

                                    <div class="fs-6 text-gray-700 ">@lang('Welcome to our crypto trade portal where you can buy and sell crypto digital assets from over 70 currencies available on the platform. <br>
                                   <b> You can click on the Trade Log button at the top right corner of your screen to view your trade log</b>
                                    ')
                                        <br> <br>

                                        <!--begin::Action-->
                                        <a href="{{ route('user.crypto.sell') }}" class="btn btn-primary er fs-6 px-8 py-4 mb-4">
                                            @lang('Sell Asset Now') </a>

                                            <a href="{{ route('user.crypto.buy') }}" class="btn btn-secondary er fs-6 px-8 py-4 mb-4">
                                                @lang('Buy Asset Now') </a>
                                        <br> <br>



                                        <a href="{{ route('user.crypto.rates') }}" class="btn btn-info fs-6 px-8 py-4 mb-4">
                                            @lang('View Our Rates') </a>
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
                        <img src="{{ asset('assets/assets/dist/images/backgrounds/2.png') }}" alt="" class="mw-100 h-200px h-sm-325px" />
                    </div>
                    <!--end::Illustration-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
    @endsection

    @push('breadcrumb-plugins')

    @endpush
    @push('script')
    @endpush
