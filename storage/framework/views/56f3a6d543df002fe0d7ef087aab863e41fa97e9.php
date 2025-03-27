<?php $__env->startSection('content'); ?>
<!-- ============================= Classic Blog Start ================================== -->
<?php echo $__env->make($activeTemplate . 'partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="blog-listing-1" class="wide-60 blog-page-section division">
  <div class="container">
    <div class="row">
      

      <!-- BLOG POSTS WRAPPER -->
       <div class="col-lg-9">
         <div class="posts-wrapper pr-25">

          <?php $__empty_1 = true; $__currentLoopData = $blogElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
           <!-- BLOG POST #1 -->
           <div class="blog-post b-bottom mb-40">														
             <div class="row d-flex align-items-center">


              <!-- BLOG POST IMAGE -->
              <div class="col-md-5"> 
                <div class="blog-post-img">
                  <img class="img-fluid" src="<?php echo e(getImage('assets/images/frontend/blog/thumb_' . @$item->data_values->image, '480x280')); ?>" alt="blog-post-image">	
                </div>
              </div>	

              
              <!-- BLOG POST TEXT -->	
              <div class="col-md-7">
                <div class="blog-post-txt">	

                  <!-- Post Tag -->
                  <p class="post-tag txt-upcase"><a href="<?php echo e(route('blog.details', [$item->id, slug($item->data_values->title)])); ?>" class="theme-color">In Blog</a> - 1 min read</p>

                  <!-- Post Link -->
                  <h5 class="h5-md">
                    <a href="<?php echo e(route('blog.details', [$item->id, slug($item->data_values->title)])); ?>"><?php echo e($item->data_values->title); ?></a>
                  </h5>

                  <!-- Post Text -->
                  <p class="p-md grey-color"></p>

                  <!-- Author Data -->
                  <div class="post-author">
                    <span><?php echo e(diffForHumans($item->created_at)); ?></span>	
                    <span>By <?php echo e($general->site_name); ?></span>	
                  </div>	

                </div>
              </div>	<!-- END BLOG POST TEXT -->
                

            </div>				
          </div>	<!-- END BLOG POST #1 -->	

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <div class="col-lg-4 col-md-6 col-sm-12 mrb-30">
              <?php echo e(alert('danger',$emptyMessage)); ?>

          </div>
          <?php endif; ?>
          <!-- BLOG POST #2 -->
           

         </div>
       </div>	<!-- END BLOG POSTS WRAPPER -->
 
    </div>    <!-- End row -->
  </div>     <!-- End container -->
</section>	<!-- END BLOG POSTS LISTING-1 -->
 


<!-- PAGE PAGINATION
  <?php if($blogElements->hasPages()): ?> 
============================================= -->
<div class="page-pagination division">
  <div class="container">
    <div class="row">	
      <div class="col-md-12">

        <nav aria-label="Page navigation">
          <ul class="pagination ico-20 justify-content-center">
            <?php echo e(paginateLinks($blogElements)); ?>

          </ul>	
        </nav>					

      </div>
    </div>  <!-- End row -->	
  </div> <!-- End container -->
</div>	<!-- END PAGE PAGINATION -->
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/blog.blade.php ENDPATH**/ ?>