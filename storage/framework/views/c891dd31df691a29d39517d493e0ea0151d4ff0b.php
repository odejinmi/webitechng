<?php $__env->startSection('panel'); ?>
    <div class="page-content">
        <div class="container">
            <div class="content-area card">
                <div class="card-innr"> 

                    <div class="rosw match-height">
                        <!-- Company Table Card -->
                        <div class="col-lg-12 col-12">
                          <div class="card card-company-table">
                            <div class="card-body p-0">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>Type</th>
                                      <th>User</th>
                                      <th>Amount</th> 
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $exchange; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                    <?php 
                                    $card = App\Models\Giftcard::whereId($data->card_id)->first();
                                    $cardtype = App\Models\Giftcardtype::whereId($data->currency)->first();
                                    ?>
                                    <tr>
                                      <td>
                                        <div class="d-flex align-items-center">
                                          <div class="avatar rounded">
                                            <div class="avatar-content">
                                              <img width="40" src="<?php echo e(asset('assets/images/giftcards')); ?>/<?php echo e(@$card->image); ?>" alt="Toolbar svg" />
                                            </div>
                                          </div>
                                          <div>
                                            <div class="fw-bolder"><?php echo e(@$card->name); ?></div>
                                            <div class="font-small-2 text-muted"><?php echo e(@$cardtype->name); ?></div>
                                            <small>  <?php echo e($data->created_at); ?></small>
                                          </div>
                                        </div>
                                      </td> 
                                      <td>
                                        <div class="d-flex align-items-center">
                                          <div class="avatar bg-light-primary me-1">
                                            <div class="avatar-content">
                                              <i data-feather="user" class="font-medium-3"></i>
                                            </div>
                                          </div>
                                          <a href="<?php echo e(route('admin.users.detail', $data->user_id)); ?>"><?php echo e(@$data->user->username); ?></a>
                                        </div>
                                      </td>
                                      <td class="text-nowrap">
                                        <div class="d-flex flex-column">
                                          <span class="fw-bolder mb-25"><?php echo e(number_format($data->amount, 2)); ?><small><?php echo e($data->country); ?></small></span>
                                          <span class="font-small-2 text-muted"><?php echo e($data->type); ?></span>
                                        </div>
                                      </td> 
                                      <td>
                                        <div class="d-flex align-items-center">
                                          <span class="fw-bolder me-1">
                                            <?php if($data->status == 1): ?>
                                            <span
                                                class="dt-type-md badge badge-outline bg-success badge-md">Approved</span>
                                        <?php elseif($data->status == 2): ?>
                                            <span
                                                class="dt-type-md badge badge-outline bg-danger badge-md">Declined</span> 
                                        <?php else: ?>
                                            <span
                                                class="dt-type-md badge badge-outline bg-warning badge-md">Pending</span>                                         <?php endif; ?>
                                          </span>
                                           
                                        </div>
                                        <a href="<?php echo e(route('admin.card-info', $data->id)); ?>" class="btn btn-light-alt btn-xs btn-icon toggle-tigger">
                                            Manage
                                        </a> 
                                      </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    Data not found
                                    <?php endif; ?>
                                     
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/ Company Table Card -->
                    

 
                </div>
            </div>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/itechng/core/resources/views/admin/giftcard/giftcard-log.blade.php ENDPATH**/ ?>