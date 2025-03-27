<?php $__env->startSection('panel'); ?>
    <div class="row justify-content-center gy-4">
        <div class="col-lg-8">
            <div class="card b-radius--10">
                <div class="card-body  p-4 ">
                    <form action="<?php echo e(route('user.deposit.manual.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <p class="text-center mt-2"><?php echo app('translator')->get('You have requested'); ?> <b
                                        class="text--success"><?php echo e(showAmount($data['amount'])); ?>

                                        <?php echo e(__($general->cur_text)); ?></b> , <?php echo app('translator')->get('Please pay'); ?>
                                    <b class="text--success"><?php echo e(showAmount($data['final_amo']) . ' ' . $data['method_currency']); ?>

                                    </b> <?php echo app('translator')->get('for successful payment'); ?>
                                </p>
                                <h4 class="text-center mb-4"><?php echo app('translator')->get('Please follow the instruction below'); ?></h4>

                                <p class="my-4 text-center"><?php echo  $data->gateway->description ?></p>

                            </div>
                           
                            <?php if($formData): ?>

                                    <?php $__currentLoopData = $formData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php if($v->type == "text"): ?>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong><?php echo e(__(@inputTitle($v->name))); ?> <?php if(@$v->is_required == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                                                    <input type="text" class="form-control form-control-lg"
                                                           name="<?php echo e($k); ?>"  value="<?php echo e(old($k)); ?>" placeholder="<?php echo e(__(@$v->name)); ?>">
                                                </div>
                                            </div>
                                            <?php elseif($v->type == "checkbox"): ?>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong><?php echo e(__(@inputTitle($v->name))); ?> <?php if(@$v->is_required == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                                                    <input  class="form-check-input" type="checkbox"
                                                           name="<?php echo e($k); ?>"  value="<?php echo e(old($k)); ?>" placeholder="<?php echo e(__(@$v->name)); ?>">
                                                </div>
                                            </div>
                                            <?php elseif($v->type == "select"): ?>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong><?php echo e(__(@inputTitle($v->name))); ?> <?php if(@$v->is_required == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                                                    <select class="form-control select2" name="<?php echo e($k); ?>"  value="<?php echo e(old($k)); ?>">
                                                        <?php $__currentLoopData = $v->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option><?php echo e($data); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php elseif($v->type == "radio"): ?>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong><?php echo e(__(@inputTitle($v->name))); ?> <?php if(@$v->is_required == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                                                    <?php $__currentLoopData = $v->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="<?php echo e($k); ?>" value="<?php echo e($data); ?>" name="exampleRadios" id="<?php echo e($data); ?>" value="option1" checked>
                                                        <label class="form-check-label" for="<?php echo e($data); ?>">
                                                            <?php echo e($data); ?>

                                                        </label>
                                                      </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                </div>
                                            </div>
                                           <?php elseif($v->type == "textarea"): ?>
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <label><strong><?php echo e(__(inputTitle($v->name))); ?>

                                                            <?php if($v->is_required == 'required'): ?>
                                                            <span class="text-danger">*</span>
                                                            <?php endif; ?></strong>
                                                        </label>
                                                        <textarea name="<?php echo e($k); ?>"  class="form-control"  placeholder="<?php echo e(__($v->name)); ?>" rows="3"><?php echo e(old($k)); ?></textarea>

                                                    </div>
                                                </div>
                                        <?php elseif($v->type == "file"): ?>
                                            <div class="col-md-12 mb-3">

                                                <label class="text-uppercase">
                                                    <strong>
                                                        <?php echo e(__($v->name)); ?> <?php if($v->is_required == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?>
                                                    </strong>
                                                </label>
                                                <div class="verification-img">
                                                    <div class="image-upload">
                                                        <div class="image-edit">
                                                            <input type='file' name="<?php echo e($k); ?>" id="imageUpload" class="form-control" accept=".png, .jpg, .jpeg" />
                                                            <label for="imageUpload"></label>
                                                        </div>
                                                        <div class="image-preview">
                                                            <div id="imagePreview" style="background-image: url(<?php echo e(asset(imagePath()['image']['default'])); ?>);">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            <div class="col-md-12">
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-outline-primary w-100 h-45"><?php echo app('translator')->get('Pay Now'); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/payment/manual.blade.php ENDPATH**/ ?>