
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
                                <h2 class="fw-bold text-dark"><?php echo app('translator')->get('Request New Account'); ?></h2>
                                <!--end::Title-->

                                <!--begin::Notice-->
                                <div class="text-muted fw-semibold fs-6">
                                    <?php echo app('translator')->get('Please fill the form below to request new account details.'); ?>
                                    <a href="#" class="link-primary fw-bold">Help Page</a>.
                                </div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Heading-->    
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center form-label mb-3">
                                    <?php echo app('translator')->get('Fixed Amount'); ?> 
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
                            <script>
                                function submitform() { 
                                    var amount = document.getElementById('amount').value; 
                                    if(amount < 1)
                                    {
                                        SlimNotifierJs.notification(`error`, `error`,`Please specify amount first`, 3000);
                                        return;
                                    } 
                                    var account = document.getElementById('account'); 
                                    if(account == '')
                                    {
                                        return;
                                    }
                                    var fee = account.selectedOptions[0].getAttribute("data-fee");
                                    var currency = account.selectedOptions[0].getAttribute("data-currency");
                                    var rate = account.selectedOptions[0].getAttribute("data-rate");
                                    var commission = (amount / 100) * fee; // Correct Calculation
                                    var worth = amount - commission;
                                    var get = worth * rate;
                                    let USDollar = new Intl.NumberFormat('en-US', {
                                        style: 'currency',
                                        currency: 'USD',
                                    });
                                    document.getElementById("commision").innerHTML = `<span class="badge bg-danger text-white">Fee: ${commission}</span><br>`;
                                    document.getElementById("worth").innerHTML = `<span class="badge bg-info text-white"  >Value: ${currency} ${worth}</span><br>`;
                                    document.getElementById("rate").innerHTML = `<span class="badge bg-dark text-white"  >Rate 1${currency} = ${USDollar.format(rate)}<?php echo e($general->cur_text); ?></span><br>`;
                                    document.getElementById("get").innerHTML = `<span class="badge bg-success text-white" >What You Get: ${USDollar.format(get)} <?php echo e($general->cur_text); ?> </span>`;
                                                   
                                }
                                
                            </script> 
                            <?php $__env->stopPush(); ?>
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3"><?php echo app('translator')->get('Enter Amount'); ?></label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" onkeyup="submitform()" id="amount" class="form-control form-control-lg form-control-solid  amount <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('amount')); ?>" name="amount" placeholder="0.00" />
                                <!--end::Input-->
                                <span class="badge text-white" id="commision"></span> 
                                <span class="badge text-white" id="worth"></span>
                                <span class="badge text-white" id="rate"></span>
                                <span class="badge text-white" id="get"></span>
                            </div>
                            <!--end::Input group--> 

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3"><?php echo app('translator')->get('Account '); ?></label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select  onchange="submitform()"  class="form-control form-control-lg form-control-solid  purpose <?php $__errorArgs = ['account'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="account" select-2" name="account">
                                    <option selected disabled>Please Select Account</option>
                                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option data-fee="<?php echo e($data->fee); ?>" data-rate="<?php echo e($data->rate); ?>" data-currency="<?php echo e($data->currency); ?>"  value="<?php echo e($data->id); ?>"><?php echo e($data->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select> 
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

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/vendor/request_account/create.blade.php ENDPATH**/ ?>