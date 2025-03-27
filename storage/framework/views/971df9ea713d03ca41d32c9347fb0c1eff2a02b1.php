<?php
    $footerContent = getContent('footer.content', true);
    $footerElements = getContent('footer.element', null, false, true);
    $addressContent = getContent('address.content', true);
?>
	
			
			<!-- ============================ Footer Start ================================== -->
			<footer class="footer skin-light-footer">
				<div>
					<div class="container">
						<div class="row">
							
							<div class="col-lg-3 col-md-4">
								<div class="footer-widget">
									<img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" width="40" class="img-footer" alt="">
									<div class="footer-add">
										<p><?php echo app('translator')->get('Premium Bills Payment System For Global Bilss Payment'); ?></p>
									</div>
									<div class="foot-socials">
										<ul>
                                            <?php $__empty_1 = true; $__currentLoopData = $footerElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
											<li><a href="<?php echo e(@$item->data_values->social_url); ?>"><?php echo @$item->data_values->social_icon ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <?php echo e(__($emptyMessage)); ?>

                                            <?php endif; ?> 
										</ul>
									</div>
								</div>
							</div>		
							<div class="col-lg-2 col-md-4">
								<div class="footer-widget">
									<h4 class="widget-title"><?php echo app('translator')->get('Sitemap'); ?></h4>
									<ul class="footer-menu">
										<li><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a></li>
										<li><a href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->get('Contact'); ?></a></li>
										<li><a href="<?php echo e(route('blog')); ?>"><?php echo app('translator')->get('Blog'); ?></a></li> 
									</ul>
								</div>
							</div>
									
							<div class="col-lg-2 col-md-4">
								<div class="footer-widget">
									<h4 class="widget-title"><?php echo app('translator')->get("Privacy Policy"); ?></h4>
									<ul class="footer-menu">
                                <?php
                                $policyPages = getContent('privacy_policy.element', null, false, true);
                                ?>
                                <?php $__empty_1 = true; $__currentLoopData = $policyPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $policy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li><a href="<?php echo e(route('policy.pages', [slug($policy->data_values->title), $policy->id])); ?>"><?php echo e(__($policy->data_values->title)); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php echo e(__($emptyMessage)); ?>

                                <?php endif; ?>  
									</ul>
								</div>
							</div>
							
							<div class="col-lg-2 col-md-6">
								<div class="footer-widget">
									<h4 class="widget-title">The Company</h4>
									<ul class="footer-menu">
										<li><a href="<?php echo e(route('pages', 'about')); ?>"><?php echo app('translator')->get('About'); ?></a></li>
										<li><a href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->get('Contact'); ?></a></li> 
									</ul>
								</div>
							</div>
							
							<div class="col-lg-3 col-md-6">
								<div class="footer-widget">
									<h4 class="widget-title">Download Apps</h4>	
									<div class="app-wrap">
										<p><a href="JavaScript:Void(0);"><img width="40" src="<?php echo e(asset($activeTemplateTrue . 'img/google-app.png')); ?>" class="img-fluid" alt=""></a></p>
										<p><a href="JavaScript:Void(0);"><img width="40" src="<?php echo e(asset($activeTemplateTrue . 'img/ios-app.png')); ?>" class="img-fluid" alt=""></a></p>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
				<div class="footer-bottom">
					<div class="container">
						<div class="row align-items-center justify-content-between">
							
							<div class="col-xl-4 col-lg-5 col-md-5">
								<p class="mb-0"><script>document.write(new Date().getFullYear())</script>© <?php echo e($general->site_name); ?>® Design by <?php echo app('translator')->get('KHAYTECH DIGITALZ'); ?>.</p>
							</div>
							
							<div class="col-xl-8 col-lg-7 col-md-7">
								<div class="job-info-count-group">
                                    <?php
                                        $counterContent = getContent('counter.content', true);
                                        $counterElements = getContent('counter.element', null, false, true);
                                    ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $counterElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
									<div class="single-jb-info-count">
										<div class="jbs-y7"><h5 class="ctr"><?php echo e(@$item->data_values->number); ?></h5><span class="theme-2-cl">K</span></div>
										<div class="jbs-y5"><p><?php echo e(@$item->data_values->title); ?></p></div>
									</div> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php echo emptyData; ?>

                                    <?php endif; ?> 
									 
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</footer>
			<!-- ============================ Footer End ================================== -->

 
 
 <?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/partials/footer.blade.php ENDPATH**/ ?>