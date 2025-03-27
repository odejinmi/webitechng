<?php $__env->startSection('panel'); ?>
    <div class="row justify-content-center">
        <?php if(request()->routeIs('admin.deposit.list') ||
            request()->routeIs('admin.deposit.method') ||
            request()->routeIs('admin.users.deposits') ||
            request()->routeIs('admin.users.deposits.method')): ?>
             <div class="col-lg-4 col-md-6">
                <div class="card border-top border-success">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($successful)); ?></h2>
                        <h6 class="fw-medium text-success mb-0"><?php echo app('translator')->get('Successful Deposits'); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-success display-6"><i class="ti ti-check"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-warning">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($pending)); ?></h2>
                        <h6 class="fw-medium text-warning mb-0"><?php echo app('translator')->get('Pending Deposits'); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-warning display-6"><i class="ti ti-loader"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-danger">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($rejected)); ?></h2>
                        <h6 class="fw-medium text-danger mb-0"><?php echo app('translator')->get('Rejected Deposits'); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-danger display-6"><i class="ti ti-x"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-md-12">
                <div class="card border-top border-secondary">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($initiated)); ?></h2>
                        <h6 class="fw-medium text-secondary mb-0"><?php echo app('translator')->get('Initiated Deposits'); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-secondary display-6"><i class="ti ti-alert-triangle"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                 
        <?php endif; ?>

        <div class="col-md-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Gateway | Transaction'); ?></th>
                                    <th><?php echo app('translator')->get('Initiated'); ?></th>
                                    <th><?php echo app('translator')->get('User'); ?></th>
                                    <th><?php echo app('translator')->get('Amount'); ?></th>
                                    <th><?php echo app('translator')->get('Conversion'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $details = $deposit->detail ? json_encode($deposit->detail) : null;
                                    ?>
                                    <tr>
                                        <td>
                                            <span class="fw-bold"> <a
                                                    href="<?php echo e(appendQuery('method', @$deposit->gateway->alias)); ?>"><?php echo e(__(@$deposit->gateway->name)); ?></a>
                                            </span>
                                            <br>
                                            <small> <?php echo e($deposit->trx); ?> </small> 
                                        </td>

                                        <td>
                                            <?php echo e(showDateTime($deposit->created_at)); ?><br><?php echo e(diffForHumans($deposit->created_at)); ?>

                                        </td>
                                        <td>
                                            <span class="fw-bold"><?php echo e(__($deposit->user->fullname)); ?></span>
                                            <br>
                                            <span class="small">
                                                <a
                                                    href="<?php echo e(appendQuery('search', @$deposit->user->username)); ?>"><span>@</span><?php echo e(__($deposit->user->username)); ?></a>
                                            </span>
                                        </td>
                                        <td>
                                            <?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($deposit->amount)); ?> + <span
                                                class="text--danger"
                                                title="<?php echo app('translator')->get('charge'); ?>"><?php echo e(showAmount($deposit->charge)); ?> </span>
                                            <br>
                                            <strong title="<?php echo app('translator')->get('Amount with charge'); ?>">
                                                <?php echo e(showAmount($deposit->amount + $deposit->charge)); ?>

                                                <?php echo e(__($general->cur_text)); ?>

                                            </strong>
                                        </td>
                                        <td>
                                            1 <?php echo e(__($general->cur_text)); ?> = <?php echo e(showAmount($deposit->rate)); ?>

                                            <?php echo e(__($deposit->method_currency)); ?>

                                            <br>
                                            <strong><?php echo e(showAmount($deposit->final_amo)); ?>

                                                <?php echo e(__($deposit->method_currency)); ?></strong>
                                        </td>
                                        <td>
                                            <?php echo $deposit->statusBadge ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.deposit.details', $deposit->id)); ?>"
                                                class="btn btn-sm btn-outline-primary ms-1">
                                                <i class="ti ti-desktop"></i> <?php echo app('translator')->get('Details'); ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <?php if($deposits->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo paginateLinks($deposits) ?>
                    </div>
                <?php endif; ?>
            </div><!-- card end -->
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if(!request()->routeIs('admin.users.deposits') && !request()->routeIs('admin.users.deposits.method')): ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['dateSearch' => 'yes']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dateSearch' => 'yes']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/admin/deposit/log.blade.php ENDPATH**/ ?>