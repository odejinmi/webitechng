
<?php $__env->startSection('panel'); ?>
    <!-- content @s
        -->

        <div class="row">
            <div class="col-12">

                <!--begin::Container-->
                <div class="body-wrapper">
                    <div class="container-fluid">
                        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                            <div class="card-body px-4 py-3">
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <h4 class="fw-semibold mb-8"><?php echo e($pageTitle); ?></h4>
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item">
                                                    <a class="text-muted text-decoration-none" href="#">Home</a>
                                                </li>
                                                <li class="breadcrumb-item" aria-current="page">Shop</li>
                                            </ol>
                                            <img src="<?php echo e(getImage(imagePath()['storefront_logo']['path'] . '/' . $storefront->logo, imagePath()['storefront_logo']['size'])); ?>"
                                                alt="" class="img-fluid" width="40" />
                                        </nav>
                                    </div>
                                    <div class="col-3">
                                        <div class="text-center mb-n5">
                                            <img src="<?php echo e(getImage(imagePath()['storefront_header']['path'] . '/' . $storefront->header, imagePath()['storefront_header']['size'])); ?>"
                                                alt="" class="img-fluid mb-n4" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="shop-detail">
                            <div class="card shadow-none border">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div id="sync1" class="owl-carousel owl-theme">
                                                <div class="item rounded overflow-hidden">
                                                    <img src="<?php echo e(getImage(imagePath()['storefront_product']['path'].'/'. $product->image,imagePath()['storefront_product']['size'])); ?>" alt=""
                                                        class="img-fluid">
                                                </div>
                                                <div class="item rounded overflow-hidden">
                                                    <img src="<?php echo e(getImage(imagePath()['storefront_product']['path'].'/'. $product->image_2,imagePath()['storefront_product']['size'])); ?>" alt=""
                                                        class="img-fluid">
                                                </div>
                                                 
                                            </div>

                                            <div id="sync2" class="owl-carousel owl-theme">
                                                <div class="item rounded overflow-hidden">
                                                    <img src="<?php echo e(getImage(imagePath()['storefront_product']['path'].'/'. $product->image,imagePath()['storefront_product']['size'])); ?>" alt=""
                                                        class="img-fluid">
                                                </div>
                                                <div class="item rounded overflow-hidden">
                                                    <img src="<?php echo e(getImage(imagePath()['storefront_product']['path'].'/'. $product->image_2,imagePath()['storefront_product']['size'])); ?>" alt=""
                                                        class="img-fluid">
                                                </div>
                                                 
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="shop-content">
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    
                                                    <span class="fs-2"><?php echo e($product->name); ?></span>
                                                </div> 
                                                <h4 class="fw-semibold mb-3"><del class="fs-5 text-muted"></del><?php echo e($general->cur_sym); ?><?php echo e(number_format($product->amount,2)); ?> </h4>
                                                <div class="d-flex align-items-center gap-8 pb-4 border-bottom">
                                                    <ul class="list-unstyled d-flex align-items-center mb-0"> 
                                                    <a href="javascript:void(0)">(<?php echo e($orders); ?> Total Purchase)</a>
                                                </div>
                                                <div class="d-flex align-items-center gap-8 py-7">
                                                    
                                                </div>
                                                <form   novalidate="novalidate" action="<?php echo e(route('user.product.buy',$product->trx)); ?>" method="post"  enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="d-flex align-items-center gap-7 pb-7 mb-7 border-bottom">
                                                    <h6 class="mb-0 fs-4 fw-semibold">QTY:</h6>
                                                    <div class="input-group input-group-sm rounded">
                                                        <button
                                                            class="btn minus min-width-40 py-0 border-end border-secondary fs-5 border-end-0 text-secondary"
                                                            type="button" id="add1"><i
                                                                class="ti ti-minus"></i></button>
                                                        <input type="text" class="min-width-40 flex-grow-0 border border-secondary text-secondary fs-4 fw-semibold form-control text-center qty"
                                                            placeholder="" name="quantity" aria-label="Example text with button addon"
                                                            aria-describedby="add1" value="1">
                                                        <button
                                                            class="btn min-width-40 py-0 border border-secondary fs-5 border-start-0 text-secondary add"
                                                            type="button" id="addo2"><i class="ti ti-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="d-sm-flex align-items-center gap-3 pt-8 mb-7">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary">Buy Now</button> 
                                                </div>
                                                </form>
                                                <p class="mb-0">Dispatched in <?php echo e($product->delivery); ?> days</p>
                                                <a href="javascript:void(0)">Why the longer time for delivery?</a>
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
                                                id="pills-description-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-description" type="button" role="tab"
                                                aria-controls="pills-description" aria-selected="true">
                                                Description
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-4" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-description" role="tabpanel"
                                            aria-labelledby="pills-description-tab" tabindex="0">
                                            <?php echo e($product->details); ?>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--end::Container-->
                <?php $__env->stopSection(); ?>

                <?php $__env->startPush('script'); ?>


  <script src="<?php echo e(asset('assets/assets/dist/libs/owl.carousel/dist/assets/owl.carousel.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/assets/dist/js/productDetail.js')); ?>"></script>
  <?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate . 'layouts.store', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/vendor/storefront/front_product.blade.php ENDPATH**/ ?>