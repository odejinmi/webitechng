<?php $__env->startSection('panel'); ?>

    <div class="row">

        <div class="table-responsive border rounded">
            <table class="table align-middle text-nowrap mb-0">
              <thead>
                <tr> 
                  <th scope="col">Coin</th>
                  <th scope="col">Date</th>
                  <th scope="col">Address</th>
                  <th scope="col">Balance</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $wallets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                   
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="<?php echo e(url('/')); ?>/assets/images/coins/<?php echo e(@$data->coin->image); ?>" class="rounded-circle" alt="..." width="56"
                        height="56">
                      <div class="ms-3">
                        <h6 class="fw-semibold mb-0 fs-4"><?php echo e(@$data->coin->name); ?></h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="mb-0"> <?php echo e(showDateTime($data->created_at)); ?><br><?php echo e(diffForHumans($data->created_at)); ?></p>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                       <p class="mb-0 ms-2"><?php echo e($data->address); ?></p> 
                    </div>
                    <?php if($data->status == 1): ?>
                       <label class="mb-0 badge bg-success">Active</label>
                       <?php else: ?>
                       <label class="mb-0 badge bg-danger">Inactive</label>
                    <?php endif; ?>
                  </td>
                  <td>
                    <h6 class="mb-0 fs-4">$<?php echo e(number_format($data->usd,2)); ?></h6>
                    <p class="mb-0"><?php echo e($data->balance); ?><?php echo e(@$data->coin->symbol); ?></p>
                  </td>
                  <td>
                    <?php $hasPermission = App\Models\Role::hasPermission(['admin.crypto.viewwalletd*','admin.crypto.deactivatewallet*','admin.crypto.activatewallet*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <div class="btn-group mb-2">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                          data-bs-toggle="dropdown" aria-expanded="false">
                          Action
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <?php $hasPermission = App\Models\Role::hasPermission(['admin.crypto.viewwalletd*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                          <li><a class="dropdown-item" href="<?php echo e(route('admin.crypto.viewwalletd',$data->address)); ?>">Transactions</a></li>
                          <?php endif ?>
                          <?php if($data->status == 1): ?>
                          <?php $hasPermission = App\Models\Role::hasPermission(['admin.crypto.deactivatewallet*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                          <li>
                            <a class="dropdown-item" href="<?php echo e(route('admin.crypto.deactivatewallet',$data->address)); ?>">Deactivate</a>
                          </li>
                          <?php endif ?>
                          <?php else: ?>
                          <?php $hasPermission = App\Models\Role::hasPermission(['admin.crypto.activatewallet*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                          <li>
                            <a class="dropdown-item" href="<?php echo e(route('admin.crypto.activatewallet',$data->address)); ?>">Activate</a>
                          </li>
                          <?php endif ?>
                          <?php endif; ?>
                        </ul>
                      </div>
                      <?php endif ?>
                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
              </tbody>
            </table>
          </div>
    </div>
</div>

<?php $__env->stopSection(); ?>



<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/admin/currency/wallet/wallets.blade.php ENDPATH**/ ?>