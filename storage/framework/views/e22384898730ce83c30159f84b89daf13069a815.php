
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
                                    <img src="<?php echo e(getImage(imagePath()['storefront_logo']['path'].'/'. $storefront->logo,imagePath()['storefront_logo']['size'])); ?>" alt="" class="img-fluid" width="40" />
                                </nav>
                            </div>
                            <div class="col-3">
                                <div class="text-center mb-n5">
                                    <img src="<?php echo e(getImage(imagePath()['storefront_header']['path'].'/'. $storefront->header,imagePath()['storefront_header']['size'])); ?>" alt="" class="img-fluid mb-n4" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card position-relative overflow-hidden">
                    <div class="shop-part d-flex w-100">
                         
                        <div class="card-body p-4 pb-0">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <a class="btn btn-primary d-lg-none d-flex" data-bs-toggle="offcanvas"
                                    href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                    <i class="ti ti-menu-2 fs-6"></i>
                                </a>
                                <h5 class="fs-5 fw-semibold mb-0 d-none d-lg-block">Products</h5>
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Search by Name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Search by Name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                            </div>
                            <div class="row">
                                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="card hover-img overflow-hidden rounded-2">
                                        <div class="position-relative">
                                            <a href="<?php echo e(route('storefront.product',$data->trx)); ?>"><img
                                                    src="<?php echo e(getImage(imagePath()['storefront_product']['path'].'/'. $data->image,imagePath()['storefront_product']['size'])); ?>" class="card-img-top rounded-0"
                                                    alt="..."></a>
                                            <a href="<?php echo e(route('storefront.product',$data->trx)); ?>"
                                                class="text-bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>
                                        </div>
                                        <div class="card-body pt-3 p-4">
                                            <h6 class="fw-semibold fs-4"><?php echo e($data->name); ?></h6>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="fw-semibold fs-4 mb-0"><?php echo e($general->cur_sym); ?><?php echo e(number_format($data->amount,2)); ?> 
                                                    <span class="ms-2 fw-normal text-muted fs-3"><del><?php echo e($general->cur_sym); ?><?php echo e(number_format($data->amount + 10,2)); ?></del></span>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php echo emptyData2(); ?>

                                <?php endif; ?> 
                                 
                            </div>
                            <?php if($products->hasPages()): ?>
                            <div class="card-footer">
                                <?php echo e($products->links()); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                         
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
        <!--end::Container-->
    <?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.store', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/vendor/storefront/front_storefront.blade.php ENDPATH**/ ?>