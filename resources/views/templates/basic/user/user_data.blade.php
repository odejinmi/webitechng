@extends($activeTemplate . 'layouts.app')
@section('panel')

<div class="card pt-4 mb-6 mb-xl-9">
    <!--begin::Card header-->
    <div class="card-header border-0">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>{{ __($pageTitle) }}</h2>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0 pb-5">
        <!--begin::Form-->
            <form method="POST" action="{{ route('user.data.submit') }}" enctype="multipart/form-data">
                @csrf
            <!--begin::Input group-->
            <div class="mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold mb-2">
                    <span>Update Avatar</span>

                    <span class="ms-1" data-bs-toggle="tooltip" title="Allowed file types: png, jpg, jpeg.">
                        <i class="ti ti-alert-circle fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                    </span>
                </label>
                <!--end::Label-->

                <!--begin::Image input wrapper-->
                <div class="mt-1">
                    <!--begin::Image input placeholder-->
                    <style>.image-input-placeholder {
                            background-image: url('{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }}');
                        }

                        [data-bs-theme="dark"] .image-input-placeholder {
                            background-image: url('{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }}');
                        }
                    </style>
                    <!--end::Image input placeholder-->

                    <!--begin::Image input-->
                    <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                        <!--begin::Preview existing avatar-->
                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }}')"></div>
                        <!--end::Preview existing avatar-->

                        <!--begin::Edit-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                            <i class="ti ti-upload fs-7"><span class="path1"></span><span class="path2"></span></i>
                            <!--begin::Inputs-->
                            <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="avatar_remove" />
                            <!--end::Inputs-->
                        </label>
                        <!--end::Edit-->

                        <!--begin::Cancel-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                            <i class="ti ti-x fs-2"><span class="path1"></span><span class="path2"></span></i>                        </span>
                        <!--end::Cancel-->

                        <!--begin::Remove-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                            <i class="ti ti-x fs-2"><span class="path1"></span><span class="path2"></span></i>                        </span>
                        <!--end::Remove-->
                    </div>
                    <!--end::Image input-->
                </div>
                <!--end::Image input wrapper-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold mb-2 required">@lang('First Name')</label>
                <!--end::Label-->

                <!--begin::Input-->
                <input type="text" class="form-control form-control-solid" name="firstname" value="{{ old('firstname') }}" placeholder="@lang('Enter First Name')" required />
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold mb-2 required">@lang('Last Name')</label>
                <!--end::Label-->

                <!--begin::Input-->
                <input type="text" class="form-control form-control-solid" name="lastname" value="{{ old('lastname') }}" placeholder="@lang('Enter Last Name')" required />
                <!--end::Input-->
            </div>
            <!--end::Input group-->

            <!--begin::Row-->
            <div class="row row-cols-1 row-cols-md-2">
                <!--begin::Col-->
                <div class="col">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold mb-2">
                            <span class="required">@lang('Address')</span>

                            <span class="ms-1" data-bs-toggle="tooltip" title="Enter a correct address">
                                <i class="ti ti-alert-circle fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                            </span>
                        </label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid"  name="address" value="{{ old('address') }}"placeholder="@lang('Enter Your Address')" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold mb-2">
                            <span>@lang('State')</span>

                            <span class="ms-1" data-bs-toggle="tooltip" title="Enter your state">
                                <i class="ti ti-alert-circle fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                            </span>
                        </label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input type="test" class="form-control form-control-solid" name="state" value="{{ old('state') }}"placeholder="@lang('Enter Your State')" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold mb-2">
                            <span>@lang('City')</span>

                            <span class="ms-1" data-bs-toggle="tooltip" title="Enter a valid city name">
                                <i class="ti ti-alert-circle fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                            </span>
                        </label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input type="test" class="form-control form-control-solid" name="city" value="{{ old('city') }}"placeholder="@lang('Enter Your City')" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold mb-2">
                            <span>@lang('Zip Code')</span>

                            <span class="ms-1" data-bs-toggle="tooltip" title="Zip code must be valid">
                                <i class="ti ti-alert-circle fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                            </span>
                        </label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input type="test" class="form-control form-control-solid" name="zip" value="{{ old('zip') }}"placeholder="@lang('Enter Your Zip Code')" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <div class="d-flex justify-content-end">
            <!--begin::Button-->
            <button type="submit" class="btn btn-light-primary">
                <span class="indicator-label">
                    Save
                </span>
            </button>
            <!--end::Button-->
            </div>
        </form>
        <!--end::Form-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
@endsection
