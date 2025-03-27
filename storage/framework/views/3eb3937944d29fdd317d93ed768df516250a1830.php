<?php $__env->startSection('panel'); ?>

<div class="body-wrappser">

  <div class="product-list">
      <div class="card">
          <div class="card-body p-3">
              <div class="table-responsive border rounded">
                  <table class="table align-middle text-nowrap mb-0">
                      <thead>
                        <tr>
                          <th>Type</th>
                          <th>Status</th> 
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <?php  
                        ?>
                        <tr>
                          <td>
                            <div class="d-flex align-items-center"> 
                              <div>
                                <div class="avatar-content">
                                  <img width="40" src="<?php echo e(asset('assets/images/giftcards')); ?>/<?php echo e($giftcard->image); ?>" alt="Toolbar svg" />
                                </div>
                                <div class="fw-bolder"><?php echo e($data->name); ?></div>
                                <small>  <?php echo e($data->created_at); ?></small>
                              </div>
                            </div>
                          </td>  
                          <td class="text-nowrap">
                            <div class="d-flex flex-column">
                                <span class="fw-bolder me-1">
                                    <?php if($data->status == 1): ?>
                                    <span
                                        class="dt-type-md badge badge-outline bg-success badge-md">Active</span>
                                   <?php else: ?>
                                    <span
                                        class="dt-type-md badge badge-outline bg-warning badge-md">Inactive</span>                                         
                                    </span>
                                    <?php endif; ?>
                                  </span>
                            </div>
                          </td> 
                          <td>  
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.updatecardType')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editgiftcard<?php echo e($data->id); ?>"  class="btn bg-light-primary  btn-xs btn-icon  btn-outline-primary">Edit</a>
                                <?php endif ?>
                                <?php if($data->status != 1): ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.activatecardtype')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                <a href="<?php echo e(route('admin.activatecardtype', $data->id)); ?>" class="btn bg-light-success  btn-xs btn-icon btn-outline-success">Activate</a>
                                <?php endif ?>
                                <?php endif; ?>
                                <?php if($data->status == 1): ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.deactivatecardtype')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                <a href="<?php echo e(route('admin.deactivatecardtype', $data->id)); ?>" class="btn btn-xs btn-icon  bg-light-warning btn-outline-warning">Deactivate</a>
                                <?php endif ?>
                                <?php endif; ?>
                                <?php $hasPermission = App\Models\Role::hasPermission('admin.deletecardtype')  ? 1 : 0;
            if($hasPermission == 1): ?>
                                <a href="<?php echo e(route('admin.deletecardtype', $data->id)); ?>" class="btn  btn-xs btn-icon  bg-light-danger btn-outline-danger">Delete</a>
                                <?php endif ?>
                            </div> 
                          </td>
                        </tr>


 
 <!-- Edit Modal -->
 <div class="modal fade" id="editgiftcard<?php echo e($data->id); ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
      <div class="modal-content">
          <div class="modal-header bg-transparent">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body pb-5 px-sm-5 pt-50">
              <div class="text-center mb-2">
                  <h4 class="popup-title">Update <?php echo e($data->name); ?></h4>
                  <p>Fill the form below to update giftcard type.</p>

              </div>
              <form role="form" method="POST" class="row gy-1 pt-75"
                  action="<?php echo e(route('admin.updatecardType', $data->id)); ?>" name="editForm"
                  enctype="multipart/form-data">
                  <?php echo e(csrf_field()); ?>

                  <div class="col-12 mb-3">
                      <label class="form-label" for="modalEditUserFirstName">Giftcard Type:</label>
                      <input type="text" class="form-control" placeholder="Card  Name"
                          value="<?php echo e($data->name); ?>" name="name">
                  </div>
                  <div class="col-12 mb-3">
                      <label class="form-label" for="modalEditUserLastName">Sell Card Rate</label>
                      <input type="text" class="form-control"  value="<?php echo e($data->sell_rate); ?>" name="sell_rate" placeholder="Card Sell Rate">
                  </div>
                  <div class="col-12 mb-3">
                      <label class="form-label" for="modalEditUserName">Buy Card Rate</label>
                      <input type="text" class="form-control"  value="<?php echo e($data->buy_rate); ?>" name="buy_rate" placeholder="Card Buy Rate">
                  </div>
                  <div class="col-12 mb-3">
                      <label class="form-label" for="modalEditUserEmail">Giftcard Currency</label>
                      <input type="text" class="form-control" placeholder="Currency"
                         value="<?php echo e($data->currency); ?>" name="currency">
                  </div>

                  <div class="col-12 text-center mt-2 pt-50">
                      <button type="submit" class="btn btn-primary me-1">Submit</button>
                      <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                          aria-label="Close">
                          Discard
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
<!--/ Edit Modal -->

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        Data not found
                        <?php endif; ?>
                      </tbody>
                  </table>

              </div>

          </div>
      </div>
  </div>


        <!-- Create Modal -->
        <div class="modal fade" id="creategiftcard" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                        <div class="text-center mb-2">
                            <h4 class="popup-title">Create New Giftcard</h4>
                            <p>Fill the form below to create a new giftcard.</p>

                        </div>
                        <form role="form" method="POST" class="row gy-1 pt-75"
                            action="<?php echo e(route('admin.storecardType', $giftcard->id)); ?>" name="editForm"
                            enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="col-12 mb-3">
                                <label class="form-label" for="modalEditUserFirstName">Giftcard Type:</label>
                                <input type="text" class="form-control" placeholder="Card  Name"
                                    value="<?php echo e(old('name')); ?>" name="name">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label" for="modalEditUserLastName">Sell Card Rate</label>
                                <input type="text" class="form-control" name="sell_rate" placeholder="Card Sell Rate">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label" for="modalEditUserName">Buy Card Rate</label>
                                <input type="text" class="form-control" name="buy_rate" placeholder="Card Buy Rate">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="modalEditUserEmail">Giftcard Currency</label>
                                <input type="text"class="form-control" placeholder="Currency"
                                    value="<?php echo e(old('currency')); ?>" name="currency">
                            </div>

                            <div class="col-12 text-center mt-2 pt-50">
                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    Discard
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Create Modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<?php $hasPermission = App\Models\Role::hasPermission('admin.storecardType')  ? 1 : 0;
            if($hasPermission == 1): ?>
<a href="#" data-bs-toggle="modal" data-bs-target="#creategiftcard" class="btn btn-sm btn-primary btn-outline"><em class="ti ti-giftcard"></em>New Giftcard Type</a>
<?php endif ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/giftcard/type.blade.php ENDPATH**/ ?>