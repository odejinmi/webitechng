<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-md-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('User'); ?></th>
                                    <th><?php echo app('translator')->get('IP'); ?></th>
                                    <th><?php echo app('translator')->get('Browser'); ?></th>
                                    <th><?php echo app('translator')->get('Device'); ?></th>
                                    <th><?php echo app('translator')->get('Country'); ?></th>
                                    <th><?php echo app('translator')->get('City'); ?></th>
                                    <th><?php echo app('translator')->get('Code'); ?></th>
                                    <th><?php echo app('translator')->get('Area'); ?></th>
                                    <th><?php echo app('translator')->get('Longitude'); ?></th>
                                    <th><?php echo app('translator')->get('Latitude'); ?></th>
                                    <th><?php echo app('translator')->get('Date Attempted'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $scams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . @$report->user->image, getFileSize('userProfile'))); ?>" alt="avatar" class="rounded-circle" width="35" />
                                                <div class="ms-3">
                                                  <div class="user-meta-info">
                                                    <h6 class="user-name mb-0" > <?php echo e(@$report->user->fullname); ?></h6>
                                                    <span class="user-work fs-3"> <?php echo e(@$report->user->username); ?></span>
                                                  </div>
                                                </div>
                                              </div>
                                        </td>
                                        <td><?php echo e(@$report->ip_address); ?></td> 
                                        <td><?php echo e(@$report->browser); ?></td> 
                                        <td><?php echo e(@$report->device); ?></td> 
                                        <td><?php echo e(@$report->country); ?></td> 
                                        <td><?php echo e(@$report->city); ?></td> 
                                        <td><?php echo e(@$report->code); ?></td> 
                                        <td><?php echo e(@$report->area); ?></td> 
                                        <td><?php echo e(@$report->longitude); ?></td> 
                                        <td><?php echo e(@$report->latitude); ?></td> 
                                        <td><?php echo e(@$report->created_at); ?></td> 
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="100%" class="text-center"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bugModal" tabindex="-1" role="dialog" aria-labelledby="bugModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bugModalLabel"><?php echo app('translator')->get('Report & Request'); ?></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Type'); ?></label>
                            <select class="form-control" name="type" required>
                                <option value="bug" <?php if(old('type') == 'bug'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Report Bug'); ?></option>
                                <option value="feature" <?php if(old('type') == 'feature'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Feature Request'); ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Message'); ?></label>
                            <textarea class="form-control" name="message" rows="5" required><?php echo e(old('message')); ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?> 
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/admin/scams.blade.php ENDPATH**/ ?>