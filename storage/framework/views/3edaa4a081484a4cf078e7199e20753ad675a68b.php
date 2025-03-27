
<?php $__env->startSection('panel'); ?>
 <!-- content @s
-->
<!--begin::Container-->

<div class="row">
    <!-- Column -->
    <div class="col-sm-12 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-row">
            <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-success">
              <i class="ti ti-credit-card fs-6"></i>
            </div>
            <div class="ms-3 align-self-center">
              <h4 class="mb-0 fs-5"><?php echo app('translator')->get('Total Products'); ?></h4>
              <span class="text-muted"></span>
            </div>
            <div class="ms-auto align-self-center">
              <h2 class="fs-7 mb-0"><?php echo e($products); ?></h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-sm-12 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-row">
            <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-info">
              <i class="ti ti-credit-card fs-6"></i>
            </div>
            <div class="ms-3 align-self-center">
              <h4 class="mb-0 fs-5"><?php echo app('translator')->get('Total Sales'); ?></h4>
              <span class="text-muted"></span>
            </div>
            <div class="ms-auto align-self-center">
              <h2 class="fs-7 mb-0"><?php echo e(showAmount($sales)); ?> <?php echo e(__($general->cur_text)); ?></h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Column --> 

    <div class="col-12"> 

        <!-- ---------------------
                    start File export
                ---------------- -->
        <div class="card">
          <div class="card-body">
            <div>
              <label><?php echo app('translator')->get('Storefront Link'); ?></label>
              <div class="input-group">
                <input type="text"id="referralURL"
                    value="<?php echo e(route('storefront',strToLower($storefront->trx))); ?>" readonly
                    class="form-control" placeholder="Right Side"
                    aria-describedby="basic-addon2">
                <button onclick="myFunction()" class="btn btn-primary" type="button">
                  <a class="ti ti-link text-white"></a>
                </button>
            </div>
            </div>
          </div>
        </div>
</div>

<div class="col-12"> 

    <!-- ---------------------
                start File export
            ---------------- -->
    <div class="card">
      <div class="card-body">
          
        <div class="mb-2">
          <h5 class="mb-0"><?php echo e($pageTitle); ?></h5>
        </div>
        <p class="card-subtitle mb-3">
          <?php echo app('translator')->get('A table showing all the '); ?> <?php echo e($pageTitle); ?> <?php echo app('translator')->get('on your account. You can export transaction record'); ?>
        </p>
        <div class="table-responsive">
          <table
            id="file_export"
            class="table border table-striped table-bordered display text-nowrap"
          >
            <thead>
              <!-- start row -->
              <tr>
                  <th><?php echo app('translator')->get('TRX'); ?></th>
                  <th><?php echo app('translator')->get('Product'); ?></th>
                  <th><?php echo app('translator')->get('Buyer'); ?></th>
                  <th class="text-center"><?php echo app('translator')->get('Date'); ?></th>
                  <th class="text-center"><?php echo app('translator')->get('Amount'); ?></th>   
                  <th class="text-center"><?php echo app('translator')->get(''); ?></th>   
              </tr>
              <!-- end row -->
            </thead>
            <tbody>
               
              <?php $__empty_1 = true; $__currentLoopData = @$order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <?php
                            $product = App\Models\Product::whereId($data->product_id)->first();
                            ?>
                      <tr>
                        <td> 
                            <span class=""><?php echo e(__($data->trx)); ?></span> 
                            <div class="d-flex align-items-center">
                                <span class="<?php if($data->status == 'deliver'): ?> text-bg-success <?php else: ?> text-bg-danger <?php endif; ?> p-1 rounded-circle"></span>
                                <p class="mb-0 ms-2"><?php echo e($data->status); ?></p>
                            </div>
                        </td>
                        <td> 
                         <?php echo e($product->name); ?><br>
                         QTY: <?php echo e($data->quantity); ?>

                        </td>
                        <td> 
                         Name: <?php echo e($data->user->fullname); ?>

                         <br>
                         Email: <?php echo e($data->user->email); ?>

                         <br>
                        Phone:  <?php echo e($data->user->mobile); ?>

                        </td>

                          <td class="text-center">
                              <?php echo e(showDateTime($data->created_at)); ?><br><?php echo e(diffForHumans($data->created_at)); ?>

                          </td> 
                          <td class="text-center"> 
                              <strong><?php echo e(showAmount($data->price)); ?> <?php echo e(__($general->cur_text)); ?></strong>                                        
                          </td> 
                          <td>
                            <?php if($data->status == 'pending'): ?>
                            <div class="d-flex align-items-center"> 

                                <div class="btn-group mb-2">
                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                      data-bs-toggle="dropdown" aria-expanded="false">
                                      Action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <li><a class="dropdown-item" href="<?php echo e(route('user.storefront.order.status',$data->trx.'?status=deliver')); ?>">Mark As Delivered</a></li>
                                      <li>
                                        <a class="dropdown-item" href="<?php echo e(route('user.storefront.order.status',$data->trx.'?status=decline')); ?>">Mark As Declined</a>
                                      </li> 
                                    </ul>
                                  </div>
                              </div>
                            <?php endif; ?>
                          </td>
                      </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                      <?php echo emptyData(); ?>

                  <?php endif; ?>
              <!-- end row -->
              <!-- end row -->
            </tbody>
            <tfoot>
              <tr>
                <th><?php echo app('translator')->get('TRX'); ?></th>
                <th><?php echo app('translator')->get('Payer'); ?></th>
                <th class="text-center"><?php echo app('translator')->get('Date'); ?></th>
                <th class="text-center"><?php echo app('translator')->get('Amount'); ?></th>  
              </tr>
            </tfoot>
          </table>
        </div>
        <?php if($order->hasPages()): ?>
      <div class="card-footer">
          <?php echo e($order->links()); ?>

      </div>
      <?php endif; ?>
      </div>
    </div>

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Stepper-->
            <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">
                <!--begin::Form-->
                    <form  class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" action="" method="post"  enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <!--begin::Step 2-->
                    <div data-kt-stepper-element="scontent">
                        
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-10 pb-lg-15">
                                <!--begin::Title-->
                                <h2 class="fw-bold text-dark"><?php echo app('translator')->get('Update Storefront'); ?></h2>
                                <!--end::Title-->

                                <!--begin::Notice-->
                                <div class="text-muted fw-semibold fs-6">
                                    <?php echo app('translator')->get('Please fill the form below to update your storefront.'); ?>
                                    <a href="#" class="link-primary fw-bold">Help Page</a>.
                                </div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Heading--> 
                            
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3"><?php echo app('translator')->get('Storefront Name'); ?></label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" id="name" class="form-control form-control-lg form-control-solid  name <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($storefront->name); ?>" name="name" placeholder="Enter Name" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group--> 

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3"><?php echo app('translator')->get('Storefont Details '); ?></label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea type="text" class="form-control form-control-lg form-control-solid  details <?php $__errorArgs = ['details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="details"
                                    name="details" value="<?php echo e(old('details')); ?>" placeholder="Enter Storefont Details" ><?php echo e($storefront->details); ?></textarea>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->  

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row"> 
                                
                                <div class="p-3 bg--white">
                                    <div class="">
                                        <img src="<?php echo e(getImage(imagePath()['storefront_logo']['path'].'/'. $storefront->logo,imagePath()['storefront_logo']['size'])); ?>" width="100" alt="<?php echo app('translator')->get('Image'); ?>" class="b-radius--10" >
                                    </div>
                                </div>

                                <!--begin::Label-->
                                <label class="form-label mb-3"><?php echo app('translator')->get('Storefront Logo'); ?></label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="file" id="logo" class="form-control form-control-lg form-control-solid  logo <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="logo" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->   

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <div class="p-3 bg--white">
                                    <div class="">
                                        <img src="<?php echo e(getImage(imagePath()['storefront_header']['path'].'/'. $storefront->header,imagePath()['storefront_header']['size'])); ?>" width="100" alt="<?php echo app('translator')->get('Image'); ?>" class="b-radius--10" >
                                    </div>
                                </div> 
                                <!--begin::Label-->
                                <label class="form-label mb-3"><?php echo app('translator')->get('Storefront Header Image'); ?></label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="file"  class="form-control form-control-lg form-control-solid  <?php $__errorArgs = ['header'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="header" />
                                <!--end::Input-->
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="logo" class="control-label">Storefront Status:</label>
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" <?php if($storefront->status): ?> checked <?php endif; ?> name="status" id="status" /> 
                                </div>   
                                </div>  
                            </div>
                            <!--end::Input group--> 

                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 2-->



                     
                    <!--begin::Actions-->
                    <div class="d-flex flex-stack pt-15">
                        <!--begin::Wrapper-->
                        <div>
                            <button type="submit" class="btn btn-lg btn-primary" type="button" id="submit"><?php echo app('translator')->get('Update'); ?>
                               <i class="ti ti-arrow-right fs-4 ms-1 me-0"><span class="path1"></span><span class="path2"></span></i> 
                            </button>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Stepper-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Container-->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="<?php echo e(route('user.storefront.products',$storefront->trx)); ?>" class="btn btn-sm btn-primary">Add Products</a>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
<script>

  function myFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/
            document.execCommand("copy");
            SlimNotifierJs.notification('success', 'Storefront Link Copied');

        }
 </script>
<?php $__env->stopPush(); ?> 
<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/vendor/storefront/storefront_manage.blade.php ENDPATH**/ ?>