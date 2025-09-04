<?php $__env->startSection('panel'); ?>
<!-- content @s -->
<!--begin::Container-->
<div id="kt_content_container" class=" container-xxl ">
    <!--begin::Card-->

    <div class="row">
        <div class="col-xl-8 d-flex align-items-strech">
          <div class="card w-100">
            <div class="card-body p-4">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h6 class="card-title fw-semibold">QR Transaction</h6>
                  <p class="card-subtitle mb-0">Please find below your QR Transactions</p>
                </div>
                <div class="dropdown">
                  <button class="btn btn-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="flag-icon flag-icon-ng me-1" title="us"></i> <?php echo e($general->cur_text); ?> <i
                      class="ti ti-chevron-down ms-1"></i>
                  </button>

                </div>
              </div>
              <div class="card mt-4 mb-0 shadow-none">
                <div class="table-responsive">
                  <table class="table mb-0 align-middle text-nowrap">
                    <thead>
                      <tr>
                        <th class="ps-0">Customer</th>
                        <th>Date</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody class="text-dark ">
                    <?php $__empty_1 = true; $__currentLoopData = $trx; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-3 fw-semibold">
                            <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . @$data->customer->image, getFileSize('userProfile'))); ?>" class="rounded-circle" alt="user"
                              width="45" /> <?php echo e(@$data->customer->username); ?>

                          </div>
                        </td>
                        <td>
                          <span><?php echo date(' D d, M Y', strtotime($data->created_at)); ?><br><small>
                            <?php echo e(date('h:i A', strtotime($data->created_at))); ?></small></span>
                        </td>
                        <td class="text-success"><?php echo e($general->cur_sym); ?><?php echo e(number_format($data->amount,2)); ?></td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                      <?php echo emptyData2(); ?>

                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
                <?php if($trx->hasPages()): ?>
                <div class="card-footer">
                    <?php echo e($trx->links()); ?>

                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 d-flex align-items-strech">
          <div class="card w-100">
            <img src="<?php echo e(QR($url)); ?>" class="card-img" alt="nft" />
            <div class="p-4 mt-n4 text-center">
              <div class="position-relative mt-n4">
                <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . auth()->user()->image, getFileSize('userProfile'))); ?>" alt="nft"
                  class="rounded-circle border border-3 border-white" width="50" />
              </div>
              <div>
                <h6 class="mb-0 fw-semibold mt-2"><?php echo e(auth()->user()->fullname); ?></h6>
              </div>
              <div class="d-flex align-items-center justify-content-between mt-2 pb-3 border-bottom">
                <div class="text-start">
                  <span class="fs-6">Total Payment</span>
                  <h6 class="mb-0 fw-semibold text-danger"><?php echo e($general->cur_sym); ?><?php echo e(number_format($payment,2)); ?></h6>
                </div>
                <div class="text-end">
                  <span class="fs-6">Total Received</span>
                  <h6 class="mb-0 fw-semibold text-success"><?php echo e($general->cur_sym); ?><?php echo e(number_format($received,2)); ?></h6>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3 pt-3">

                <div>
                  <h6 class="mb-0 fw-semibold">Received Today</h6>
                  <span class="fs-2 text-success"><?php echo e($general->cur_sym); ?><?php echo e(number_format($today,2)); ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Stepper-->



            <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">
                <section class="payment-method text-center">



                    <p class="mb-0 fs-2"></p>

                    <div class="container">
                        <h1 class="fw-semibold fs-s5">Scan QR Codes</h1>


                        <div class="section">
                            <div id="my-qr-reader">
                            </div>
                        </div>
                    </div>

                </section>
            </div>
            <!--end::Stepper-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Container-->
<?php $__env->startPush('style'); ?>
<style>

#my-qr-reader {
    padding: 20px !important;
    border: 1.5px solid #b2b2b2 !important;
    border-radius: 8px;
}

#my-qr-reader img[alt="Info icon"] {
    display: none;
}

#my-qr-reader img[alt="Camera based scan"] {
    width: 100px !important;
    height: 100px !important;
}

button {
    padding: 10px 20px;
    border: 1px solid #b2b2b2;
    outline: none;
    border-radius: 0.25em;
    color: white;
    font-size: 15px;
    cursor: pointer;
    margin-top: 15px;
    margin-bottom: 10px;
    background-color: #008000ad;
    transition: 0.3s background-color;
}

button:hover {
    background-color: #008000;
}

#html5-qrcode-anchor-scan-type-change {
    text-decoration: none !important;
    color: #1d9bf0;
}

video {
    width: 100% !important;
    border: 1px solid #b2b2b2 !important;
    border-radius: 0.25em;
}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>

<script
src="https://unpkg.com/html5-qrcode">
</script>
<script>
    function domReady(fn) {
    if (
        document.readyState === "complete" ||
        document.readyState === "interactive"
    ) {
        setTimeout(fn, 1000);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

domReady(function () {

    // If found you qr code
    function onScanSuccess(decodeText, decodeResult) {
        window.location.replace(decodeText, "_newtab");
        //alert("You Qr is : " + decodeText, decodeResult);
    }

    let htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader",
        { fps: 10, qrbos: 250 }
    );
    htmlscanner.render(onScanSuccess);
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/qr/index.blade.php ENDPATH**/ ?>