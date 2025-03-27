<?php $__env->startSection('panel'); ?>
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="card">
                        <div class="card-body">


                            <div class="buy-sell-widget">

                                <div class="tab-content tab-content-default">
                                    <div class="tab-pane fade show active" id="buy" role="tabpanel">



                                        <div class="col-12 layout-spacing">
                                            <div class="widget widget-table-two">

                                                <div class="widget-heading">
                                                    <h5 class=""><?php echo e($pageTitle); ?></h5>
                                                </div>

                                                <div class="widget-content">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        <div class="th-content">Customer</div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="th-content">Product</div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="th-content">Invoice</div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="th-content th-heading">Price</div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="th-content">Status</div>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $__empty_1 = true; $__currentLoopData = $card; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                                    <?php
                                                                        $gcard = App\Models\Giftcard::whereId($data->card_id)->first();
                                                                    ?>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="td-content customer-name"><img width="50"
                                                                                    src="<?php echo e(asset('assets/images/giftcards')); ?>/<?php echo e(@$gcard->image); ?>"
                                                                                    alt="avatar"><span><?php echo e(@$gcard->name); ?></span>
                                                                            </div>

                                                                        </td>
                                                                        <td>
                                                                            <div
                                                                                class="td-content product-brand text-primary">
                                                                                <?php echo date(' d/M/Y', strtotime($data->created_at)); ?><br>
                                                                                <?php echo e(Carbon\Carbon::parse($data->updated_at)->diffForHumans()); ?>

                                                                            </div>
                                                                        </td>
                                                                        <td> 
                                                                            <a href="#tranxDetails<?php echo e($data->id); ?>"
                                                                                class="badge bg-primary"
                                                                                data-bs-toggle="modal">View More <small>(<?php echo e($data->trx); ?>)</small></a>
                                                                        </td>
                                                                        <td>
                                                                            <div class="td-content pricing"><span
                                                                                    class="">
                                                                                    <span><?php echo e($data->country); ?></span><?php echo e($data->amount); ?></span>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="td-content">
                                                                                <?php if($data->status == 1): ?>
                                                                                    <span
                                                                                        class="badge badge-success">Approved</span>
                                                                                <?php elseif($data->status == 0): ?>
                                                                                    <span
                                                                                        class="badge badge-warning">Pending</span>
                                                                                <?php elseif($data->status == 2): ?>
                                                                                    <span
                                                                                        class="badge badge-danger">Declined</span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <div class="modal fade" tabindex="-1"
                                                                        id="tranxDetails<?php echo e($data->id); ?>">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <a href="#" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close"><em
                                                                                        class="icon ni ni-cross"></em></a>
                                                                                <div class="modal-body modal-body-md">
                                                                                    <div class="nk-modal-head mb-3 mb-sm-5">
                                                                                        <h4 class="nk-modal-title title">
                                                                                            Transaction <small
                                                                                                class="text-primary">#<?php echo e($data->trx); ?></small>
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div class="nk-tnx-details">
                                                                                        <div
                                                                                            class="nk-block-between flex-wrap g-3">
                                                                                            <div class="nk-tnx-type">
                                                                                                <?php if($data->status == 1): ?>
                                                                                                    <div
                                                                                                        class="nk-tnx-type-icon bg-success-dim text-success">
                                                                                                    <?php elseif($data->status == 0): ?>
                                                                                                        <div
                                                                                                            class="nk-tnx-type-icon bg-warning-dim text-warning">
                                                                                                        <?php elseif($data->status == 2): ?>
                                                                                                            <div
                                                                                                                class="nk-tnx-type-icon bg-danger-dim text-danger">
                                                                                                <?php endif; ?>


                                                                                                <em
                                                                                                    class="icon ni ni-wallet"></em>
                                                                                            </div>
                                                                                            <div class="nk-tnx-type-text">
                                                                                                <h5 class="title">
                                                                                                    <?php echo e($data->country); ?><?php echo e(number_format($data->amount, 2)); ?>

                                                                                                </h5>
                                                                                                <span
                                                                                                    class="sub-text mt-n1"><?php echo date('D, d/M, Y: h:m A', strtotime($data->created_at)); ?></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <ul
                                                                                            class="align-center flex-wrap gx-3">
                                                                                            <li>
                                                                                                <?php if($data->status == 1): ?>
                                                                                                    <span
                                                                                                        class="badge badge-sm badge-success">Completed</span>
                                                                                                <?php elseif($data->status == 0): ?>
                                                                                                    <span
                                                                                                        class="badge badge-sm badge-warning">Pending</span>
                                                                                                <?php elseif($data->status == 2): ?>
                                                                                                    <span
                                                                                                        class="badge badge-sm badge-danger">Declined</span>
                                                                                                <?php endif; ?>
                                                                                            </li>
                                                                                        </ul>

                                                                                    </div>
                                                                                    <div
                                                                                        class="nk-modal-head mt-sm-5 mt-4 mb-4">
                                                                                        <h5 class="title"><b>Transaction Info</b>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="row gy-3">
                                                                                        <div class="col-lg-6"><span
                                                                                                class="sub-text">Gift
                                                                                                Card: </span><span
                                                                                                class="caption-text"><?php echo e(isset(App\Models\Giftcard::whereId($data->card_id)->first()->id) ? App\Models\Giftcard::whereId($data->card_id)->first()->name : 'N/A'); ?></span>
                                                                                        </div>
                                                                                        <div class="col-lg-6"><span
                                                                                                class="sub-text">Gift Card
                                                                                                Type: </span><span
                                                                                                class="caption-text text-break"><?php echo e(isset(App\Models\Giftcardtype::whereId($data->currency)->first()->id) ? App\Models\Giftcardtype::whereId($data->currency)->first()->name : 'N/A'); ?></span>
                                                                                        </div>
                                                                                        <div class="col-lg-6"><span
                                                                                                class="sub-text">Exchange
                                                                                                Rate: </span><span
                                                                                                class="caption-text">1<?php echo e($data->country); ?>

                                                                                                =
                                                                                                <?php echo e($general->cur_sym); ?><?php echo e(number_format($data->rate, 2)); ?></span>
                                                                                        </div>
                                                                                        <div class="col-lg-6"><span
                                                                                                class="sub-text">Calculated
                                                                                                Value: </span><span
                                                                                                class="caption-text"><?php echo e($general->cur_sym); ?><?php echo e(number_format($data->amount * $data->rate, 2)); ?>

                                                                                            </span></div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="nk-modal-head mt-sm-5 mt-4 mb-4">
                                                                                        <h5 class="title"><b>Transaction
                                                                                            Details</b></h5>
                                                                                    </div>
                                                                                    <div class="row gy-3">
                                                                                        <?php if($data->status == 2): ?>
                                                                                        <div class="col-lg-6"><span
                                                                                            class="sub-text">Decline Reason: </span><span
                                                                                            class="caption-text"><?php echo e($data->val_1); ?></span>
                                                                                        </div>
                                                                                        <?php endif; ?>

                                                                                        <div class="col-lg-6"><span
                                                                                                class="sub-text">Card
                                                                                                Type: </span><span
                                                                                                class="caption-text"><?php echo e($data->type); ?></span>
                                                                                        </div>
                                                                                        <div class="col-lg-6">
                                                                                            <span class="sub-text">Card
                                                                                                Number: </span><span
                                                                                                class="caption-text align-center"><span
                                                                                                    class="badge badge-primary ml-2 text-white"><?php echo e(isset($data->code) ? $data->code : '**********'); ?>

                                                                                                </span></span>
                                                                                        </div>

                                                                                        <?php if($data->image): ?>
                                                                                            <div class="col-lg-6">
                                                                                                <span class="sub-text">Card
                                                                                                    Front View: </span><span
                                                                                                    class="caption-text align-center"><img width="40"
                                                                                                        src="<?php echo e(asset('assets/images/giftcards/' . $data->image)); ?>"
                                                                                                        wdith="70"
                                                                                                        alt="passport"></span>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                        <?php if($data->image2): ?>
                                                                                            <div class="col-lg-6">
                                                                                                <span class="sub-text">Card
                                                                                                    Back View: </span><span
                                                                                                    class="caption-text align-center"><img width="40"
                                                                                                        src="<?php echo e(asset('assets/images/giftcards/' . $data->image2)); ?>"
                                                                                                        wdith="70"
                                                                                                        alt="passport"></span>
                                                                                            </div>
                                                                                        <?php endif; ?> 
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    Data Not Found
                                                    <?php endif; ?>
                                                    </tbody>
                                                    </table>
                                                </div>

                                                <ul class="pagination justify-content-center justify-content-md-start">
                                                    <?php echo e(@$card->links()); ?>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/giftcard/giftcard-log.blade.php ENDPATH**/ ?>