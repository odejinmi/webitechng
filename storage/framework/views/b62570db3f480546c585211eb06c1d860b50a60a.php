<?php $__env->startSection('panel'); ?>
<div class="d-flex gap-2 scrollable-x py-3 px-7 border-bottom">
                       <form action="">
                            <div class="d-flex flex-wrap gap-4">
                              <div class="flex-grow-1">
                                <label><?php echo app('translator')->get('TRX'); ?></label>
                                <input class="form-control" name="search" type="text" value="<?php echo e(request()->search); ?>">
                              </div>
                              <div class="flex-grow-1">
                                <label><?php echo app('translator')->get('Type'); ?></label>
                                <select class="form-control" name="trx_type">
                                  <option value=""><?php echo app('translator')->get('All'); ?></option>
                                  <option value="+" <?php if(request()->trx_type == '+'): echo 'selected'; endif; ?>>
                                    <?php echo app('translator')->get('Plus'); ?></option>
                                  <option value="-" <?php if(request()->trx_type == '-'): echo 'selected'; endif; ?>>
                                    <?php echo app('translator')->get('Minus'); ?></option>
                                </select>
                              </div>
                              <div class="flex-grow-1">
                                <label><?php echo app('translator')->get('Remark'); ?></label>
                                <select class="form-control" name="remark">
                                  <option value=""><?php echo app('translator')->get('Any'); ?></option>
                                  <?php $__currentLoopData = $remarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $remark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($remark->remark); ?>" <?php if(request()->remark == $remark->remark): echo 'selected'; endif; ?>>
                                    <?php echo e(__(keyToTitle($remark->remark))); ?>

                                  </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              </div>
                              <div class="flex-grow-1">
                                <label><?php echo app('translator')->get('Date'); ?></label>
                                <input class="datepicker-here form-control" name="date" data-range="true"
                                  data-multiple-dates-separator=" - " data-language="en" data-position='bottom right'
                                  type="text" value="<?php echo e(request()->date); ?>" placeholder="<?php echo app('translator')->get('Start date - End date'); ?>"
                                  autocomplete="off">
                              </div>
                              <div class="flex-grow-1 align-self-end">
                                <button class="btn btn-primary btn-sm w-100 h-45 "><i class="ti ti-search"></i>
                                  <?php echo app('translator')->get('Filter'); ?></button>
                              </div>
                            </div>
                          </form>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-sm table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="d-flex align-items-center gap-2 ps-1">
                                            <div class="text-base">
                                            </div><span>Remark</span>
                                        </div>
                                    </th>
                                    <th scope="col">TRX</th>
                                    <th scope="col">Fee</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col" class="d-none d-xl-table-cell">Date</th>
                                    <th scope="col" class="d-none d-xl-table-cell">Status</th>
                                    <th scope="col" class="d-none d-xl-table-cell">Required Action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3 ps-1">

                                            <div class="d-none d-xl-inline-flex icon icon-shape w-rem-8 h-rem-8 rounded-circle text-sm <?php if($data->trx_type == '+'): ?> bg-success text-success <?php else: ?>  bg-danger text-danger <?php endif; ?> bg-opacity-25 ">
                                                <?php if($data->trx_type == '+'): ?> <i class="bi bi-download"></i> <?php else: ?> <i class="bi bi-upload"></i> <?php endif; ?>

                                            </div>
                                            <div><span class="d-block text-heading fw-bold"><?php echo e($data->remark); ?></span></div>
                                        </div>
                                    </td>
                                    <td class="text-xs"><?php echo e(($data->trx)); ?></td>
                                    <td><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($data->charge)); ?></td>
                                    <td><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($data->amount)); ?></td>
                                    <td class="d-none d-xl-table-cell"><?php echo e(showDate($data->created_at)); ?></td>
                                    <td class="d-none d-xl-table-cell">
                                        <span class="badge badge-lg badge-dot"><i class="<?php if($data->trx_type == '+'): ?> bg-success <?php else: ?> bg-danger <?php endif; ?>"></i><?php if($data->trx_type == '+'): ?> Credit <?php else: ?> Debit <?php endif; ?></span>
                                    </td>
                                    <td class="d-none d-xl-table-cell"><?php echo e($data->details); ?></td>
                                    <td class="text-end">
                                        <a href="<?php echo e(route('user.transaction.receipt',$data->trx)); ?>" class="btn btn-sm btn-square btn-neutral w-rem-6 h-rem-6"><i class="bi bi-printer"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php echo emptyData(); ?>

                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                    <?php if($transactions->hasPages()): ?>
                    <div class="py-4 px-6">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-md-auto">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pagination-spaced gap-1">
                                       <?php echo e($transactions->links()); ?>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/templates/satoshi/user/transactions.blade.php ENDPATH**/ ?>