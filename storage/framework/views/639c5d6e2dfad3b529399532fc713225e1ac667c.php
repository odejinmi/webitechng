            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->
            <!-- Start Navigation -->
			<div class="header header-transparent dark">
				<div class="container">
					<nav id="navigation" class="navigation navigation-landscape">
						<div class="nav-header">
							<a class="nav-brand" href="<?php echo e(route('home')); ?>"><img width="40" src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" class="logo" alt=""></a>
							<div class="nav-toggle"></div>
							<div class="mobile_nav">
								<ul>
                                    <?php if(auth()->guard()->check()): ?>
									<li>
										<a href="<?php echo e(route('user.home')); ?>" class="btn btn-primary"><i class="fas fa-sign-in-alt me-2"></i><?php echo app('translator')->get('Dashboard'); ?></a>
									</li>
                                    <?php else: ?>
									<li>
										<a href="<?php echo e(route('user.login')); ?>" class="btn btn-primary"><i class="fas fa-sign-in-alt me-2"></i><?php echo app('translator')->get('Log In'); ?></a>
									</li>
                                    <?php endif; ?>
								</ul>
							</div>
						</div>
						<div class="nav-menus-wrapper" style="transition-property: none;">
							<ul class="nav-menu"> 
								<li><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a></li> 
                                <li><a href="JavaScript:Void(0);"><?php echo app('translator')->get('Pages'); ?><span class="submenu-indicator"></span></a>
									<ul class="nav-dropdown nav-submenu">
										<?php
											$pages = App\Models\Page::where('tempname', $activeTemplate)
												->where('is_default', 0)
												->get();
                                        //$pages = getContent('pages.element', null, false, true);
                                        ?>
										<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li>
											<a href="<?php echo e(route('pages', [$data->slug])); ?>"><?php echo e(__($data->name)); ?></a>                                
										</li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
										<li>
											<a href="<?php echo e(route('rates')); ?>"><?php echo app('translator')->get('Rates'); ?></a>                                
										</li>
									</ul>
								</li>
								<li><a href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->get('Contact'); ?></a></li>
							</ul>
							<ul class="nav-menu nav-menu-social align-to-right">
                                <?php if(auth()->guard()->check()): ?>
								<li>
									<a href="<?php echo e(route('user.home')); ?>"><i class="fas fa-sign-in-alt me-2"></i><?php echo app('translator')->get('Dashboard'); ?></a>
								</li>
								<li class="list-buttons ms-2">
									<a href="<?php echo e(route('user.logout')); ?>" class="bg-primary"><?php echo app('translator')->get("Logout"); ?><i class="fa-regular fa-circle-right ms-2"></i></a>
								</li>
                                <?php else: ?>
								<li>
									<a href="<?php echo e(route('user.login')); ?>"><i class="fas fa-sign-in-alt me-2"></i><?php echo app('translator')->get('Login'); ?></a>
								</li>
								<li class="list-buttons ms-2">
									<a href="<?php echo e(route('user.register')); ?>" class="bg-primary"><?php echo app('translator')->get("Register"); ?><i class="fa-regular fa-circle-right ms-2"></i></a>
								</li>
                                <?php endif; ?>
							</ul>
						</div>
					</nav>
				</div>
			</div> 
			<!-- End Navigation -->
			<div class="clearfix"></div>
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
 
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/partials/header.blade.php ENDPATH**/ ?>