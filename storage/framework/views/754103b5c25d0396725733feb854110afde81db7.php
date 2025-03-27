<?php
    $testimonialContent = getContent('testimonial.content', true);
    $testimonialElements = getContent('testimonial.element', null, false, true);
?>
			
			
			<!-- ============================ Clients Reviews ================================== -->
			<section class="pt-0 mt-3">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-xl-8 col-lg-9 col-md-12 col-sm-12">
                            <center>
                            <h2 class="mb-3 lh-base"><?php echo e(__(@$testimonialContent->data_values->heading)); ?></h2>
                            <p class="mb-0 fs-5 fw-light"><?php echo e(__(@$testimonialContent->data_values->sub_heading)); ?></p>
                            </center>
							<div class="single-slice" id="single-reviews">
							
                                <?php $__empty_1 = true; $__currentLoopData = $testimonialElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
								<div class="sng-revs-wrap text-center mb-4">
									<div class="sng-revs-thumber mb-4">
										<div class="sng-revs-usrs mb-3">
											<figure class="border border-2 p-2 mb-0 circle d-inline-flex"><img src="<?php echo e(getImage('assets/images/frontend/testimonial/' . @$item->data_values->image, '70x70')); ?>" class="img-fluid circle" width="90" alt=""></figure>
										</div>
										<div class="sng-revs-usrcaps">
											<h5 class="mb-1"><?php echo e(__(@$item->data_values->name)); ?></h5>
											<p class="mb-0 text-muted"><?php echo e(__(@$item->data_values->designation)); ?></p>
										</div>
									</div>
									<div class="sng-revs-desc">
										<div class="d-flex justify-content-center fs-6 mb-3">
											<i class="fa-solid fa-star text-warning mx-2"></i>
											<i class="fa-solid fa-star text-warning mx-2"></i>
											<i class="fa-solid fa-star text-warning mx-2"></i>
											<i class="fa-solid fa-star text-warning mx-2"></i>
											<i class="fa-solid fa-star text-warning mx-2"></i>
										</div>
										<div class="text-center">
											<p class="text-center fs-5 fw-light mb-0">"<?php echo e(__(@$item->data_values->review)); ?>"</p>
										</div>
									</div>								
								</div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php echo emptyData(); ?>

                                <?php endif; ?>
								
								 
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- ============================ Clients Reviews End ================================== -->
			

 <?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/sections/testimonial.blade.php ENDPATH**/ ?>