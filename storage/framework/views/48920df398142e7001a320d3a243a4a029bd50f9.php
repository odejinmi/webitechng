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
                            <form  class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" action="<?php echo e(route('user.deposit.insert')); ?>" method="post">
                            <?php echo csrf_field(); ?>

                            <!--begin::Step 2-->
                            <div data-kt-stepper-element="scontent">
                                <!--begin::Wrapper-->
                                <div class="w-100">
                                    <!--begin::Heading-->
                                    <div class="pb-10 pb-lg-15">
                                        <!--begin::Title-->
                                        <h2 class="fw-bold text-dark"><?php echo app('translator')->get('Fund Wallet'); ?></h2>
                                        <!--end::Title-->

                                        <!--begin::Notice-->
                                        <div class="text-muted fw-semibold fs-6">
                                            If you need more info, please check out
                                            <a href="horizontal.html#" class="link-primary fw-bold">Help Page</a>.
                                        </div>
                                        <!--end::Notice-->
                                    </div>
                                    <!--end::Heading-->

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
unset($__errorArgs, $__bag); ?>" id="amount" value="<?php echo e(old('amount')); ?>"
                                            name="amount" placeholder="0.00" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="mb-0 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center form-label mb-5">
                                            <?php echo app('translator')->get('Select Payment Method'); ?>


                                            <span class="ms-1" data-bs-toggle="tooltip"
                                                title="Select your prefered payment method">
                                                <i class="ti ti-alert-circle text-gray-500 fs-6"><span
                                                        class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span></i></span> </label>
                                        <!--end::Label-->

                                        <!--begin::Options-->
                                        <div class="mb-0">
                                            <!--begin:Option-->
                                            <?php $__empty_1 = true; $__currentLoopData = $gatewayCurrency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <label class="d-flex flex-stack mb-5 cursor-pointer" for="<?php echo e($data->id); ?>">
                                                <!--begin:Label-->
                                                <span class="d-flex align-items-center me-2">
                                                    <!--begin::Icon-->
                                                    <span class="symbol symbol-50px me-6">
                                                        <span class="symbol-label">
                                                            <img width="40" src="<?php echo e(getImage(imagePath()['gateway']['path'].'/'. $data->method->image,imagePath()['gateway']['size'])); ?>" alt="" class="img-fluid ms-auto">
                                                        </span>
                                                    </span>
                                                    <!--end::Icon-->

                                                    <!--begin::Description-->
                                                    <span class="d-flex flex-column">
                                                        <span class="fw-bold text-gray-800 text-hover-primary fs-5"><?php echo e(__($data->name)); ?></span>
                                                        <span class="fs-6 fw-semibold text-muted"><?php echo e($general->cur_sym); ?><?php echo e(showAmount($data->min_amount )); ?> - <?php echo e($general->cur_sym); ?><?php echo e(showAmount($data->max_amount)); ?></span>
                                                    </span>
                                                    <!--end:Description-->
                                                </span>
                                                <!--end:Label-->

                                                <!--begin:Input-->
                                                <span class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input methodId"  value="<?php echo e($data); ?>" <?php echo e(old('methodId') == $data->id ? ' checked' : ''); ?> type="radio" name="methodId" data-resource="<?php echo e($data); ?>" id="<?php echo e($data->id); ?>" />
                                                </span>
                                                <!--end:Input-->
                                            </label>
                                            <!--end::Option-->
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <?php echo emptyData(); ?>

                                            <?php endif; ?>
                                        </div>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Step 2-->



                            <!--begin::Actions-->
                            <div class="d-flex flex-stack pt-15">

                                <input type="hidden" name="currency" class="edit-currency form-control">
                                <input type="hidden" name="method_code" class="edit-method-code  form-control">
                                <!--begin::Wrapper-->
                                <div>
                                    <button hidden id="submitnow" type="submit"></button>

                                    <button type="button" class="btn btn-lg btn-primary" data-bs-toggle="modal" href="#deposit-now" type="button" disabled id="submit"><?php echo app('translator')->get('Proceed'); ?>
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
<div class="modal fade" tabindex="-1" role="dialog" id="deposit-now">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
     <div class="modal-body modal-body-lg">
    <div class="nk-block-head nk-block-head-xs text-center">
        <h5 class="nk-block-title"><?php echo app('translator')->get('Confirm Deposit'); ?></h5>
        <div class="nk-block-text">
            <div class="caption-text"><?php echo app('translator')->get('Please review your deposit process and click on Confirm Deposit when ready'); ?></div>
        </div>
    </div>
    <div class="nk-block" >
        <div class="card-body showCharge d-none">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo app('translator')->get('Method Name'); ?></span>
                    <span class="text-danger" id="method"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo app('translator')->get('Fixed charge'); ?></span>
                    <span class="text-danger" id="fixed_charge"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo app('translator')->get('Percentage charge'); ?></span><span class="text-danger"
                                                                 id="percentage_charge"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo app('translator')->get('Min limit'); ?></span>
                    <span class="text-info" id="min_limit"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo app('translator')->get('Max limit'); ?></span>
                    <span class="text-info" id="max_limit"></span>
                </li>
            </ul>
        </div>

        <div class="buysell-field form-action text-center">
            <div class="mt-3">
                <a class="btn btn-primary"  onclick="document.getElementById('submitnow').click()" ><?php echo app('translator')->get('Confirm Deposit'); ?></a>
            </div>
            <div class="pt-3">
                <a href="#" data-bs-dismiss="modal" class="btn btn-danger"><?php echo app('translator')->get('Cancel Deposit'); ?></a>
            </div>
        </div>
    </div><!-- .nk-block -->
    </div><!-- .modal-body -->
    </div><!-- .modal-content -->
    </div><!-- .modla-dialog -->
    </div><!-- .modal -->
    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <a class="btn btn-sm btn-primary" href="<?php echo e(route('user.deposit.history')); ?>">
            <i class="ti ti-printer"></i>
            <?php echo app('translator')->get('Deposit History'); ?></a>
    <?php $__env->stopPush(); ?>


    <?php $__env->startPush('script'); ?>
        <script>
            'use strict';
            $(document).ready(function() {

                $(document).on('input', 'input[name="amount"]', function() {
                    let limit = '2';
                    let amount = $(this).val();
                    let fraction = amount.split('.')[1];
                    if (fraction && fraction.length > limit) {
                        amount = (Math.floor(amount * Math.pow(10, limit)) / Math.pow(10, limit)).toFixed(
                        limit);
                        $(this).val(amount);
                    }
                });

                $(document).on('change, input', ".methodId", function(e) {
                    var amount = document.getElementById("amount").value;
                    let methodId = this.value;
                    const errorlogs = JSON.stringify(methodId);
                    const personObject = JSON.parse(methodId);
                    // && amount < personObject.max_limit
                    if (personObject.id) {
                        //$('.method_currency').text(resource.currency);
                        $('input[name=currency]').val(personObject.currency);
                        $('input[name=method_code]').val(personObject.method_code);

                        submitButton(true);
                        $('.showCharge').removeClass('d-none');
                        $('#method').html(personObject.name);
                        $('#fixed_charge').html(parseFloat(personObject.fixed_charge) +
                            '<?php echo e(__($general->cur_text)); ?>');
                        $('#percentage_charge').html(personObject.percent_charge +
                            '<?php echo e(__($general->cur_text)); ?> ');
                        $('#min_limit').html(parseFloat(personObject.min_amount) +
                            '<?php echo e(__($general->cur_text)); ?> ');
                        $('#max_limit').html(parseFloat(personObject.max_amount) +
                            '<?php echo e(__($general->cur_text)); ?> ');
                    } else {
                        $('.showCharge').addClass('d-none');
                    }

                });
            });

            function submitButton(status) {
                if (status) {
                    $("#submit").removeAttr("disabled");
                    $("#submitnow").removeAttr("disabled");
                } else {
                    $("#submit").attr("disabled", true);
                    $("#submitnow").attr("disabled", true);
                }
            }
        </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/payment/deposit.blade.php ENDPATH**/ ?>