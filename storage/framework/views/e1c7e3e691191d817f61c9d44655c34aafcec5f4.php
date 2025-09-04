<?php $__env->startSection('panel'); ?>
    <?php echo $__env->make($activeTemplate . 'partials.settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<form action="" method="POST" class="form" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?> 
                    <hr class="my-6">
                    <div class="row align-items-center">
                        <div class="col-md-2"><label class="form-label">First name</label></div>
                        <div class="col-md-8 col-xl-5">
                            <div class=""><input type="text" name="firstname" value="<?php echo e($user->firstname); ?>" class="form-control"></div>
                        </div>
                    </div>
                    <hr class="my-6">
                    <div class="row align-items-center">
                        <div class="col-md-2"><label class="form-label">Last name</label></div>
                        <div class="col-md-8 col-xl-5">
                            <div class=""><input type="text" name="lastname" value="<?php echo e($user->lastname); ?>" class="form-control"></div>
                        </div>
                    </div>

                    <hr class="my-6">
                    <div class="row align-items-center">
                        <div class="col-md-2"><label class="form-label">Address</label></div>
                        <div class="col-md-8 col-xl-5">
                            <div class="">
                              <select name="gender" aria-label="Select a Gender" <?php if(@$user->gender != null): ?> readonly <?php endif; ?> data-control="select2"
                                                data-placeholder="Select a gender..."
                                                class="form-select form-select-solid form-lg fw-semibold">
                                                <option selected disabled>Select Gender</option>
                                                <option <?php if(@$user->gender == 'Male'): ?> selected <?php endif; ?>
                                                   value="Male">Male</option>
                                                   <option <?php if(@$user->gender == 'Female'): ?> selected <?php endif; ?>
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
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if(@$user->address->country == $country->country): ?> selected <?php endif; ?>
                                                                value="<?php echo e($country->country); ?>"
                                                                data-code="<?php echo e($key); ?>">
                                                                <?php echo e(__($country->country)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>    
                            </div>
                        </div>
                    </div>
                    <hr class="my-6">
                    <div class="row align-items-center">
                        <div class="col-md-2"><label class="form-label">State</label></div>
                        <div class="col-md-8 col-xl-5">
                            <div class=""><input type="text"  placeholder="state"  name="state" value="<?php echo e(@$user->address->state); ?>" class="form-control"></div>
                        </div>
                    </div> 
                    <hr class="my-6">
                    <div class="row align-items-center">
                        <div class="col-md-2"><label class="form-label">City</label></div>
                        <div class="col-md-8 col-xl-5">
                            <div class=""><input type="text"  placeholder="city"  name="city" value="<?php echo e(@$user->address->city); ?>" class="form-control"></div>
                        </div>
                    </div> 
                    <hr class="my-6">
                    <div class="row align-items-center">
                        <div class="col-md-2"><label class="form-label">Zip Code</label></div>
                        <div class="col-md-8 col-xl-5">
                            <div class=""><input type="text"  placeholder="zip"  name="zip" value="<?php echo e(@$user->address->zip); ?>" class="form-control"></div>
                        </div>
                    </div> 
                    <hr class="my-6">
                    <div class="row align-items-center">
                        <div class="col-md-2"><label class="form-label">Address</label></div>
                        <div class="col-md-8 col-xl-5">
                            <div class=""><input type="text"  placeholder="address"  name="address" value="<?php echo e(@$user->address->address); ?>" class="form-control"></div>
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
                                                src="<?php echo e(getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile'))); ?>"
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

                    
                    <hr class="my-6 ">
                    <div class="d-flex   justify-content-end gap-2 mb-6">
                         <button type="submit" class="btn btn-sm btn-primary">Save</button></div>
</form>
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

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/templates/satoshi/user/profile_setting.blade.php ENDPATH**/ ?>