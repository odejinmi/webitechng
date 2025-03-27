<?php
    $counterContent = getContent('counter.content', true);
    $counterElements = getContent('counter.element', null, false, true);
?>
<!-- ============================ Our Counters Start ================================== -->
<!-- STATISTIC-4
			============================================= -->
			<section id="statistic-4" class="bg-09 statistic-section division">
				<div class="container white-color">
					<div class="row">

                        <?php $__empty_1 = true; $__currentLoopData = $counterElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
						<!-- STATISTIC BLOCK #1 -->
						<div class="col-sm-6 col-md-3">						
							<div class="statistic-block text-center mb-40 wow fadeInUp" data-wow-delay="0.4s">	

								<!-- Icon  -->
								<div class="statistic-ico ico-60"><span class="flaticon-browser">
                                    <?php echo @$item->data_values->icon ?>    
                                </span></div> 

								<!-- Text -->
								<h3 class="h3-xs statistic-number"><span class="count-element"><?php echo e(@$item->data_values->number); ?></span></h3>
								<p class="p-md txt-400"><?php echo e(@$item->data_values->title); ?></p>		

							</div>						
						</div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php echo emptyData; ?>

                        <?php endif; ?>  

						 
					</div>    <!-- End row -->
				</div>	   <!-- End container -->		
			</section>	<!-- END STATISTIC-4 -->



 <?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/templates/satoshi/sections/counter.blade.php ENDPATH**/ ?>