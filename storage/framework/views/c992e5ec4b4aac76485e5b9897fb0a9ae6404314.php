<?php $__env->startSection('panel'); ?>

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <?php
                if ($saved->total < 1) {
                    $saved->total = 1;
                }

                $progress = ($saved->paid / $saved->total) * 100;
            ?>

            <div class="row layout-top-spacing">

                <div class="col-lg-12 d-flex align-items-strech">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                <div class="mb-3 mb-sm-0">
                                    <h5 class="card-title fw-semibold">
                                        <?php if($saved->type == 1): ?>
                                            Recurrent Savings

                                        <?php elseif($saved->type == 2): ?>
                                            Target Savings
                                        <?php else: ?>
                                            Fixed Savings
                                        <?php endif; ?>
                                    </h5>
                                    <?php if($saved->status != 0): ?>
                                        <badge class="badge bg-success text-white">Running & Active &nbsp;&nbsp;<i class="text-white fa fa-spinner fa-spin"></i></badge> 
                                    <?php else: ?>
                                    <badge class="badge bg-danger text-white">Closed</badge> 
                                    <?php endif; ?>
                                </div>
                                
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div id="chart"></div>
                                </div>
                                <div class="col-md-4">
                                     

                                    <div class="d-flex align-items-baseline mb-4 pb-1">
                                        <span class="round-8 text-bg-success rounded-circle me-6"></span>
                                        <div>
                                            <p class="fs-3 mb-1">
                                                Total Saved
                                            </p>
                                            <h6 class="fs-5 fw-semibold mb-0">
                                                <?php echo e($general->cur_sym); ?>

                                                <?php echo e(number_format($sum, 2)); ?>

                                            </h6>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="d-flex align-items-baseline mb-4">
                                            <span class="round-8 text-bg-primary rounded-circle me-6"></span>
                                            <div>
                                                <p class="fs-3 mb-1">
                                                    <?php if($saved->type == 1): ?>
                                                        Recurrent Amount:
                                                    <?php elseif($saved->type == 2): ?>
                                                    Target Goal:
                                                    <?php elseif($saved->type == 3): ?>
                                                        Fixed Amount:
                                                    <?php endif; ?>
                                                </p>
                                                <h6 class="fs-5 fw-semibold mb-0">
                                                    <?php echo e($general->cur_sym); ?><?php echo e(number_format($saved->amount, 2)); ?></h6>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-baseline mb-4 pb-1">
                                            <span class="round-8 text-bg-secondary rounded-circle me-6"></span>
                                            <div>
                                                <p class="fs-3 mb-1">
                                                    <?php if($saved->type == 1): ?>
                                                        Cycle:

                                                </p>
                                                <h6 class="fs-5 fw-semibold mb-0">
                                                    <?php if($saved->cycle == 1): ?>
                                                        Daily (<?php echo e($saved->recurrent); ?> Days)
                                                    <?php elseif($saved->cycle == 7): ?>
                                                        Weekly (<?php echo e($saved->recurrent); ?> Weeks)
                                                    <?php elseif($saved->cycle == 30): ?>
                                                        Monthly (<?php echo e($saved->recurrent); ?> Months)
                                                    <?php endif; ?>
                                                </h6>
                                            <?php else: ?>
                                                          <p class="fs-3 mb-1"> Mature Date:</p>
                                                <h6 class="fs-5 fw-semibold mb-0"><?php echo date(' D d, M Y', strtotime($saved->mature)); ?> <small>
                                                        <?php echo e(date('h:i A', strtotime($saved->mature))); ?></small></h6>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <?php if($saved->val_1 != null): ?>
                                        <div class="d-flex align-items-baseline mb-4 pb-1">
                                            <span class="round-8 text-bg-info rounded-circle me-6"></span>
                                            <div>
                                        <p class="fs-3 mb-1"> Reason:</p>
                                                <h6 class="fs-5 fw-semibold mb-0"><?php echo e($saved->val_1); ?></h6>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                              


                                        <div class="d-flex align-items-baseline mb-4 pb-1">
                                            <span class="round-8 text-bg-warning rounded-circle me-6"></span>
                                            <div>
                                                <p class="fs-3 mb-1">
                                                    <?php if($saved->type == 1): ?>
                                                        Recurrent:
                                                    <?php else: ?>
                                                        Total Payment
                                                    <?php endif; ?>

                                                </p>
                                                <h6 class="fs-5 fw-semibold mb-0">
                                                    <?php echo e($count); ?> Times
                                                </h6>
                                            </div>
                                        </div>

                                        <div>
                                            <?php if($saved->type == 2 && $saved->status != 0): ?>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#inlineForm"
                                                    class="btn btn-primary  w-100">Fast Save</button> 
                                            <?php endif; ?>
                                            <?php if($saved->status != 0): ?>  
                                            <br><br>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#inlineClose"
                                                class="btn btn-danger  w-100">Close Savings Account</button>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-12 col-12">
                              <div class="card card-company-table">
                                  <div class="card-body p-0">
                                      <div class="table-responsive">
                                          <table class="table">
                                              <thead>
                                                  <tr>
                                                      <th>Ref No</th>
                                                      <th>Date</th>
                                                      <th>Amount</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php $__currentLoopData = $pay; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                      <tr>
                                                          <td>
                                                              <div class="d-flex align-items-center">
                                                                  <div>
                                                                      <div class="fw-bolder">
                                                                          <?php echo e($data->trx); ?></div>
                                                                      <div
                                                                          class="font-small-2 text-muted">
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </td>
                                                          <td>
                                                              <div class="fw-bolder align-items-center">

                                                                  <span><?php echo date(' D d, M Y', strtotime($saved->created_at)); ?><br><small>
                                                                          <?php echo e(date('h:i A', strtotime($saved->created_at))); ?></small></span>
                                                              </div>
                                                          </td>
                                                          <td class="text-nowrap">
                                                              <div class="d-flex flex-column">
                                                                  <span
                                                                      class="fw-bolder mb-25"><?php echo e($general->cur_sym); ?><?php echo e(number_format($data->amount, 2)); ?></span>
                                                                  <span
                                                                      class="font-small-2 text-muted">Bal:
                                                                      <?php echo e($general->cur_sym); ?><?php echo e(number_format($data->balance, 2)); ?></span>
                                                              </div>
                                                          </td>
                                                      </tr>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              </tbody>
                                          </table>
                                      </div>
                                      <?php if(count($pay) < 1): ?>
                                          <div class="demo-spacing-0">
                                              <div class="alert alert-danger" role="alert">
                                                  <div class="alert-body"><strong>Hello
                                                          <?php echo e(Auth::user()->username); ?>!</strong> You have
                                                      not made any savings.</div>
                                              </div>
                                          </div>
                                      <?php endif; ?>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>



                <!-- Modal -->
                <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Please note that you
                                    must have enough fund in your deposit wallet to proceed with
                                    this savings</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="<?php echo e(route('user.save.pay', $saved->reference)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="modal-body">
                                    <label>Enter Amount: </label>
                                    <div class="mb-1">
                                        <input type="number" name="amount" placeholder="<?php echo e($general->cur_sym); ?> 0.00"
                                            class="form-control form-control-lg focus" />
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Make
                                        Payment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                <!-- Modal -->
                <div class="modal fade text-start" id="inlineClose" tabindex="-1" aria-labelledby="myModalLabel33"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">You are about to close this savings account. 
                                    <?php if(\Carbon\Carbon::now() < $saved->mature): ?>
                                    <br>
                                    <p class="text-danger">Please note you will lose <?php echo e(env('CLOSE_SAVINGS')); ?>% of your total savings if you close before due date</p>
                                    <?php endif; ?>
                                </h4>

                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="<?php echo e(route('user.save.close', $saved->reference)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="modal-body">
                                     <div class="d-flex align-items-baseline mb-4 pb-1">
                                        <span class="round-8 text-bg-primary rounded-circle me-6"></span>
                                        <div>
                                            <p class="fs-3 mb-1">
                                                Total Saved
                                            </p>
                                            <h6 class="fs-5 fw-semibold mb-0"> 
                                                <?php echo e($general->cur_sym); ?>

                                                <?php echo e(number_format($sum, 2)); ?>

                                            </h6>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-baseline mb-4 pb-1">
                                        <span class="round-8 text-bg-danger rounded-circle me-6"></span>
                                        <div>
                                            <p class="fs-3 mb-1">
                                                Total Charge
                                            </p>
                                            <h6 class="fs-5 fw-semibold mb-0">
                                                <?php
                                                 $commission = (@$sum / 100) * @env('CLOSE_SAVINGS');

                                                ?>
                                                <?php echo e($general->cur_sym); ?>

                                                <?php echo e(number_format($commission, 2)); ?>

                                            </h6>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-baseline mb-4 pb-1">
                                        <span class="round-8 text-bg-success rounded-circle me-6"></span>
                                        <div>
                                            <p class="fs-3 mb-1">
                                                What You Get
                                            </p>
                                            <h6 class="fs-5 fw-semibold mb-0">
                                                
                                                <?php echo e($general->cur_sym); ?>

                                                <?php echo e(number_format($sum - $commission, 2)); ?>

                                            </h6>
                                        </div>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Close Savings</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>


        <?php $__env->stopSection(); ?>

        <?php $__env->startPush('breadcrumb-plugins'); ?>
            <a class="btn btn-sm btn-primary" href="<?php echo e(route('user.savings.history')); ?>"> <i class="ti ti-printer"></i>
                <?php echo app('translator')->get('My Savings'); ?></a>
        <?php $__env->stopPush(); ?>
        <?php $__env->startPush('script'); ?>
        <script>
          // =====================================
  // Profit
  // =====================================
  var chart = {
    series: [
      {
        name: "Savings this month",
        data: ["<?php echo e(number_format($jan,2)); ?>","<?php echo e(number_format($feb,2)); ?>","<?php echo e(number_format($mar,2)); ?>","<?php echo e(number_format($apr,2)); ?>","<?php echo e(number_format($may,2)); ?>","<?php echo e(number_format($jun,2)); ?>","<?php echo e(number_format($jul,2)); ?>","<?php echo e(number_format($aug,2)); ?>","<?php echo e(number_format($sep,2)); ?>","<?php echo e(number_format($oct,2)); ?>","<?php echo e(number_format($nov,2)); ?>","<?php echo e(number_format($dec,2)); ?>"],
      }
    ],
    chart: {
      toolbar: {
        show: false,
      },
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      height: 320,
      stacked: true,
    },
    colors: ["var(--bs-primary)", "var(--bs-secondary)"],
    plotOptions: {
      bar: {
        horizontal: false,
        barHeight: "60%",
        columnWidth: "20%",
        borderRadius: [6],
        borderRadiusApplication: "end",
        borderRadiusWhenStacked: "all",
      },
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      borderColor: "rgba(0,0,0,0.1)",
      strokeDashArray: 3,
      xaxis: {
        lines: {
          show: false,
        },
      },
    },
    yaxis: {
      min: -5,
      max: 5,
      title: {
        // text: 'Age',
      },
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      categories: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ],
    },
    yaxis: {
      tickAmount: 4,
    },
    tooltip: {
      theme: "dark",
    },
  };

  var chart = new ApexCharts(document.querySelector("#chart"), chart);
  chart.render();

    </script>
        <?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypoint/core/resources/views/templates/basic/user/vendor/savings/view.blade.php ENDPATH**/ ?>