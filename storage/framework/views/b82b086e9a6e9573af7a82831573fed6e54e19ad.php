    
    <?php $__env->startSection('content'); ?>

    <?php echo $__env->make($activeTemplate . 'partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- ====== start contact ====== -->
    <?php
    $contactContent = getContent('contact.content', true);
    $addressContent = getContent('address.content', true);
    $user = auth()->user();
    ?> 

			<!-- PAGE
			============================================= -->
			<section id="contacts-3" class="bg-lightgrey wide-60 contacts-section division">				
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1">
							<div class="section-title text-center mb-60">		

								<!-- Title 	-->	
								<h2 class="h2-xs"><?php echo e($pageTitle); ?></h2>	 
									
							</div>	
						</div>
					</div>


				 	<div class="row">


                    PAGE CONTENT GOES HERE				 		 

					</div>	<!-- End row -->


				</div>	   <!-- End container -->		
			</section>	<!-- END CONTACTS-3 -->


            
    <?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/advert.blade.php ENDPATH**/ ?>