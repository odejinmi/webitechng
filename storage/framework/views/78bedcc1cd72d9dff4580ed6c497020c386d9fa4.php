<?php $__env->startSection('content'); ?>
    <?php
        $bannerContent = getContent('banner.content', true);
    ?>

<div class="image-cover hero-header position-relative bg-white">
    <div class="position-absolute bottom-0 end-0 z-0">
        <img src="<?php echo e(asset($activeTemplateTrue . 'img/shd-1.png')); ?>" class="img-fluid" alt="SVG" width="300">
    </div>
    <div class="position-absolute bottom-0 start-0 z-0">
        <img src="<?php echo e(asset($activeTemplateTrue . 'img/shd-2.png')); ?>" class="img-fluid" alt="SVG" width="350">
    </div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="elcoss-excort mt-lg-5">
                    <div class="bg-light-warning text-warning rounded-2 px-3 py-2 d-inline-flex font--medium mb-2"><span>Trending Bills in your Hand</span></div>
                    <h1 class="mb-4">Smart & Simple <br>Global Bills Payment Platform.</h1>
                    <p class="fs-5 fw-light fs-mob">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti.</p>
                </div>
                <div class="features-groupss mt-4 mb-2">
                    <ul class="row gx-3 gy-4 p-0">
                        <li class="font--medium col-xl-6 col-lg-6 col-6"><span class="square--30 circle d-inline-flex align-items-center justify-content-center text-success bg-light-success me-2"><i class="fa-solid fa-check"></i></span>5 Project Free</li>
                        <li class="font--medium col-xl-6 col-lg-6 col-6"><span class="square--30 circle d-inline-flex align-items-center justify-content-center text-success bg-light-success me-2"><i class="fa-solid fa-check"></i></span>Unlimited Team</li>
                        <li class="font--medium col-xl-6 col-lg-6 col-6"><span class="square--30 circle d-inline-flex align-items-center justify-content-center text-success bg-light-success me-2"><i class="fa-solid fa-check"></i></span>Friendly Support</li>
                        <li class="font--medium col-xl-6 col-lg-6 col-6"><span class="square--30 circle d-inline-flex align-items-center justify-content-center text-success bg-light-success me-2"><i class="fa-solid fa-check"></i></span>250 GB Free Space</li>
                    </ul>
                </div>
                <div class="btns-clasic mt-5 mb-3">
                    <div class="btn-groupss">
                        <a href="JavaScript:Void(0);" class="btn btn-lg btn-success font--medium px-lg-4 px-xl-5 px-4 mx-2 my-2">How It Work</a>
                        <a href="JavaScript:Void(0);" class="btn btn-lg btn-dark font--medium px-lg-4 px-xl-5 mx-2 my-2">Send Money Process<i class="fa-solid fa-circle-play ms-2"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-lg-5 col-md-12 col-sm-12 col-xl-offset-1 col-lg-offset-1">
                <div class="position-relative bg-white rounded-4 p-xl-4 p-lg-3 p-3 mt-xl-5 mt-lg-4 mt-md-4 shadow">
                    <div class="position-relative mb-3">
                        <h4 class="text-dark mb-0">Ready to begin the payment!</h4>
                        <p class="text-muted">Provide your login credentials below .</p>
                    </div>
                    <form class="form w-100 verify-gcaptcha"  data-kt-redirect-url="<?php echo e(route('user.home')); ?>"  class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST"
                        action="<?php echo e(route('user.login')); ?>">
                        <?php echo csrf_field(); ?> 
                        <div class="mb-3">
                            <label for="youSend" class="fs-6 text-dark font--medium mb-1">Username:</label>
                            <div class="input-group">
                                <input type="text" name="username"  placeholder="johndoe"  class="form-control" data-bv-field="youSend" id="youSend" value="" placeholder="">
                                 
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="recipientGets" class="fs-6 text-dark font--medium mb-1">They Recieved In:</label>
                            <div class="input-group">
                                <input type="text" name="password" placeholder="******" class="form-control" data-bv-field="recipientGets" id="recipientGets" value="" placeholder="">
                                
                            </div>
                        </div>
                        <div class="d-grid mb-3"><button type="submit" class="btn btn-success font--medium">Continue</button></div>
                        <p class="text-muted"><?php echo app('translator')->get('Don\'t have an account'); ?>

                                <a href="<?php echo e(route('user.register')); ?>" class="link-primary">
                                    <?php echo app('translator')->get('Sign up'); ?>
                                </a>
                            </p>
                    </form>
                </div>
            </div>
        </div>
    </div>	
</div>
			<!-- ============================ Hero Banner  Start================================== -->
            <div class="image-cover hero-header position-relative bg-white">
				<div class="container">

					<div class="row justify-content-center align-items-center">
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
							<div class="elcoss-excort mt-xl-5 mt-lg-4">
								<h1 class="mb-4"><span class="font--medium xxl-font"><?php echo e(__(@$bannerContent->data_values->heading)); ?></h1>
								<p class="fs-5 fw-light fs-mob"><?php echo e(__(@$bannerContent->data_values->sub_heading)); ?></p>
							</div>
							<div class="row row-cols-md-3 row-cols-2 g-4 my-lg-5 my-4">
								<div class="col"><i class="fa-solid fa-seedling d-block fs-1 text-primary mb-2 pb-1"></i>
									<p class="mb-0 font--medium">Effective approach to the branding</p>
								</div>
								<div class="col"><i class="fa-solid fa-plane-circle-check d-block fs-2 text-primary mb-3"></i>
									<p class="mb-0 font--medium">We guarantee the results after a weeks</p>
								</div>
								<div class="col"><i class="fa-solid fa-circle-check d-block fs-3 text-primary mb-3"></i>
									<p class="mb-0 font--medium">Completing tasks given the time by our team</p>
								</div>
							 </div>
							 <div class="btns-clasic mt-0 mb-3">
								<div class="btn-groupss mt-5 mb-2">
                                    <a href="JavaScript:Void(0);" class="d-inline-block mx-2 my-2"><img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'img/google-app.png')); ?>" width="140" alt="Google Play"></a>
                                    <a href="JavaScript:Void(0);" class="d-inline-block mx-2 my-2"><img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'img/ios-app.png')); ?>" width="140" alt="IOS"></a>
                                </div>
							</div>
						</div>
						
						<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 offset-lg-1 offset-xl-1">
							<div class="position-relative">
								<img class="d-block position-relative z-2 img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'img/fintech_header_new.gif')); ?>" alt="Nicolas Black">
							</div>
						</div>
					</div>
						
				</div>
			</div>
			<!-- ============================ Hero Banner End ================================== -->
			
     <?php if($sections->secs != null): ?>
        <?php $__currentLoopData = json_decode($sections->secs); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make($activeTemplate . 'sections.' . $sec, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/home.blade.php ENDPATH**/ ?>