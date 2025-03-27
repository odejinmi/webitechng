<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-12">

            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header pt-8">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2><?php echo e($pageTitle); ?></h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Form-->
                    <form class="form" id="kt_file_manager_settings">
                        <div class="fv-row row mb-15">
                            <!--begin::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-12">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold"><?php echo app('translator')->get('Select Wallet'); ?></label>
                                <!--end::Label-->
                            </div>
                            <!--end::Col-->
                            <div class="col-lg-6">
                                <!--begin::Option-->
                                <input type="radio" class="btn-check" name="account_type" onchange="selectwallet('main')"
                                    id="mainwallet" />
                                <label
                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10"
                                    for="mainwallet">
                                    <i class="ti ti-wallet fs-3x me-5"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span><span
                                            class="path4"></span><span class="path5"></span></i>
                                    <!--begin::Info-->
                                    <span class="d-block fw-semibold text-start">
                                        <span class="text-dark fw-bold d-block fs-4 mb-2">
                                            <?php echo app('translator')->get('Main Wallet'); ?>
                                        </span>
                                        <span
                                            class="text-muted fw-semibold fs-6"><?php echo e($general->cur_sym); ?><?php echo e(showAmount(Auth::user()->balance)); ?></span>
                                    </span>
                                    <!--end::Info-->
                                </label>
                                <!--end::Option-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6">
                                <!--begin::Option-->
                                <input type="radio" class="btn-check" name="account_type" onchange="selectwallet('ref')"
                                    id="refwallet" />
                                <label
                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center"
                                    for="refwallet">
                                    <i class="ti ti-wallet fs-3x me-5"><span class="path1"></span><span
                                            class="path2"></span></i>
                                    <!--begin::Info-->
                                    <span class="d-block fw-semibold text-start">
                                        <span class="text-dark fw-bold d-block fs-4 mb-2"><?php echo app('translator')->get('Referral Wallet'); ?></span>
                                        <span
                                            class="text-muted fw-semibold fs-6"><?php echo e($general->cur_sym); ?><?php echo e(showAmount(Auth::user()->ref_balance)); ?></span>
                                    </span>
                                    <!--end::Info-->
                                </label>
                                <!--end::Option-->
                            </div>
                            <!--end::Col-->
                            <?php $__env->startPush('script'); ?>
                                <script>
                                    function selectwallet(wallet) {
                                        localStorage.setItem('wallet', wallet);
                                    }
                                </script>
                            <?php $__env->stopPush(); ?>
                        </div>
                        <!--begin::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row row mb-15">
                            <!--begin::Col-->
                            <div class="col-md-3 d-flex align-items-center">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold"><?php echo app('translator')->get('Select Country'); ?></label>
                                <!--end::Label-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-md-9">
                                <!--begin::Input-->
                                <select name="country" class="form-select form-select-solid" data-control="select22"
                                    id="youSendCurrency" data-hide-search="false" onchange="populate()"
                                    data-placeholder="<?php echo app('translator')->get('Select Country'); ?>">
                                    <option selected disableds><?php echo app('translator')->get('Select a Country'); ?>...</option>
                                    <option value="nigeria" data-callingCode="NG" data-countrycurrency="NGN"
                                        data-isoName="NG" data-countrycontinent="Africa" data-network="<?php echo e($networks); ?>"
                                        value="Nigeria" data-icon="currency-flag currency-flag-ng me-1">Nigeria</option>
                                </select> <!--end::Input-->
                                <!--end::Input-->
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <?php $__env->startPush('script'); ?>
                            <script>
                                function populate() {
                                    // START GET DATA \\
                                    const loadingEl = document.createElement("div");
                                    document.body.prepend(loadingEl);
                                    loadingEl.classList.add("page-loader");
                                    loadingEl.classList.add("flex-column");
                                    loadingEl.classList.add("bg-dark");
                                    loadingEl.classList.add("bg-opacity-25");
                                    loadingEl.innerHTML = `
                                <span class="spinner-border text-primary" role="status"></span>
                                <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>
                            `;

                                    // Show page loading
                                    KTApp.showPageLoading();
                                    document.getElementById('providers').innerHTML = '';
                                    var network = $("#youSendCurrency option:selected").attr('data-network');

                                    networks = JSON.parse(network);
                                    let html = '';
                                    networks.map(plan => {
                                        let htmlSegment =
                                            `<label class="d-flex flex-stack cursor-pointer mb-5" for="${plan['networkid']}" >
                                                    <span class="d-flex align-items-center me-2">
                                                        <span class="symbol symbol-50px me-6">
                                                            <span class="symbol-label bg-light-primary">
                                                                <i class="ti ti-image fs-2x text-warning"><img src="<?php echo e(url('/')); ?>/assets/images/provider/${plan['logo']}" width="30" class="path1"/></i>
                                                            </span>
                                                            
                                                        </span> 
                                                        <span class="d-flex flex-column">
                                                            <span class="fw-bold fs-6">${plan['name']}</span>
                                                            <span class="fs-7 text-muted">Airtime Topup</span>
                                                        </span>
                                                    </span>
        
                                                    <span class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="radio" onchange="networkprovider('${plan['networkid']}','${plan['logo']}','${plan['name']}','${plan['networkid']}')"
                                                            name="operator" id="${plan['networkid']}" value="${plan['networkid']}" />
                                                    </span>
                                                </label>
                                                `;
                                        html += htmlSegment;
                                    });

                                    document.getElementById('providers').innerHTML =
                                        `<div class="mb-0">
                                             <label class="d-flex align-items-center form-label mb-5"> </label> ${html} 
                                        </div>`; 
                                    KTApp.hidePageLoading();
                                    loadingEl.remove();
                                }
                                // END GET DATA \\ 
                            </script>
                            <script>
                                function networkprovider(operatorId, image, name, networkid) {
                                    document.getElementById("operatorId").value = networkid;

                                }
                                // END GET OPERATORS
                            </script>
                        <?php $__env->stopPush(); ?>
                        <input id="operatorId" hidden />
                        <!--begin::Input group-->
                        <div class="fv-row row mb-15">
                            <!--begin::Col-->
                            <div class="col-md-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold mt-2"><?php echo app('translator')->get('Select Network'); ?></label>
                                <div class="text-muted fs-7"></div>
                                <!--end::Label-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-md-9">
                                <div id="providers"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row row mb-15">
                            <!--begin::Col-->
                            <div class="col-md-3 d-flex align-items-center">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold"><?php echo app('translator')->get('Beneficiary Phone'); ?></label>
                                <!--end::Label-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-md-9">
                                <input name="phone" id="phone" class="form-control form-control-lg form-control-solid"
                                    value="" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row row mb-15">
                            <!--begin::Col-->
                            <div class="col-md-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold mt-2"><?php echo app('translator')->get('Amount'); ?></label>
                                <div class="text-muted fs-7"></div>
                                <!--end::Label-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-md-9">
                                <input name="amount" id="amount" type="number"
                                    class="form-control form-control-lg form-control-solid" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row row mb-15">
                            <!--begin::Col-->
                            <div class="col-md-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold "><?php echo app('translator')->get('Transaction Pin'); ?></label>
                                <!--end::Label-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-md-9">
                                <input type="password" onkeyup="verifypassword(this)" id="password"
                                    class="form-control form-control-lg form-control-solid" name="password" placeholder=""
                                    value="" autocomplete="off" />

                            </div>
                            <!--end::Col-->
                            <?php $__env->startPush('script'); ?>
                                <script>
                                    function verifypassword(e) {
                                        $("#passmessage").html(`<button class="btn btn-primary" type="button" disabled>
                                                    <span
                                                      class="spinner-border spinner-border-sm"
                                                      role="status"
                                                      aria-hidden="true"></span>
                                                    <span class="visually-hidden">Loading...</span>
                                                    </button>`);

                                        var raw = JSON.stringify({
                                            _token: "<?php echo e(csrf_token()); ?>",
                                            password: e.value,
                                        });

                                        var requestOptions = {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            body: raw
                                        };
                                        fetch("<?php echo e(route('user.trxpass')); ?>", requestOptions)
                                            .then(response => response.text())
                                            .then(result => {
                                                resp = JSON.parse(result);
                                                if (resp.ok != true) {
                                                    document.getElementById("submit").disabled = true;
                                                }
                                                if (resp.ok != false) {
                                                    document.getElementById("submit").disabled = false;
                                                }
                                                $("#passmessage").html(
                                                    `<div class="alert alert-${resp.status}" role="alert"><strong>${resp.status} - </strong> ${resp.message}</div>`
                                                );
                                            })
                                            .catch(error => {

                                            });
                                        // END GET DATA \\
                                    }
                                </script>
                            <?php $__env->stopPush(); ?>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Action buttons-->
                        <div class="row mt-12">
                            <div id="passmessage"></div>
                            <div class="col-md-9 offset-md-3">
                                <!--begin::Button-->
                                <button type="button" onclick="submitform()" class="btn btn-primary" id="submit">
                                    <span class="indicator-label">
                                        Proceed
                                    </span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                        <!--begin::Action buttons-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        // START BUY AIRTIME \\
        function submitform() {
            const loadingEl = document.createElement("div");
            document.body.prepend(loadingEl);
            loadingEl.classList.add("page-loader");
            loadingEl.classList.add("flex-column");
            loadingEl.classList.add("bg-dark");
            loadingEl.classList.add("bg-opacity-25");
            loadingEl.innerHTML = `
                                <span class="spinner-border text-primary" role="status"></span>
                                <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>
                            `;

            // Show page loading
            KTApp.showPageLoading();
            var raw = JSON.stringify({
                _token: "<?php echo e(csrf_token()); ?>",
                password: document.getElementById('password').value,
                amount: document.getElementById('amount').value,
                phone: document.getElementById('phone').value,
                operator: document.getElementById('operatorId').value,
                wallet: localStorage.getItem('wallet'),
            });

            var requestOptions = {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: raw
            };
            fetch("<?php echo e(route('user.buy.airtime.local.post')); ?>", requestOptions)
                .then(response => response.text())
                .then(result => {
                    resp = JSON.parse(result);
                    $("#passmessage").html(
                        `<div class="alert alert-${resp.status}" role="alert"><strong>${resp.status} - </strong> ${resp.message}</div>`
                    );

                    KTApp.hidePageLoading();
                    loadingEl.remove();
                })
                .catch(error => {

                    KTApp.hidePageLoading();
                    loadingEl.remove();
                });

        }

        // END BUY AIRTIME \\
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/bills/airtime/airtime_buy_local.blade.php ENDPATH**/ ?>