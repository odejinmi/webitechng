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
                                <h2 class="fw-bold text-dark">@lang('Virtual Card')</h2>
                                <!--end::Title-->

                                <!--begin::Notice-->
                                <div class="text-muted fw-semibold fs-6">
                                    @lang('If you need more info, please check out')
                                    <a href="#" class="link-primary fw-bold">Help Page</a>.
                                </div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Heading--> 

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Card Type')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select type="text" class="form-control form-control-lg form-control-solid  username @error('card') is-invalid @enderror" id="card"
                                    name="type">
                                    <option selected disabled>Select An Option</option>
                                    <option value="Verve">Verve (NGN)</option>
                                    <option value="MasterCard" disabled>MasterCard (USD)</option>
                                    <option value="visa">Visa (USD)</option>
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Section-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3" data-kt-translate="two-step-label">@lang('Type your 11 digit BVN')</label>
                                <!--end::Label-->

                                <!--begin::Input group-->
                                <div class="d-flex flex-wrap flex-stack">                      
                                    <input  type="text" name="bvn" maxlength="11" class="form-control form-control-solid"/>
                                </div>                
                                <!--begin::Input group-->
                            </div>
                            <!--end::Section-->


                            <!--begin::Section-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3" data-kt-translate="two-step-label">@lang('Type your 6 digit Transaction PIN')</label>
                                <!--end::Label-->

                                <!--begin::Input group-->
                                <div class="d-flex flex-wrap flex-stack">                      
                                    <input  type="text" name="code_1" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-40px w-40px fs-2qx text-center border-primary border-hover mx-1 my-2" value=""/>
                                    <input  type="text" name="code_2" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-40px w-40px fs-2qx text-center border-primary border-hover mx-1 my-2" value=""/>
                                    <input  type="text" name="code_3" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-40px w-40px fs-2qx text-center border-primary border-hover mx-1 my-2" value=""/> 
                                    <input  type="text" name="code_4" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-40px w-40px fs-2qx text-center border-primary border-hover mx-1 my-2" value=""/> 
                                    <input  type="text" name="code_5" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-40px w-40px fs-2qx text-center border-primary border-hover mx-1 my-2" value=""/>                     
                                    <input  type="text" name="code_6" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-40px w-40px fs-2qx text-center border-primary border-hover mx-1 my-2" value=""/> 
                                </div>                
                                <!--begin::Input group-->
                            </div>
                            <!--end::Section-->

                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 2-->



                    <!--begin::Actions-->
                    <div class="d-flex flex-stack pt-15">
 
                        <!--begin::Wrapper-->
                        <div>

                            <button type="submit" class="btn btn-lg btn-primary" type="button" id="submit">@lang('Proceed')
                                
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

@push('breadcrumb-plugins')
<a class="btn btn-sm btn-primary" href="{{ route('user.virtualcard.history') }}"> <i class="ti ti-printer"></i> @lang('My Card')</a>
@endpush
