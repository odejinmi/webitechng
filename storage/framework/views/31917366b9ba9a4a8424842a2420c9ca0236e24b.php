<?php
    $testimonialContent = getContent('testimonial.content', true);
    $testimonialElements = getContent('testimonial.element', null, false, true);
?>
			 <!-- TESTIMONIALS-2
       ============================================= -->
	   <section id="reviews-2" class="bg-lightgrey wide-100 reviews-section division">
        <div class="container">


            <!-- SECTION TITLE -->
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="section-title text-center mb-60">

                        <!-- Title 	-->
                        <h2 class="h2-xs"><?php echo e(__(@$testimonialContent->data_values->heading)); ?></h2>

                        <!-- Text -->
                        <p class="p-xl"><?php echo e(__(@$testimonialContent->data_values->sub_heading)); ?>

                        </p>

                    </div>
                </div>
            </div>


            <!-- TESTIMONIALS CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme reviews-wrapper">

						<?php $__empty_1 = true; $__currentLoopData = $testimonialElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <!-- TESTIMONIAL #1 -->
                        <div class="review-2 radius-08">

                            <!-- App Rating -->
                            <div class="app-rating ico-20 yellow-color">
                                <span class="flaticon-star"></span>
                                <span class="flaticon-star"></span>
                                <span class="flaticon-star"></span>
                                <span class="flaticon-star"></span>
                                <span class="flaticon-star"></span>
                            </div>

                            <!-- Title -->
                            <h5 class="h5-xs"><?php echo e(__(@$item->data_values->name)); ?></h5>
							<div class="sng-revs-usrs mb-3">
								<figure class="border border-2 p-2 mb-0 circle d-inline-flex"><img src="<?php echo e(getImage('assets/images/frontend/testimonial/' . @$item->data_values->image, '70x70')); ?>" class="img-fluid circle" width="90" alt=""></figure>
							</div>
                            <!-- Testimonial Text -->
                            <div class="review-2-txt">

                                <!-- Text -->
                                <p class="p-md grey-color"><?php echo e(__(@$item->data_values->review)); ?>"
                                </p>

                                <!-- Testimonial Author -->
                                <h6 class="h6-sm">-<?php echo e(__(@$item->data_values->designation)); ?></h6>

                            </div>

                        </div> <!-- END TESTIMONIAL #1 -->
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
						<?php echo emptyData(); ?>

						<?php endif; ?>
						

                        
                    </div>
                </div>
            </div> <!-- END TESTIMONIALS CONTENT -->


        </div> <!-- End container -->
    </section> <!-- END TESTIMONIALS-2 -->


 <?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/satoshi/sections/testimonial.blade.php ENDPATH**/ ?>