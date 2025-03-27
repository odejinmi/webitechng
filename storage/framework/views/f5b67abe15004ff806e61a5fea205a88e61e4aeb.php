<?php
    $footerContent = getContent('footer.content', true);
    $footerElements = getContent('footer.element', null, false, true);
    $addressContent = getContent('address.content', true);
?>



			<!-- FOOTER-2
			============================================= -->
			<footer id="footer-2" class="footer division">
				<div class="container">


					<!-- FOOTER CONTENT -->
					<div class="row">


						<!-- FOOTER INFO -->
						<div class="col-md-10 col-lg-5 col-xl-4">
							<div class="footer-info mb-40">

								<!-- Footer Logo -->	
								<div class="footer-logo"><img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" alt="footer-logo"/></div>

								<!-- Text -->	
								<p><?php echo e($general->site_name); ?> is a property of <?php echo e($general->site_name); ?>, a company duly registered with CAC with RC Number: XYZ.
								</p>
							
							</div>	
						</div>	


						<!-- FOOTER PRODUCTS LINKS -->
						<div class="col-md-3 col-lg-2 col-xl-2 offset-xl-1">
							<div class="footer-links mb-40">
							
								<!-- Title -->
								<h6 class="h6-xl">Products</h6>

								<!-- Footer List -->
								<ul class="clearfix">									
									<li><p><a href="#">How It Works?</a></p></li>																	
									<li><p><a href="#">Integrations</a></p></li>
									<li><p><a href="#">Product Updates</a></p></li> 						
								</ul>

							</div>
						</div>


						<!-- FOOTER COMPANY LINKS -->
						<div class="col-md-3 col-lg-2 col-xl-2">
							<div class="footer-links mb-40">
							
								<!-- Title -->
								<h6 class="h6-xl">Useful Links</h6>

								<!-- Footer Links -->
								<ul class="clearfix">								
									<li><p><a href="#">Privacy Policy</a></p></li>							
									<li><p><a href="#">Career</a></p></li>	
									<li><p><a href="#">Advertising</a></p></li>	 
								</ul>

							</div>
						</div>


						<!-- FOOTER NEWSLETTER FORM -->
						<div class="col-md-6 col-lg-3 col-xl-3">
							<div class="footer-form mb-20">

								<!-- Title -->
								<h6 class="h6-xl">Follow the Best</h6>

								<!-- Text -->	
								<p class="mb-20">Stay up to date with our latest news and our new products</p>
 
														
							</div>
						</div>	<!-- END FOOTER NEWSLETTER FORM -->


					</div>	  <!-- END FOOTER CONTENT -->


					<!-- BOTTOM FOOTER -->
					<div class="bottom-footer">
						<div class="row d-flex align-items-center">


							<!-- FOOTER COPYRIGHT -->
							<div class="col-lg-6">
								<div class="footer-copyright">
									<p>&copy; <?php echo e(date('Y')); ?> <?php echo e($general->site_name); ?>. All Rights Reserved</p>
								</div>
							</div>


							<!-- BOTTOM FOOTER LINKS -->
							<div class="col-lg-6">
								<ul class="bottom-footer-list ico-15 text-right clearfix">
									<li><p class="first-list-link"><a href="#"><span class="flaticon-facebook"></span> Facebook</a></p></li>	
									<li><p><a href="#"><span class="flaticon-twitter"></span> Twitter</a></p></li>
									<li><p><a href="#"><span class="flaticon-youtube"></span> YouTube</a></p></li>
									<li><p class="last-li"><a href="#"><span class="flaticon-instagram"></span> Instagram</a></p></li>
								</ul>
							</div>


						</div>  <!-- End row -->
					</div>	<!-- END BOTTOM FOOTER -->


				</div>	   <!-- End container -->										
			</footer>	<!-- END FOOTER-2 -->




		</div>	<!-- END PAGE CONTENT -->

	 <?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/templates/satoshi/partials/footer.blade.php ENDPATH**/ ?>