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
                    <form  class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" action="" method="post"  enctype="multipart/form-data">
                    @csrf

                    <!--begin::Step 2-->
                    <div data-kt-stepper-element="scontent">
                        
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-10 pb-lg-15">
                                <!--begin::Title-->
                                <h2 class="fw-bold text-dark">@lang('Create Storefront')</h2>
                                <!--end::Title-->

                                <!--begin::Notice-->
                                <div class="text-muted fw-semibold fs-6">
                                    @lang('Please fill the form below to create your storefront.')
                                    <a href="#" class="link-primary fw-bold">Help Page</a>.
                                </div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Heading--> 
                            
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Storefront Name')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" id="name" class="form-control form-control-lg form-control-solid  name @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="Enter Name" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group--> 

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Storefont Details ')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea type="text" class="form-control form-control-lg form-control-solid  details @error('details') is-invalid @enderror" id="details"
                                    name="details" value="{{ old('details') }}" placeholder="Enter Storefont Details" ></textarea>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->  

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Storefront Logo')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="file" id="logo" class="form-control form-control-lg form-control-solid  logo @error('logo') is-invalid @enderror" name="logo" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->   

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Storefront Header Image')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="file"  class="form-control form-control-lg form-control-solid  @error('header') is-invalid @enderror" name="header" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group--> 

                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 2-->



                    <div class="alert alert-info" role="alert">
                        <strong>Note - </strong> @lang('The default store front currency is ') {{$general->cur_text}} <br>
                       <b> @lang('Purchase made for any product from the storefront will be debited from customer\'s wallet balance ')</b>
                    </div>
                    <!--begin::Actions-->
                    <div class="d-flex flex-stack pt-15">
                        <!--begin::Wrapper-->
                        <div>
                            <button type="submit" class="btn btn-lg btn-primary" type="button" id="submit">@lang('Create')
                               <i class="ti ti-arrow-right fs-4 ms-1 me-0"><span class="path1"></span><span class="path2"></span></i> 
                            </button>
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
 
@endsection
