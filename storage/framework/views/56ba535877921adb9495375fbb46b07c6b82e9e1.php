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
                                    <h4 class="text-gray-900 fw-bold"><?php echo app('translator')->get('Create Invoice / Payment Link'); ?></h4>

                                    <div class="fs-6 text-gray-700 "><?php echo app('translator')->get('Welcome to our invoice / payment links portal where you can send payment link to customers and receive payment for goods or services rendered in countries across the world<br>
                                   <b> You can click on the invoice log button at the top right corner of your screen to view your invoice log</b>
                                    '); ?>
                                        <br> <br>

                                        <!--begin::Action-->
                                        <a href="<?php echo e(route('user.invoice.create')); ?>" class="btn btn-primary er fs-6 px-8 py-4">
                                            <?php echo app('translator')->get('Create Invoice'); ?> </a>
                                        <br> <br>
                                        <!--end::Action-->
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
                        <img src="<?php echo e(asset('assets/assets/dist/images/backgrounds/invoice.png')); ?>" alt="" class="mw-100 h-200px h-sm-325px" />
                    </div>
                    <!--end::Illustration-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <a class="btn btn-sm btn-primary" href="<?php echo e(route('user.invoice.history')); ?>"> <i class="ti ti-printer"></i> <?php echo app('translator')->get('Invoice History'); ?></a>
    <?php $__env->stopPush(); ?>
    <?php $__env->startPush('script'); ?>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/vendor/invoice/index.blade.php ENDPATH**/ ?>