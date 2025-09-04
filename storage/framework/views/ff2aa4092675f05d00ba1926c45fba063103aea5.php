<?php $__env->startSection('panel'); ?>

    <section class="crancy-adashboard crancy-shows">
        <div class="container container__bscreen">
            <div class="row">
                <div class="col-8" style="
      margin-left: auto;
      margin-right: auto;">
                    <div class="crancy-body">
                        <!-- Dashboard Inner -->
                        <div class="crancy-dsinner">

                            <!-- Single User -->

                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <div>
                                            <h5><?php echo e($withdraw->method->name); ?></h5>
                                        </div>
                                        <div class="hstack align-items-center"><a href="#" class="text-muted"><i
                                                    class="bi bi-arrow-repeat"></i></a>
                                        </div>
                                    </div>
                                    <div class="vstack gap-6">
                                        <div>
                                            <div class="d-flex align-items-center gap-3">
                                                <div
                                                    class="icon icon-shape flex-none text-base text-bg-dark rounded-circle">
                                                    <img src="<?php echo e(getImage(imagePath()['withdraw']['method']['path'] . '/' . $withdraw->method->image, imagePath()['withdraw']['method']['size'])); ?>"
                                                        class="w-rem-6 h-rem-6" alt="...">
                                                </div>
                                                <div>
                                                    <h6 class="progress-text mb-1 d-block">Rate</h6>
                                                    <p class="text-muted text-xs">Exchange Rate</p>
                                                </div>
                                                <div class="text-end ms-auto">
                                                    <span class="h6 text-sm">1 <?php echo e(__($general->cur_text)); ?> =
                                                        <?php echo e(showAmount($withdraw->rate)); ?>

                                                        <?php echo e(__($withdraw->currency)); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center gap-3">
                                                <div
                                                    class="icon icon-shape flex-none text-base text-bg-dark rounded-circle">
                                                    <img src="<?php echo e(getImage(imagePath()['withdraw']['method']['path'] . '/' . $withdraw->method->image, imagePath()['withdraw']['method']['size'])); ?>"
                                                        class="w-rem-6 h-rem-6" alt="...">
                                                </div>
                                                <div>
                                                    <h6 class="progress-text mb-1 d-block">Amount</h6>
                                                    <p class="text-danger text-xs">Fee: <?php echo e(showAmount($withdraw->charge)); ?>

                                                        <?php echo e(__($general->cur_text)); ?></p>
                                                </div>
                                                <div class="text-end ms-auto">
                                                    <span class="h6 text-sm"><?php echo e(showAmount($withdraw->amount)); ?>

                                                        <?php echo e(__($general->cur_text)); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center gap-3">
                                                <div
                                                    class="icon icon-shape flex-none text-base text-bg-dark rounded-circle">
                                                    <img src="<?php echo e(getImage(imagePath()['withdraw']['method']['path'] . '/' . $withdraw->method->image, imagePath()['withdraw']['method']['size'])); ?>"
                                                        class="w-rem-6 h-rem-6" alt="...">
                                                </div>
                                                <div>
                                                    <h6 class="progress-text mb-1 d-block">Payment</h6>
                                                    <p class="text-muted text-xs"></p>
                                                </div>
                                                <div class="text-end ms-auto">
                                                    <span class="h6 text-sm"><?php echo e(showAmount($withdraw->final_amount)); ?>

                                                        <?php echo e(__($withdraw->currency)); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="crancy-single-user mg-top-30">
                                <div class="alert alert-info mt-3 mb-3">


                                    <p class="card-subtitle mb-0"><?php echo $withdraw->method->description; ?></p>
                                </div>

                                <form action="<?php echo e(route('user.withdraw.submit')); ?>" method="post"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <?php if($withdraw->method->user_data): ?>
                                        <?php $__currentLoopData = $withdraw->method->user_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($v->type == 'text'): ?>
                                                <div class="form-group mb-3">
                                                    <label><strong><?php echo e(strtoUpper($v->field_level)); ?> <?php if($v->validation == 'required'): ?>
                                                                <span class="text-danger">*</span>
                                                            <?php endif; ?>
                                                        </strong>
                                                    </label>
                                                    <input type="text" name="<?php echo e($k); ?>" class="form-control"
                                                        value="<?php echo e(old($k)); ?>"
                                                        placeholder="<?php echo e(__($v->field_level)); ?>"
                                                        <?php if($v->validation == 'required'): ?> required <?php endif; ?>>
                                                    <?php if($errors->has($k)): ?>
                                                        <span class="text-danger"><?php echo e(__($errors->first($k))); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php elseif($v->type == 'textarea'): ?>
                                                <div class="form-group mb-3">
                                                    <label><strong><?php echo e(strtoUpper($v->field_level)); ?> <?php if($v->validation == 'required'): ?>
                                                                <span class="text-danger">*</span>
                                                            <?php endif; ?>
                                                        </strong>
                                                    </label>
                                                    <textarea name="<?php echo e($k); ?>" class="form-control" placeholder="<?php echo e(__($v->field_level)); ?>" rows="3"
                                                        <?php if($v->validation == 'required'): ?> required <?php endif; ?>><?php echo e(old($k)); ?></textarea>
                                                    <?php if($errors->has($k)): ?>
                                                        <span class="text-danger"><?php echo e(__($errors->first($k))); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php elseif($v->type == 'file'): ?>
                                                <label><strong><?php echo e(strtoUpper($v->field_level)); ?> <?php if($v->validation == 'required'): ?>
                                                            <span class="text-danger">*</span>
                                                        <?php endif; ?>
                                                    </strong></label>
                                                <div class="form-group mb-3">
                                                    <div class="fileinput fileinput-new " data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail withdraw-thumbnail"
                                                            data-trigger="fileinput">
                                                            <img class="w-100" src="<?php echo e(getImage('/')); ?>"
                                                                alt="<?php echo app('translator')->get('Image'); ?>">
                                                        </div>
                                                        <div
                                                            class="fileinput-preview fileinput-exists thumbnail wh-200-150">
                                                        </div>
                                                        <div class="img-input-div">
                                                            <span class="btn btn-info btn-file">
                                                                <span class="fileinput-new "> <?php echo app('translator')->get('Select'); ?>
                                                                    <?php echo e(__($v->field_level)); ?></span>
                                                                <span class="fileinput-exists"> <?php echo app('translator')->get('Change'); ?></span>
                                                                <input type="file" class="form-control"
                                                                    name="<?php echo e($k); ?>" accept="image/*"
                                                                    <?php if($v->validation == 'required'): ?> required <?php endif; ?>>
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


                                    <button type="submit" id="btn-confirm" class="btn btn-primary btn-xm">Confirm</button>

                            </div>
                            <!-- End Single User -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/templates/satoshi/user/withdraw/preview.blade.php ENDPATH**/ ?>