    
    <?php $__env->startSection('content'); ?>

    <?php echo $__env->make($activeTemplate . 'partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- ====== start contact ====== -->
    <?php
    $contactContent = getContent('contact.content', true);
    $addressContent = getContent('address.content', true);
    $user = auth()->user();
    ?>
<!-- ============================= Contact Us Start ================================== -->
<!-- GOOGLE MAP
			============================================= -->
	 		<!--<div id="gmap" class="contacts-map division">
				<div class="google-map">
		 			<iframe src="https://www.google.com/maps/dir/6.2819399,5.6142568/Vision-X+Crypto+Services+LTD/@5.9271656,5.4349978,10z/data=!3m1!4b1!4m9!4m8!1m1!4e1!1m5!1m1!1s0x1041af9c84fb571f:0x56dfb841d86f6faa!2m2!1d5.8160493!2d5.5878746" width="600" height="450" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
	 			</div>	
	 		</div>	--> <!-- END GOOGLE MAP -->
			
			
			
			




			<!-- CONTACTS-3
			============================================= -->
			<section id="contacts-3" class="bg-lightgrey wide-60 contacts-section division">				
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1">
							<div class="section-title text-center mb-60">		

								<!-- Title 	-->	
								<h2 class="h2-xs">Have an issue?</h2>	

								<!-- Text -->	
								<p class="p-xl">Any questions or remarks? Just write us a message!
								</p>
									
							</div>	
						</div>
					</div>


				 	<div class="row">


						<!-- CONTACT FORM -->
				 		<div class="col-md-7 col-lg-8">
				 			<div class="form-holder pc-30 mb-40">
                                    <form class="row contact-form" method="post" action="<?php echo e(route('contact')); ?>">
                                        <?php echo csrf_field(); ?>
																						
                                        <div class="col-sm-6">
                                            <label class="form-label"><?php echo app('translator')->get('Name'); ?></label>
                                            <input class="form-control" type="text" placeholder="Your name">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label"><?php echo app('translator')->get('Email'); ?></label>
                                            <input class="form-control" type="email" placeholder="<?php echo app('translator')->get('Enter E-Mail Address'); ?>" value="<?php echo e($user ? $user->email : old('email')); ?>"
                                            <?php echo e($user ? 'readonly' : ''); ?> required>
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label"><?php echo app('translator')->get('Subject'); ?></label>
                                            <input class="form-control" name="subject" value="<?php echo e(old('subject')); ?>"  placeholder="Your Phone">
                                        </div> 
                                        <div class="col-12">
                                            <label class="form-label"><?php echo app('translator')->get('Message'); ?></label>
                                            <textarea class="form-control" rows="4"  name="message" placeholder="Type your message here..."></textarea>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" required type="checkbox">
                                                <label class="form-check-label">I agree to the <a class="nav-link d-inline fs-normal text-decoration-underline p-0" href="contact-v1.html#">Terms &amp; Conditions</a></label>
                                            </div>
                                        </div>
					                                            
					                <!-- Form Button -->
					                <div class="col-md-12 mt-15 text-right">  
					                	<button type="submit" class="btn btn-md btn-theme tra-grey-hover submit">Send Message</button> 
					                </div>
					                       												
								</form>	
				 			</div>	
				 		</div>	<!-- END CONTACT FORM -->	


				 		<!-- CONTACTS INFO -->
				 		<div class="col-md-5 col-lg-4">
				 			<div class="contacts-info pc-30 mb-40">

								<!-- LOCATION -->
								<div class="contact-3-box mb-40 clearfix">
									<h5 class="h5-xs">Our Location</h5>													
									<p class="grey-color"><?php echo e(__(@$addressContent->data_values->address)); ?></p>
								</div>

								<!-- PHONES -->
								<div class="contact-3-box mb-40 clearfix">
									<h5 class="h5-xs">Contact Info</h5>	
									<p class="grey-color"><span>Phone :</span>  <?php echo e(__(@$addressContent->data_values->phone)); ?></p> 
									<p class="grey-color"><span>Email :</span> <a href="mailto:<?php echo e(__(@$addressContent->data_values->email)); ?>"><?php echo e(__(@$addressContent->data_values->email)); ?></a></p>
								</div>

								<!-- WORKING HOURS -->
								<div class="contact-3-box clearfix">
									<h5 class="h5-xs">Working Hours</h5>	
									<p class="grey-color"><span>Mon – Fri :</span> 8:00 AM - 5:00 PM</p>
									<p class="grey-color"><span>Saturday :</span> 10:00 AM - 2:00 PM</p>
									<p class="grey-color"><span>Sunday :</span> Closed</p>
								</div>

							</div>	
						</div>	<!-- END CONTACTS INFO -->


					</div>	<!-- End row -->


				</div>	   <!-- End container -->		
			</section>	<!-- END CONTACTS-3 -->


            
    <?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/itechng/core/resources/views/templates/basic/contact.blade.php ENDPATH**/ ?>