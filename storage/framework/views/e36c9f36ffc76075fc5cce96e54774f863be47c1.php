<?php $__env->startSection('panel'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group mb-3">
                        <label><?php echo app('translator')->get('Status'); ?></label>
                        <div class="form-check form-switch form-check-success">
                          <input type="checkbox" class="form-check-input"  <?php if(@$general->maintenance_mode): ?> checked <?php endif; ?> name="status""
                           id="status" /> 
                      </div> 

                       </div>
                    </div>
                  </div>
                    <div class="form-group mb-3">
                      <label><?php echo app('translator')->get('Description'); ?></label>
                        <textarea class="form-control nicEdit" rows="10" name="description"><?php echo @$maintenance->data_values->description ?></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/admin/setting/maintenance.blade.php ENDPATH**/ ?>