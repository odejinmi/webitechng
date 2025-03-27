<?php $__env->startSection('panel'); ?>
<div class="row">
    <!-- Weekly Stats -->
    <div class="col-lg-4 d-flex align-items-strech">
      <div class="card w-100">
        <div class="card-body">
          <h5 class="card-title fw-semibold">Weekly Stats</h5>
          <p class="card-subtitle mb-0">Average sales</p>
          <div id="stats" class="my-4"></div>

          <div class="position-relative">
            <div class="d-flex align-items-center justify-content-between mb-7">
 

              <div class="d-flex">
                <div class="p-6 bg-light-primary rounded me-6 d-flex align-items-center justify-content-center">
                  <i class="ti ti-grid-dots text-primary fs-6"></i>
                </div>
                <div>
                  <h6 class="mb-1 fs-4 fw-semibold"><?php echo app('translator')->get('Request Amount'); ?></h6>
                  <p class="fs-3 mb-0"></p>
                </div>
              </div>
              <div class="bg-light-primary badge">
                <p class="fs-3 text-primary fw-semibold mb-0"><?php echo e(showAmount($withdraw->amount)); ?> <?php echo e(__($general->cur_text)); ?></p>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-7">
              <div class="d-flex">
                <div class="p-6 bg-light-success rounded me-6 d-flex align-items-center justify-content-center">
                  <i class="ti ti-grid-dots text-success fs-6"></i>
                </div>
                <div>
                  <h6 class="mb-1 fs-4 fw-semibold"><?php echo app('translator')->get('Payout Charge'); ?></h6>
                  <p class="fs-3 mb-0"></p>
                </div>
              </div>
              <div class="bg-light-success badge">
                <p class="fs-3 text-success fw-semibold mb-0"><?php echo e(showAmount($withdraw->charge)); ?> <?php echo e(__($general->cur_text)); ?></p>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-7">
                <div class="d-flex">
                <div class="p-6 bg-light-danger rounded me-6 d-flex align-items-center justify-content-center">
                  <i class="ti ti-grid-dots text-danger fs-6"></i>
                </div>
                <div>
                  <h6 class="mb-1 fs-4 fw-semibold"><?php echo app('translator')->get('After Charge'); ?></h6>
                  <p class="fs-3 mb-0"></p>
                </div>
              </div>
              <div class="bg-light-danger badge">
                <p class="fs-3 text-danger fw-semibold mb-0"><?php echo e(showAmount($withdraw->after_charge)); ?> <?php echo e(__($general->cur_text)); ?></p>
              </div>
            </div>


            <div class="d-flex align-items-center justify-content-between mb-7">
                <div class="d-flex">
                  <div class="p-6 bg-light-danger rounded me-6 d-flex align-items-center justify-content-center">
                    <i class="ti ti-grid-dots text-danger fs-6"></i>
                  </div>
                  <div>
                    <h6 class="mb-1 fs-4 fw-semibold"><?php echo app('translator')->get('Conversion Rate'); ?></h6>
                    <p class="fs-3 mb-0"></p>
                  </div>
                </div>
                <div class="bg-light-danger badge">
                  <p class="fs-3 text-danger fw-semibold mb-0">1 <?php echo e(__($general->cur_text)); ?> = <?php echo e(showAmount($withdraw->rate)); ?> <?php echo e(__($withdraw->currency)); ?></p>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-7">
                <div class="d-flex">
                  <div class="p-6 bg-light-danger rounded me-6 d-flex align-items-center justify-content-center">
                    <i class="ti ti-grid-dots text-danger fs-6"></i>
                  </div>
                  <div>
                    <h6 class="mb-1 fs-4 fw-semibold"><?php echo app('translator')->get('What You Get'); ?></h6>
                    <p class="fs-3 mb-0"></p>
                  </div>
                </div>
                <div class="bg-light-danger badge">
                  <p class="fs-3 text-danger fw-semibold mb-0"><?php echo e(showAmount($withdraw->final_amount)); ?> <?php echo e(__($withdraw->currency)); ?></p>
                </div>
            </div>


          </div>
        </div>
      </div>
    </div>


    <!-- Top Performers -->
    <div class="col-lg-8 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold"><?php echo e($withdraw->method->name); ?></h5>
                <p class="card-subtitle mb-0"><?php echo $withdraw->method->description; ?></p>
              </div>
              <div>
                <img width="50" src="<?php echo e(getImage(imagePath()['withdraw']['method']['path'].'/'. $withdraw->method->image,imagePath()['withdraw']['method']['size'])); ?>">

              </div>
            </div>
            <form action="<?php echo e(route('user.withdraw.submit')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if($withdraw->method->user_data): ?>
                <?php $__currentLoopData = $withdraw->method->user_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($v->type == "text"): ?>
                        <div class="form-group mb-3">
                            <label><strong><?php echo e(strtoUpper($v->field_level)); ?> <?php if($v->validation == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                            <input type="text" name="<?php echo e($k); ?>" class="form-control" value="<?php echo e(old($k)); ?>" placeholder="<?php echo e(__($v->field_level)); ?>" <?php if($v->validation == "required"): ?> required <?php endif; ?>>
                            <?php if($errors->has($k)): ?>
                                <span class="text-danger"><?php echo e(__($errors->first($k))); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php elseif($v->type == "textarea"): ?>
                        <div class="form-group mb-3">
                            <label><strong><?php echo e(strtoUpper($v->field_level)); ?> <?php if($v->validation == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                            <textarea name="<?php echo e($k); ?>"  class="form-control"  placeholder="<?php echo e(__($v->field_level)); ?>" rows="3" <?php if($v->validation == "required"): ?> required <?php endif; ?>><?php echo e(old($k)); ?></textarea>
                            <?php if($errors->has($k)): ?>
                                <span class="text-danger"><?php echo e(__($errors->first($k))); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php elseif($v->type == "file"): ?>
                        <label><strong><?php echo e(strtoUpper($v->field_level)); ?> <?php if($v->validation == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                        <div class="form-group mb-3">
                            <div class="fileinput fileinput-new " data-provides="fileinput">
                                <div class="fileinput-new thumbnail withdraw-thumbnail"
                                     data-trigger="fileinput">
                                    <img class="w-100" src="<?php echo e(getImage('/')); ?>" alt="<?php echo app('translator')->get('Image'); ?>">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail wh-200-150"></div>
                                <div class="img-input-div">
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new "> <?php echo app('translator')->get('Select'); ?> <?php echo e(__($v->field_level)); ?></span>
                                        <span class="fileinput-exists"> <?php echo app('translator')->get('Change'); ?></span>
                                        <input type="file" class="form-control" name="<?php echo e($k); ?>" accept="image/*" <?php if($v->validation == "required"): ?> required <?php endif; ?>>
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists"
                                    data-dismiss="fileinput"> <?php echo app('translator')->get('Remove'); ?></a>
                                </div>
                            </div>
                            <?php if($errors->has($k)): ?>
                                <br>
                                <span class="text-danger"><?php echo e(__($errors->first($k))); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <button type="submit" class="btn w-100 btn-block btn-primary mt-3" id="btn-confirm"><?php echo app('translator')->get('Confirm'); ?></button></li>
 
            </form>
          </div>
        </div>
      </div>


</div>

 
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script-lib'); ?>
<script src="<?php echo e(asset($activeTemplateTrue.'/js/bootstrap-fileinput.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('style-lib'); ?>
<link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue.'/css/bootstrap-fileinput.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>

    (function($){

        "use strict";

            $('.withdraw-thumbnail').hide();

            $('.clickBtn').on('click', function() {

                var classNmae = $('.fileinput').attr('class');

                if(classNmae != 'fileinput fileinput-exists'){
                    $('.withdraw-thumbnail').hide();
                }else{

                    $('.fileinput-preview img').css({"width":"100%", "height":"300px", "object-fit":"contain"});

                    $('.withdraw-thumbnail').show();

                }

            });

    })(jQuery);

</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
<style>
    .fileinput .thumbnail{
        max-height: 300px;
        width: 100%;
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/withdraw/preview.blade.php ENDPATH**/ ?>