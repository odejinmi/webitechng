<?php $__env->startSection('panel'); ?>

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid " id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class=" container-xxl ">

                <!--begin::Navbar-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        <!--begin::Details-->
                        <div class="d-flex flex-wrap flex-sm-nowrap">
                            <!--begin: Pic-->
                            <div class="me-7 mb-4">
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                    <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile'))); ?>" alt="image" />
                                    <div
                                        class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                                    </div>
                                </div>
                            </div>
                            <!--end::Pic-->

                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Name-->
                                        <div class="d-flex align-items-center mb-2">
                                            <a href="#"
                                                class="text-gray-900 text-hover-primary fs-2 fw-bold me-1"><?php echo e(__($user->fullname)); ?></a>
                                            <a href="#"><i class="ti ti-shield fs-1 text-primary"><span
                                                        class="path1"></span><span class="path2"></span></i></a>
                                        </div>
                                        <!--end::Name-->

                                        <!--begin::Info-->
                                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                                <i class="ti ti-user fs-4 me-1"><span
                                                        class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span></i> <?php echo e(__($user->username)); ?>

                                            </a>
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                                <i class="ti ti-map-pin fs-4 me-1"><span
                                                        class="path1"></span><span class="path2"></span></i> <?php echo e(__($user->address->country)); ?>

                                            </a>
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                                <i class="ti ti-mail fs-4"><span class="path1"></span><span
                                                        class="path2"></span></i> <?php echo e(__($user->email)); ?>

                                            </a>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->

                                    <!--begin::Actions-->
                                    <div class="d-flex my-4">

                                        <a href="<?php echo e(route('user.deposit.index')); ?>" class="btn btn-sm btn-primary me-3"><?php echo app('translator')->get('Fund Wallet'); ?></a>

                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Title-->

                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap flex-stack">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column flex-grow-1 pe-8">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap">
                                            <!--begin::Stat-->
                                            <div
                                                class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <!--begin::Number-->
                                                <div class="d-flex align-items-center">
                                                    <i class="ti ti-wallet fs-3 text-success me-2"><span
                                                            class="path1"></span><span class="path2"></span></i>
                                                    <div class="fs-2 fw-bold" data-kt-countup="true"
                                                        data-kt-countup-value="<?php echo e((Auth::user()->balance)); ?>" data-kt-countup-prefix="<?php echo e($general->cur_sym); ?>">0</div>
                                                </div>
                                                <!--end::Number-->

                                                <!--begin::Label-->
                                                <div class="fw-semibold fs-6 text-gray-400"><?php echo app('translator')->get('Main Wallet'); ?></div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Stat-->

                                            <!--begin::Stat-->
                                            <div
                                                class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <!--begin::Number-->
                                                <div class="d-flex align-items-center">
                                                    <i class="ti ti-wallet fs-3 text-danger me-2"><span
                                                            class="path1"></span><span class="path2"></span></i>
                                                    <div class="fs-2 fw-bold" data-kt-countup="true"
                                                        data-kt-countup-value="<?php echo e((Auth::user()->ref_balance)); ?>" data-kt-countup-prefix="<?php echo e($general->cur_sym); ?>">0</div>
                                                </div>
                                                <!--end::Number-->

                                                <!--begin::Label-->
                                                <div class="fw-semibold fs-6 text-gray-400"><?php echo app('translator')->get('Referral Wallet'); ?></div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Stat-->
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Wrapper-->

                                    <!--begin::Progress-->
                                    <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                            <span class="fw-semibold fs-6 text-gray-400">Profile Compleation</span>
                                            <span class="fw-bold fs-6">100%</span>
                                        </div>

                                        <div class="h-5px mx-3 w-100 bg-light mb-3">
                                            <div class="bg-success rounded h-5px" role="progressbar" style="width: 100%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!--end::Progress-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Details-->
                    </div>
                </div>
                <!--end::Navbar-->
                <!--begin::Basic info-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0"><?php echo app('translator')->get('Profile Details'); ?></h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->

                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form action="" method="POST" class="form" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6"><?php echo app('translator')->get('Avatar'); ?></label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                            style="background-image: url('<?php echo e(getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile'))); ?>')">
                                            <!--begin::Preview existing avatar-->
                                            <div class="image-input-wrapper w-125px h-125px"
                                                style="background-image: url('<?php echo e(getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile'))); ?>')"></div>
                                            <!--end::Preview existing avatar-->

                                            <!--begin::Label-->
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change avatar">
                                                <i class="ti ti-pencil fs-7"><span class="path1"></span><span
                                                        class="path2"></span></i>
                                                <!--begin::Inputs-->
                                                <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Cancel-->
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                title="Cancel avatar">
                                                <i class="ti ti-x fs-2"><span class="path1"></span><span
                                                        class="path2"></span></i> </span>
                                            <!--end::Cancel-->

                                            <!--begin::Remove-->
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                title="Remove avatar">
                                                <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span
                                                        class="path2"></span></i> </span>
                                            <!--end::Remove-->
                                        </div>
                                        <!--end::Image input-->

                                        <!--begin::Hint-->
                                        <div class="form-text"><?php echo app('translator')->get('Allowed file types: png, jpg, jpeg.'); ?></div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6"><?php echo app('translator')->get('Full Name'); ?></label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-6 fv-row">
                                                <input type="text"
                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                    placeholder="First name"  name="firstname" value="<?php echo e($user->firstname); ?>" />
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-lg-6 fv-row">
                                                <input type="text"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Last name" name="lastname" value="<?php echo e($user->lastname); ?>" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Gender</span>


                                        <span class="ms-1" data-bs-toggle="tooltip" title="Gender">
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span></i></span> </label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <select name="gender" aria-label="Select a Gender" <?php if(@$user->gender != null): ?> readonly <?php endif; ?> data-control="select2"
                                            data-placeholder="Select a gender..."
                                            class="form-select form-select-solid form-lg fw-semibold">
                                            <option selected disabled>Select Gender</option>
                                            <option <?php if(@$user->gender == 'Male'): ?> selected <?php endif; ?>
                                               value="Male">Male</option>
                                               <option <?php if(@$user->gender == 'Female'): ?> selected <?php endif; ?>
                                                  value="Male">Female</option>
                                        </select>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->


                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6"><?php echo app('translator')->get('Date Of Birth'); ?></label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" placeholder="YYYY-MM-DD" class="form-control form-control-lg form-control-solid" name="dob" value="<?php echo e($user->dob); ?>" <?php if($user->dob != null): ?> readonlys <?php endif; ?>  />
                                    </div>
                                    <!--end::Col-->
                                </div>

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6"><?php echo app('translator')->get('City'); ?></label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" class="form-control form-control-lg form-control-solid" name="city" value="<?php echo e($user->address->city); ?>"  />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                 <!--begin::Input group-->
                                 <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6"><?php echo app('translator')->get('Zip Code'); ?></label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" class="form-control form-control-lg form-control-solid" name="zip" value="<?php echo e($user->address->zip); ?>"  />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                 <!--begin::Input group-->
                                 <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6"><?php echo app('translator')->get('Address'); ?></label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" class="form-control form-control-lg form-control-solid" name="address" value="<?php echo e($user->address->address); ?>"  />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                 <!--begin::Input group-->
                                 <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6"><?php echo app('translator')->get('State'); ?></label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" class="form-control form-control-lg form-control-solid" name="state" value="<?php echo e($user->address->state); ?>"  />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->



                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Country</span>


                                        <span class="ms-1" data-bs-toggle="tooltip" title="Country of origination">
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span></i></span> </label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <select name="country" aria-label="Select a Country" data-control="select2"
                                            data-placeholder="Select a country..."
                                            class="form-select form-select-solid form-lg fw-semibold">
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if(@$user->address->country == $country->country): ?> selected <?php endif; ?>
                                                                value="<?php echo e($country->country); ?>"
                                                                data-code="<?php echo e($key); ?>">
                                                                <?php echo e(__($country->country)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->



                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Communication</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <!--begin::Options-->
                                        <div class="d-flex align-items-center mt-3">
                                            <!--begin::Option-->
                                            <label
                                                class="form-check form-check-custom form-check-inline form-check-solid me-5">
                                                <input class="form-check-input" <?php if($user->en == 1): ?> checked <?php endif; ?> type="checkbox"
                                                name="en" value="1" />
                                                <span class="fw-semibold ps-2 fs-6">
                                                    <?php echo app('translator')->get('Email'); ?>
                                                </span>
                                            </label>
                                            <!--end::Option-->

                                            <!--begin::Option-->
                                            <label
                                                class="form-check form-check-custom form-check-inline form-check-solid">
                                                <input class="form-check-input"  <?php if($user->sn == 1): ?> checked <?php endif; ?> type="checkbox"
                                                name="sn" value="1" />
                                                <span class="fw-semibold ps-2 fs-6">
                                                    <?php echo app('translator')->get('Phone'); ?>
                                                </span>
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->


                                 <!--begin::Input group-->
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
                                                <input class="form-check-input" <?php if($user->theme == 'basic'): ?> checked <?php endif; ?> type="radio"
                                                name="theme" value="basic" />
                                                <span class="fw-semibold ps-2 fs-6">
                                                    <?php echo app('translator')->get('Basic'); ?>
                                                </span>
                                            </label>
                                            <!--end::Option-->

                                            <!--begin::Option-->
                                            <label
                                                class="form-check form-check-custom form-check-inline form-check-solid">
                                                <input class="form-check-input"  <?php if($user->theme == 'satoshi'): ?> checked <?php endif; ?> type="radio"
                                                name="theme" value="satoshi" />
                                                <span class="fw-semibold ps-2 fs-6">
                                                    <?php echo app('translator')->get('Satoshi'); ?>
                                                </span>
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--end::Card body-->

                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset"
                                    class="btn btn-light btn-active-light-primary me-2"><?php echo app('translator')->get('Discard'); ?></button>
                                <button type="submit" class="btn btn-primary"
                                    id="kt_account_profile_details_submit"><?php echo app('translator')->get('Save Changes'); ?></button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Basic info-->
                <!--begin::Sign-in Method-->
                <div class="card  mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_signin_method">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0"><?php echo app('translator')->get('Account Security'); ?></h3>
                        </div>
                    </div>
                    <!--end::Card header-->

                    <!--begin::Content-->
                    <div id="kt_account_settings_signin_method" class="collapse show">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Email Address-->
                            <div class="d-flex flex-wrap align-items-center">
                                <!--begin::Label-->
                                <div id="kt_signin_email">
                                    <div class="fs-6 fw-bold mb-1"><?php echo app('translator')->get('Transaction Pin'); ?></div>
                                    <div class="fw-semibold text-gray-600">******</div>
                                </div>
                                <!--end::Label-->

                                <!--begin::Edit-->
                                <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                    <!--begin::Form-->
                                    <form id="kt_change_pin" action="<?php echo e(route('user.change.trxpassword')); ?>" class="form" method="POST"
                                        enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row mb-6">
                                            <div class="col-lg-6 mb-4 mb-lg-0">
                                                <div class="fv-row mb-0">
                                                    <label for="password" class="form-label fs-6 fw-bold mb-3"><?php echo app('translator')->get('Enter Account Password'); ?></label>
                                                    <input type="password" name="password"
                                                        class="form-control form-control-lg form-control-solid"
                                                        id="password" placeholder="*********" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="fv-row mb-0">
                                                    <label for="pin"
                                                        class="form-label fs-6 fw-bold mb-3"><?php echo app('translator')->get('Enter New Transaction PIN'); ?></label>
                                                    <input type="number"
                                                        class="form-control form-control-lg form-control-solid"
                                                        name="pin" id="pin" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <button id="kt_pin_submit" type="submit"
                                                class="btn btn-primary  me-2 px-6"><?php echo app('translator')->get('Update PIN'); ?></button>
                                            <button id="kt_signin_cancel" type="button"
                                                class="btn btn-color-gray-400 btn-active-light-primary px-6"><?php echo app('translator')->get('Cancel'); ?></button>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Edit-->

                                <!--begin::Action-->
                                <div id="kt_signin_email_button" class="ms-auto">
                                    <button class="btn btn-light btn-active-light-primary"><?php echo app('translator')->get('Reset PIN'); ?></button>
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Email Address-->
                            <?php $__env->startPush('script'); ?>
                            <script src="<?php echo e(asset('assets/assets/dist/js/password.js')); ?>"></script>
                            <?php $__env->stopPush(); ?>

                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-6"></div>
                            <!--end::Separator-->

                            <!--begin::Password-->
                            <div class="d-flex flex-wrap align-items-center mb-10">
                                <!--begin::Label-->
                                <div id="kt_signin_password">
                                    <div class="fs-6 fw-bold mb-1">Password</div>
                                    <div class="fw-semibold text-gray-600">************</div>
                                </div>
                                <!--end::Label-->

                                <!--begin::Edit-->
                                <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                    <!--begin::Form-->
                                    <form  id="kt_signin_change_password" class="form" novalidate="novalidate" action="<?php echo e(route('user.change.password')); ?>" method="POST"  enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                        <div class="row mb-1">
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="current_password"
                                                        class="form-label fs-6 fw-bold mb-3"><?php echo app('translator')->get('Current Password'); ?></label>
                                                    <input type="password"
                                                        class="form-control form-control-lg form-control-solid "
                                                        name="current_password" id="current_password" />
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="password" class="form-label fs-6 fw-bold mb-3"><?php echo app('translator')->get('New
                                                        Password'); ?></label>
                                                    <input type="password"
                                                        class="form-control form-control-lg form-control-solid "
                                                        name="password" id="password" />
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="password_confirmation"
                                                        class="form-label fs-6 fw-bold mb-3"><?php echo app('translator')->get('Confirm New Password'); ?></label>
                                                    <input type="password"
                                                        class="form-control form-control-lg form-control-solid "
                                                        name="password_confirmation" id="password_confirmation" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-text mb-5"><?php echo app('translator')->get('Password must be at least 8 character and contain
                                            symbols'); ?></div>

                                        <div class="d-flex">
                                            <button type="submit" id="kt_password_submit" class="btn btn-primary me-2 px-6"><?php echo app('translator')->get('Update Password'); ?></button>
                                            <button id="kt_password_cancel" type="button"
                                                class="btn btn-color-gray-400 btn-active-light-primary px-6"><?php echo app('translator')->get('Cancel'); ?></button>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Edit-->

                                <!--begin::Action-->
                                <div id="kt_signin_password_button" class="ms-auto">
                                    <button class="btn btn-light btn-active-light-primary"><?php echo app('translator')->get('Reset Password'); ?></button>
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Password-->


                            <!--begin::Notice-->
                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed  p-6">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-shield-tick fs-2tx text-primary me-4"><span
                                        class="path1"></span><span class="path2"></span></i> <!--end::Icon-->

                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                    <!--begin::Content-->
                                    <div class="mb-3 mb-md-0 fw-semibold">
                                        <h4 class="text-gray-900 fw-bold"><?php echo app('translator')->get('Secure Your Account'); ?></h4>

                                        <div class="fs-6 text-gray-700 pe-7">Two-factor authentication adds an extra layer
                                            of security to your account. To log in, in addition you'll need to provide a 6
                                            digit code</div>
                                    </div>
                                    <!--end::Content-->

                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-primary px-6 align-self-center text-nowrap"
                                        data-bs-toggle="modal" data-bs-target="#kt_modal_two_factor_authentication">
                                        Enable </a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Notice-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Sign-in Method-->

                <!--begin::Deactivate Account-->
                <div class="card  ">


                    <!--begin::Modal - Two-factor authentication-->
<div class="modal fade" id="kt_modal_two_factor_authentication" tabindex="-1" aria-hidden="true">
    <!--begin::Modal header-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header flex-stack">
                <!--begin::Title-->
                <h2><?php echo app('translator')->get('Google Two Factor Authentication'); ?></h2>
                <!--end::Title-->

                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body scroll-y pt-10 pb-15 px-lg-17">
               <div class="row">


<!--begin::Apps-->
<div class="d-wnone" data-kt-element="apps">
    <!--begin::Heading-->
    <h3 class="text-dark fw-bold mb-7">
        <?php if(auth()->user()->ts): ?>  <?php echo app('translator')->get('Disabled Google 2FA'); ?> <?php else: ?>  <?php echo app('translator')->get('Enable Google 2FA'); ?> <?php endif; ?>
    </h3>
    <!--end::Heading-->
    <?php if(!auth()->user()->ts): ?>
    <!--begin::Description-->
    <div class="text-gray-500 fw-semibold fs-6 mb-10">
        <?php echo app('translator')->get('Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device'); ?> <a class="text--base"
        href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
        target="_blank">Download</a>

        <!--begin::QR code image-->
        <div class="pt-5 text-center">
            <img src="<?php echo e($qrCodeUrl); ?>" alt="" class="mw-150px"/>
        </div>
        <!--end::QR code image-->
    </div>
    <!--end::Description-->



<!--begin::Notice-->
<div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-10 p-6">
            <!--begin::Icon-->
        <i class="ti ti-alert-circle fs-2tx text-warning me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>        <!--end::Icon-->

    <!--begin::Wrapper-->
    <div class="d-flex flex-stack flex-grow-1 ">
                    <!--begin::Content-->
            <div class=" fw-semibold">

                                    <div class="fs-6 text-gray-700 ">If you having trouble using the QR code, select manual entry on your app, and enter your username and the code: <div class="fw-bold text-dark pt-2"><?php echo e($secret); ?></div></div>
                            </div>
            <!--end::Content-->

            </div>
    <!--end::Wrapper-->
</div>
<?php endif; ?>
<?php if(auth()->user()->ts): ?>
    <!--begin::Form-->
    <form class="form" action="<?php echo e(route('user.twofactor.disable')); ?>" method="POST">
        <?php echo csrf_field(); ?>


        <div class="form-group mb-3">
            <label class="form-label"><?php echo app('translator')->get('Setup Key'); ?></label>
            <div class="input-group">
                <input type="text" name="key" value="<?php echo e($secret); ?>" class="form-control form--control referralURL" readonly>
                <button type="button" class="btn btn-primary input-group-text copytext" id="copyBoard"> <i class="ti ti-copy"></i> </button>
            </div>
        </div>
        <!--begin::Input group-->
        <div class="mb-10 fv-row">
            <label><?php echo app('translator')->get('Google Authenticatior OTP'); ?></label>
            <input type="text" name="code"  class="form-control form-control-lg form-control-solid" placeholder="Enter authentication code" name="code"/>
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="d-flex flex-center">
            <button type="reset" data-kt-element="apps-cancel" class="btn btn-light me-3">
               <?php echo app('translator')->get('Cancel'); ?>
            </button>
            <button type="submit" data-kt-element="apps-submit" class="btn btn-primary">
                <span class="indicator-label">
                   <?php echo app('translator')->get('Submit'); ?>
                </span>
            </button>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
<?php else: ?>
 <!--begin::Form-->
 <form class="form" action="<?php echo e(route('user.twofactor.enable')); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <div class="form-group mb-3">
        <label class="form-label"><?php echo app('translator')->get('Setup Key'); ?></label>
        <div class="input-group">
            <input type="text" name="key" value="<?php echo e($secret); ?>"
                class="form-control form--control referralURL" readonly>
            <button type="button"
                class="btn btn-primary input-group-text copytext"
                id="copyBoard"> <i class="ti ti-copy"></i> </button>
        </div>
    </div>

    <!--begin::Input group-->
    <div class="mb-10 fv-row">
        <label><?php echo app('translator')->get('Google Authenticatior OTP'); ?></label>
        <input type="text" name="code"  class="form-control form-control-lg form-control-solid" placeholder="Enter authentication code" name="code"/>
    </div>
    <!--end::Input group-->


    <!--begin::Actions-->
    <div class="d-flex flex-center">
        <button type="reset" data-kt-element="apps-cancel" class="btn btn-light me-3">
           <?php echo app('translator')->get('Cancel'); ?>
        </button>
        <button type="submit" data-kt-element="apps-submit" class="btn btn-primary">
            <span class="indicator-label">
               <?php echo app('translator')->get('Submit'); ?>
            </span>
        </button>
    </div>
    <!--end::Actions-->
</form>
<!--end::Form-->
<?php endif; ?>
</div>
<!--end::Options-->
               </div>

            </div></div></div></div>

              <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
              data-bs-target="#kt_account_deactivate" aria-expanded="true"
              aria-controls="kt_account_deactivate">
              <div class="card-title m-0">
                  <h3 class="fw-bold m-0"><?php echo app('translator')->get('Deactivate Account'); ?></h3>
              </div>
          </div>
          <!--end::Card header-->

                    <!--begin::Content-->
                    <div id="kt_account_settings_deactivate" class="collapse show">
                        <!--begin::Form-->
                        <form class="form" action="<?php echo e(route('user.account.deactivate')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">

                                <!--begin::Notice-->
                                <div
                                    class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                    <!--begin::Icon-->
                                    <i class="ki-duotone ki-information fs-2tx text-warning me-4"><span
                                            class="path1"></span><span class="path2"></span><span
                                            class="path3"></span></i> <!--end::Icon-->

                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-grow-1 ">
                                        <!--begin::Content-->
                                        <div class=" fw-semibold">
                                            <h4 class="text-gray-900 fw-bold"><?php echo app('translator')->get('You Are Deactivating Your Account'); ?></h4>

                                            <div class="fs-6 text-gray-700 "><?php echo app('translator')->get('By clicking on the deactivate button below, you are concenting to deactivating your account. Please proceed with caution'); ?></div>
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Notice-->

                                <div class="form-group mb-3">
                                    <label class="form-label"><?php echo app('translator')->get('Account Password'); ?></label>
                                    <div class="input-group">
                                        <input type="password" name="password"
                                            class="form-control form--control">
                                        <button type="button"
                                            class="btn btn-primary input-group-text"> <i class="ti ti-key"></i> </button>
                                    </div>
                                </div>
                                <!--end::Notice-->
                                <!--begin::Form input row-->
                                <div class="form-check form-check-solid fv-row">
                                    <input name="deactivate" required class="form-check-input" type="checkbox" value=""
                                        id="deactivate" />
                                    <label class="form-check-label fw-semibold ps-2 fs-6" for="deactivate"><?php echo app('translator')->get('I confirm my
                                        account deactivation'); ?></label>
                                </div>
                                <!--end::Form input row-->
                            </div>
                            <!--end::Card body-->

                            <!--begin::Card footer-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button id="deactivate" type="submit"
                                    class="btn btn-danger fw-semibold"><?php echo app('translator')->get('Deactivate Account'); ?></button>
                            </div>
                            <!--end::Card footer-->

                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Deactivate Account-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/profile_setting.blade.php ENDPATH**/ ?>