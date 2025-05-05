<?php $__env->startSection('panel'); ?>
    <!-- crancy Dashboard -->

<div class="vstack gap-3 gap-xl-6 mt-8">
        <div class="row row-cols-sm-2 row-cols-md-6 g-3">
            <div class="col">
                <div class="card border-primary-hover">
                    <div class="card-body d-flex gap-3"><img src="<?php echo e(url('/')); ?>/assets/images/country/ngn.png"
                            class="w-rem-7 h-rem-7 mt-1" alt="...">
                        <div class=""><span class="d-block text-muted mb-1">Total Deposit</span>
                            <span
                                class="d-block text-lg fw-bold text-heading"><?php echo e($general->cur_sym); ?><?php echo e(number_format(@$totaldepo, 2)); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex gap-3 mb-1">
                            <img src="<?php echo e(url('/')); ?>/assets/images/country/alert.png"
                            class="w-rem-7 h-rem-7 mt-1" alt="...">
                            <span class="text-muted">Pending Deposit</span>

                        </div>
                        <div class="d-flex align-items-center">
                            <span class="text-lg text-heading fw-bold"><?php echo e($general->cur_sym); ?><?php echo e(number_format(@$pendingdepo, 2)); ?></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-details">

                <div class="card border-0 gradient-bottom-right start-purple middle-yellow end-cyan">
                                            <div class="position-relative p-6 overlap-10">
                                                <div class="row justify-content-between align-items-center">
                                                    <div class="col">
                                                        <div class="icon icon-shape flex-none text-base text-bg-primary rounded-circle">
                                                            <i class="bi bi-bank w-rem-6 h-rem-6" alt="..."></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto" id="fundbutton" onclick="generatenuban()">
                                                        <span class="badge bg-dark text-success">Generate Nuban</span>
                                                    </div>
                                                    <div id="responsemessage"></div>
                                                </div>
                                                <?php if(Auth::user()->nuban != null): ?>
                                                    <?php if($general->nuban_provider == 'MONNIFY'): ?>
                                                    <?php
                                                        $nuban = json_decode(Auth::user()->nuban, true);
                                                        $rand = rand(0,1);
                                                    ?>
                                                    <?php $__currentLoopData = $nuban; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($key == $rand): ?>
                                                    <?php if(isset($data['bankName']) && isset($data['accountName']) && isset($data['accountNumber'])): ?>
                                                    <div class="mt-8 mb-6">
                                                        <span class="surtitle text-dark text-opacity-60">Account Number</span>
                                                        <div class="d-flex gap-4 h3 fw-bold">
                                                            <div><?php echo e($data['accountNumber']); ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <span class="surtitle text-dark text-opacity-60">Name</span>
                                                            <span class="d-block h6"><?php echo e($data['accountName']); ?></span></div>
                                                        <div class="col">
                                                            <span class="surtitle text-dark text-opacity-60">Bank</span>
                                                            <span class="d-block h6"><?php echo e(strToUpper(@$data['bankName']) ?? null); ?></span></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <?php elseif(
                                                    $general->nuban_provider == 'STROWALLET' ||
                                                        $general->nuban_provider == 'PAYVESSEL' ||
                                                        $general->nuban_provider == '9PSB' ||
                                                        $general->nuban_provider == 'PAYLONY'): ?>
                                                    <?php
                                                        $bankdetails = json_decode(Auth::user()->nuban);
                                                    ?>

                                                    <div class="mt-8 mb-6">
                                                        <span class="surtitle text-dark text-opacity-60">Account Number</span>
                                                        <div class="d-flex gap-4 h3 fw-bold">
                                                            <div><?php echo e(@$bankdetails->account_number); ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <span class="surtitle text-dark text-opacity-60">Name</span>
                                                            <span class="d-block h6"><?php echo e(@$bankdetails->account_name); ?></span></div>
                                                        <div class="col">
                                                            <span class="surtitle text-dark text-opacity-60">Bank</span>
                                                            <span class="d-block h6"><?php echo e(@$bankdetails->bank_name ?? null); ?></span></div>
                                                    </div>


                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>


        <div class="row row-cols-md-2 g-6">
             <form  class="" novalidate="novalidate" action="<?php echo e(route('user.deposit.insert')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="col">
                <div class="card border-0 border-xxl">
                    <div class="card-body p-0 p-xxl-6">
                        <div class="d-flex gap-8 justify-content-center mb-5"><a href="#"
                                class="text-lg fw-bold text-heading">Wallet Funding</a></div>
                        <div class="vstack gap-2">

                            <div class="bg-body-secondary rounded-3 p-4">
                                <div class="d-flex justify-content-between text-xs text-muted">
                                    <span class="fw-semibold">Gateway</span>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <select class="form-control" onchange="getgateway()" style="height: 100pxx;" id="methodId" name="methodId">
                                        <?php $__currentLoopData = $gatewayCurrency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($data); ?>">
                                                <?php echo e($data->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <h6 class="progress-text mb-1 d-block"></h6>
                            </div>


                            <div class="bg-body-secondary rounded-3 p-4">
                                <div class="d-flex justify-content-between text-xs text-muted">
                                    <span class="fw-semibold">Amount</span>
                                </div>
                                <div class="d-flex justify-content-between mt-4"><input type="tel" id="amount"
                                        placeholder="<?php echo e($general->cur_sym); ?> 0.00" name="amount"
                                        class="form-control form-control-flush text-xl fw-bold w-rem-40">
                                    <div class="d-flex align-items-center gap-2"><img
                                            src="<?php echo e(url('/')); ?>/assets/images/country/ngn.png"
                                            class="w-rem-6 h-rem-6 rounded-circle" alt="...">
                                        <span class="fw-semibold text-sm">NGN</span>
                                    </div>
                                </div>
                            </div>



                            <input type="hidden" name="currency" class="edit-currency form-control">
                            <input type="hidden" name="method_code" class="edit-currency form-control">
                            <button type="submit" id="submit"
                                class="btn btn-lg btn-dark w-100">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <div class="col">
                <div class="card border-0 border-xxl h-md-100">
                    <div class="card-body p-0 p-xxl-6">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div>
                                <h5>Deposit history</h5>
                            </div>
                            <div class="hstack align-items-center"><a href="#" class="text-muted"><i
                                        class="bi bi-arrow-repeat"></i></a>
                            </div>
                        </div>
                        <div class="vstack gap-6">
                            <?php $__empty_1 = true; $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div data-bs-toggle="modal" data-bs-target="#popup_modal_<?php echo e($trx->id); ?>">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="icon icon-shape flex-none text-base text-bg-primary rounded-circle">
                                            <i class="bi bi-bank w-rem-6 h-rem-6" alt="..."></i>
                                        </div>
                                        <div>
                                            <h6 class="progress-text mb-1 d-block"><?php echo e($trx->trx); ?></h6>
                                            <p class="text-muted text-xs">
                                                 <?php
                                                        $details =
                                                            $data->detail != null
                                                                ? json_encode($data->detail)
                                                                : null;
                                                    ?>
                                                <?php if($trx->status == 2): ?>
                                                    <span class="badge bg-warning"><?php echo app('translator')->get('Pending'); ?></span>
                                                <?php elseif($trx->status == 1): ?>
                                                    <span class="badge bg-success"><?php echo app('translator')->get('Completed'); ?></span>

                                                <?php elseif($trx->status == 0): ?>
                                                    <span class="badge bg-dark"><?php echo app('translator')->get('Initiated'); ?></span>
                                                </button>
                                                <?php elseif($trx->status == 3): ?>
                                                    <span class="badge bg-danger"><?php echo app('translator')->get('Rejected'); ?></span>
                                                </button>
                                                <?php endif; ?> <br>
                                                <?php echo e(diffForHumans($trx->created_at)); ?></p>
                                        </div>
                                        <div class="text-end ms-auto">
                                            <span
                                                class="h6 text-sm">-<?php echo e($general->cur_sym); ?><?php echo e(showAmount($trx->amount)); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="crancy-default__modal modal fade" id="popup_modal_<?php echo e($trx->id); ?>"
                                    tabindex="-1" aria-labelledby="popup_modal_<?php echo e($trx->id); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content crancy-preview__modal-content">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="crancy-flex__right">
                                                        <a id="crancy-main-form__close" type="initial"
                                                            class="crancy-preview__modal--close btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none">
                                                                <g clip-path="url(#clip0_989_10425)">
                                                                    <circle cx="12" cy="12" r="12"
                                                                        fill="#EDF2F7" />
                                                                    <path d="M16.9498 7.05029L7.05033 16.9498"
                                                                        stroke="#5D6A83" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M7.05029 7.05029L16.9498 16.9498"
                                                                        stroke="#5D6A83" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_989_10425">
                                                                        <rect width="24" height="24"
                                                                            fill="white" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="crancy-wc__heading crancy-flex__column-center text-center">
                                                        <h3 class="crancy-login-popup__title"> Details</h3>
                                                        <p>

                                                <?php echo e($data->admin_feedback); ?>

                                                        </p>
                                                             <?php
                                                        $details =
                                                            $data->detail != null
                                                                ? json_encode($data->detail)
                                                                : null;
                                                    ?>
                                                    <?php if($data->status == 2): ?>
                                                    <span class="badge bg-warning"><?php echo app('translator')->get('Pending'); ?></span>
                                                <?php elseif($data->status == 1): ?>
                                                    <span class="badge bg-success"><?php echo app('translator')->get('Completed'); ?></span>


                                                <?php elseif($data->status == 3): ?>
                                                    <span class="badge bg-danger"><?php echo app('translator')->get('Rejected'); ?></span>
                                                <?php endif; ?>
                                                        <!-- Search Form -->
                                                        <div
                                                            class="crancy-header__form crancy-header__form__currency mg-top-20">

                                                        </div>
                                                        <!-- End Search Form -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php echo emptyData2(); ?>

                            <?php endif; ?>

                            <?php echo e($deposits->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
    function generatenuban() {
        // START GET DATA \\
        document.getElementById("fundbutton").disabled = true;
        $("#responsemessage").html(`<br>
            <span class="spinner-border text-primary" role="status"></span>
            <span class="text-gray-800 fs-6 fw-semibold mt-5">Generating...</span>
        `);
        // Show page loading
        var _token = $("input[name='_token']").val();
        var raw = JSON.stringify({
            _token: "<?php echo e(csrf_token()); ?>",
        });

        var requestOptions = {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: raw
        };
        fetch("<?php echo e(route('user.generate.nuban')); ?>", requestOptions)
            .then(response => response.text())
            .then(result => {
                resp = JSON.parse(result);
                document.getElementById("fundbutton").disabled = false;
                $("#responsemessage").html(
                    `<div class="alert alert-${resp.status}" role="alert"><strong>Hello - </strong> ${resp.message}</div>`
                    );
                if(resp.status == 'success')
                {
                    location.reload();
                }
            })
            .catch(error => {
            console.info(error);
            });
        // END GET DATA \\


    }
    </script>
    <script>
        (function($) {
            "use strict";
            $('.detailBtn').on('click', function() {
                var modal = $('#detailModal');

                var userData = $(this).data('info');
                var html = '';
                if (userData) {
                    userData.forEach(element => {
                        if (element.type != 'file') {
                            html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>${element.name}</span>
                                <span">${element.value}</span>
                            </li>`;
                        }
                    });
                }

                modal.find('.userData').html(html);

                if ($(this).data('admin_feedback') != undefined) {
                    var adminFeedback = `
                        <div class="my-3">
                            <strong><?php echo app('translator')->get('Admin Feedback'); ?></strong>
                            <p>${$(this).data('admin_feedback')}</p>
                        </div>
                    `;
                } else {
                    var adminFeedback = '';
                }
                modal.find('.feedback').html(adminFeedback);
                modal.modal('show');
            });
        })(jQuery);
    </script>
    <script>
        'use strict';

            function getgateway()
            {
                var amount = document.getElementById("amount").value;
                let methodId = document.getElementById("methodId").value;
                const errorlogs = JSON.stringify(methodId);
                const personObject = JSON.parse(methodId);
                if (personObject.id) {
                    $('input[name=currency]').val(personObject.currency);
                    $('input[name=method_code]').val(personObject.method_code);

                }

            }


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

        });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/templates/satoshi/user/deposit_history.blade.php ENDPATH**/ ?>