<?php $__env->startSection('panel'); ?>
    <!-- File export -->
    <div class="row">
        <div class="col-12">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Heading-->
                    <div class="card-px text-center pt-15 pb-15">
                        <!--begin::Alert-->

                        <!--begin::Notice-->
                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6">
                            <!--begin::Icon-->
                            <i class="ti ti-alert-circle fs-2tx text-warning me-4"><span class="path1"></span><span
                                    class="path2"></span><span class="path3"></span></i> <!--end::Icon-->

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1 ">
                                <!--begin::Content-->
                                <div class=" fw-semibold">
                                    <h4 class="text-gray-900 fw-bold"><?php echo app('translator')->get('Create Savings'); ?></h4>

                                    <div class="fs-6 text-gray-700 "><?php echo app('translator')->get('Welcome to our savings plan portal where you can create savings plan on the platform<br>
                                   <b> You can click on the voucher log button at the top right corner of your screen to view your savings log</b>
                                    '); ?>
                                        <br> <br>

                                        <!--begin::Action-->
                                        <a href="<?php echo e(route('user.savings.start')); ?>" class="btn btn-primary er fs-6 px-8 py-4">
                                            <?php echo app('translator')->get('Start Savings'); ?> </a>
                                         
                                    </div>
                                </div>
                                <!--end::Content-->

                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Notice-->
                        <!--end::Alert-->


                    </div>
                    <!--end::Heading-->

                    <!--begin::Illustration-->
                    <div class="text-center pb-15 px-5">
                        <img src="<?php echo e(asset('assets/assets/dist/images/backgrounds/savings.png')); ?>" alt="" class="mw-100 h-200px h-sm-325px" />
                    </div>
                    <!--end::Illustration-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>

         <!-- SignIn modal content -->
         <div id="redeem-modal" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="text-center mt-2 mb-4">
                    <a href="#" class="text-success">
                      <span><img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" class="me-3" width="80" alt="" />
                      </span>
                    </a>
                  </div>

                  <form action="<?php echo e(route('user.voucher.redeem')); ?>" method="post" class="ps-3 pr-3"> 
                    <?php echo csrf_field(); ?> 
                    <div class="mb-3">
                      <label for="password1">Voucher Code</label>
                      <input class="form-control" type="password" required="" name="code" id="code"
                        placeholder="**********" />
                    </div> 
                    <div class="mb-3 text-center">
                      <button class="btn btn-rounded bg-info-subtle text-info font-medium" type="submit">
                        Redeem Voucher
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <a class="btn btn-sm btn-primary" href="<?php echo e(route('user.savings.history')); ?>"> <i class="ti ti-printer"></i> <?php echo app('translator')->get('My Savings'); ?></a>
    <?php $__env->stopPush(); ?>
    <?php $__env->startPush('script'); ?>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/vendor/savings/index.blade.php ENDPATH**/ ?>