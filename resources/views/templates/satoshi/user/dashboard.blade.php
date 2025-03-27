@extends(checkTemplate() . 'layouts.app')
@section('panel')
    <div class="vstack gap-3 gap-xl-6">
        <div class="row row-cols-xl-12 g-12 g-xl-6">

            <div class="col">
                <div class="card bg-success bg-opacity-10 border-success border-opacity-40">
                    <div class="p-5">
                        <div class="d-flex gap-3 mb-5"><img src="{{ asset(checkTemplate(true) . 'images/country/ngn.png')}}"
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
                           <p class="text-success"> {{ $general->cur_sym }}{{ showAmount($widget['balance']) }}</p></div>
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
                              <span class="badge bg-primary bg-opacity-25 text-primary">Transaction Value: {{ $general->cur_sym }}{{ number_format($widget['total_transaction'], 2) }}</span>
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
    <span class="card-label fw-bold text-gray-800">@lang('Bills Payment Chart')</span>
    <span class="text-gray-400 mt-1 fw-semibold fs-6">@lang('An overview showing your bills payment histroy')</span>
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
                      @lang('All')
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
                          @lang('Airtime')
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
                          @lang('Internet')
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
                          @lang('TV')
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
                        @lang('Utility')
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
                        @lang('Insurance')
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
                        @php
                            $trxlog = \App\Models\Transaction::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->take(5)->get();
                        @endphp
                        <div class="list-group list-group-flush">
                          @forelse($trxlog as $data)
                            <div class="list-group-item d-flex align-items-center justify-content-between gap-6">
                                <div class="d-flex align-items-center gap-3">
                                    <div
                                        class="icon icon-shape rounded-circle icon-sm flex-none w-rem-10 h-rem-10 text-sm  @if ($data->trx_type == '+') bg-success @else bg-danger @endif bg-opacity-25  @if ($data->trx_type == '+') text-success @else text-danger @endif">
                                        <i class=" @if ($data->trx_type == '+') bi bi-download @else bi bi-upload @endif"></i>
                                    </div>
                                    <div class="">
                                        <span class="d-block text-heading text-sm fw-semibold">{{ $data->remark }} </span><span
                                            class="d-none d-sm-block text-muted text-xs">{{ showTime($data->created_at) }} {{ showDate($data->created_at) }}</span>
                                    </div>
                                </div>
                                <div class="d-none d-md-block text-sm">{{$data->trx}}</div>
                                <div class="d-none d-md-block">
                                    <span class="badge bg-body-secondary @if ($data->trx_type == '+') text-success @else text-danger @endif"> @if ($data->trx_type == '+') Credit @else Debit @endif</span>
                                </div>
                                <div class="text-end">
                                    <span class="d-block text-heading text-sm fw-bold">{{ __($general->cur_sym) }}{{ showAmount($data->amount) }} </span><span
                                        class="d-block text-danger text-xs">Fee: {{ __($general->cur_sym) }}{{ showAmount($data->fee) }}</span>
                                </div>
                            </div>
                            @empty
                                {!! emptyData() !!}
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')


     <script src="{{ asset('assets/assets/dist/libs/apexcharts/dist/apexcharts.min.js')}}""></script>

     <script src="{{ asset('assets/assets/dist/libs/jquery/dist/jquery.min.js')}}"></script>
    <script>
        // =====================================
        // Profit
        // =====================================
        var chart = {
            series: [{
                    name: "Total Credit",
                    data: {!! json_encode($yearDeposit) !!},
                },
                {
                    name: "Total Debit",
                    data: {!! json_encode($yearPayout) !!},
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
                categories: {!! json_encode($yearLabels) !!},

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
                  data: {!! json_encode($yearAirtime) !!},
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
              categories: {!! json_encode($yearLabels) !!},

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
                data: {!! json_encode($yearInternet) !!},
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
            categories: {!! json_encode($yearLabels) !!},

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
              data: {!! json_encode($yearCabletv) !!},
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
          categories: {!! json_encode($yearLabels) !!},

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
              data: {!! json_encode($yearUtility) !!},
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
          categories: {!! json_encode($yearLabels) !!},

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
                data: {!! json_encode($yearInsurance) !!},
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
            categories: {!! json_encode($yearLabels) !!},

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
              data: {!! json_encode($yearAirtime) !!},
          },{
              name: "Total Internet",
              data: {!! json_encode($yearInternet) !!},
          },{
              name: "Total Cable TV",
              data: {!! json_encode($yearCabletv) !!},
          },{
              name: "Total Utility",
              data: {!! json_encode($yearUtility) !!},
          },{
              name: "Total Insurance",
              data: {!! json_encode($yearInsurance) !!},
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
          categories: {!! json_encode($yearLabels) !!},

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
@endpush
