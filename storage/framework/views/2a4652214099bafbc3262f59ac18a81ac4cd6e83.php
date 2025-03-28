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

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1 ">
                                <!--begin::Content-->
                                <div class=" fw-semibold">
                                    <center>
                                    <h4 class="text-gray-900 fw-bold"><?php echo app('translator')->get('Trade Giftcards'); ?></h4>

                                    <div class="fs-6 text-gray-700 "><?php echo app('translator')->get('Welcome to our giftcard trading portal where you can buy and sell from over 700 service providers and 300+ countries across the world<br>
                                   <b> You can click on the trade log button at the top right corner of your screen to view your giftcard trading log</b>
                                    '); ?>
                                        <br> <br></center>

                                        <!--begin::Action-->

                                         <a href="<?php echo e(route('user.buygift')); ?>" class="btn btn-primary er fs-6 px-8 py-4">
                                            <?php echo app('translator')->get('Buy Giftcard'); ?> </a>
                                        <a href="<?php echo e(route('user.sellgift')); ?>" class="btn btn-danger er fs-6 px-8 py-4">
                                                <?php echo app('translator')->get('Sell Giftcard'); ?> </a>
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
                        <img src="<?php echo e(asset('assets/assets/dist/images/backgrounds/6134225.png')); ?>" alt="" class="mw-100 h-100px h-sm-325px" />
                    </div>
                    <!--end::Illustration-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
    <?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb'); ?>
 <a class="btn bg-white text-primary" href="<?php echo e(route('user.sellcardlog')); ?>"> <i class="ti ti-printer"></i> <?php echo app('translator')->get('Giftcard Log'); ?></a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(checkTemplate() . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/templates/satoshi/user/giftcard/index.blade.php ENDPATH**/ ?>