@extends(checkTemplate() . 'layouts.app')
@section('panel')
    <div class="row">
        @if ($general->login_bonus == 1)
            @if (Auth::user()->earn_at < DTnow() || Auth::user()->earn_at == null)
                <!--begin::Engage widget 4-->
                <div class="col-lg-12">
                    <div class="card border-transparent " data-bs-theme="light" style="background-color: #1C325E;">
                        <!--begin::Body-->
                        <div class="card-body d-flex ps-xl-15">
                            <!--begin::Wrapper-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <div class="position-relative fs-2x z-index-2 fw-bold text-white mb-7">
                                    <span class="me-2">
                                        @lang('Welcome') {{ auth::user()->username }} ! <br>
                                        <span class="position-relative d-inline-block text-danger">
                                            <a href="#"
                                                class="text-danger opacity-75-hover">{{ $general->cur_sym }}{{ showAmount($general->login_earn) }}</a>
                                            <!--begin::Separator-->
                                            <span
                                                class="position-absolute opacity-50 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
                                            <!--end::Separator-->
                                        </span>
                                    </span>
                                    @lang('daily bonus awaits you')
                                </div>
                                <!--end::Title-->

                                <!--begin::Action-->
                                <div class="mb-3">
                                    <a href='{{ route('user.login_earn') }}' class="btn btn-danger fw-semibold me-2">
                                        @lang('Get Reward')
                                    </a>
                                </div>
                                <!--begin::Action-->
                            </div>
                            <!--begin::Wrapper-->

                            <!--begin::Illustration-->
                            <img src="{{ asset('assets/assets/dist/images/backgrounds/gift.gif') }}"
                                class="position-absolute me-3 bottom-0 end-0 h-200px" alt="" />
                            <!--end::Illustration-->
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
            @endif
        @endif
        <!--end::Engage widget 4-->

        <!--begin::Notice-->
        <div class="col-lg-12 mb-4 align-items-strech">

            <div class="notice d-flex @if(Auth::user()->nuban == null) bg-light-danger rounded border-danger @else bg-light-primary rounded border-primary @endif  border border-dashed min-w-lg-600px flex-shrink-0 p-6">
                <!--begin::Icon-->

                <i class="@if(Auth::user()->nuban == null) ti ti-alert-circle fs-2tx text-danger @else  ti ti-building-bank fs-2tx text-primary @endif me-4">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i> <!--end::Icon-->

                <!--begin::Wrapper-->
                <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                    <!--begin::Content-->
                    <div class="mb-3 mb-md-0 fw-semibold">
                        <h4 class="text-gray-900 fw-bold">@lang('Dedicated Account Number')</h4>


                        @if(Auth::user()->nuban == null)
                        <div class="fs-6 text-gray-700 pe-7">@lang('Please click the generate button to generate your dedicated account number')
                        </div>
                        @else
                            @if($general->nuban_provider == "MONNIFY")
                            @php
                            $nuban = json_decode(Auth::user()->nuban, true);
                            @endphp
                            @foreach($nuban as $data)
                            @if(isset($data['bankName']) && isset($data['accountName']))
                             <div class="d-flex align-items-center flex-wrap d-grid gap-2 mb-3">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center me-5 me-xl-13">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px symbol-circle me-3">
                                        <span class="symbol-label" style="background: #040273;">
                                            <i class="ti ti-building-bank fs-4 text-white"><span class="path1"></span><span class="path2"></span></i>                                    </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <a href="#" class="text-dark text-opacity-75 fs-8">@lang('Bank Name')</a>
                                        <span class="fw-bold text-dark fs-7 d-block">{{@$data['bankName'] ?? null}}</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <div class="d-flex align-items-center me-5 me-xl-13">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px symbol-circle me-3">
                                        <span class="symbol-label" style="background: #410a8fc1;">
                                            <i class="ti ti-user fs-4 text-white"><span class="path1"></span><span class="path2"></span></i>                                    </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <a href="#" class="text-dark text-opacity-75 fs-8">@lang('Account Name')</a>
                                        <span class="fw-bold text-dark fs-7 d-block">{{@$data['accountName']}}</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center me-5 me-xl-13">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px symbol-circle me-3">
                                        <span class="symbol-label" style="background: #410a8fc1;">
                                            <i class="ti ti-wallet fs-4 text-white"><span class="path1"></span><span class="path2"></span></i>                                    </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <a href="#" class="text-dark text-opacity-75 fs-8">@lang('Account Number')</a>
                                        <span class="fw-bold text-dark fs-7 d-block">{{@$data['accountNumber']}}</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->
                            </div>
                            @endif
                            @endforeach

                            @elseif($general->nuban_provider == "STROWALLET" || $general->nuban_provider == "PAYVESSEL")
                            <div class="d-flex align-items-center flex-wrap d-grid gap-2 ">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center me-5 me-xl-13">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px symbol-circle me-3">
                                        <span class="symbol-label" style="background: #040273;">
                                            <i class="ti ti-building-bank fs-4 text-white"><span class="path1"></span><span class="path2"></span></i>                                    </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <a href="#" class="text-dark text-opacity-75 fs-8">@lang('Bank Name')</a>
                                        @php
                                        $bankdetails = json_decode(Auth::user()->nuban);
                                        @endphp
                                        <span class="fw-bold text-dark fs-7 d-block">{{@$bankdetails->bank_name}}</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <div class="d-flex align-items-center me-5 me-xl-13">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px symbol-circle me-3">
                                        <span class="symbol-label" style="background: #410a8fc1;">
                                            <i class="ti ti-user fs-4 text-white"><span class="path1"></span><span class="path2"></span></i>                                    </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <a href="#" class="text-dark text-opacity-75 fs-8">@lang('Account Name')</a>
                                        <span class="fw-bold text-dark fs-7 d-block">{{@$bankdetails->account_name}}</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center me-5 me-xl-13">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px symbol-circle me-3">
                                        <span class="symbol-label" style="background: #410a8fc1;">
                                            <i class="ti ti-wallet fs-4 text-white"><span class="path1"></span><span class="path2"></span></i>                                    </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <a href="#" class="text-dark text-opacity-75 fs-8">@lang('Account Number')</a>
                                        <span class="fw-bold text-dark fs-7 d-block">{{@$bankdetails->account_number}}</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->
                            </div>
                            @elseif($general->nuban_provider == "PAYLONY")
                            <div class="d-flex align-items-center flex-wrap d-grid gap-2 ">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center me-5 me-xl-13">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px symbol-circle me-3">
                                        <span class="symbol-label" style="background: #410a8fc1;">
                                            <i class="ti ti-building-bank fs-4 text-white"><span class="path1"></span><span class="path2"></span></i>                                    </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <a href="#" class="text-dark text-opacity-75 fs-8">@lang('Bank Name')</a>
                                        @php
                                        $bankdetails = json_decode(Auth::user()->nuban);
                                        @endphp
                                        <span class="fw-bold text-dark fs-7 d-block">{{@$bankdetails->bank_name}}</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <div class="d-flex align-items-center me-5 me-xl-13">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px symbol-circle me-3">
                                        <span class="symbol-label" style="background: #410a8fc1;">
                                            <i class="ti ti-user fs-4 text-white"><span class="path1"></span><span class="path2"></span></i>                                    </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <a href="#" class="text-dark text-opacity-75 fs-8">@lang('Account Name')</a>
                                        <span class="fw-bold text-dark fs-7 d-block">{{@$bankdetails->account_name}}</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center me-5 me-xl-13">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px symbol-circle me-3">
                                        <span class="symbol-label" style="background: #410a8fc1;">
                                            <i class="ti ti-wallet fs-4 text-white"><span class="path1"></span><span class="path2"></span></i>                                    </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <a href="#" class="text-dark text-opacity-75 fs-8">@lang('Account Number')</a>
                                        <span class="fw-bold text-dark fs-7 d-block">{{@$bankdetails->account_number}}</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->
                            </div>
                            @endif
                        <!--end::Items-->

                        @endif
                        <div id="responsemessage"></div>
                    </div>
                    <!--end::Content-->

                    <!--begin::Action-->
                    @if(Auth::user()->nuban == null)
                    <a href="#" id="fundbutton" onclick="generatenuban()" class="btn btn-primary px-6 align-self-center text-nowrap">
                        @lang('Generate') </a>
                    <!--end::Action-->
                    @endif
                </div>
                <!--end::Wrapper-->
            </div>
        </div>
        <br><br>
        <br><br>

@push('script')
<script>
    function generatenuban() {
        // START GET DATA \\
        const loadingEl = document.createElement("div");
        document.body.prepend(loadingEl);
        loadingEl.classList.add("page-loader");
        loadingEl.classList.add("flex-column");
        loadingEl.classList.add("bg-dark");
        loadingEl.classList.add("bg-opacity-25");
        loadingEl.innerHTML = `
         <span class="spinner-border text-primary" role="status"></span>
         <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>
        `;
        document.getElementById("fundbutton").disabled = true;
        $("#responsemessage").html('');
        // Show page loading
        KTApp.showPageLoading();
        var _token = $("input[name='_token']").val();
        var raw = JSON.stringify({
            _token: "{{ csrf_token() }}",
        });

        var requestOptions = {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: raw
        };
        fetch("{{ route('user.generate.nuban') }}", requestOptions)
            .then(response => response.text())
            .then(result => {
                resp = JSON.parse(result);
                document.getElementById("fundbutton").disabled = false;
                $("#responsemessage").html(
                    `<div class="alert alert-${resp.status}" role="alert"><strong>${resp.status} - </strong> ${resp.message}</div>`
                    );

                KTApp.hidePageLoading();
                loadingEl.remove();
                if(resp.status == 'success')
                {
                    location.reload();
                }
            })
            .catch(error => {
            console.info(error);
            });
        // END GET DATA \\


    }
</script>
@endpush


        <div class="col-lg-4 d-flex align-items-strech">
            <div class="card bg-info border-0 w-100">
                <div class="card-body pb-0">
                    <h5 class="fw-semibold mb-1 text-white card-title"> @lang('Wallet Balance') </h5>
                    <div class="text-center mt-3">
                        <img src="{{ asset('assets/assets/dist/images/backgrounds/piggy.png') }}" class="img-fluid"
                            alt="" />
                    </div>
                </div>
                <div class="cards mx-2 mb-2 mt-n2">
                    <div class="card-body">
                        <div class="mb-7 pb-1">
                            <div class="d-flex justify-content-between align-items-center mb-6">
                                <div>
                                    <h6 class="mb-1 fs-4 fw-semibold text-white">@lang('Main Wallet')</h6>
                                    <p class="fs-3 mb-0"></p>
                                </div>
                                <div>
                                    <span
                                        class="badge bg-light-primary text-primary fw-semibold fs-3">{{ $general->cur_sym }}{{ showAmount($widget['balance']) }}</span>
                                </div>
                            </div>
                            <div class="progress bg-light-primary" style="height: 4px;">
                                <div class="progress-bar w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-6">
                                <div>
                                    <h6 class="mb-1 fs-4 fw-semibold text-white">@lang('Referral Wallet')</h6>
                                    <p class="fs-3 mb-0"></p>
                                </div>
                                <div>
                                    <span
                                        class="badge bg-light-secondary text-secondary fw-bold fs-3">{{ $general->cur_sym }}{{ showAmount($widget['ref_balance']) }}</span>
                                </div>
                            </div>
                            <form class="mt-3">
                                <div class="input-group">
                                    <input type="text" id="referralURL"
                                        value="{{ route('user.register', Auth::user()->username) }}" readonly
                                        class="form-control" placeholder="Right Side" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                    <button onclick="myFunction()"  class="btn btn-light-secondary text-secondary font-medium" type="button"><a
                                            class="ti ti-copy"></a></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">@lang('Transaction Overview')</h5>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-12">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


<!--begin::Row-->
<div class="row gy-5 g-xl-10">
  <!--begin::Col-->
  <div class="col-xl-4 mb-xl-10">

<!--begin::List widget 16-->
<div class="card card-flush h-xl-100">
  <!--begin::Header-->
  <div class="card-header pt-7">
      <!--begin::Title-->
      <h3 class="card-title align-items-start flex-column">
    <span class="card-label fw-bold text-gray-800">@lang('Recent Transaction')</span>
    <span class="text-gray-400 mt-1 fw-semibold fs-6">@lang('Recent transactions log')</span>
  </h3>
      <!--end::Title-->

      <!--begin::Toolbar-->
      <div class="card-toolbar">
          <a href="{{ route('user.transactions') }}" class="btn btn-sm btn-light" data-bs-toggle='tooltip' data-bs-dismiss='click' title="@lang('View all transactions on your account')">@lang('View All')</a>
      </div>
      <!--end::Toolbar-->
  </div>
  <!--end::Header-->

  <!--begin::Body-->
  <div class="card-body pt-4 px-0">
      <!--begin::Nav-->
      <ul class="nav nav-pills nav-pills-custom item position-relative mx-9 mb-9">
          <!--begin::Item-->
          <li class="nav-item col-6 mx-0 p-0">
              <!--begin::Link-->
              <a class="nav-link active d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="delivery.html#kt_list_widget_16_tab_1">
                  <!--begin::Subtitle-->
                  <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                     @lang('Credit')
                  </span>
                  <!--end::Subtitle-->

                  <!--begin::Bullet-->
                  <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                  <!--end::Bullet-->
              </a>
              <!--end::Link-->
          </li>
          <!--end::Item-->

          <!--begin::Item-->
          <li class="nav-item col-6 mx-0 px-0">
              <!--begin::Link-->
              <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="delivery.html#kt_list_widget_16_tab_2">
                  <!--begin::Subtitle-->
                  <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                      @lang('Debit')
                  </span>
                  <!--end::Subtitle-->

                  <!--begin::Bullet-->
                  <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                  <!--end::Bullet-->
              </a>
              <!--end::Link-->
          </li>
          <!--end::Item-->

          <!--begin::Bullet-->
          <span class="position-absolute z-index-1 bottom-0 w-100 h-4px bg-light rounded"></span>
          <!--end::Bullet-->
      </ul>
      <!--end::Nav-->

      <!--begin::Tab Content-->
      <div class="tab-content px-9 hover-scroll-overlay-y pe-7 me-3 mb-2" style="height: 454px">

              <!--begin::Tap pane-->
              <div class="tab-pane fade show active" id="kt_list_widget_16_tab_1">

                      <!--begin::Item-->
                      @forelse($credit as $data)
                      <div class="m-0">
                          <!--begin::Timeline-->
                          <div class="timeline ms-n1">
                                <!--begin::Timeline item-->
                              <div class="timeline-item align-items-center">
                                  <!--begin::Timeline line-->
                                  <div class="timeline-line w-20px"></div>
                                  <!--end::Timeline line-->

                                  <!--begin::Timeline icon-->
                                  <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                                      <i class="ti ti-wallet fs-2 text-success"><span class="path1"></span><span class="path2"></span></i>
                                  </div>
                                  <!--end::Timeline icon-->

                                  <!--begin::Timeline content-->
                                  <div class="timeline-content m-0">
                                      <!--begin::Label-->
                                      <span class="fs-8 fw-bolder text-success text-uppercase">{{$data->remark}}</span>
                                      <!--begin::Label-->

                                      <!--begin::Title-->
                                      <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">{{ __($general->cur_sym) }}{{ showAmount($data->amount) }}</a>
                                      <!--end::Title-->

                                      <!--begin::Title-->
                                      <span class="fw-semibold text-gray-400">{{ diffForHumans($data->created_at) }}</span>
                                      <!--end::Title-->
                                  </div>
                                  <!--end::Timeline content-->
                              </div>
                              <!--end::Timeline item-->
                          </div>
                          <!--end::Timeline-->
                         </div>
                      <!--end::Item-->

                      <!--begin::Separator-->
                      <div class="separator separator-dashed mt-5 mb-4"></div>
                      <!--end::Separator-->
                      @empty
                       {!! emptyData() !!}
                      @endforelse
                      <!--begin::Item-->
              </div>
              <!--end::Tap pane-->

              <!--begin::Tap pane-->
              <div class="tab-pane fade " id="kt_list_widget_16_tab_2">

              <!--begin::Item-->
              @forelse($debit as $data)
              <div class="m-0">
                  <!--begin::Timeline-->
                  <div class="timeline ms-n1">
                        <!--begin::Timeline item-->
                      <div class="timeline-item align-items-center">
                          <!--begin::Timeline line-->
                          <div class="timeline-line w-20px"></div>
                          <!--end::Timeline line-->

                          <!--begin::Timeline icon-->
                          <div class="timeline-icon pt-1" style="margin-left: 0.5px">
                              <i class="ti ti-wallet-off fs-2 text-danger"><span class="path1"></span><span class="path2"></span></i>
                          </div>
                          <!--end::Timeline icon-->

                          <!--begin::Timeline content-->
                          <div class="timeline-content m-0">
                              <!--begin::Label-->
                              <span class="fs-8 fw-bolder text-danger text-uppercase">{{$data->remark}}</span>
                              <!--begin::Label-->

                              <!--begin::Title-->
                              <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">{{ __($general->cur_sym) }}{{ showAmount($data->amount) }}</a>
                              <!--end::Title-->

                              <!--begin::Title-->
                              <span class="fw-semibold text-gray-400">{{ diffForHumans($data->created_at) }}</span>
                              <!--end::Title-->
                          </div>
                          <!--end::Timeline content-->
                      </div>
                      <!--end::Timeline item-->
                  </div>
                  <!--end::Timeline-->
                 </div>
              <!--end::Item-->

              <!--begin::Separator-->
              <div class="separator separator-dashed mt-5 mb-4"></div>
              <!--end::Separator-->
              @empty
               {!! emptyData() !!}
              @endforelse
              <!--begin::Item-->
              </div>
              <!--end::Tap pane-->

      </div>
      <!--end::Tab Content-->
  </div>
  <!--end: Card Body-->
</div>
<!--end::List widget 16-->     </div>
  <!--end::Col-->

  <!--begin::Col-->
  <div class="col-xl-8 mb-5 mb-xl-10">

<!--begin::Chart widget 32-->
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
<!--end::Chart widget 32-->    </div>
  <!--end::Col-->
</div>
<!--end::Row-->



    <div class="row">

        <div class="col-xl-12 mb-xl-10">
            <!--begin::Slider Widget 1-->
            <div id="kt_sliders_widget_1_slider"
                class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100" data-bs-ride="carousel"
                data-bs-interval="5000">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <h4 class="card-title d-flex align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">@lang('Login Session')</span>
                        <span class="text-gray-400 mt-1 fw-bold fs-7">@lang('Your current and last login activity')</span>
                    </h4>
                    <!--end::Title-->

                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Carousel Indicators-->
                        <ol
                            class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-primary">
                            <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="0" class="active ms-1"></li>
                            <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="1" class=" ms-1"></li>
                        </ol>
                        <!--end::Carousel Indicators-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body py-6">
                    <!--begin::Carousel-->
                    <div class="carousel-inner mt-n5">
                        <!--begin::Item-->
                        <div class="carousel-item active show">
                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-5">
                                <!--begin::Symbol-->
                                  <div class="symbol symbol-70px symbol-circle me-5">
                                    <span class="symbol-label bg-light-info">
                                        <i class="ti ti-clock fs-3x text-info"><span class="path1"></span><span class="path2"></span></i>
                                    </span>
                                </div>
                                <!--end::Symbol-->

                                <!--begin::Info-->
                                <div class="m-0">
                                    <!--begin::Subtitle-->
                                    <h5 class="fw-bold text-gray-800 mb-3">@lang('Current Session')</h5>
                                    <!--end::Subtitle-->

                                    <!--begin::Items-->
                                    <div class="d-flex d-grid gap-5">
                                        <!--begin::Item-->
                                        <div class="d-flex flex-column flex-shrink-0 me-4">
                                            <!--begin::Section-->
                                            <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                <i class="ti ti-map fs-6 text-gray-600 me-2"><span
                                                        class="path1"></span><span class="path2"></span></i> {{ __(@$current_login->user_ip) }}
                                            </span>
                                            <!--end::Section-->

                                            <!--begin::Section-->
                                            <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                <i class="ti ti-clock fs-6 text-gray-600 me-2"><span
                                                        class="path1"></span><span class="path2"></span></i> {{ @diffForHumans($current_login->created_at) }}
                                            </span>
                                            <!--end::Section-->
                                        </div>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <div class="d-flex flex-column flex-shrink-0">
                                            <!--begin::Section-->
                                            <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                <i class="ti ti-browser fs-6 text-gray-600 me-2"><span
                                                        class="path1"></span><span class="path2"></span></i> {{ __(@$current_login->browser) }}
                                            </span>
                                            <!--end::Section-->

                                            <!--begin::Section-->
                                            <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                <i class="ti ti-device-mobile fs-6 text-gray-600 me-2"><span
                                                        class="path1"></span><span class="path2"></span></i> {{ __(@$current_login->os) }}
                                            </span>
                                            <!--end::Section-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Items-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Action-->
                            <div class="m-0">
                                <a href="{{route('user.logout')}}" class="btn btn-sm btn-light me-2 mb-2">@lang('Logout')</a>
                                <a href="#" class="btn btn-sm btn-primary mb-2">@lang('View Session')</a>
                            </div>
                            <!--end::Action-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="carousel-item ">
                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-5">
                               <!--begin::Symbol-->
                               <div class="symbol symbol-70px symbol-circle me-5">
                                <span class="symbol-label bg-light-info">
                                    <i class="ti ti-calendar fs-3x text-info"><span class="path1"></span><span class="path2"></span></i>
                                </span>
                            </div>
                            <!--end::Symbol-->

                                <!--begin::Info-->
                                <div class="m-0">
                                    <!--begin::Subtitle-->
                                    <h5 class="fw-bold text-gray-800 mb-3">@lang('Last Login')</h5>
                                    <!--end::Subtitle-->

                                    <!--begin::Items-->
                                    <div class="d-flex d-grid gap-5">
                                      <!--begin::Item-->
                                      <div class="d-flex flex-column flex-shrink-0 me-4">
                                          <!--begin::Section-->
                                          <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                              <i class="ti ti-map fs-6 text-gray-600 me-2"><span
                                                      class="path1"></span><span class="path2"></span></i> {{ __(@$last_login->user_ip) }}
                                          </span>
                                          <!--end::Section-->

                                          <!--begin::Section-->
                                          <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                              <i class="ti ti-clock fs-6 text-gray-600 me-2"><span
                                                      class="path1"></span><span class="path2"></span></i> {{ @diffForHumans($last_login->created_at) }}
                                          </span>
                                          <!--end::Section-->
                                      </div>
                                      <!--end::Item-->

                                      <!--begin::Item-->
                                      <div class="d-flex flex-column flex-shrink-0">
                                          <!--begin::Section-->
                                          <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                              <i class="ti ti-browser fs-6 text-gray-600 me-2"><span
                                                      class="path1"></span><span class="path2"></span></i> {{ __(@$last_login->browser) }}
                                          </span>
                                          <!--end::Section-->

                                          <!--begin::Section-->
                                          <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                              <i class="ti ti-device-mobile fs-6 text-gray-600 me-2"><span
                                                      class="path1"></span><span class="path2"></span></i> {{ __(@$last_login->os) }}
                                          </span>
                                          <!--end::Section-->
                                      </div>
                                      <!--end::Item-->
                                  </div>
                                  <!--end::Items-->
                              </div>
                              <!--end::Info-->
                          </div>
                          <!--end::Wrapper-->

                          <!--begin::Action-->
                          <div class="m-0">
                              <a href="{{route('user.logout')}}" class="btn btn-sm btn-light me-2 mb-2">@lang('Logout')</a>
                              <a href="#" class="btn btn-sm btn-primary mb-2">@lang('View Session')</a>
                          </div>
                          <!--end::Action-->
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Carousel-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Slider Widget 1-->


        </div>
        <!--end::Col-->



    </div>
@endsection

@push('script')
    <script>
        // =====================================
        // Revenue Updates
        // =====================================
        var options = {
            color: "#adb5bd",
            series: @json($user_login_counter->flatten()),
            labels: @json($user_login_counter->keys()),
            chart: {
                type: "donut",
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '88%',
                        background: 'transparent',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                offsetY: 7,
                            },
                            value: {
                                show: false,
                            },
                            total: {
                                show: true,
                                color: '#7C8FAC',
                                fontSize: '20px',
                                fontWeight: "600",
                                label: 'Logins',
                            },
                        },
                    },
                },
            },
            stroke: {
                show: false,
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: true,
            },

            legend: {
                show: false,
            },
            colors: ["var(--bs-primary)", "#EAEFF4", "var(--bs-secondary)"],

            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };

        var chart = new ApexCharts(document.querySelector("#sales-overview"), options);
        chart.render();



        function myFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/
            document.execCommand("copy");
            iziToast.success({
                message: 'Link Copied',
                position: "topRight"
            });

        }
    </script>
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
