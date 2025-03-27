<?php $__env->startSection('panel'); ?>
<!-- row opened -->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title"><?php echo e($currency->name); ?>  Currency Manager</div>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-lg-6 col-xl-12 col-md-12 col-sm-12">
													 
													<div class="card-body">
														<form action="<?php echo e(route('admin.crypto.postcoin',$currency->id)); ?>" class="form-horizontal" method="POST">
                                                        <?php echo e(csrf_field()); ?>

														    <div class="form-group mb-4">
															<small><?php echo e($currency->name); ?> Wallet Address <b>(For Manual Payments Only)</b></small>
																<input type="text" class="form-control" value="<?php echo e($currency->wallet_address); ?>" name="wallet_address" placeholder="Wallet Address ">
															</div>
															<div class="form-group mb-4">
																<small><?php echo e($currency->account_details); ?> Account Details Address <b>(Manual Payments For Crypto Buying Customers Only)</b></small>
																	<textarea type="text" class="form-control" value="<?php echo e($currency->account_details); ?>" name="account_details" placeholder="Account Details "><?php echo e($currency->account_details); ?></textarea>
																</div>
															<div class="form-group mb-4">
															<small><?php echo e($currency->name); ?> Wallet API Key <b>(For API Auto Payments Only)</b></small>
																<input type="text" class="form-control" value="<?php echo e($currency->apikey); ?>" name="apikey" placeholder="API Wallet Key">
															</div>
															<div class="form-group  mb-4">
															<small><?php echo e($currency->name); ?> Wallet Password <b>(For API Auto Payments Only)</b></small>
																<input type="text" class="form-control" value="<?php echo e($currency->apipass); ?>" name="apipass" placeholder="API Wallet Password">
															</div>
															<div class="form-group  mb-4">
															<small><?php echo app('translator')->get('Merchant Transaction Fee'); ?> <b>(%)</b></small>
																<input type="text" class="form-control" value="<?php echo e($currency->merchant_trx_fee); ?>" name="merchant_trx_fee" placeholder="Merchant Fee">
															</div>

															<div class="form-group  mb-4">
																<small><?php echo app('translator')->get('Currency Swap Rate'); ?> <b>(1 = USD = <?php echo e($currency->swap_rate); ?> <?php echo e($general->cur_text); ?>)</b></small>
																	<input type="text" class="form-control"  value="<?php echo e($currency->swap_rate); ?>" name="swap_rate" placeholder="Swap Rate">
															</div>

															<div class="form-group  mb-4">
																<small><?php echo app('translator')->get('Currency Buy Rate'); ?> <b>(1 = USD = <?php echo e($currency->buy_rate); ?> <?php echo e($general->cur_text); ?>)</b></small>
																	<input type="text" class="form-control"  value="<?php echo e($currency->buy_rate); ?>" name="buy_rate" placeholder="Buy Rate">
															</div>

															<div class="form-group  mb-4">
																<small><?php echo app('translator')->get('Currency Sell Rate'); ?> <b>(1 = USD = <?php echo e($currency->sell_rate); ?> <?php echo e($general->cur_text); ?>)</b></small>
																	<input type="text" class="form-control"  value="<?php echo e($currency->sell_rate); ?>" name="sell_rate" placeholder="Sell Rate">
															</div>

															<div class="form-group  mb-4">
															<small><?php echo app('translator')->get('Service Provider Transaction Fee'); ?> <b>(<?php echo e($currency->symbol); ?>)</b></small>
																<input type="text" class="form-control" value="<?php echo e($currency->api_trx_fee); ?>" name="api_trx_fee" placeholder="API Transaction Fee">
															</div>
															<div class="form-group  mb-4">
															<small><?php echo app('translator')->get('Service Provider Processing Fee'); ?> <b>(%)</b></small>
																<input type="text" class="form-control" value="<?php echo e($currency->api_processing_fee); ?>" name="api_processing_fee" placeholder="API Processing Fee">
															</div>
															<div class="form-group  mb-4">
															<small><?php echo app('translator')->get('Minimum Transaction'); ?> <b>(USD)</b></small>
																<input type="text" class="form-control" value="<?php echo e($currency->maximum_amount); ?>" name="maximum_amount" placeholder="Max Amount">
															</div>

															<div class="form-group  mb-4">
															<small><?php echo app('translator')->get('Minimum Transaction'); ?> <b>(USD)</b></small>
																<input type="text" class="form-control" value="<?php echo e($currency->minimum_amount); ?>" name="minimum_amount" placeholder="Min Amount">
															</div>
															<?php $hasPermission = App\Models\Role::hasPermission(['admin.crypto.edit*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
															<div class="form-group mb-0 mt-3 justify-content-end">
																<div>
																	<button type="submit" class="btn btn-primary">Update</button>
																</div>
															</div>
															<?php endif ?>
														</form>
													</div>
											</div>


										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- row closed -->
					</div>
				</div>
				<!-- App-content closed -->
			</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/currency/edit.blade.php ENDPATH**/ ?>