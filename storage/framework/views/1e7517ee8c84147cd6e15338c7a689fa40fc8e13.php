<?php $__env->startSection('panel'); ?>
    <script>
        function goBack() {
            window.history.back()
        }
    </script>

    <div class="page-content">
        <div class="container">

            <div class="col-lg-12 col-12">
                <div class="card card-user-timeline">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <i data-feather="list" class="user-timeline-title-icon"></i>
                      <h4 class="card-title">Transaction Details</h4>
                    </div>
                  </div>

                 

                
                 
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="card b-radius--10 ">
                        <div class="card-body p-0">

                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                          <h6>Transaction Date</h6>
                          <div class="d-flex align-items-center">
                            <h6 class="more-info mb-0"><?php echo e(date('d M Y', strtotime($exchange->created_at))); ?></h6>
                          </div>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                          <h6>Transaction Status</h6>
                           <div class="d-flex align-items-center">
                             
                            <div class="more-info">
                            <?php if($exchange->status == 1): ?>
                                <span class="badge bg-success">Success</span>
                            <?php elseif($exchange->status == 2): ?>
                                <span class="badge bg-danger">Rejected</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Pending</span>
                            <?php endif; ?>                            
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                          <h6>Customer</h6>
                          <p></p>
                          <div class="avatar-group">
                            <?php echo e(isset($exchange->user->username) ? $exchange->user->username : 'No User Available'); ?>

                        </div>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                          <h6>Amount</h6>
                          <p class="mb-0"><?php echo e(number_format($exchange->amount, 2)); ?> <?php echo e($exchange->country); ?></p>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                          <h6>Card Type</h6>
                          <p class="mb-0"><?php echo e(App\Models\Giftcard::whereId($exchange->card_id)->first()->name); ?></p>
                          <p class="mb-0"><?php echo e(App\Models\Giftcardtype::whereId($exchange->currency)->first()->name); ?></p>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                          <h6>Value in <?php echo e($general->cur_text); ?></h6>
                          <p class="mb-0"><?php echo e($general->cur_sym); ?><?php echo e(number_format($exchange->amount * $exchange->rate, 2)); ?></p>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                          <h6>Transaction ID</h6>
                          <p class="mb-0"><?php echo e($exchange->trx); ?></p>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                          <h6>Giftcard Number</h6>
                          <p class="mb-0"><?php echo e(isset($exchange->code) ? $exchange->code : 'Not Available Fot This Trade'); ?></p>
                      </li>
                      <?php if($exchange->image): ?>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <br>
					<div class="data-details-head">Front View</div>
					<div class="data-doc-item data-doc-item-lg">
						<div class="data-doc-image"><img  width="40"  src="<?php echo e(asset('assets/images/giftcards/' . $exchange->image)); ?>"
								alt="passport"></div>
						<ul class="data-doc-actions">
							<li><a href="<?php echo e(asset('assets/images/giftcards/' . $exchange->image)); ?>" download><em
										class="ti ti-import"></em></a></li>
						</ul>
					</div>
				</li>
			<?php endif; ?>
			<?php if($exchange->image2): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <br>
					<div class="data-details-head">Back View</div>
					<div class="data-doc-item data-doc-item-lg">
						<div class="data-doc-image"><img width="40" src="<?php echo e(asset('assets/images/giftcards/' . $exchange->image2)); ?>"
								alt="passport"></div>
						<ul class="data-doc-actions">
							<li><a href="<?php echo e(asset('assets/images/giftcards/' . $exchange->image2)); ?>" download><em
										class="ti ti-import"></em></a></li>
						</ul>
					</div>
				</li>
			<?php endif; ?>
			<?php if($exchange->status == 0): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
					 
					<div class="data-details-des"><span>
						   
							<button type="button" class="btn btn-primary" data-bs-toggle="modal"
								data-bs-target="#modalapprove<?php echo e($exchange->trx_type); ?>">Approve</button>
							<button type="button" class="btn btn-danger" data-bs-toggle="modal"
								data-bs-target="#modaldecline<?php echo e($exchange->trx_type); ?>">Decline</button>
						</span></div>
				</li>
			<?php endif; ?>
                    </ul>
                        </div>
                    </div>
                </div>
                  </div>
                </div>
              </div>
              <!--/ Timeline Card -->

            
        </div><!-- .container -->
    </div>



    <!-- Modal Content Code -->
    <div class="modal fade" tabindex="-1" id="modalapprovesell">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Approve Giftcard Trade</h5>
                </div>
                <form class="form-validate is-alter" role="form" action="<?php echo e(route('admin.appgift', $exchange->id)); ?>"
                    method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <p>You are about to approve this giftcard trade. This action cannot be reversed</p>
                    <div class="alert alert-danger">
                        Hello, Please enter an amount to fund customer wallet with. The already calculated value of  <?php echo e($general->cur_sym); ?><b><?php echo e($exchange->amount * $exchange->rate); ?></b> is preset in the amount field. You can proceed to enter a custom amount if required
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="amount">Amount To Fund</label>
                        <div class="form-control-wrap">
                            <input type="text"  value="<?php echo e($exchange->amount * $exchange->rate); ?>" name="amount" class="form-control" id="amount" required>
                        </div>
                    </div>
                </div>
               
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-sm btn-primary">Approve</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="modaldeclinesell">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Decline Giftcard Trade</h5>
                </div>
                <div class="modal-body">
                    <p>You are about to decline this giftcard trade. This action cannot be reversed</p>
                </div>
                <div class="modal-footer bg-light">
                    <a href="<?php echo e(route('admin.rejgift', $exchange->id)); ?>"><em class="ti ti-check-box"></em> Confirm</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Buy Modal Content Code -->
    <div class="modal fade" tabindex="-1" id="modalapprovebuy">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Approve Giftcard PurchaseTrade</h5>
                </div>
                <div class="modal-body">
                    <p>You are about to approve this giftcard trade. This action cannot be reversed</p>
                        <form class="form-validate is-alter" role="form" action="<?php echo e(route('admin.appgift', $exchange->id)); ?>"
                        method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php if($exchange->type == 'Digital'): ?>
                        <div class="form-group">
                            <label class="form-label" for="pin">Giftcard Number</label>
                            <div class="form-control-wrap">
                                <input type="text" name="pin" class="form-control" id="pin" required>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="form-group">
                            <label class="form-label" for="front">Upload Gift Front View Image</label>
                            <div class="form-control-wrap">
                                <input type="file" class="form-control" name="front" id="front" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="front">Upload Gift Back View Image</label>
                            <div class="form-control-wrap">
                                <input type="file" class="form-control" name="back" id="back" required>
                            </div>
                        </div>
                        <?php endif; ?> 
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline btn-primary btn-sm">Proceed</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <a href="#" data-bs-dismiss="modal"><em class="ti ti-trash"></em> Close</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modaldeclinebuy">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Decline Giftcard Purchase Trade</h5>
                </div>
                <div class="modal-body">
                    <p>You are about to decline this giftcard trade. This action cannot be reversed</p>
                    <form class="form-validate is-alter" role="form" action="<?php echo e(route('admin.rejgift', $exchange->id)); ?>"
                        method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label class="form-label" for="pin">Reason For Decline</label>
                            <div class="form-control-wrap">
                                <textarea type="text" name="reason" class="form-control" id="reason" required></textarea>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="form-label">Toggle on the switch below to refund trade money of <b class="text-success"><?php echo e($general->cur_sym); ?><?php echo e(number_format($exchange->pay,2)); ?></b> back to customer's wallet</label>
                            <div class="form-check form-switch form-check-success">
                                <input type="checkbox" class="form-check-input" name="refund"
                                id="refund" /> 
                            </div>  
                        </div> 
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline btn-danger btn-sm">Proceed</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <a href="#" data-bs-dismiss="modal"><em class="ti ti-trash"></em> Close</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/itechng/core/resources/views/admin/giftcard/giftcard-info.blade.php ENDPATH**/ ?>