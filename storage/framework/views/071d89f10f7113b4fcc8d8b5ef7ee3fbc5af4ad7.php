
<?php $__env->startSection('panel'); ?>
<form action="" method="post" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
    <div class="d-flex align-items-end justify-content-between">
        <div>
            <h4 class="fw-semibold mb-1">Account Verification</h4>
            <p class="text-sm text-muted">By filling your data you get a much better experience using
                our website.</p>
                <?php if($user->kyc_complete == 3): ?>
                        <badge class="badge bg-warning">KYC Status: <?php echo app('translator')->get('Pending'); ?></badge>
                        <?php elseif($user->kyc_complete == 1): ?>
                        <badge class="badge bg-success">KYC Status: <?php echo app('translator')->get('Approved'); ?></badge>
                        <?php elseif($user->kyc_complete == 2): ?>
                        <badge class="badge bg-danger">KYC Status: <?php echo app('translator')->get('Rejected'); ?></badge>
                        <?php echo app('translator')->get('Please proceed to reupload file'); ?>
                        <?php endif; ?>
        </div> 
    </div>
    <hr class="my-6">
    <div class="row align-items-center">
        <div class="col-md-2"><label class="form-label">Your name</label></div>
        <div class="col-md-8 col-xl-5">
            <div class=""><input type="text" value="<?php echo e($user->fullname); ?>" disabled class="form-control"></div>
        </div>
    </div> 
    <hr class="my-6">
    <div class="row align-items-center">
        <div class="col-md-2"><label class="form-label">Email</label></div>
        <div class="col-md-8 col-xl-5">
            <div class="">
                <div class="input-group position-relative">
                    <input type="email" disabled value="<?php echo e($user->email); ?>" class="form-control"
                        placeholder="username" aria-label="username">
                    <span class="input-group-text"><i class="bi bi-check"></i></span>
                </div>
                <span class="mt-2 valid-feedback">Looks good!</span>
            </div>
        </div>
    </div>
     
    <hr class="my-6">
    <div class="row align-items-center">
        <div class="col-md-2"><label class="form-label">Id Type</label></div>
        <div class="col-md-8 col-xl-5">
            <div class="">
                <div class="input-group position-relative">
                   <select class="form-select crancy__item-input" aria-label="Default select example" name="type">
                        <option>Select</option>
                        <option>Voters Card</option>
                        <option>International Passport</option>
                        <option>Drivers Licence</option>
                        <option>NIN Card</option>
                      </select>
                </div>
            </div>
        </div>
    </div>
     
    <hr class="my-6">
    <div class="row align-items-center">
        <div class="col-md-2"><label class="form-label">Front View</label></div>
        <div class="col-md-8 col-xl-5">
            <div class=""><label class="form-label visually-hidden">Front View</label>
                <div class="card shadow-none border-2 border-dashed border-primary-hover position-relative">
                    <div class="d-flex justify-content-center px-5 py-5">
                        <label for="front" class="position-absolute w-100 h-100 top-0 start-0 cursor-pointer"><input
                                name="front" id="front" autocomplete="off"
                              onchange="readURL(this);"  type="file" class="visually-hidden"></label>
                        <div class="text-center">
                            <div class="text-2xl text-muted">
                              <img id="khaytech" width="35"
                                src="<?php echo e(asset($activeTemplateTrue . 'dashboard/img/upload-file.png')); ?>" />
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

    <hr class="my-6">
    <div class="row align-items-center">
        <div class="col-md-2"><label class="form-label">Back View</label></div>
        <div class="col-md-8 col-xl-5">
            <div class=""><label class="form-label visually-hidden">Back View</label>
                <div class="card shadow-none border-2 border-dashed border-primary-hover position-relative">
                    <div class="d-flex justify-content-center px-5 py-5">
                        <label for="back" class="position-absolute w-100 h-100 top-0 start-0 cursor-pointer"><input
                                name="front" id="back" autocomplete="off"
                              onchange="readURL2(this);"  type="file" class="visually-hidden"></label>
                        <div class="text-center">
                            <div class="text-2xl text-muted">
                              <img id="khaytech2" width="35"
                                src="<?php echo e(asset($activeTemplateTrue . 'dashboard/img/upload-file.png')); ?>" />
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

    <?php $__env->startPush('script'); ?>
      <script>
        function readURL(input) {
          if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
              document.querySelector('#khaytech').setAttribute('src', e.target.result)
            };
            reader.readAsDataURL(input.files[0]);
          }
        }

        function readURL2(input) {
          if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
              document.querySelector('#khaytech2').setAttribute('src', e.target.result)
            };
            reader.readAsDataURL(input.files[0]);
          }
        }
      </script>
      <?php $__env->stopPush(); ?>
    <hr class="my-6">
    <div class="row align-items-center">
        <div class="col-md-2"><label class="form-label">Privacy</label></div>
        <div class="col-md-8 col-xl-5">
            <div class="form-check form-switch"><input class="form-check-input"  required type="checkbox" name="switch_make_public"
                    id="switch_make_public">
                <label class="form-check-label ms-2" for="switch_make_public">I concent that i am not submitting false document</label>
            </div>
        </div>
    </div>
    <hr class="my-6 d-md-nones">
    <div class="d-flex d-md-nones justify-content-end gap-2 mb-6">
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/satoshi/user/kyc/index.blade.php ENDPATH**/ ?>