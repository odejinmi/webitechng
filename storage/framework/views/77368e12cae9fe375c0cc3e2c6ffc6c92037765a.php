<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="<?php echo e(route('admin.withdraw.method.update', $method->id)); ?>" method="POST"
                      enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="payment-method-item">
                            <div class="payment-method-header">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url(<?php echo e(getImage(imagePath()['withdraw']['method']['path'].'/'. $method->image,imagePath()['withdraw']['method']['size'])); ?>)"></div>
                                    </div>

                                    <label><?php echo app('translator')->get('Method Logo'); ?></label>
                                    <div class="avatar-edit">
                                        <input type="file" name="image" class="form-control profilePicUpload" id="image" accept=".png, .jpg, .jpeg"/>
                                    </div>
                                </div>
                                
                                <div class="content mt-3">
                                    <label><?php echo app('translator')->get('Method Name'); ?></label>
                                    <div class="d-flex justify-content-between">
                                        <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Method Name'); ?>" name="name" value="<?php echo e($method->name); ?>"/>
                                    </div>
                                    <br>
                                    <div class="d-flex justify-content-between">
                                    <ul class="list-group">
                                        <li
                                            class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                            <div>
                                                <p class="fw-bold mb-0"><?php echo app('translator')->get('Affiliate Payout'); ?></p>
                                                <p class="mb-0">
                                                    <small><?php echo app('translator')->get('If you disable this module, non affiliate users will be able to make request using this method'); ?></small>
                                                </p>

                                                <div class="form-check form-switch form-check-success">
                                                    <input type="checkbox" class="form-check-input" name="affiliate"
                                                    <?php if($method->affiliate): ?> checked <?php endif; ?> id="affiliate" />
                                                    <label class="form-check-label" for="affiliate">
                                                        <span class="switch-icon-left"><i data-feather="plus"></i></span>
                                                        <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                    </label>
                                                </div>

                                            </div>
                                           
                                        </li>
                                        
                                    </ul>
                                    
                                    </div>
                                    <div class="row mt-4">
                                         
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="w-100"><?php echo app('translator')->get('Currency'); ?> <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="currency" class="form-control border-radius-5" value="<?php echo e($method->currency); ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="w-100"><?php echo app('translator')->get('Rate'); ?> <span class="text-danger">*</span></label>

                                                <div class="input-group has_append">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">1 <?php echo e(__($general->cur_text)); ?>

                                                            =
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="0" name="rate" value="<?php echo e(getAmount($method->rate)); ?>"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="currency_symbol"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="w-100"><?php echo app('translator')->get('Processing Time'); ?> <span class="text-danger">*</span></label>
                                                <input type="text" name="delay" class="form-control border-radius-5" value="<?php echo e($method->delay); ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment-method-body">
                                <div class="row">
                                    <div class="col-lg-12 mt-4">
                                        <div class="card border-primary mb-2">
                                            <h5 class="card-header bg-light-primary"><?php echo app('translator')->get('Payout Days'); ?></h5>
                                            <div class="card-body">
                                                <small class="ms-2 mt-2  "><?php echo app('translator')->get('Separate multiple days by'); ?> <code>,</code>(<?php echo app('translator')->get('comma'); ?>)
                                                    <?php echo app('translator')->get('or'); ?> <code><?php echo app('translator')->get('enter'); ?></code> <?php echo app('translator')->get('key'); ?></small>
                                                    <br>
                                                    <small> <b class="text-danger">Days of the week are case sensitive. Please use correct spelling starting the first letter with an <b>Uppercase</b></b></small>

                                                <select name="payout_days[]" class="form-control select2-auto-tokenize" multiple="multiple"
                                                    required>
                                                    <?php if(@$method->payout_days): ?>
                                                    <?php $__currentLoopData = json_decode($method->payout_days,true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($option); ?>" selected><?php echo e(__($option)); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?> 
                                                </select>
                                                
                                                <?php $__env->startPush('script'); ?>
                                                <script>
                                                    (function($) {
                                                        "use strict";
                                                        $('.select2-auto-tokenize').select2({
                                                           // dropdownParent: $('.card-body'),
                                                            tags: true,
                                                            tokenSeparators: [',']
                                                        });
                                                    })(jQuery);
                                                </script>
                                                <?php $__env->stopPush(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card border-primary mb-2">
                                            <h5 class="card-header bg-light-primary"><?php echo app('translator')->get('Range'); ?></h5>
                                            <div class="card-body">
                                                <div class="input-group has_append mb-3">
                                                    <label class="w-100"><?php echo app('translator')->get('Minimum Amount'); ?> <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="min_limit" placeholder="0" value="<?php echo e(getAmount($method->min_limit)); ?>"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"> <?php echo e(__($general->cur_text)); ?> </div>
                                                    </div>
                                                </div>
                                                <div class="input-group has_append">
                                                    <label class="w-100"><?php echo app('translator')->get('Maximum Amount'); ?> <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="0" name="max_limit" value="<?php echo e(getAmount($method->max_limit)); ?>"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"> <?php echo e(__($general->cur_text)); ?> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card border-primary">
                                            <h5 class="card-header bg-light-primary"><?php echo app('translator')->get('Charge'); ?></h5>
                                            <div class="card-body">
                                                <div class="input-group has_append mb-3">
                                                    <label class="w-100"><?php echo app('translator')->get('Fixed Charge'); ?> <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="0" name="fixed_charge" value="<?php echo e(getAmount($method->fixed_charge)); ?>"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"> <?php echo e(__($general->cur_text)); ?> </div>
                                                    </div>
                                                </div>
                                                <div class="input-group has_append">
                                                    <label class="w-100"><?php echo app('translator')->get('Percent Charge'); ?> <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="0" name="percent_charge" value="<?php echo e(getAmount($method->percent_charge)); ?>">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">%</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card border-primary my-2">
                                            <h5 class="card-header bg-light-primary"><?php echo app('translator')->get('Withdraw Instruction'); ?> </h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea rows="5" class="form-control border-radius-5 nicEdit" name="instruction"><?php echo e($method->description); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card border-primary">

                                            <h5 class="card-header bg-light-primary"> 
                                                <button style="display: flex; justify-content: flex-end; margin-left: auto; margin-right: 0;" type="button" class="btn btn-sm btn-outline-primary float-right addUserData">
                                                    <i class="ti ti-plus"></i><?php echo app('translator')->get('Add New'); ?>
                                                </button>
                                            </h5>


                                            <div class="card-body">
                                                <div class="row addedField">

                                                    <?php if($method->user_data != null): ?>
                                                        <?php $__currentLoopData = $method->user_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-12 user-data">
                                                                <div class="form-group">
                                                                    <div class="input-group mb-md-0 mb-4">
                                                                        <div class="col-md-4">
                                                                            <input name="field_name[]" class="form-control" type="text" value="<?php echo e($v->field_level); ?>" required placeholder="<?php echo app('translator')->get('Field Name'); ?>">
                                                                        </div>
                                                                        <div class="col-md-3 mt-md-0 mt-2">
                                                                            <select name="type[]" class="form-control">
                                                                                <option value="text" <?php if($v->type == 'text'): ?> selected <?php endif; ?>> 
                                                                                    <?php echo app('translator')->get('Input Text'); ?>
                                                                                </option>
                                                                                <option value="textarea" <?php if($v->type == 'textarea'): ?> selected <?php endif; ?>> 
                                                                                    <?php echo app('translator')->get('Textarea'); ?>
                                                                                </option>
                                                                                <option value="file" <?php if($v->type == 'file'): ?> selected <?php endif; ?>> 
                                                                                    <?php echo app('translator')->get('File'); ?>
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3 mt-md-0 mt-2">
                                                                            <select name="validation[]" class="form-control">
                                                                                <option value="required" <?php if($v->validation == 'required'): ?> selected <?php endif; ?>> <?php echo app('translator')->get('Required'); ?> </option>
                                                                                <option value="nullable" <?php if($v->validation == 'nullable'): ?> selected <?php endif; ?>>  <?php echo app('translator')->get('Optional'); ?> </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-2 mt-md-0 mt-2 text-right">
                                                                            <span class="input-group-btn">
                                                                                <button class="btn btn-outline-danger btn-lg removeBtn w-100" type="button">
                                                                                    <i class="ti ti-trash"></i>
                                                                                </button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary btn-block"><?php echo app('translator')->get('Save Method'); ?></button>
                    </div>
                </form>
            </div><!-- card end -->
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('admin.withdraw.method.index')); ?>" class="btn btn-sm btn-outline-primary box--shadow1 text--small">
        <i class="la la-fw la-backward"></i> <?php echo app('translator')->get('Go Back'); ?>
    </a>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('style'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        (function ($) {
            "use strict";

            $('input[name=currency]').on('input', function () {
                $('.currency_symbol').text($(this).val());
            });
            $('.currency_symbol').text($('input[name=currency]').val());

            $('.addUserData').on('click', function () {
                var html = `
                <div class="col-md-12 user-data">
                    <div class="form-group">
                        <div class="input-group mb-md-0 mb-4">
                            <div class="col-md-4">
                                <input name="field_name[]" class="form-control" type="text" required placeholder="<?php echo app('translator')->get('Field Name'); ?>">
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <select name="type[]" class="form-control">
                                    <option value="text" > <?php echo app('translator')->get('Input Text'); ?> </option>
                                    <option value="textarea" > <?php echo app('translator')->get('Textarea'); ?> </option>
                                    <option value="file"> <?php echo app('translator')->get('File'); ?> </option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <select name="validation[]"
                                        class="form-control">
                                    <option value="required"> <?php echo app('translator')->get('Required'); ?> </option>
                                    <option value="nullable">  <?php echo app('translator')->get('Optional'); ?> </option>
                                </select>
                            </div>
                            <div class="col-md-2 mt-md-0 mt-2 text-right">
                                <span class="input-group-btn">
                                    <button class="btn btn-outline-danger btn-lg removeBtn w-100" type="button">
                                        <i class="ti ti-x"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>`;

                $('.addedField').append(html);
            });


            $(document).on('click', '.removeBtn', function () {
                $(this).closest('.user-data').remove();
            });

            <?php if(old('currency')): ?>
            $('input[name=currency]').trigger('input');
            <?php endif; ?>
        })(jQuery);


    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/admin/withdraw/edit.blade.php ENDPATH**/ ?>