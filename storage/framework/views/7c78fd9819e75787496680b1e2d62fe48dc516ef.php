

<?php
      $subscribeContent = getContent('subscribe.content', true);
?>
<!-- NEWSLETTER-1
			============================================= -->
			<div id="newsletter-1" class="bg-10 newsletter-section division">
				<div class="container white-color">


					<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1">
							<div class="section-title text-center mb-40">		

								<!-- Title 	-->	
								<h3 class="h3-md"><?php echo e(__(@$subscribeContent->data_values->heading)); ?></h3>	

								<!-- Text -->	
								<p class="p-xl"><?php echo e(__(@$subscribeContent->data_values->sub_heading)); ?>

								</p>
									
							</div>	
						</div>
					</div>


					<!-- NEWSLETTER FORM -->
					<div class="row">
						<div class="col-md-10 col-lg-8 offset-md-1 offset-lg-2">
							<div class="newsletter-txt text-center">
								<form class="newsletter-form" method="post" action="<?php echo e(route('subscribe')); ?>" id="subscribeForm">
                                        <?php echo csrf_field(); ?>
                                           
									<div class="input-group">
										<input  id="subscribe" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo app('translator')->get('Your Email Address'); ?>" required  class="form-control" placeholder="Enter your email address" required id="s-email">								
										<span class="input-group-btn">
											<button type="submit" class="btn btn-theme tra-white-hover">Subscribe</button>
										</span>										
									</div>

									<!-- Small Text -->
									<p class="p-sm">No spam, just awesome stuff. Read the  <a href="#">Privacy Policy</a></p>

									<!-- Newsletter Form Notification -->	
									<label for="s-email" class="form-notification"></label>
												
								</form>							
							</div>
						</div>	
					</div>    <!-- END NEWSLETTER FORM -->


				</div>	   <!-- End container -->	
			</div>	<!-- END NEWSLETTER-1 -->


 
<?php $__env->startPush('script'); ?>
<script>
    (function($) {
        "use strict";

        $("#subscribeForm").on("submit", function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                url: '<?php echo e(route('subscribe')); ?>',
                method: 'post',
                data: data,
                success: function(response) {
                    if (response.success) {
                        $('#subscribeForm').trigger("reset");
                        notify('success', response.message);
                    } else {
                        $.each(response.error, function(key, value) {
                            notify('error', value);
                        });
                    }
                },
                error: function(error) {
                    console.log(error)
                }
            });
        });

    })(jQuery);
</script>
 
<?php $__env->stopPush(); ?>
 
<?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/templates/satoshi/sections/subscribe.blade.php ENDPATH**/ ?>