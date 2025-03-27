<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-12">

          <div class="shop-detail">
            <div class="card shadow-none border">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div id="sync1" class="owl-carousel owl-theme">
                      <div class="item rounded overflow-hidden">
                        <img src="<?php echo e(getImage(imagePath()['event']['path'] .'/'.$event->image,imagePath()['event']['size'])); ?>" alt="" class="img-fluid">
                      </div>
                      <div class="item rounded overflow-hidden">
                        <img src="<?php echo e(getImage(imagePath()['event']['path'] .'/'.$event->image,imagePath()['event']['size'])); ?>" alt="" class="img-fluid">
                      </div>
                      <div class="item rounded overflow-hidden">
                        <img src="<?php echo e(getImage(imagePath()['event']['path'] .'/'.$event->image,imagePath()['event']['size'])); ?>" alt="" class="img-fluid">
                      </div>
                       
                    </div>

                    <div id="sync2" class="owl-carousel owl-theme">
                      <div class="item rounded overflow-hidden">
                        <img src="<?php echo e(getImage(imagePath()['event']['path'] .'/'.$event->image,imagePath()['event']['size'])); ?>" alt="" class="img-fluid">
                      </div>
                      <div class="item rounded overflow-hidden">
                        <img src="<?php echo e(getImage(imagePath()['event']['path'] .'/'.$event->image,imagePath()['event']['size'])); ?>" alt="" class="img-fluid">
                      </div>
                      <div class="item rounded overflow-hidden">
                        <img src="<?php echo e(getImage(imagePath()['event']['path'] .'/'.$event->image,imagePath()['event']['size'])); ?>" alt="" class="img-fluid">
                      </div> 
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="shop-content">
                      <?php if($event->end_date < $now): ?>
                      <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge text-bg-danger fs-2 fw-semibold rounded-3 text-white">Event Closed</span>
                      </div>
                      <?php endif; ?>
                      <h4 class="fw-semibold"><?php echo e(__($event->title)); ?></h4>
                      <p class="mb-3"><?php echo e(__(@$event->type->name)); ?></p>
                      <h4 class="fw-semibold mb-3">Location:  <?php echo e(__(@$event->city->name)); ?> - <?php echo e(__(@$event->location->name)); ?></h4>
                      <div class="d-flex align-items-center gap-8 pb-4 border-bottom">
                        <a >Start Date: <?php echo e(showDate($event->start_date)); ?> - <?php echo e(__($event->start_time)); ?><br>
                          End Date: <?php echo e(showDate($event->end_date)); ?> - <?php echo e(__($event->end_time)); ?>

                        </a>
                      </div>
                      <br>

                      <?php if($event->tickets != null): ?>
                      <?php
                      $tickets = json_encode($event->tickets, true);
                      $tickets = json_decode($tickets, true);
                      ?>
                      <div class="col-lg-12">
                        <div class="card">
                          <div class="card-body">
                            <div class="mb-3">
                              <h4 class="card-title mb-0"><?php echo app('translator')->get('Available Tickets'); ?></h4>
                            </div>
                            <ul class="list-group">
                              <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <li class="list-group-item d-flex align-items-center">
                                <i class="ti ti-ticket fs-4 me-2 text-primary"></i>
                                <?php echo e($v['name']); ?> 
                                <span class="badge bg-light-primary text-primary font-medium rounded-pill ms-auto"> <?php echo e($general->cur_sym); ?> <?php echo e(@number_format($v['price'],2)); ?></span>
                              </li>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               
                            </ul>
                          </div>

                        <div class="d-sm-flex align-items-center gap-3 pt-8 mb-7">
                          <a href="<?php echo e(route('user.event.ticket.buy',encrypt($event->id))); ?>" class="btn d-block btn-primary">Buy Event Ticket</a>
                        </div>
                        </div>
            
                      </div> 
                      
                      <?php endif; ?>
           
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card shadow-none border">
              <div class="card-body p-4">
                <ul class="nav nav-pills user-profile-tab border-bottom" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button
                      class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                      id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button"
                      role="tab" aria-controls="pills-description" aria-selected="true">
                      <?php echo app('translator')->get('Description'); ?>
                    </button>
                  </li>
                   
                </ul>
                <div class="tab-content pt-4" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-description" role="tabpanel"
                    aria-labelledby="pills-description-tab" tabindex="0">
                    <h5 class="fs-5 fw-semibold mb-7">
                      
                    </h5>
                    <p class="mb-7">
                      <?php echo e(__($event->description)); ?>

                    </p>
                     
                  </div>
                   
                </div>
              </div>
            </div>
            <div class="related-products pt-7">
              <h4 class="mb-3 fw-semibold">Related Events</h4>
              <div class="row">
                <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-6 col-xl-3">
                  <div class="card hover-img overflow-hidden rounded-2">
                    <div class="position-relative">
                      <a href="<?php echo e(route('user.event.view',encrypt($event->id))); ?>"><img src="<?php echo e(getImage(imagePath()['event']['path'] .'/'.$event->image,imagePath()['event']['size'])); ?>"
                          class="card-img-top rounded-0" alt="..."></a>
                    </div>
                    <div class="card-body pt-3 p-4">
                      <h6 class="fw-semibold fs-4"><?php echo e($event->titile); ?></h6>
                      <div class="d-flex align-items-center justify-content-between">
                        <h6 class="fw-semibold fs-4 mb-0"><?php echo e(__(@$event->city->name)); ?> - <?php echo e(__(@$event->location->name)); ?></h6>
                         
                      </div>
                    </div>
                  </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 
              </div>
            </div>
          </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>


  <script src="<?php echo e(asset('assets/assets/dist/libs/owl.carousel/dist/assets/owl.carousel.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/assets/dist/js/productDetail.js')); ?>"></script>
  <?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/bills/event/view.blade.php ENDPATH**/ ?>