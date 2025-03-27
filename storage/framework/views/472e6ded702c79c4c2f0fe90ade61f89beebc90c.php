<?php $__env->startSection('panel'); ?>
<div class="page-content">
  <div class="container">
      <div class="row">
          <div class="col-lg-12">

              <div class="modasl fasde" id="creategiftcard" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                      <div class="modal-content"> 
                          <div class="modal-body pb-5 px-sm-5 pt-50">
                              <div class="text-center mb-2">
                                  <h4 class="popup-title">Update <?php echo e($giftcard->name); ?> Giftcard</h4>
                                  <p>Fill the form below to update <?php echo e($giftcard->name); ?>.</p>

                              </div>
                              <form role="form" method="POST" class="row gy-1 pt-75"
                                  action="<?php echo e(route('admin.postcard')); ?>" name="editForm"
                                  enctype="multipart/form-data">
                                  <?php echo e(csrf_field()); ?>

                                  <div class="col-12 mb-4">
                                      <label class="form-label" for="modalEditUserFirstName">Giftcard Name:</label>
                                      <input type="text" class="form-control" placeholder="Card  Name"
                                          value="<?php echo e($giftcard->name); ?>" name="name">
                                      <input hidden name="id" value="<?php echo e($giftcard->id); ?>">

                                  </div>
                                   
                                  <div class="col-12 mb-4">
                                      <label class="form-label" for="modalEditUserEmail">Giftcard image</label>
                                      <input type="file"class="form-control" placeholder="image" value="<?php echo e($giftcard->image); ?>"
                                      name="image">
                                  </div>
                                  <span class="topbar-logo">
                                    <img src="<?php echo e(asset('assets/images/giftcards')); ?>/<?php echo e($giftcard->image); ?>"  width="100" alt="<?php echo e($giftcard->image); ?>">
                                  </span>

                                  <div class="col-12 text-center mt-2 pt-50">
                                      <button type="submit" class="btn btn-primary me-1">Submit</button>
                                     
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>

          </div>
      </div><!-- .card-innr -->
  </div><!-- .card -->
</div>  
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<a class="btn btn-sm btn-primary" href="<?php echo e(route('admin.giftcardindex')); ?>"><?php echo app('translator')->get('Back'); ?></a>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/admin/giftcard/edit.blade.php ENDPATH**/ ?>