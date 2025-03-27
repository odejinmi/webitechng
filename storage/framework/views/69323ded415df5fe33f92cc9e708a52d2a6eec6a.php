
<?php $__env->startSection('panel'); ?>
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
                    <?php echo csrf_field(); ?>

                    <!--begin::Step 2-->
                    <div data-kt-stepper-element="scontent">
                        
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-10 pb-lg-15">
                                <!--begin::Title-->
                                <h2 class="fw-bold text-dark"><?php echo app('translator')->get('P2P Transfer'); ?></h2>
                                <!--end::Title-->

                                <!--begin::Notice-->
                                <div class="text-muted fw-semibold fs-6">
                                    <?php echo app('translator')->get('If you need more info, please check out'); ?>
                                    <a href="#" class="link-primary fw-bold">Help Page</a>.
                                </div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Heading-->
<!--begin::Input group-->
<div class="fv-row">
    <!--begin::Row-->
    <div class="row">
        <!--begin::Col-->
        <div class="col-lg-6">
            <!--begin::Option-->
            <input type="radio" class="btn-check" name="wallet" value="act_wallet" checked="checked" id="act_wallet"/>
            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10" for="act_wallet">
                <i class="ti ti-wallet fs-3x me-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                <!--begin::Info-->
                <span class="d-block fw-semibold text-start">                            
                    <span class="text-dark fw-bold d-block fs-4 mb-2">
                        <?php echo app('translator')->get('Main Wallet'); ?>
                    </span>
                    <span class="text-muted fw-semibold fs-6"><?php echo e($general->cur_sym); ?><?php echo e(showAmount(Auth::user()->balance)); ?></span>
                </span>
                <!--end::Info-->
            </label>   
            <!--end::Option-->
        </div>
        <!--end::Col-->
        
        <!--begin::Col-->
        <div class="col-lg-6">
            <!--begin::Option-->
            <input type="radio" class="btn-check"  name="wallet" value="ref_wallet"  id="ref_wallet"/>
            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center" for="ref_wallet">
                <i class="ti ti-cash fs-3x me-5"><span class="path1"></span><span class="path2"></span></i>
                <!--begin::Info-->
                <span class="d-block fw-semibold text-start">                              
                    <span class="text-dark fw-bold d-block fs-4 mb-2"> <?php echo app('translator')->get('Referral Wallet'); ?></span>
                    <span class="text-muted fw-semibold fs-6"><?php echo e($general->cur_sym); ?><?php echo e(showAmount(Auth::user()->ref_balance)); ?></span>
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
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center form-label mb-3">
                                    <?php echo app('translator')->get('Fixed Amount'); ?> 
                                    <span class="ms-1" data-bs-toggle="tooltip"
                                        title="Select a fixed amount">
                                        <i class="ti ti-alert-circle text-gray-500 fs-6"><span
                                                class="path1"></span><span class="path2"></span><span
                                                class="path3"></span></i></span> </label>
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
                                    <?php echo app('translator')->get('Select a fixed amount above or enter a custom amount below'); ?>
                                </div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group-->
                            <?php $__env->startPush('script'); ?>
                            <script>
                                function fixeamount(e)
                                {
                                document.getElementById("amount").value = e.value;
                                }
                            </script>
                            <?php $__env->stopPush(); ?>
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3"><?php echo app('translator')->get('Enter Amount'); ?></label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" id="amount" class="form-control form-control-lg form-control-solid  amount <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('amount')); ?>" name="amount" placeholder="0.00" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group--> 

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3"><?php echo app('translator')->get('Recipient\'s Username or Email'); ?></label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-lg form-control-solid  username <?php $__errorArgs = ['recipient'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="recipient"
                                    name="recipient" value="<?php echo e(old('recipient')); ?>" placeholder="Beneficiary" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->


                            <!--begin::Section-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3" data-kt-translate="two-step-label"><?php echo app('translator')->get('Type your transaction code'); ?></label>
                                <!--end::Label-->

                                <!--begin::Input group-->
                                <div class="d-flex flex-wrap flex-stack">  
                                    <input type="text" class="form-control form-control-lg form-control-solid  username <?php $__errorArgs = ['pin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="pin"
                                    name="pin" value="<?php echo e(old('pin')); ?>" placeholder="****" /> 
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

                            <button type="submit" class="btn btn-lg btn-primary" type="button" id="submit"><?php echo app('translator')->get('Proceed'); ?>
                                
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/p2p/create.blade.php ENDPATH**/ ?>