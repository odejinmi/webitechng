<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="card card-body">
            <div class="table-responsive">
              <table class="table search-table align-middle text-nowrap">
                <thead class="header-item">
                  <th><?php echo app('translator')->get('Customer'); ?></th>
                  <th><?php echo app('translator')->get('Type'); ?></th>
                  <th><?php echo app('translator')->get('Date Submited'); ?></th>
                  <th><?php echo app('translator')->get('Action'); ?></th>
                </thead>
                <tbody>
                  <!-- start row -->
                  <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <tr class="search-items">
                    
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile'))); ?>" alt="avatar" class="rounded-circle" width="35" />
                        <div class="ms-3">
                          <a href="<?php echo e(route('admin.users.detail', $user->id)); ?>">
                          <div class="user-meta-info">
                            <h6 class="user-name mb-0" data-name="<?php echo e($user->fullname); ?>"> <?php echo e($user->fullname); ?></h6>
                            <span class="user-work fs-3" data-occupation="<?php echo e($user->username); ?>"> <?php echo e($user->username); ?></span><br>
                            <span class="user-work fs-3" data-occupation="<?php echo e($user->email); ?>"> <?php echo e($user->email); ?></span>
                          </div>
                        </a>
                        </div>
                      </div>
                    </td>
                    <td>
                      <span class="usr-email-addr" data-email="<?php echo e(@$user->kyc->type); ?>"><?php echo e(@$user->kyc->type ?? ''); ?></span>
                      <br> 
                      <?php if($user->kyc_source == 'mobile'): ?>
                      <a href="https://mobile.ltechng.co/assets/images/kyc/<?php echo e($user->username); ?>/front_kyc_image.png" target="_blank" download class="btn btn-sm btn-primary">
                        <i class="ti ti-download fs-5"></i>Front 
                        <img src="https://mobile.ltechng.co/assets/images/kyc/<?php echo e($user->username); ?>/front_kyc_image.png" width="20">
                      </a>
                      <a href="https://mobile.ltechng.co/assets/images/kyc/<?php echo e($user->username); ?>/back_kyc_image.png" target="_blank" download class="btn btn-sm btn-secondary">
                        <i class="ti ti-download fs-5"></i> Back
                        <img src="https://mobile.ltechng.co/assets/images/kyc/<?php echo e($user->username); ?>/back_kyc_image.png" width="20">
                      </a>  
                      <?php else: ?>
                      <a href="<?php echo e(asset('assets/images/kyc')); ?>/<?php echo e($user->username); ?>/front_kyc_image.png" target="_blank" class="btn btn-sm btn-primary">
                        <i class="ti ti-download fs-5"></i>Front 
                      </a>
                      <a href="<?php echo e(asset('assets/images/kyc')); ?>/<?php echo e($user->username); ?>/back_kyc_image.png" target="_blank" class="btn btn-sm btn-secondary">
                        <i class="ti ti-download fs-5"></i> Back
                      </a>  
                      
                      <?php endif; ?>
                    </td>
                    
                    <td>
                      <span class="usr-ph-no" data-date=""> 
                        <?php echo e(showDateTime(@$user->kyc->date)); ?> <br>
                        <?php echo e(diffForHumans(@$user->kyc->date)); ?>    
                    </span>
                    </td>
                    <td>
                      <div class="action-btn">
                        <?php if($user->kyc_complete == 3): ?>
                        <a href="<?php echo e(route('admin.users.kyc.approve', $user->id)); ?>" class="btn btn-sm btn-success">
                         <?php echo app('translator')->get('Approve'); ?>
                        </a> 
                        <a href="<?php echo e(route('admin.users.kyc.reject', $user->id)); ?>" class="btn btn-sm btn-danger">
                         <?php echo app('translator')->get('Reject'); ?>
                        </a> 
                        <?php endif; ?>
                      </div>
                    </td>
                  </tr>
                  <!-- end row -->
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <?php echo emptyData(); ?>

                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            <?php if($users->hasPages()): ?>
            <div class="card-footer py-4">
                <?php echo e(paginateLinks($users)); ?>

            </div>
           <?php endif; ?>
          </div>
        </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Username / Email']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Username / Email']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/admin/users/kyc.blade.php ENDPATH**/ ?>