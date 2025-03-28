@extends($activeTemplate . 'layouts.app')
@section('panel')
 <!-- content @s
-->
<!--begin::Container-->
<div id="kt_content_container" class=" container-xxl ">
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Stepper-->
            <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">


                <!--begin::Form-->
                    <form  class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" action="" method="post">
                    @csrf

                    <!--begin::Step 2-->
                    <div data-kt-stepper-element="scontent">

                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-10 pb-lg-15">
                                <!--begin::Title-->
                                <h2 class="fw-bold text-dark">@lang('Update Invoice / Payment Link')</h2>
                                <!--end::Title-->

                                <!--begin::Notice-->
                                <div class="text-muted fw-semibold fs-6">
                                    @lang('Invoice ID:')
                                    <a href="#" class="link-primary fw-bold">{{$invoice->trx}}</a>.
                                </div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center form-label mb-3">
                                    @lang('Fixed Amount')
                                    <span class="ms-1" data-bs-toggle="tooltip" title="Select a fixed amount">
                                        <i class="ti ti-alert-circle text-gray-500 fs-6">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </span>
                                 </label>
                                <!--end::Label-->

                                <!--begin::Row-->
                                <div class="row mb-2" data-kt-buttons="true">
                                    <!--begin::Col-->
                                    <div class="col">
                                        <!--begin::Option-->
                                        <label
                                            class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                                            <input type="radio"  onchange="fixeamount(this)"  class="btn-check" value="200" />

                                            <span class="fw-bold fs-3">200</span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col">
                                        <!--begin::Option-->
                                        <label
                                            class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4 active">
                                            <input type="radio"  onchange="fixeamount(this)"  class="btn-check" value="500" />
                                            <span class="fw-bold fs-3">500</span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col">
                                        <!--begin::Option-->
                                        <label
                                            class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                                            <input type="radio"  onchange="fixeamount(this)"  class="btn-check" value="1000" />
                                            <span class="fw-bold fs-3">1000</span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col">
                                        <!--begin::Option-->
                                        <label
                                            class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                                            <input type="radio"  onchange="fixeamount(this)"  class="btn-check" value="2000" />
                                            <span class="fw-bold fs-3">2000</span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->

                                <!--begin::Hint-->
                                <div class="form-text">
                                    @lang('Select a fixed amount above or enter a custom amount below')
                                </div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group-->
                            @push('script')
                            <script>
                                function fixeamount(e)
                                {
                                document.getElementById("amount").value = e.value;
                                }
                            </script>
                            @endpush
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Enter Amount')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" id="amount"  value="{{$invoice->amount}}" class="form-control form-control-lg form-control-solid  amount @error('amount') is-invalid @enderror" value="{{ old('amount') }}" name="amount" placeholder="0.00" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Purpose ')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-lg form-control-solid  purpose @error('purpose') is-invalid @enderror" id="purpose"
                                    name="purpose" value="{{$invoice->purpose}}"  placeholder="Purpose of invoice" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                             <!--begin::Input group-->
                             <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Status ')</label>
                                <div class="form-check form-switch form-check-custom form-check-solid">

                                    <input @if($invoice->status == 1) checked @endif class="form-check-input" type="checkbox" name="status" id="status"/>
                                    <label class="form-check-label" for="status">
                                        <small class="text-danger">Toggle on switch to make invoice active</small>
                                    </label>
                                </div>
                            </div>
                            <!--end::Input group-->

                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 2-->



                    <!--begin::Actions-->
                    <div class="d-flex flex-stack pt-15">

                        <!--begin::Wrapper-->
                        <div>

                            <button type="submit" class="btn btn-lg btn-primary" type="button" id="submit">@lang('Update Invoice')

                                <i class="ti ti-arrow-right fs-4 ms-1 me-0"><span class="path1"></span><span class="path2"></span></i> </button>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Stepper-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Container-->
<!-- @@ Preview Modal @e -->
<div class="modal fade" tabindex="-1" role="dialog" id="payout-now">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
    <div class="modal-body modal-body-lg">
    <div class="nk-block-head nk-block-head-xs text-center">
    <h5 class="nk-block-title">@lang('Confirm Deposit')</h5>
    <div class="nk-block-text">
        <div class="caption-text">@lang('Please review your payout request and click on Confirm Payout when ready')</div>
    </div>
    </div>
    <div class="nk-block" >
    <div class="card-body showCharge d-none">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>@lang('Method Name')</span>
                <span class="text-danger" id="method"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>@lang('Fixed charge')</span>
                <span class="text-danger" id="fixed_charge"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>@lang('Percentage charge')</span><span class="text-danger"
                                                             id="percentage_charge"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>@lang('Min limit')</span>
                <span class="text-info" id="min_limit"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>@lang('Max limit')</span>
                <span class="text-info" id="max_limit"></span>
            </li>
        </ul>
    </div>

    <div class="buysell-field form-action text-center">
        <div class="mt-3">
            <a class="btn btn-primary"  onclick="document.getElementById('submitnow').click()" >@lang('Confirm Payout')</a>
        </div>
        <div class="pt-3">
            <a href="#" data-bs-dismiss="modal" class="btn btn-danger">@lang('Cancel Payout')</a>
        </div>
    </div>
    </div><!-- .nk-block -->
    </div><!-- .modal-body -->
    </div><!-- .modal-content -->
    </div><!-- .modla-dialog -->
    </div><!-- .modal -->
@endsection
