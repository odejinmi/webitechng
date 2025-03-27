

<?php
      $subscribeContent = getContent('subscribe.content', true);
?>
<!-- ============================ Call To Action ================================== -->
<section class="bg-cover call-action-container bg-primary position-relative">
    <div class="position-absolute top-0 end-0 z-0">
        <img src="<?php echo e(asset($activeTemplateTrue . 'img/alert-bg.png')); ?>" alt="SVG" width="300">
    </div>
    <div class="position-absolute bottom-0 start-0 me-10 z-0">
        <img src="<?php echo e(asset($activeTemplateTrue . 'img/circle.png')); ?>" alt="SVG" width="150">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-10 col-md-12 col-sm-12">
                
                <div class="call-action-wrap wow animated fadeInUp">
                    <div class="call-action-caption">
                        <h2 class="text-light"><?php echo e(__(@$subscribeContent->data_values->heading)); ?></h2>
                        <p class="text-light"><?php echo e(__(@$subscribeContent->data_values->sub_heading)); ?></p>
                    </div>
                    <div class="call-action-form">
                        <form class="subscribe-form subscribeForm" method="post" action="<?php echo e(route('subscribe')); ?>" id="subscribeForm">
                        <?php echo csrf_field(); ?>
                            <div class="newsltr-form rounded-3">
                                <input id="subscribe" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo app('translator')->get('Your Email Address'); ?>" required class="form-control" placeholder="Enter Your email">
                                <button type="submit" class="subscribe-btn btn btn-dark"><?php echo app('translator')->get('Subscribe'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- ============================ Call To Action End ================================== -->
 
 
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
 
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/sections/subscribe.blade.php ENDPATH**/ ?>