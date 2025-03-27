<?php $__env->startSection('panel'); ?>
    <!-- File export -->
    <div class="row">
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                  <h2 class="fw-bolder mb-0 fs-8 lh-base"><?php echo e($event->title); ?></h2>
                </div>
              </div> 

              <div class="row">
                <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php

                $tickets = json_encode($data->event->tickets, true);
                $tickets = json_decode($tickets, true);
                $name = null;
                foreach($tickets as $k => $v)
                {
                    if($v['trx'] == $data->ticket_id)
                    $name = $v['name'];
                }
                ?>
                <div class="col-sm-6 col-lg-4" id="<?php echo e($data->code); ?>">
                    <div class="card">
                      <div class="card-body pt-6">
                        <div class="text-end">
                          <span
                            class="badge fw-bolder py-1 <?php if($data->status != 1): ?> bg-danger-subtle text-danger <?php else: ?> bg-success-subtle text-success <?php endif; ?> text-uppercase fs-2 rounded-3"><?php echo e($data->code); ?></span>
                        </div>
                        <span class="fw-bolder text-uppercase fs-2 d-block mb-7"><?php echo e($data->event->title); ?></span>
                        <div class="my-4">
                          <img src="<?php echo e(QR($data->code)); ?>" alt="" class="img-fluid" width="80" height="80">
                        </div>
                        <div class="d-flex mb-3">
                          <h5 class="fw-bolder fs-6 mb-0"><?php echo e($general->cur_sym); ?> </h5>
                          <h2 class="fw-bolder fs-12 ms-2 mb-0"><?php echo e(@number_format($v['price'],2)); ?></h2>
                          <span class="ms-2 fs-4 d-flex align-items-center">/seat</span>
                        </div>
                        <ul class="list-unstyled mb-7">
                            <li class="d-flex align-items-center gap-2 py-2">
                             <i class="ti ti-check text-primary fs-4"></i>
                             <span class="text-dark"><?php echo e($v['benefits']); ?></span>
                           </li>
                           <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-check text-primary fs-4"></i>
                            <span class="text-dark"><?php echo e(__(@$event->city->name)); ?> - <?php echo e(__(@$event->location->name)); ?></span>
                           </li>
                           <li class="d-flex align-items-center gap-2 py-2">
                            <i class="ti ti-check text-primary fs-4"></i>
                            <span class="text-dark">Start: <?php echo e(showDate($event->start_date)); ?> <?php echo e($event->start_time); ?></span>
                          </li>
                          <li class="d-flex align-items-center gap-2 py-2">
                           <i class="ti ti-check text-primary fs-4"></i>
                           <span class="text-dark">End: <?php echo e(showDate($event->end_date)); ?> <?php echo e($event->end_time); ?></span>
                         </li>
 
                        </ul>
                        <button class="btn btn-primary btn-sm" onclick="printDiv('<?php echo e($data->code); ?>')">Print Ticket</button>
                      </div>
                    </div>
                  </div>
 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                 
              </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <a class="btn btn-sm btn-primary" href="<?php echo e(route('user.event.history')); ?>"> <i class="ti ti-printer"></i> <?php echo app('translator')->get('Payment Log'); ?></a>
    <?php $__env->stopPush(); ?>
    <?php $__env->startPush('script'); ?>
    <script>
    function printDiv(divId) 
    {
     var printContents = document.getElementById(divId).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
    }

    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/bills/event/ticket.blade.php ENDPATH**/ ?>