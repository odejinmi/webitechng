<?php if(@$data): ?>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="mb-3">
            <?php if($item->type == 'checkbox'): ?>
                <h6 class="text--info"> <?php echo e(implode(',', $item->value ?? [])); ?></h6>
            <?php elseif($item->type == 'file'): ?>
                <?php if($item->value): ?>
                    <?php if(auth()->guard('admin')->user()): ?>
                        <a class="me-3" href="<?php echo e(route('admin.download.attachment', encrypt(getFilePath('verify') . '/' . $item->value))); ?>"><i class="fa fa-file"></i> <?php echo app('translator')->get('Attachment'); ?> </a>
                    <?php else: ?>
                        <a class="me-3" href="<?php echo e(route('user.download.attachment', encrypt(getFilePath('verify') . '/' . $item->value))); ?>"><i class="fa fa-file"></i> <?php echo app('translator')->get('Attachment'); ?> </a>
                    <?php endif; ?>
                <?php else: ?>
                    <?php echo app('translator')->get('No file or file path not found....'); ?>
                <?php endif; ?>
            <?php else: ?>
                <h6 class="text--dark"><?php echo e(__($item->value)); ?></h6>
            <?php endif; ?>
            <small class="text-muted"><?php echo e(__(keyToTitle(@$item->name))); ?></small>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/components/view-form-data.blade.php ENDPATH**/ ?>