<?php $__env->startSection('panel'); ?>
    <div class="row gy-4">
        <div class="col-xl-4">
            <div class="card custom--card">
                <div class="card-body">
                    <h5 class="text-center"><?php echo app('translator')->get('You are aplying to take loan'); ?></h5>
                    <p class="text-center text--danger">(<?php echo app('translator')->get('Be Sure Before Confirm'); ?>)</p>
                    <ul>
                        <li class="pricing-card__list flex-between">
                            <span class="fw-bold"><?php echo app('translator')->get('Plan Name'); ?></span>
                            <span><?php echo app('translator')->get($plan->name); ?></span>
                        </li>

                        <li class="pricing-card__list flex-between">
                            <span class="fw-bold"><?php echo app('translator')->get('Loan Amount'); ?></span>
                            <span><?php echo e($general->cur_sym . showAmount($amount)); ?></span>
                        </li>

                        <li class="pricing-card__list flex-between">
                            <span class="fw-bold"><?php echo app('translator')->get('Total Installment'); ?></span>
                            <span><?php echo e($plan->total_installment); ?></span>
                        </li>

                        <?php $per_intallment = $amount * $plan->per_installment / 100; ?>

                        <li class="pricing-card__list flex-between">
                            <span class="fw-bold"><?php echo app('translator')->get('Per Installment'); ?></span>
                            <span><?php echo e($general->cur_sym . showAmount($per_intallment)); ?></span>
                        </li>

                        <li class="pricing-card__list flex-between text--danger">
                            <span class="fw-bold"><?php echo app('translator')->get('You Need To Pay'); ?></span>
                            <span class="fw-bold"><?php echo e($general->cur_sym . showAmount($per_intallment * $plan->total_installment)); ?></span>
                        </li>
                    </ul>

                    <p class="p-2">
                        <?php if($plan->delay_value && getAmount($plan->delay_charge)): ?>
                            <small class="text--danger">*
                                <?php echo app('translator')->get('If an installment is delayed for'); ?>
                                <span class="fw-bold"><?php echo e($plan->delay_value); ?></span> <?php echo app('translator')->get('or more days then, an amount of'); ?>, <span class="fw-bold"><?php echo e($general->cur_sym . showAmount($plan->delay_charge)); ?></span> <?php echo app('translator')->get('will be applied for each day.'); ?>
                            </small>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card custom--card">
                <div class="card-header">
                    <h5 class="card-title"><?php echo app('translator')->get('Application Form'); ?></h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('user.loan.apply.confirm')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php if($plan->instruction): ?>
                            <div class="form-group">
                                <p class="rounded p-3">
                                    <?php echo $plan->instruction ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        <?php if($formData): ?>
                        <?php $__currentLoopData = $formData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group">
                                <label class="form-label <?php if($data->is_required == 'required'): ?> required <?php endif; ?>"><?php echo e(__(keyToTitle($data->name))); ?></label>
                                <?php if($data->type == 'text'): ?>
                                    <input type="text" class="form-control form--control" name="<?php echo e($data->label); ?>" value="<?php echo e(old($data->label)); ?>" <?php if($data->is_required == 'required'): ?> required <?php endif; ?>>
                                <?php elseif($data->type == 'textarea'): ?>
                                    <textarea class="form-control form--control" name="<?php echo e($data->label); ?>" <?php if($data->is_required == 'required'): ?> required <?php endif; ?>><?php echo e(old($data->label)); ?></textarea>
                                <?php elseif($data->type == 'select'): ?>
                                    <select class="form-control form--control" name="<?php echo e($data->label); ?>" <?php if($data->is_required == 'required'): ?> required <?php endif; ?>>
                                        <option value=""><?php echo app('translator')->get('Select One'); ?></option>
                                        <?php $__currentLoopData = $data->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item); ?>" <?php if($item == old($data->label)): echo 'selected'; endif; ?>><?php echo e(__($item)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php elseif($data->type == 'checkbox'): ?>
                                    <?php $__currentLoopData = $data->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-check">
                                            <input class="form-check-input" name="<?php echo e($data->label); ?>[]" type="checkbox" value="<?php echo e($option); ?>" id="<?php echo e($data->label); ?>_<?php echo e(titleToKey($option)); ?>">
                                            <label class="form-check-label" for="<?php echo e($data->label); ?>_<?php echo e(titleToKey($option)); ?>"><?php echo e($option); ?></label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php elseif($data->type == 'radio'): ?>
                                    <?php $__currentLoopData = $data->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-check">
                                            <input class="form-check-input" name="<?php echo e($data->label); ?>" type="radio" value="<?php echo e($option); ?>" id="<?php echo e($data->label); ?>_<?php echo e(titleToKey($option)); ?>" <?php if($option == old($data->label)): echo 'checked'; endif; ?>>
                                            <label class="form-check-label" for="<?php echo e($data->label); ?>_<?php echo e(titleToKey($option)); ?>"><?php echo e($option); ?></label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php elseif($data->type == 'file'): ?>
                                    <input type="file" class="form-control form--control" name="<?php echo e($data->label); ?>" <?php if($data->is_required == 'required'): ?> required <?php endif; ?> accept="<?php $__currentLoopData = explode(',', $data->extensions); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ext): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> .<?php echo e($ext); ?>, <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
                                    <pre class="text--base mt-1"><?php echo app('translator')->get('Supported mimes'); ?>: <?php echo e($data->extensions); ?></pre>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                                <br>
                        <button type="submit" class="btn btn-primary w-100"><?php echo app('translator')->get('Apply'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('bottom-menu'); ?>
    <div class="col-12 order-lg-3 order-4">
        <div class="d-flex nav-buttons flex-align gap-md-3 gap-2">
            <a href="<?php echo e(route('user.loan.plans')); ?>" class="btn btn--base active"><?php echo app('translator')->get('Loan Plans'); ?></a>
            <a href="<?php echo e(route('user.loan.list')); ?>" class="btn btn-outline--base"><?php echo app('translator')->get('My Loan List'); ?></a>
        </div>
    </div>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/loan/form.blade.php ENDPATH**/ ?>