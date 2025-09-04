@extends($activeTemplate . 'layouts.app')
@section('panel')

<div class="vstack gap-3 gap-xl-6 mt-8">
        <div class="row row-cols-sm-2 row-cols-md-6 g-3">
            <div class="col">
                <div class="card border-primary-hover">
                    <div class="card-body d-flex gap-3"><img src="{{ url('/') }}/assets/images/country/ngn.png"
                            class="w-rem-7 h-rem-7 mt-1" alt="...">
                        <div class=""><span class="d-block text-muted mb-1">Total Transfer</span>
                            <span
                                class="d-block text-lg fw-bold text-heading">{{ $general->cur_sym }}{{ number_format(@$totalwithdrawvalue, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex gap-3 mb-1"><span class="text-muted">Transaction Count</span>

                        </div>
                        <div class="d-flex align-items-center">
                            <span class="text-lg text-heading fw-bold">{{ number_format(@$totalwithdrawcount) }} </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="row row-cols-md-2 g-6">
             <form  class="crancy-wallet-form" novalidate="novalidate" action="{{ route('user.withdraw.money') }}" method="post">
            @csrf
            <div class="col">
                <div class="card border-0 border-xxl">
                    <div class="card-body p-0 p-xxl-6">
                        <div class="d-flex gap-8 justify-content-center mb-5"><a href="#"
                                class="text-lg fw-bold text-heading">Request Payout</a></div>
                        <div class="vstack gap-2">

                            <div class="bg-body-secondary rounded-3 p-4">
                                <div class="d-flex justify-content-between text-xs text-muted">
                                    <span class="fw-semibold">Method</span>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <select class="form-control" style="height: 100pxx;" name="methodId" id="select2">
                                        @foreach ($withdrawMethod as $data)
                                            <option value="{{ $data->id }}">
                                                {{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div>
                                <h6 class="progress-text mb-1 d-block"></h6>
                            </div>


                            <div class="bg-body-secondary rounded-3 p-4">
                                <div class="d-flex justify-content-between text-xs text-muted">
                                    <span class="fw-semibold">Amount</span>
                                </div>
                                <div class="d-flex justify-content-between mt-4"><input type="tel" id="amount"
                                        placeholder="{{ $general->cur_sym }} 0.00" name="amount"
                                        class="form-control form-control-flush text-xl fw-bold w-rem-40">
                                    <div class="d-flex align-items-center gap-2"><img
                                            src="{{ url('/') }}/assets/images/country/ngn.png"
                                            class="w-rem-6 h-rem-6 rounded-circle" alt="...">
                                        <span class="fw-semibold text-sm">NGN</span>
                                    </div>
                                </div>
                            </div>

                            <!--begin::Input group-->
                            <div class="bg-body-secondary rounded-3 p-4">
                                <!--begin::Row-->
                                <div class="d-flex justify-content-between mt-4 gap-5">
                                    <!--begin::Col-->
                                    <div >
                                        <!--begin::Option-->
                                        <input type="radio" class="btn-check" name="wallet" value="act_wallet"
                                               onchange="selectwallet('main')" id="act_wallet" />
                                        <label
                                            class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10"
                                            for="act_wallet">
                                            <i class="ti ti-wallet fs-3x me-5"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span><span
                                                    class="path4"></span><span class="path5"></span></i>
                                            <!--begin::Info-->
                                            <span class="d-block fw-semibold text-start">
                                                        <span class="text-dark fw-bold d-block fs-4 mb-2">
                                                            @lang('Main Wallet')
                                                        </span>
                                                        <span
                                                            class="text-muted fw-semibold fs-6">{{ $general->cur_sym }}{{ showAmount(Auth::user()->balance) }}</span>
                                                    </span>
                                            <!--end::Info-->
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div >
                                        <!--begin::Option-->
                                        <input type="radio" class="btn-check" name="wallet"  value="ref_wallet"
                                               onchange="selectwallet('ref')"
                                               id="ref_wallet" />
                                        <label
                                            class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center"
                                            for="ref_wallet">
                                            <i class="ti ti-cash fs-3x me-5"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                            <!--begin::Info-->
                                            <span class="d-block fw-semibold text-start">
                                                        <span class="text-dark fw-bold d-block fs-4 mb-2">
                                                            @lang('Referral Wallet')</span>
                                                        <span
                                                            class="text-muted fw-semibold fs-6">{{ $general->cur_sym }}{{ showAmount(Auth::user()->ref_balance) }}</span>
                                                    </span>
                                            <!--end::Info-->
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Input group-->



                            <button type="submit" id="submit"
                                class="btn btn-lg btn-dark w-100">Request Payout</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <div class="col">
                <div class="card border-0 border-xxl h-md-100">
                    <div class="card-body p-0 p-xxl-6">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div>
                                <h5>Order history</h5>
                            </div>
                            <div class="hstack align-items-center"><a href="#" class="text-muted"><i
                                        class="bi bi-arrow-repeat"></i></a>
                            </div>
                        </div>
                        <div class="vstack gap-6">
                            @forelse($withdraws as $trx)
                                <div data-bs-toggle="modal" data-bs-target="#popup_modal_{{ $trx->id }}">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="icon icon-shape flex-none text-base text-bg-primary rounded-circle">
                                            <i class="bi bi-bank w-rem-6 h-rem-6" alt="..."></i>
                                        </div>
                                        <div>
                                            <h6 class="progress-text mb-1 d-block">{{ $trx->trx }}</h6>
                                            <p class="text-muted text-xs">
                                                 @php
                                                        $details =
                                                            $data->detail != null
                                                                ? json_encode($data->detail)
                                                                : null;
                                                    @endphp
                                                    @if ($data->status == 2)
                                                    <span class="badge bg-warning">@lang('Pending')</span>
                                                @elseif($data->status == 1)
                                                    <span class="badge bg-success">@lang('Completed')</span>

                                                @elseif($data->status == 3)
                                                    <span class="badge bg-danger">@lang('Rejected')</span>
                                                </button>
                                                @endif <br>
                                                {{ diffForHumans($trx->created_at) }}</p>
                                        </div>
                                        <div class="text-end ms-auto">
                                            <span
                                                class="h6 text-sm">-{{ $general->cur_sym }}{{ showAmount($trx->amount) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="crancy-default__modal modal fade" id="popup_modal_{{ $trx->id }}"
                                    tabindex="-1" aria-labelledby="popup_modal_{{ $trx->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content crancy-preview__modal-content">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="crancy-flex__right">
                                                        <a id="crancy-main-form__close" type="initial"
                                                            class="crancy-preview__modal--close btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none">
                                                                <g clip-path="url(#clip0_989_10425)">
                                                                    <circle cx="12" cy="12" r="12"
                                                                        fill="#EDF2F7" />
                                                                    <path d="M16.9498 7.05029L7.05033 16.9498"
                                                                        stroke="#5D6A83" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M7.05029 7.05029L16.9498 16.9498"
                                                                        stroke="#5D6A83" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_989_10425">
                                                                        <rect width="24" height="24"
                                                                            fill="white" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="crancy-wc__heading crancy-flex__column-center text-center">
                                                        <h3 class="crancy-login-popup__title"> Details</h3>
                                                        <p>

                                                {{ $data->admin_feedback }}
                                                        </p>
                                                             @php
                                                        $details =
                                                            $data->detail != null
                                                                ? json_encode($data->detail)
                                                                : null;
                                                    @endphp
                                                    @if ($data->status == 2)
                                                    <span class="badge bg-warning">@lang('Pending')</span>
                                                @elseif($data->status == 1)
                                                    <span class="badge bg-success">@lang('Completed')</span>


                                                @elseif($data->status == 3)
                                                    <span class="badge bg-danger">@lang('Rejected')</span>
                                                @endif
                                                        <!-- Search Form -->
                                                        <div
                                                            class="crancy-header__form crancy-header__form__currency mg-top-20">

                                                        </div>
                                                        <!-- End Search Form -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @empty
                                {!! emptyData2() !!}
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection

@push('script')

@endpush
