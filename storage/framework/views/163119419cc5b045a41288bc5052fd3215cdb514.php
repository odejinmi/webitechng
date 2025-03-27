<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'title' => 'User Data',
    'form' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'title' => 'User Data',
    'form' => null,
]); ?>
<?php foreach (array_filter(([
    'title' => 'User Data',
    'form' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="card mt-3">

    <div class="card-header d-flex justify-content-between">
        <h5 class="card-title"><?php echo e(__(@$title)); ?></h5>
        <button type="button" class="btn btn-sm btn-outline--primary float-end form-generate-btn">
            <i class="la la-fw la-plus"></i><?php echo app('translator')->get('Add New'); ?>
        </button>
    </div>

    <div class="card-body">
        <div class="row addedField">
            <?php if(@$form): ?>
                <?php $__currentLoopData = $form->form_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="card border mb-3" id="<?php echo e($loop->index); ?>">
                            <input type="hidden" name="form_generator[is_required][]" value="<?php echo e($formData->is_required); ?>">
                            <input type="hidden" name="form_generator[extensions][]" value="<?php echo e($formData->extensions); ?>">
                            <input type="hidden" name="form_generator[options][]" value="<?php echo e(implode(',', $formData->options)); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Label'); ?></label>
                                    <input type="text" name="form_generator[form_label][]" class="form-control" value="<?php echo e($formData->name); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Type'); ?></label>
                                    <input type="text" name="form_generator[form_type][]" class="form-control" value="<?php echo e($formData->type); ?>" readonly>
                                </div>
                                <?php
                                    $jsonData = getFormData($formData);
                                ?>
                                <?php if(!@$formData->default): ?>
                                    <div class="btn-group w-100">
                                        <button type="button" class="btn btn--primary editFormData" data-form_item="<?php echo e($jsonData); ?>" data-update_id="<?php echo e($loop->index); ?>">
                                            <i class="las la-pen"></i>
                                        </button>
                                        <button type="button" class="btn btn--danger removeFormData">
                                            <i class="las la-times"></i>
                                        </button>
                                    </div>
                                <?php else: ?>
                                    <div class="bg--danger w-100 p-1 rounded text-center"> <?php echo app('translator')->get('Must be Required'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->startPush('script'); ?>
    <script>
        "use strict"
        var formGenerator = new FormGenerator();
        formGenerator.totalField = <?php echo e(@$form ? count((array) $form->form_data) : 0); ?>

    </script>

    <script src="<?php echo e(asset('assets/global/js/form_actions.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/ltecyxtc/public_html/core/resources/views/components/viser-form-data.blade.php ENDPATH**/ ?>