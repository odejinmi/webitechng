
<?php $__env->startSection('content'); ?>

<?php echo $__env->make($activeTemplate . 'partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ====== start sitemap ====== -->
<section id="sitemap" class="bg-lightgrey wide-60 sitemap-section division">				
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
            <!-- Sitemap Content -->
            <div class="col-md-8 offset-md-2">
                <div class="sitemap-content">
                    <h3 class="text-center mb-4">Sitemap</h3>
                    <ul class="sitemap-list">
                        <li><a href="/">Home</a></li>
                        <li><a href="/about">About Us</a></li>
                        <li><a href="/services">Our Services</a></li>
                        <li><a href="/portfolio">Portfolio</a></li>
                        <li><a href="/contact">Contact Us</a></li>
                        <!-- Add more pages as needed -->
                    </ul>
                </div>
            </div>
        </div>

    </div> <!-- End container -->		
</section> <!-- END Sitemap Section -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/sitemap.blade.php ENDPATH**/ ?>