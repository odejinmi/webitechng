
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
                                <h2 class="fw-bold text-dark"><?php echo app('translator')->get('Airtime To Cash'); ?></h2>
                                <!--end::Title-->

                                <!--begin::Notice-->
                                <div class="text-muted fw-semibold fs-6">
                                    <?php echo app('translator')->get('Please note that you will be charged a transaction fee of in '); ?>
                                    <a href="#" class="link-danger fw-bold">%</a> for this airtime to cash transaction.
                                </div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Heading-->  
                           
                            <?php $__env->startPush('script'); ?>
                            
                            <script> 
                            
                                document.getElementById("code").disabled = true;
                                document.getElementById("pin").disabled = true;
                                function fixeamount(e)
                                {
                                if(e.name == 'amount')
                                {
                                    document.getElementById("amount").value = e.value;
                                }
                                
                                if(document.getElementById("network").value != 'empty' && e.name == 'network')
                                {
                                    document.getElementById("amount").value = null;
                                    getNetwork();
                                    return;
                                }
                                submitform();
                                // START AIRTIME FEE \\
                                function getNetwork() {
                                    const loadingEl = document.createElement("div");
                                    document.body.prepend(loadingEl);
                                    loadingEl.classList.add("page-loader");
                                    loadingEl.classList.add("flex-column");
                                    loadingEl.classList.add("bg-dark");
                                    loadingEl.classList.add("bg-opacity-25");
                                    loadingEl.innerHTML = ` <span class="spinner-border text-primary" role="status"></span> <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>`;
                                    // Show page loading
                                    KTApp.showPageLoading();
                                    var network_input = document.getElementById('network').value; 
                                    var raw = JSON.stringify({
                                        _token: "<?php echo e(csrf_token()); ?>",
                                        network: network_input,
                                        fee: true,
                                    });

                                    var requestOptions = {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        body: raw
                                    };
                                    fetch("<?php echo e(route('user.airtime.tocash.fee')); ?>", requestOptions)
                                        .then(response => response.text())
                                        .then(result => {
                                            resp = JSON.parse(result);
                                            SlimNotifierJs.notification(`${resp.status}`, `${resp.status}`,`${resp.message}`, 3000);
                                            KTApp.hidePageLoading();
                                            loadingEl.remove(); 
                                            var plans = resp.range;
                                            var html = '';
                                                if (resp.ok != false) {
                                                    plans.map(plan => {
                                                        let htmlSegment =
                                                        `
                                                        <li class="list-group-item d-flex align-items-center">
                                                        <i class="ti ti-gift fs-4 me-2 text-primary"></i>
                                                        <?php echo e($general->cur_sym); ?> ${plan['min']} - <?php echo e($general->cur_sym); ?>${plan['max']}
                                                        <span class="badge bg-light-danger text-danger font-medium rounded-pill ms-auto"
                                                            >${plan['fee']}%</span>
                                                        </li> `;  
                                                        html += htmlSegment; 
                                                    }); 
                                                    
                                                    document.getElementById("amount").disabled = false;
                                                    document.getElementById('networkfee').innerHTML =
                                                    `
                                                    <div class="col-lg-12">
                                                      <div class="card">
                                                        <div class="card-body">
                                                        <div class="mb-3">
                                                            <h5 class="mb-0">Airtime Conversion Rate</h5>
                                                        </div>
                                                        <ul class="list-group"> 
                                                        ${html}
                                                        </ul>
                                                        </div>
                                                       </div>
                                                    </div> 
                                                    `;
                                                }
                                                else
                                                {
                                                    
                                                    document.getElementById("amount").disabled = true;
                                                    document.getElementById('networkfee').innerHTML = "";
                                                }
                                        })
                                        .catch(error => {
                                            KTApp.hidePageLoading();
                                            loadingEl.remove();
                                        });
                                        
                                        document.getElementById("commision").innerHTML = '';
                                        document.getElementById("worth").innerHTML = '';
                                        return;

                                }

                                function submitform() {
                                    const loadingEl = document.createElement("div");
                                    document.body.prepend(loadingEl);
                                    loadingEl.classList.add("page-loader");
                                    loadingEl.classList.add("flex-column");
                                    loadingEl.classList.add("bg-dark");
                                    loadingEl.classList.add("bg-opacity-25");
                                    loadingEl.innerHTML = ` <span class="spinner-border text-primary" role="status"></span> <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>`;
                                    // Show page loading
                                    KTApp.showPageLoading();
                                    var amount_input = document.getElementById('amount').value; 
                                    var network_input = document.getElementById('network').value; 
                                    var raw = JSON.stringify({
                                        _token: "<?php echo e(csrf_token()); ?>",
                                        network: network_input,
                                        amount: amount_input, 
                                        fee: false,
                                    });

                                    var requestOptions = {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        body: raw
                                    };
                                    fetch("<?php echo e(route('user.airtime.tocash.fee')); ?>", requestOptions)
                                        .then(response => response.text())
                                        .then(result => {
                                            resp = JSON.parse(result);
                                            //SlimNotifierJs.notification(`${resp.status}`, `${resp.status}`,`${resp.message}`, 3000);
                                            KTApp.hidePageLoading();
                                            loadingEl.remove();
                                                if (resp.ok != true) 
                                                {
                                                    document.getElementById("code").disabled = true;
                                                    document.getElementById("pin").disabled = true;
                                                    document.getElementById("commision").innerHTML = '';
                                                    document.getElementById("worth").innerHTML = '';
                                                    
                                                    document.getElementById("submit").disabled = true;
                                                }
                                                if (resp.ok != false) {
                                                    var fee = resp.range.fee;
                                                    var commission = (amount_input / 100) * fee; // Correct Calculation
                                                    var worth = amount_input - commission;
                                                    document.getElementById("commision").innerHTML = `<span class="badge bg-danger text-white" id="commision">Fee: ${commission}</span>`;
                                                    document.getElementById("worth").innerHTML = `<span class="badge bg-success text-white" id="worth">Value: <?php echo e($general->cur_text); ?> ${worth}</span>`;
                                                    document.getElementById("code").disabled = false;
                                                    document.getElementById("pin").disabled = false;
                                                    
                                                    document.getElementById("submit").disabled = false;
                                                }
                                        })
                                        .catch(error => {
                                            KTApp.hidePageLoading();
                                            loadingEl.remove();
                                        });

                                }
                                // END AIRTIME FEE \\
                               
                                }
                                
                            </script>
                            <?php $__env->stopPush(); ?>
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3"><?php echo app('translator')->get('Select Network'); ?></label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select type="text"  onchange="fixeamount(this)" class="form-control form-control-lg form-control-solid  network <?php $__errorArgs = ['network'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="network"
                                    name="network" placeholder="network" >
                                    <option selected disabled value="empty">Select A Network</option>
                                    <option value="airtel">AIRTEL</option>
                                    <option value="mtn">MTN</option>
                                    <option  value="glo">GLOBACOM</option>
                                    <option value="9mobile">9MOBILE</option>
                                </select>
                                <!--end::Input-->

                                <div id="networkfee"></div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3"><?php echo app('translator')->get('Enter Amount'); ?></label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" id="amount"  onkeyup="fixeamount(this)"  class="form-control form-control-lg form-control-solid  amount <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('amount')); ?>" name="amount" placeholder="0.00" />
                                <span id="commision"></span>
                                <br>
                                <span class="badge bg-success text-white" id="worth"></span>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group--> 

                            
                            <!--begin::Section-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3" data-kt-translate="two-step-label"><?php echo app('translator')->get('Aitime Code'); ?></label>
                                <!--end::Label-->
                                <!--begin::Input group-->
                                <div class="d-flex flex-wrap flex-stack">  
                                    <input type="text" class="form-control form-control-lg form-control-solid  username <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="code"
                                    name="code" value="<?php echo e(old('code')); ?>" placeholder="XXXX-XXXX-XXXX-XXXX-XXXX" /> 
                                </div>                
                                <!--begin::Input group-->
                            </div>
                            <!--end::Section-->


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

                            <button type="submit" class="btn btn-lg btn-primary" disabled type="button" id="submit"><?php echo app('translator')->get('Proceed'); ?>
                                
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

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/bills/airtime2cash/create.blade.php ENDPATH**/ ?>