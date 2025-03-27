<?php $__env->startSection('content'); ?>
<!--Contents-->
<!-- ============================= Single Post Start ================================== -->
<?php echo $__env->make($activeTemplate . 'partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section id="blog-listing-1" class="wide-60 blog-page-section division">
    <div class="container">
      <div class="row">
        
            <div class="col-xl-8 col-lg-8 col-md-12">
                
                <!-- Post Title -->
                <h1 class="pb-2 pb-lg-3"><?php echo e(__(@$blog->data_values->title)); ?></h1>
                <div class="d-flex flex-wrap align-items-center justify-content-between border-bottom mb-4">
                    <div class="d-flex align-items-center mb-4 me-4"><span class="fs-sm me-2"><?php echo app('translator')->get('Posted'); ?>:</span><a class="text-primary position-relative fw-semibold p-0" href="#" data-scroll="" data-scroll-offset="80"><?php echo e(diffForHumans(@$blog->created_at)); ?><span class="d-block position-absolute start-0 bottom-0 w-100" style="background-color: currentColor; height: 1px;"></span></a></div>
                    <div class="d-flex align-items-center mb-4 me-4"><span class="fs-sm me-2"><?php echo app('translator')->get('Views'); ?>:</span><a class="text-primary position-relative fw-semibold p-0" href="#" data-scroll="" data-scroll-offset="80"> <?php echo e($blog->val_1); ?><span class="d-block position-absolute start-0 bottom-0 w-100" style="background-color: currentColor; height: 1px;"></span></a></div>
                    
                         <div class="d-flex">
                          
                            <ul class="bottom-footer-list ico-15 text-right clearfix">
                                <li><p class="first-list-link"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>"><span class="flaticon-facebook"></span> Facebook</a></p></li>	
                                <li><p><a href="https://twitter.com/intent/tweet?text=<?php echo e(__(@$blog->data_values->title)); ?>%0A<?php echo e(url()->current()); ?>"><span class="flaticon-twitter"></span> Twitter</a></p></li>
                                <li><p class="last-li"><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(urlencode(url()->current())); ?>&amp;title=<?php echo e(__(@$blog->data_values->title)); ?>&amp;summary=<?php echo e(__(@$blog->data_values->description)); ?>"><span class="flaticon-instagram"></span> Instagram</a></p></li>
                            </ul>
                        </div>
                </div>
                
                <!-- Post Content -->
                <p class="fs-6 pt-2 pt-sm-3"> <?php echo @$blog->data_values->description ?><p>
                
                <figure class="figure"><img class="img-fluid rounded-4 mb-3" src="<?php echo e(getImage('assets/images/frontend/blog/' . @$blog->data_values->image, '770x390')); ?>" alt="Image"></figure>
                
                  
            </div>
            
            <div class="col-xl-3 col-lg-4 col-md-12 col-xl-offset-1">
                <div class="blogs-sidewraps pt-lg-0 pt-4">
                
                    <div class="blogs-sides">
                         
                        <!-- Trending -->
                        <h4 class="font--bold"><?php echo app('translator')->get('Trending Post'); ?>:</h4>
                        <div class="position-relative mt-4 mb-4 mb-lg-5">
                            <?php $__empty_1 = true; $__currentLoopData = $recent_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <article class="position-relative d-flex align-items-center mb-4">
                                <img class="rounded" src="<?php echo e(getImage('assets/images/frontend/blog/thumb_' . @$item->data_values->image, '60x60')); ?>" width="90" alt="Post Thumb">
                                <div class="ps-3">
                                    <h4 class="h6 mb-2">
                                        <a class="stretched-link" href="<?php echo e(route('blog.details', [$item->id, slug($item->data_values->title)])); ?>"><?php echo e($item->data_values->title); ?></a>
                                    </h4>
                                    <span class="text-sm-muted"><?php echo e(diffForHumans($item->created_at)); ?></span>
                                </div>
                            </article>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="single-popular-item d-flex flex-wrap">
                                <?php echo e(__($emptyMessage)); ?>

                            </div>
                            <?php endif; ?>
                             
                        </div> 
                    </div>
                    
                    <div class="blogs-sides mt-4 mt-lg-5">
                        <img src="assets/img/popeyes-banner-ad.jpg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>
<div class="clearfix"></div>
<!-- ============================ Single Post End ================================== -->
 
<?php $__env->stopSection(); ?>
<?php $__env->startPush('fbComment'); ?>
    <?php echo loadExtension('fb-comment') ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/blog_details.blade.php ENDPATH**/ ?>