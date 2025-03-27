<?php
    $faqContent = getContent('faq.content', true);
    $faqElements = getContent('faq.element', null, false, true);
?>
<!-- ============================ FAQ's Start ================================== -->
<!-- FAQs-1
			============================================= -->
			<section id="faqs-1" class="bg-lightgrey wide-100 faqs-section division">				
				<div class="container">


					<!-- SECTION TITLE -->
					<div class="row">	
						<div class="col-lg-10 offset-lg-1">
							<div class="section-title text-center mb-60">		
                                <h2><?php echo e(__(@$faqContent->data_values->heading)); ?></h2>
								<!-- Text -->	
								<p class="p-xl"><?php echo e(__(@$faqContent->data_values->sub_heading)); ?>

								</p>
									
							</div>	
						</div>
					</div>


					<!-- FAQs-1 QUESTIONS -->	
					<div class="faqs-1-questions">
						<div class="row">
						

							<!-- QUESTIONS HOLDER -->
							<div class="col-lg-12">
								<div class="questions-holder pc-25">

                                    <?php $__empty_1 = true; $__currentLoopData = $faqElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
									<!-- QUESTION #1 -->
									<div class="question wow fadeInUp" data-wow-delay="0.4s">

										<!-- Question -->
										<h6 class="h6-xl">Do you have non-profit discount?</h6>

										<!-- Answer -->
										<p class="p-md grey-color">Etiam amet mauris suscipit sit amet in odio. Integer congue leo metus. 
										   Vitae arcu mollis blandit ultrice ligula egestas and magna suscipit lectus magna suscipit luctus 
										   blandit vitae
										</p>

									</div>	
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php echo emptyData(); ?>

                                    <?php endif; ?>
 


								</div>
							</div>	<!-- END QUESTIONS HOLDER -->


							<!-- QUESTIONS HOLDER -->
							 
						</div>	<!-- End row -->
					</div>	<!-- END FAQs-1 QUESTIONS -->	


					<!-- MORE QUESTIONS -->	
					 
				</div>	   <!-- End container -->		
			</section>	<!-- END FAQs-1 -->


 <?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/itechng/core/resources/views/templates/basic/sections/faq.blade.php ENDPATH**/ ?>