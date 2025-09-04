<?php $__env->startSection('panel'); ?>


   <!-- Transaction Log -->
   <div class="col-lg-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
          <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold"><?php echo app('translator')->get('API Key'); ?></h5>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="card">
            <div class="card-body p-4">
              <h4 class="fw-semibold mb-3">Payment Method</h4>
              <div class="d-flex align-items-center justify-content-between mt-7">
                <div class="d-flex align-items-center gap-3">
                  <div class="bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                    <i class="ti ti-lock text-dark d-block fs-7" width="22" height="22"></i>
                  </div>
                  <div>
                    <h5 class="fs-4 fw-semibold">Secret Key</h5>
                    <p class="mb-0 text-dark" id="sk"><?php echo e(@showMobileNumber($key)); ?></p>
                  </div>
                </div>
                <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Show Key"
                onclick="showkey('<?php echo e($key); ?>')">
                <i class="ti ti-eye"></i>
                </a>
                <?php $__env->startPush('script'); ?>
                <script>
                  function showkey(e)
                  {
                    document.getElementById("sk").innerHTML = e;
                  }
                </script>
                <?php $__env->stopPush(); ?>
              </div>

              <hr>
              <div class="alert alert-primary" role="alert">
                <strong>Note - </strong> <?php echo app('translator')->get('Please note, do not share your API Keys with anyone, we will not request for it, should you have any reason to doubt your API key, please feel free to generate
                new API keys using the button below'); ?>
              </div>

              <div class="d-flex align-items-center gap-3">
                <a class="btn btn-primary" href="<?php echo e(route('user.api.key.generate')); ?>">Generate New Key</a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>



   <!-- Transaction Log -->
   <div class="col-lg-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
          <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold"><?php echo app('translator')->get('Webhook Settings'); ?></h5>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="card">
            <div class="card-body p-4">
              <div id="kt_signin_email_edit" class="flex-row-fluid">
                <!--begin::Form-->
                <form id="kt_change_pin" action="<?php echo e(route('user.api.webhook')); ?>" class="form" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row mb-6">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="fv-row mb-0">
                                <label for="webhhook" class="form-label fs-6 fw-bold mb-3"><?php echo app('translator')->get('Enter Your Webhook URL'); ?></label>
                                <input type="text" name="webhook" value="<?php echo e($user->webhook_url); ?>"
                                    class="form-control form-control-lg form-control-solid"
                                    id="webhhook" placeholder="https://example.webhook.com" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="fv-row mb-0">
                                <label for="callback"
                                    class="form-label fs-6 fw-bold mb-3"><?php echo app('translator')->get('Enter Your Callback URL'); ?></label>
                                <input type="text" value="<?php echo e($user->redirect_url); ?>"
                                    class="form-control form-control-lg form-control-solid"
                                    name="callback" id="callback" placeholder="https://example.callback.com" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <button id="kt_pin_submit" type="submit"
                            class="btn btn-primary  me-2 px-6"><?php echo app('translator')->get('Update Settings'); ?></button>

                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Edit-->
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>


   <!-- Transaction Log -->
   <div class="col-lg-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
          <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold"><?php echo app('translator')->get('Sample Webhook Notification Response'); ?></h5>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="card">
            <div class="card-body p-4">
              <div id="kt_signin_email_edit" class="flex-row-fluid">
                <!--begin::Form-->

                    <div class="row mb-6 align-left">
                        <code>
                          <pre>
                          {
                            "amount_requested": "3",
                            "transaction_fee": "0.3",
                            "amount_credited": "2.7",
                            "transaction_ref": "Whogopay-Africa-Limitwered-304b5fca-a643-4a91-8d76-43f0d92a07b4",
                            "originator_account_name": "ADEMOLA BRIGGS OL",
                            "originator_account_number": "7833772288",
                            "originator_bank": "FCMB",
                            "transaction_date": "2024-03-09T07:07:23.031Z"
                          }
                        </pre>
                        </code>
                    </div>

                <!--end::Form-->
            </div>
            <!--end::Edit-->
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/satoshi/user/api_key.blade.php ENDPATH**/ ?>