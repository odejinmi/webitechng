<?php
    $aboutContent = getContent('about_1.content', true);
?>
<section>
    <div class="container">
        
        <div class="row justify-content-between align-items-center mb-5">
            
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="position-relative exloi">
                    <div class="position-relative pe-4 pb-4">
                        <img src="<?php echo e(__(getImage('assets/images/frontend/about_1/'.@$aboutContent->data_values->image,'1920x1281'))); ?>" class="img-fluid rounded-4" alt="">
                    </div>
                    <div class="position-absolute bottom-0 end-0">
                        <img src="assets/img/img-3.png" class="img-fluid rounded-2 shadow" width="230" alt="">
                    </div>
                </div>
            </div>
        
            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                <div class="position-relative exloi py-lg-0 py-4">
                    <div class="exloi-caption">
                        <div class="label text-success bg-light-success d-inline-flex rounded-4 mb-2 font--medium"><span>Let's Introduce</span></div>
                        <h2 class="display-5 font--bold lh-base mb-3"><?php echo e(__(@$aboutContent->data_values->title)); ?></h2>
                        <p class="mb-0 fs-5 fw-light mb-3">
                        <?php
                        echo @$aboutContent->data_values->description;
                        ?>
                        </p>
                        <div class="exloi-link mt-4">
                            <a href="<?php echo e(route('blog')); ?>" class="btn btn-primary font--medium rounded-5"><?php echo app('translator')->get('Blog'); ?><i class="fa-regular fa-circle-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </div>
</section>
<div class="clearfix"></div>
<!-- =========== Features Section end =========== -->
 <?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/sections/about.blade.php ENDPATH**/ ?>