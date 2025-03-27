
<?php $__env->startSection('panel'); ?>


<div class="product-list">
    <div class="card">
      <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center mb-9">
            <form action="<?php echo e(route('admin.event.search')); ?>" method="GET" class="form-inline float-sm-right bg--white mb-2 ml-0 ml-xl-2 ml-lg-0">
                <div class="input-group has_append">
                    <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('Event search.....'); ?>" value="<?php echo e($search ?? ''); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
          <a class="fs-6 text-muted" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
            data-bs-title="Filter list"><i class="ti ti-filter"></i></a>
        </div>
        <div class="table-responsive border rounded">
          <table class="table align-middle text-nowrap mb-0">
            <thead>
              <tr>
                 
                <th scope="col">Event</th>
                <th scope="col">Start</th>
                <th scope="col">End</th>
                <th scope="col">Status</th>
                <th scope="col">Feature</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                 
                <td>
                  <div class="d-flex align-items-center">
                    <img src="<?php echo e(getImage(imagePath()['event']['path'] .'/'.$event->image,imagePath()['event']['size'])); ?>" class="rounded-circle" alt="..." width="56"
                      height="56">
                    <div class="ms-3">
                      <h6 class="fw-semibold mb-0 fs-4"><?php echo e(__($event->title)); ?></h6>
                      <p class="mb-0"><?php echo e(__(@$event->city->name)); ?> - <?php echo e(__(@$event->location->name)); ?></p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="mb-0">
                    <span class="font-weight-bold"><?php echo e(__($event->start_date)); ?> - <?php echo e(__($event->start_time)); ?></span>
                  </p>
                </td>
                <td>
                  <p class="mb-0">
                    <span class="font-weight-bold"><?php echo e(__($event->end_date)); ?> - <?php echo e(__($event->end_time)); ?></span>
                  </p>
                </td>
                <td>
                    
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.event.update.status'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <?php if($event->status == 1): ?>
                    <div class="d-flex align-items-center">
                        <span class="text-bg-success p-1 rounded-circle"></span>
                        <p class="mb-0 ms-2">Approved</p>
                        <a href="javascript:void(0)" class="btn btn-sm btn-warning ml-2 updatestatus" data-toggle="tooltip" title="" data-original-title="<?php echo app('translator')->get('Deactivate'); ?>"  data-status="2" data-statusupdate="deactivate" data-id="<?php echo e($event->id); ?>">
                            <i class="ti ti-lock"></i>
                        </a>
                      </div> 
                    <?php elseif($event->status == 2): ?>
                    
                    <div class="d-flex align-items-center">
                        <span class="text-bg-success p-1 rounded-circle"></span>
                        <p class="mb-0 ms-2">Cancelled</p>
                        <a href="javascript:void(0)" class="btn btn-sm btn-success ml-2 updatestatus" data-toggle="tooltip" title="" data-original-title="<?php echo app('translator')->get('Activate'); ?>"  data-status="1" data-statusupdate="activate" data-id="<?php echo e($event->id); ?>">
                            <i class="ti ti-check"></i>
                        </a>
                      </div>  
                      <?php elseif($event->status == 0): ?>
                                            <span class="badge bg-warning"><?php echo app('translator')->get('Pending'); ?></span>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger ml-2 updatestatus" data-toggle="tooltip" title="" data-original-title="<?php echo app('translator')->get('Deactivate'); ?>"  data-status="2" data-statusupdate="deactivate" data-id="<?php echo e($event->id); ?>">
                                                Delete
                                            </a>
                                            
                                            <a href="javascript:void(0)" class="btn btn-sm btn-success ml-2 updatestatus" data-toggle="tooltip" title="" data-original-title="<?php echo app('translator')->get('Activate'); ?>" data-statusupdate="activate" data-statusupdate="activate" data-status="1" data-id="<?php echo e($event->id); ?>">
                                                Activate
                                            </a> 
                      <?php endif; ?>

                  <?php endif ?>
                </td>
                <td>
                    <?php if($event->featured == 1): ?>
                    <span class="badge bg-success"><?php echo app('translator')->get('Featured'); ?></span>
                    <br>
                    <a href="javascript:void(0)" class="btn btn-sm btn-info ml-2 notInclude" data-toggle="tooltip" title="" data-original-title="<?php echo app('translator')->get('Not Include'); ?>" data-id="<?php echo e($event->id); ?>">
                        Remove Feature
                    </a>
                    <?php else: ?>
                    <span class="badge bg-warning"><?php echo app('translator')->get('Not Featured'); ?></span>
                    <br>
                    <a href="javascript:void(0)" class="btn btn-sm btn-success ml-2 include text-white" data-toggle="tooltip" title="" data-original-title="<?php echo app('translator')->get('Include'); ?>" data-id="<?php echo e($event->id); ?>">
                        Feature Event
                    </a>
                    <?php endif; ?>
                </td>
                <td>
                    <?php $hasPermission = App\Models\Role::hasPermission(['admin.event.info*','admin.event.edit*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <div class="btn-group mb-2">
                        <button type="button" class="btn btn-primary">
                          Action
                        </button>
                         
                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                          
                          <li>
                            <hr class="dropdown-divider" />
                          </li>
                          <li>
                            <?php $hasPermission = App\Models\Role::hasPermission(['admin.event.info*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                            <a class="dropdown-item" href="<?php echo e(route('admin.event.info', $event->id)); ?>" >Sales</a>
                            <?php endif ?>
                            <?php $hasPermission = App\Models\Role::hasPermission(['admin.event.edit*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                            <a class="dropdown-item" href="<?php echo e(route('admin.event.edit', $event->id)); ?>" >Edit</a>
                            <?php endif ?>
                          </li>
                        </ul>
                      </div>
                    <?php endif ?>
                 </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr>
                  <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
              </tr>
               <?php endif; ?>
               
            </tbody>
          </table>
          <div class="d-flex align-items-center justify-content-end py-1">
             
            <nav aria-label="...">
              <ul class="pagination justify-content-center mb-0 ms-8 ms-sm-9">
                <?php echo e(paginateLinks($events)); ?>

              </ul>
            </nav>
          </div>
        </div>

      </div>
    </div>
  </div>
  


<div class="modal fade" id="approvedby" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel"><?php echo app('translator')->get('Approval Confirmation'); ?></h5> 
            </div>
            
            <form action="<?php echo e(route('admin.event.status.approved')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('POST'); ?>
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p><?php echo app('translator')->get('Are you sure to approved this event?'); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <button type="submit" class="btn btn-success"><?php echo app('translator')->get('Confirm'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="cancelBy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel"><?php echo app('translator')->get('Banned Confirmation'); ?></h5>
                
            </div>
            
            <form action="<?php echo e(route('admin.event.status.banned')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('POST'); ?>
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p><?php echo app('translator')->get('Are you sure to cancel this event?'); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <button type="submit" class="btn btn-success"><?php echo app('translator')->get('Confirm'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="includeFeatured" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel"><?php echo app('translator')->get('Featured Item Include'); ?></h5>
                    
            </div>
            <form action="<?php echo e(route('admin.event.featured.include')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('POST'); ?>
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p><?php echo app('translator')->get('Are you sure include this event featured list?'); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <button type="submit" class="btn btn-success"><?php echo app('translator')->get('Confirm'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="updatestatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="statusup1"> </h5>
                    
            </div>
            <form action="<?php echo e(route('admin.event.update.status')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id">
                <input type="hidden" name="status">
                <div class="modal-body">
                    <a><?php echo app('translator')->get('Are you sure you want to '); ?></a> <a id="statusup"></a> <a><?php echo app('translator')->get('this event?'); ?></a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <button type="submit" class="btn btn-success"><?php echo app('translator')->get('Confirm'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?>
<?php $hasPermission = App\Models\Role::hasPermission(['admin.event.create'])  ? 1 : 0;
            if($hasPermission == 1): ?>
    <a href="<?php echo e(route('admin.event.create')); ?>" class="btn btn-sm btn-primary float-sm-right box--shadow1 text--small mb-2 ml-0 ml-xl-2 ml-lg-0" ><i class="fa fa-fw fa-plus"></i><?php echo app('translator')->get('Add New Event'); ?></a>
<?php endif ?>    
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        $('.approved').on('click', function () {
            var modal = $('#approvedby');
            $('#approvedby').modal('show');

            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });
        $('.cancel').on('click', function () {
            var modal = $('#cancelBy');
            $('#cancelBy').modal('show');

            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });

        $('.include').on('click', function () {
            var modal = $('#includeFeatured');
            $('#includeFeatured').modal('show');

            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });

        $('.notInclude').on('click', function () {
            var modal = $('#NotincludeFeatured');
            $('#NotincludeFeatured').modal('show');

            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });
        
        $('.updatestatus').on('click', function () {
            var modal = $('#updatestatus');
            $('#updatestatus').modal('show');

            modal.find('input[name=id]').val($(this).data('id'))
            modal.find('input[name=status]').val($(this).data('status'))
            modal.modal('show');
            var status = $(this).data('statusupdate');
            document.getElementById("statusup1").innerHTML = status;
            document.getElementById("statusup").innerHTML = status;


        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/event/index.blade.php ENDPATH**/ ?>