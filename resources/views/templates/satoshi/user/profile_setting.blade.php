@extends($activeTemplate . 'layouts.app')
@section('panel')
    @include($activeTemplate . 'partials.settings')
<form action="" method="POST" class="form" enctype="multipart/form-data">
                            @csrf 
                    <hr class="my-6">
                    <div class="row align-items-center">
                        <div class="col-md-2"><label class="form-label">First name</label></div>
                        <div class="col-md-8 col-xl-5">
                            <div class=""><input type="text" name="firstname" value="{{ $user->firstname }}" class="form-control"></div>
                        </div>
                    </div>
                    <hr class="my-6">
                    <div class="row align-items-center">
                        <div class="col-md-2"><label class="form-label">Last name</label></div>
                        <div class="col-md-8 col-xl-5">
                            <div class=""><input type="text" name="lastname" value="{{ $user->lastname }}" class="form-control"></div>
                        </div>
                    </div>

                    <hr class="my-6">
                    <div class="row align-items-center">
                        <div class="col-md-2"><label class="form-label">Address</label></div>
                        <div class="col-md-8 col-xl-5">
                            <div class="">
                              <select name="gender" aria-label="Select a Gender" @if (@$user->gender != null) readonly @endif data-control="select2"
                                                data-placeholder="Select a gender..."
                                                class="form-select form-select-solid form-lg fw-semibold">
                                                <option selected disabled>Select Gender</option>
                                                <option @if (@$user->gender == 'Male') selected @endif
                                                   value="Male">Male</option>
                                                   <option @if (@$user->gender == 'Female') selected @endif
                                                      value="Male">Female</option>
                                            </select></div>
                        </div>
                    </div> 
                    <hr class="my-6">
                    <div class="row align-items-center">
                        <div class="col-md-2"><label class="form-label">Country</label></div>
                        <div class="col-md-8 col-xl-5">
                            <div class=""><label class="form-label visually-hidden">Country</label>
                            <select name="country" aria-label="Select a Country" data-control="select2"
                                            data-placeholder="Select a country..."
                                            class="form-select form-select-solid form-lg fw-semibold">
                                            @foreach ($countries as $key => $country)
                                                            <option @if (@$user->address->country == $country->country) selected @endif
                                                                value="{{ $country->country }}"
                                                                data-code="{{ $key }}">
                                                                {{ __($country->country) }}</option>
                                            @endforeach
                                        </select>    
                            </div>
                        </div>
                    </div>
                    <hr class="my-6">
                    <div class="row align-items-center">
                        <div class="col-md-2"><label class="form-label">State</label></div>
                        <div class="col-md-8 col-xl-5">
                            <div class=""><input type="text"  placeholder="state"  name="state" value="{{ @$user->address->state }}" class="form-control"></div>
                        </div>
                    </div> 
                    <hr class="my-6">
                    <div class="row align-items-center">
                        <div class="col-md-2"><label class="form-label">City</label></div>
                        <div class="col-md-8 col-xl-5">
                            <div class=""><input type="text"  placeholder="city"  name="city" value="{{ @$user->address->city }}" class="form-control"></div>
                        </div>
                    </div> 
                    <hr class="my-6">
                    <div class="row align-items-center">
                        <div class="col-md-2"><label class="form-label">Zip Code</label></div>
                        <div class="col-md-8 col-xl-5">
                            <div class=""><input type="text"  placeholder="zip"  name="zip" value="{{ @$user->address->zip }}" class="form-control"></div>
                        </div>
                    </div> 
                    <hr class="my-6">
                    <div class="row align-items-center">
                        <div class="col-md-2"><label class="form-label">Address</label></div>
                        <div class="col-md-8 col-xl-5">
                            <div class=""><input type="text"  placeholder="address"  name="address" value="{{ @$user->address->address }}" class="form-control"></div>
                        </div>
                    </div>  
                    <hr class="my-6">
                    <div class="row align-items-center">
                        <div class="col-md-2"><label class="form-label">Avatar</label></div>
                        <div class="col-md-8 col-xl-5">
                            <div class=""><label class="form-label visually-hidden">Cover</label>
                                <div
                                    class="card shadow-none border-2 border-dashed border-primary-hover position-relative">
                                    <div class="d-flex justify-content-center px-5 py-5">
                                        <label for="cover_upload" class="position-absolute w-100 h-100 top-0 start-0 cursor-pointer"><input name="image" id="cover_upload" type="file" class="visually-hidden"></label>
                                        <div class="text-center">
                                            <div class="text-2xl text-muted">
                                              <img width="50"
                                                src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }}"
                                                alt="#"
                                              />
                                            </div>
                                            <div class="d-flex text-sm mt-3">
                                                <p class="fw-semibold">Upload a file or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 3MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <hr class="my-6 ">
                    <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Theme</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <!--begin::Options-->
                                        <div class="d-flex align-items-center mt-3">
                                            <!--begin::Option-->
                                            <label
                                                class="form-check form-check-custom form-check-inline form-check-solid me-5">
                                                <input class="form-check-input" @if ($user->theme == 'basic') checked @endif type="radio"
                                                name="theme" value="basic" />
                                                <span class="fw-semibold ps-2 fs-6">
                                                    @lang('Basic')
                                                </span>
                                            </label>
                                            <!--end::Option-->

                                            <!--begin::Option-->
                                            <label
                                                class="form-check form-check-custom form-check-inline form-check-solid">
                                                <input class="form-check-input"  @if ($user->theme == 'satoshi') checked @endif type="radio"
                                                name="theme" value="satoshi" />
                                                <span class="fw-semibold ps-2 fs-6">
                                                    @lang('Satoshi')
                                                </span>
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Col-->
                                </div>

                    
                    <hr class="my-6 ">
                    <div class="d-flex   justify-content-end gap-2 mb-6">
                         <button type="submit" class="btn btn-sm btn-primary">Save</button></div>
</form>
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
