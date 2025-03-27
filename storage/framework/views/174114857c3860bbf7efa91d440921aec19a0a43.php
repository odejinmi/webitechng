
<ul class="list gap-4">
    <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php
    $event = App\Models\Event::whereId($item->event_id)->first();
    $ticket = [];
    foreach($item->event->tickets as $data)
    {
       if($data->trx == $item->ticket_id)
       {
        $ticket = $data;
       }
    }
    ?>

    <div class="d-flex justify-content-between mb-4">
      <p class="mb-0 fs-4"><?php echo e(@$ticket->name); ?> <b class="text-primary">(<small><?php echo e($item->quantity); ?> Slots</small>)</b></p>
      <h6 class="mb-0 fs-4 fw-semibold"><?php echo e($general->cur_sym); ?><?php echo e(getAmount($item->price*$item->quantity, 2)); ?></h6>
      <p class="mb-0 fw-medium"><a href="javascript:void(0)" class="remove-cartitem" data-id="<?php echo e($item->id); ?>""><i class="text-danger fa fa-trash"></i></a></p>
    </div> 

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <?php echo emptyData2(); ?>

    <?php endif; ?>

    <div class="hr-dashed my-4"><hr></ht></div>

    <div class="d-flex justify-content-between">
      <h6 class="mb-0 fs-4 fw-semibold">Total</h6>
      <h6 class="mb-0 fs-5 fw-semibold"><?php echo e($general->cur_sym); ?> <?php echo e(getAmount($subtotal,2)); ?></h6>
    </div> 
</ul>
 <?php $__env->startPush('script'); ?>
 <script>

 </script>
<?php $__env->stopPush(); ?>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/partials/cart_items.blade.php ENDPATH**/ ?>