<?php $__env->startSection('panel'); ?>
    <div class="vstack gap-3 gap-xl-6">
        <div class="row row-cols-xl-12 g-12 g-xl-6">

            <div class="col">
                <div class="card bg-success bg-opacity-10 border-success border-opacity-40">
                    <div class="p-5">
                        <div class="d-flex gap-3 mb-5"><img src="<?php echo e(asset($activeTemplateTrue . 'images/country/ngn.png')); ?>"
                                class="avatar" alt="...">
                            <div class=""><a class="d-inline-block text-sm text-heading fw-semibold" href="#">NGN
                                    Wallet
                                </a><span class="d-block text-xs text-muted">Naira</span></div>
                        </div>
                        <div class="d-flex align-items-end">
                            <div class="hstack gap-2">
                                <span class="badge bg-success bg-opacity-25 text-success">NGN Balance</span>
                                <span class="badge badge-count bg-success text-xs rounded-circle"><i
                                        class="bi bi-bank"></i></span>
                            </div>
                            <div class="w-rem-32 ms-auto">
                                <div data-toggle="spark-chart" data-type="line" data-height="36" data-color="success"
                                    data-dataset="22,21,20,18,26,65,31,47,10,44,45,22,21,20,18,26,65,31,47,10,44,45">
                                </div>
                            </div>
                        </div>
                        <div class="text-lg fw-bold text-heading mt-2">
                           <p class="text-success"> <?php echo e($general->cur_sym); ?><?php echo e(showAmount($widget['balance'])); ?></p></div>
                    </div>
                </div>
            </div>
              

        </div>
        <div class="row g-3 g-xl-6">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="row g-3 justify-content-between align-items-center">
                            <div class="col-12 col-sm">
                                <h5>Transaction Chart</h5>
                            </div>
                            <div class="col-12 col-sm-auto">
                              <span class="badge bg-primary bg-opacity-25 text-primary">Transaction Value: <?php echo e($general->cur_sym); ?><?php echo e(number_format($widget['total_transaction'], 2)); ?></span>
                            </div>
                        </div>
                        <div class="mx-n4">
                            <div id="chart" data-height="80"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-flush h-xl-100">
  <!--begin::Header-->
  <div class="card-header pt-7 mb-3">
      <!--begin::Title-->
      <h3 class="card-title align-items-start flex-column">
    <span class="card-label fw-bold text-gray-800"><?php echo app('translator')->get('Bills Payment Chart'); ?></span>
    <span class="text-gray-400 mt-1 fw-semibold fs-6"><?php echo app('translator')->get('An overview showing your bills payment histroy'); ?></span>
  </h3>
      <!--end::Title--> 
  </div>
  <!--end::Header-->

  <!--begin::Body-->
  <div class="card-body d-flex flex-column justify-content-between pb-5 px-0">       
      <!--begin::Nav-->             
      <ul class="nav nav-pills nav-pills-custom mb-3 mx-9">
         
            <!--begin::Item--> 
            <li class="nav-item mb-3 me-3 me-lg-6">
              <!--begin::Link--> 
              <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2 active 
                  " data-bs-toggle="pill" id="" 
                  href="#totalbills">
                  <!--begin::Icon-->
                  <div class="nav-icon mb-3">        
                      <i class="ti ti-printer fs-1 p-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>                                                                                                                                                                  
                  </div>
                  <!--end::Icon-->
                  
                  <!--begin::Title-->
                  <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                      <?php echo app('translator')->get('All'); ?>                        
                  </span> 
                  <!--end::Title-->
                  
                  <!--begin::Bullet-->
                  <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                  <!--end::Bullet-->
              </a>
              <!--end::Link-->
          </li>
          <!--end::Item--> 
              <!--begin::Item--> 
              <li class="nav-item mb-3 me-3 me-lg-6">
                  <!--begin::Link--> 
                  <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2 
                      " data-bs-toggle="pill" id="" 
                      href="#airtime">
                      <!--begin::Icon-->
                      <div class="nav-icon mb-3">        
                          <i class="ti ti-device-mobile fs-1 p-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>                                                                                                                                                                  
                      </div>
                      <!--end::Icon-->
                      
                      <!--begin::Title-->
                      <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                          <?php echo app('translator')->get('Airtime'); ?>                        
                      </span> 
                      <!--end::Title-->
                      
                      <!--begin::Bullet-->
                      <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                      <!--end::Bullet-->
                  </a>
                  <!--end::Link-->
              </li>
              <!--end::Item--> 
              <!--begin::Item--> 
              <li class="nav-item mb-3 me-3 me-lg-6">
                  <!--begin::Link--> 
                  <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2 
                      " data-bs-toggle="pill" id="" 
                      href="#internet">
                      <!--begin::Icon-->
                      <div class="nav-icon mb-3">        
                          <i class="ti ti-wifi fs-1 p-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>                                                                                                                                                                  
                      </div>
                      <!--end::Icon-->
                      
                      <!--begin::Title-->
                      <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                          <?php echo app('translator')->get('Internet'); ?>                        
                      </span> 
                      <!--end::Title-->
                      
                      <!--begin::Bullet-->
                      <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                      <!--end::Bullet-->
                  </a>
                  <!--end::Link-->
              </li>
              <!--end::Item--> 
              <!--begin::Item--> 
              <li class="nav-item mb-3 me-3 me-lg-6">
                  <!--begin::Link--> 
                  <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2 
                      " data-bs-toggle="pill" id="" 
                      href="#cabletv">
                      <!--begin::Icon-->
                      <div class="nav-icon mb-3">        
                          <i class="ti ti-video fs-1 p-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>                                                                                                                                                                  
                      </div>
                      <!--end::Icon-->
                      
                      <!--begin::Title-->
                      <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                          <?php echo app('translator')->get('TV'); ?>                        
                      </span> 
                      <!--end::Title-->
                      
                      <!--begin::Bullet-->
                      <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                      <!--end::Bullet-->
                  </a>
                  <!--end::Link-->
              </li>
              <!--end::Item--> 
              <!--begin::Item--> 
              <li class="nav-item mb-3 me-3 me-lg-6">
                <!--begin::Link--> 
                <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2 
                    " data-bs-toggle="pill" id="" 
                    href="#utility">
                    <!--begin::Icon-->
                    <div class="nav-icon mb-3">        
                        <i class="ti ti-bolt fs-1 p-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>                                                                                                                                                                  
                    </div>
                    <!--end::Icon-->
                    
                    <!--begin::Title-->
                    <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                        <?php echo app('translator')->get('Utility'); ?>                        
                    </span> 
                    <!--end::Title-->
                    
                    <!--begin::Bullet-->
                    <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                    <!--end::Bullet-->
                </a>
                <!--end::Link-->
            </li>
            <!--end::Item-->
            <!--begin::Item--> 
            <li class="nav-item mb-3 me-3 me-lg-6">
                <!--begin::Link--> 
                <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2 
                    " data-bs-toggle="pill" id="" 
                    href="#insurance">
                    <!--begin::Icon-->
                    <div class="nav-icon mb-3">        
                        <i class="ti ti-shield fs-1 p-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>                                                                                                                                                                  
                    </div>
                    <!--end::Icon-->
                    
                    <!--begin::Title-->
                    <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                        <?php echo app('translator')->get('Insurance'); ?>                        
                    </span> 
                    <!--end::Title-->
                    
                    <!--begin::Bullet-->
                    <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                    <!--end::Bullet-->
                </a>
                <!--end::Link-->
            </li>
            <!--end::Item-->
                      
      </ul>             
      <!--end::Nav-->

      <!--begin::Tab Content-->
      <div class="tab-content ps-4 pe-6">
              <!--begin::Tap pane-->

              <!--begin::Tap pane-->
              <div class="tab-pane fade active show" id="totalbills">
                <!--begin::Chart-->
                <div id="yearBill" class="min-h-auto" style="height: 375px"></div>
                <!--end::Chart-->
            </div>
            <!--end::Tap pane-->
              <div class="tab-pane fade " id="airtime">
                  <!--begin::Chart-->
                  <div id="yearAirtime" class="min-h-auto" style="height: 375px"></div>
                  <!--end::Chart-->
              </div>
              <!--end::Tap pane-->
              <!--begin::Tap pane-->
              <div class="tab-pane fade " id="internet">
                  <!--begin::Chart-->
                  <div id="yearInternet" class="min-h-auto" style="height: 375px"></div>
                  <!--end::Chart-->
              </div>
              <!--end::Tap pane-->
              <!--begin::Tap pane-->
              <div class="tab-pane fade " id="cabletv">
                <!--begin::Chart-->
                <div id="yearCabletv" class="min-h-auto" style="height: 375px"></div>
                <!--end::Chart-->
            </div>
            <!--end::Tap pane-->
              <!--begin::Tap pane-->
              <div class="tab-pane fade " id="utility">
                <!--begin::Chart-->
                <div id="yearUtility" class="min-h-auto" style="height: 375px"></div>
                <!--end::Chart-->
            </div>
            <!--end::Tap pane-->
             <!--begin::Tap pane-->
              <div class="tab-pane fade " id="insurance">
                <!--begin::Chart-->
                <div id="yearInsurance" class="min-h-auto" style="height: 375px"></div>
                <!--end::Chart-->
            </div>
            <!--end::Tap pane-->
      </div>
      <!--end::Tab Content-->        
  </div>
  <!--end: Card Body-->
</div>

        <div class="row g-3 g-xl-6">
             
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5>Transaction History</h5>
                            </div>
                            <div class="hstack align-items-center"><a href="#" class="text-muted"><i
                                        class="bi bi-arrow-repeat"></i></a></div>
                        </div>
                        <?php
                            $trxlog = \App\Models\Transaction::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->take(5)->get();
                        ?>
                        <div class="list-group list-group-flush">
                          <?php $__empty_1 = true; $__currentLoopData = $trxlog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="list-group-item d-flex align-items-center justify-content-between gap-6">
                                <div class="d-flex align-items-center gap-3">
                                    <div
                                        class="icon icon-shape rounded-circle icon-sm flex-none w-rem-10 h-rem-10 text-sm  <?php if($data->trx_type == '+'): ?> bg-success <?php else: ?> bg-danger <?php endif; ?> bg-opacity-25  <?php if($data->trx_type == '+'): ?> text-success <?php else: ?> text-danger <?php endif; ?>">
                                        <i class=" <?php if($data->trx_type == '+'): ?> bi bi-download <?php else: ?> bi bi-upload <?php endif; ?>"></i>
                                    </div>
                                    <div class="">
                                        <span class="d-block text-heading text-sm fw-semibold"><?php echo e($data->remark); ?> </span><span
                                            class="d-none d-sm-block text-muted text-xs"><?php echo e(showTime($data->created_at)); ?> <?php echo e(showDate($data->created_at)); ?></span>
                                    </div>
                                </div>
                                <div class="d-none d-md-block text-sm"><?php echo e($data->trx); ?></div>
                                <div class="d-none d-md-block">
                                    <span class="badge bg-body-secondary <?php if($data->trx_type == '+'): ?> text-success <?php else: ?> text-danger <?php endif; ?>"> <?php if($data->trx_type == '+'): ?> Credit <?php else: ?> Debit <?php endif; ?></span>
                                </div>
                                <div class="text-end">
                                    <span class="d-block text-heading text-sm fw-bold"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($data->amount)); ?> </span><span
                                        class="d-block text-danger text-xs">Fee: <?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($data->fee)); ?></span>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php echo emptyData(); ?>

                            <?php endif; ?>
                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

     
     <script src="<?php echo e(asset('assets/assets/dist/libs/apexcharts/dist/apexcharts.min.js')); ?>""></script>

     <script src="<?php echo e(asset('assets/assets/dist/libs/jquery/dist/jquery.min.js')); ?>"></script>
    <script>
        // =====================================
        // Profit
        // =====================================
        var chart = {
            series: [{
                    name: "Total Credit",
                    data: <?php echo json_encode($yearDeposit); ?>,
                },
                {
                    name: "Total Debit",
                    data: <?php echo json_encode($yearPayout); ?>,
                },
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
            colors: ["var(--bs-primary)", "var(--bs-danger)"],
            plotOptions: {
                bar: {
                    horizontal: false,
                    barHeight: "60%",
                    columnWidth: "20%",
                    borderRadius: [6],
                    borderRadiusApplication: 'end',
                    borderRadiusWhenStacked: 'all'
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
                categories: <?php echo json_encode($yearLabels); ?>,

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
    <script>
      // =====================================
      // Airtime
      // =====================================
      var chart = {
          series: [{
                  name: "Total Airtime",
                  data: <?php echo json_encode($yearAirtime); ?>,
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
          colors: ["var(--bs-primary)", "var(--bs-danger)"],
          plotOptions: {
              bar: {
                  horizontal: false,
                  barHeight: "60%",
                  columnWidth: "20%",
                  borderRadius: [6],
                  borderRadiusApplication: 'end',
                  borderRadiusWhenStacked: 'all'
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
              categories: <?php echo json_encode($yearLabels); ?>,

          },
          yaxis: {
              tickAmount: 4,
          },
          tooltip: {
              theme: "dark",
          },
      };

      var chart = new ApexCharts(document.querySelector("#yearAirtime"), chart);
      chart.render();
  </script>
  <script>
    // =====================================
    // Internet
    // =====================================
    var chart = {
        series: [{
                name: "Total Internet",
                data: <?php echo json_encode($yearInternet); ?>,
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
        colors: ["var(--bs-primary)", "var(--bs-danger)"],
        plotOptions: {
            bar: {
                horizontal: false,
                barHeight: "60%",
                columnWidth: "20%",
                borderRadius: [6],
                borderRadiusApplication: 'end',
                borderRadiusWhenStacked: 'all'
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
            categories: <?php echo json_encode($yearLabels); ?>,

        },
        yaxis: {
            tickAmount: 4,
        },
        tooltip: {
            theme: "dark",
        },
    };

    var chart = new ApexCharts(document.querySelector("#yearInternet"), chart);
    chart.render();
</script>
<script>
  // =====================================
  // Cabletv
  // =====================================
  var chart = {
      series: [{
              name: "Total Cable TV",
              data: <?php echo json_encode($yearCabletv); ?>,
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
      colors: ["var(--bs-primary)", "var(--bs-danger)"],
      plotOptions: {
          bar: {
              horizontal: false,
              barHeight: "60%",
              columnWidth: "20%",
              borderRadius: [6],
              borderRadiusApplication: 'end',
              borderRadiusWhenStacked: 'all'
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
          categories: <?php echo json_encode($yearLabels); ?>,

      },
      yaxis: {
          tickAmount: 4,
      },
      tooltip: {
          theme: "dark",
      },
  };

  var chart = new ApexCharts(document.querySelector("#yearCabletv"), chart);
  chart.render();
</script>

<script>
  // =====================================
  // Utility
  // =====================================
  var chart = {
      series: [{
              name: "Total Utility",
              data: <?php echo json_encode($yearUtility); ?>,
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
      colors: ["var(--bs-primary)", "var(--bs-danger)"],
      plotOptions: {
          bar: {
              horizontal: false,
              barHeight: "60%",
              columnWidth: "20%",
              borderRadius: [6],
              borderRadiusApplication: 'end',
              borderRadiusWhenStacked: 'all'
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
          categories: <?php echo json_encode($yearLabels); ?>,

      },
      yaxis: {
          tickAmount: 4,
      },
      tooltip: {
          theme: "dark",
      },
  };

  var chart = new ApexCharts(document.querySelector("#yearUtility"), chart);
  chart.render();
</script>
<script>
    // =====================================
    // Insurance
    // =====================================
    var chart = {
        series: [{
                name: "Total Insurance",
                data: <?php echo json_encode($yearInsurance); ?>,
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
        colors: ["var(--bs-primary)", "var(--bs-danger)"],
        plotOptions: {
            bar: {
                horizontal: false,
                barHeight: "60%",
                columnWidth: "20%",
                borderRadius: [6],
                borderRadiusApplication: 'end',
                borderRadiusWhenStacked: 'all'
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
            categories: <?php echo json_encode($yearLabels); ?>,
  
        },
        yaxis: {
            tickAmount: 4,
        },
        tooltip: {
            theme: "dark",
        },
    };
  
    var chart = new ApexCharts(document.querySelector("#yearInsurance"), chart);
    chart.render();
  </script>
<script>
  // =====================================
  // OVERALL BILLS
  // =====================================
  var chart = {
      series: [{
              name: "Total Airtime",
              data: <?php echo json_encode($yearAirtime); ?>,
          },{
              name: "Total Internet",
              data: <?php echo json_encode($yearInternet); ?>,
          },{
              name: "Total Cable TV",
              data: <?php echo json_encode($yearCabletv); ?>,
          },{
              name: "Total Utility",
              data: <?php echo json_encode($yearUtility); ?>,
          },{
              name: "Total Insurance",
              data: <?php echo json_encode($yearInsurance); ?>,
          },
      ],
      chart: {
          toolbar: {
              show: false,
          },
          type: "area",
          fontFamily: "Plus Jakarta Sans', sans-serif",
          foreColor: "#adb0bb",
          height: 320,
          stacked: false,
      },
      colors: ["var(--bs-primary)","var(--bs-info)","var(--bs-warning)","var(--bs-success)", "var(--bs-danger)"],
      plotOptions: {
          bar: {
              horizontal: false,
              barHeight: "60%",
              columnWidth: "20%",
              borderRadius: [6],
              borderRadiusApplication: 'end',
              borderRadiusWhenStacked: 'all'
          },
      },
      dataLabels: {
          enabled: false,
      },
      legend: {
          show: true,
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
          categories: <?php echo json_encode($yearLabels); ?>,

      },
      yaxis: {
          tickAmount: 4,
      },
      tooltip: {
          theme: "dark",
      },
  };

  var chart = new ApexCharts(document.querySelector("#yearBill"), chart);
  chart.render();
</script>  
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/templates/satoshi/user/dashboard.blade.php ENDPATH**/ ?>