@extends($activeTemplate . 'layouts.app')
@section('panel')
    <div class="row">
        <div class="col-12">

            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header pt-8">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>@lang('Buy Airtime')</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Form-->
                    <form class="form" id="kt_file_manager_settings">
                        <div class="fv-row row mb-15">
                            <!--begin::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-12">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold">@lang('Select Wallet')</label>
                                <!--end::Label-->
                            </div>
                            <!--end::Col-->
                            <div class="col-lg-6">
                                <!--begin::Option-->
                                <input type="radio" class="btn-check" name="account_type" onchange="selectwallet('main')"
                                    id="mainwallet" />
                                <label
                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10"
                                    for="mainwallet">
                                    <i class="ti ti-wallet fs-3x me-5"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span><span
                                            class="path4"></span><span class="path5"></span></i>
                                    <!--begin::Info-->
                                    <span class="d-block fw-semibold text-start">
                                        <span class="text-dark fw-bold d-block fs-4 mb-2">
                                            @lang('Main Wallet')
                                        </span>
                                        <span
                                            class="text-muted fw-semibold fs-6">{{ $general->cur_sym }}{{ showAmount(Auth::user()->balance) }}</span>
                                    </span>
                                    <!--end::Info-->
                                </label>
                                <!--end::Option-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6">
                                <!--begin::Option-->
                                <input type="radio" class="btn-check" name="account_type" onchange="selectwallet('ref')"
                                    id="refwallet" />
                                <label
                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center"
                                    for="refwallet">
                                    <i class="ti ti-wallet fs-3x me-5"><span class="path1"></span><span
                                            class="path2"></span></i>
                                    <!--begin::Info-->
                                    <span class="d-block fw-semibold text-start">
                                        <span class="text-dark fw-bold d-block fs-4 mb-2">@lang('Referral Wallet')</span>
                                        <span
                                            class="text-muted fw-semibold fs-6">{{ $general->cur_sym }}{{ showAmount(Auth::user()->ref_balance) }}</span>
                                    </span>
                                    <!--end::Info-->
                                </label>
                                <!--end::Option-->
                            </div>
                            <!--end::Col-->
                            @push('script')
                                <script>
                                    function selectwallet(wallet) {
                                        localStorage.setItem('wallet', wallet);
                                    }
                                </script>
                            @endpush
                        </div>
                        <!--begin::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row row mb-15">
                            <!--begin::Col-->
                            <div class="col-md-3 d-flex align-items-center">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold">@lang('Select Country')</label>
                                <!--end::Label-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-md-9">
                                <!--begin::Input-->
                                <select name="country" class="form-select form-select-solid" data-control="select2"
                                    id="youSendCurrency" data-hide-search="false" onchange="populate()"
                                    data-placeholder="@lang('Select Country')">
                                    <option value="">@lang('Select a Country')...</option>
                                    @foreach ($countries as $data)
                                        <option data-countryname="{{ $data['name'] }}"
                                            data-callingCode="{{ $data['callingCodes'][0] }}"
                                            data-countrycurrency="{{ $data['currencyCode'] }}"
                                            data-isoName="{{ $data['isoName'] }}"
                                            data-countrycontinent="{{ $data['continent'] }}" value="{{ $data['isoName'] }}"
                                            data-icon="currency-flag currency-flag-{{ strtoLower($data['currencyCode']) }} me-1">
                                            {{ $data['name'] }}</option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        @push('script')
                            <script>
                                function populate() {

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

                                    // Show page loading
                                    KTApp.showPageLoading();
                                    document.getElementById('providers').innerHTML = '';
                                    var isocode = $("#youSendCurrency option:selected").attr('data-isoName');
                                    var countryname = $("#youSendCurrency option:selected").attr('data-countryname');
                                    var countrycurrency = $("#youSendCurrency option:selected").attr('data-countrycurrency');
                                    var countrycontinent = $("#youSendCurrency option:selected").attr('data-countrycontinent');
                                    var callingCode = $("#youSendCurrency option:selected").attr('data-callingCode');
                                    // document.getElementById("countrycurrency").innerHTML = countrycurrency;
                                    // document.getElementsByClassName("currency").innerHTML = countrycurrency;
                                    // document.getElementsByClassName("callingCode").innerHTML = callingCode;
                                    //document.getElementById("countryname").innerHTML = countryname;
                                    //document.getElementById("countrycontinent").value = countrycontinent;

                                    var _token = $("input[name='_token']").val();
                                    $.ajax({
                                        url: "{{ route('user.airtime.operators') }}",
                                        type: 'GET',
                                        async: true,
                                        data: {
                                            _token: _token,
                                            isocode: isocode,
                                            includeBundles: false,
                                            includeData: false
                                        },
                                        cache: false,
                                        dataType: "json",
                                        success: function(data) {
                                            if (data.status == 'true') {
                                                var plans = data.content.response;
                                                let html = '';
                                                let filteredUsers = [];
                                                for (let i = 0; i < plans.length; i++) {
                                                    if (plans[i].data = false) {
                                                        filteredUsers = [...filteredUsers, plans[i]];
                                                    }
                                                }
                                                console.info(filteredUsers.length);
                                                plans.map(plan => {
                                                    let provider = plan['name'];
                                                    let operatorId = plan['operatorId'];
                                                    let min = plan['minAmount'];
                                                    let max = plan['maxAmount'];
                                                    let fixedAmounts = plan['fixedAmounts'];
                                                    let countryCode = plan['country']['isoName'];
                                                    let rate = plan['fx']['rate'];
                                                    let currency = plan['fx']['currencyCode'];
                                                    let htmlSegment =
                                                        `<label class="d-flex flex-stack cursor-pointer mb-5" for="${plan['operatorId']}" >
                                                                        <span class="d-flex align-items-center me-2">
                                                                            <span class="symbol symbol-50px me-6">
                                                                                <span class="symbol-label bg-light-primary">
                                                                                    <i class="ti ti-image fs-2x text-warning"><img src="${plan['logoUrls'][0]}" width="30" class="path1"/></i>
                                                                                </span>
                                                                            </span> 
                                                                            <span class="d-flex flex-column">
                                                                                <span class="fw-bold fs-6">${plan['name']}</span>
                                                                                <span class="fs-7 text-muted">${plan['country']['name']}</span>
                                                                            </span>
                                                                        </span>
                            
                                                                        <span class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="operator" id="${plan['operatorId']}" value="${plan['operatorId']}" />
                                                                        </span>
                                                                    </label>
                                                                    `;
                                                    html += htmlSegment;
                                                });



                                                document.getElementById('providers').innerHTML =
                                                    ` <div class="mb-0">
                                                                       ${html}
                                                                       </div>
                                                                    `;

                                                //  $("#loadered").html('');
                                            } else {
                                                // $("#loadered").html('');
                                            }

                                            KTApp.hidePageLoading();
                                            loadingEl.remove();
                                        }
                                    });
                                    // END GET DATA \\
                                }
                            </script>
                        @endpush

                        <!--begin::Input group-->
                        <div class="fv-row row mb-15">
                            <!--begin::Col-->
                            <div class="col-md-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold mt-2">@lang('Select Network Provider')</label>
                                <div class="text-muted fs-7"></div>
                                <!--end::Label-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-md-9">
                                <div id="providers"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row row mb-15">
                            <!--begin::Col-->
                            <div class="col-md-3 d-flex align-items-center">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold">@lang('Beneficiary Phone')</label>
                                <!--end::Label-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-md-9">
                                <input name="phone" id="phone" class="form-control form-control-lg form-control-solid"
                                    value="" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row row mb-15">
                            <!--begin::Col-->
                            <div class="col-md-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold mt-2">@lang('Amount')</label>
                                <div class="text-muted fs-7"></div>
                                <!--end::Label-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-md-9">
                                <input name="amount" id="amount" type="number"
                                    class="form-control form-control-lg form-control-solid" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row row mb-15">
                            <!--begin::Col-->
                            <div class="col-md-3">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold ">@lang('Transaction PIN')</label>
                                <!--end::Label-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-md-9">
                                <input type="password" onkeyup="verifypassword(this)" id="password"
                                    class="form-control form-control-lg form-control-solid" name="password" placeholder=""
                                    value="" autocomplete="off" />

                            </div>
                            <!--end::Col-->
                            @push('script')
                                <script>
                                    function verifypassword(e) {
                                        $("#passmessage").html(`<button class="btn btn-primary" type="button" disabled>
                                                    <span
                                                      class="spinner-border spinner-border-sm"
                                                      role="status"
                                                      aria-hidden="true"></span>
                                                    <span class="visually-hidden">Loading...</span>
                                                    </button>`);

                                        var raw = JSON.stringify({
                                            _token: "{{ csrf_token() }}",
                                            password: e.value,
                                        });

                                        var requestOptions = {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            body: raw
                                        };
                                        fetch("{{ route('user.trxpass') }}", requestOptions)
                                            .then(response => response.text())
                                            .then(result => {
                                                resp = JSON.parse(result);
                                                if (resp.ok != true) {
                                                    document.getElementById("submit").disabled = true;
                                                }
                                                if (resp.ok != false) {
                                                    document.getElementById("submit").disabled = false;
                                                }
                                                $("#passmessage").html(
                                                    `<div class="alert alert-${resp.status}" role="alert"><strong>${resp.status} - </strong> ${resp.message}</div>`
                                                    );
                                            })
                                            .catch(error => {

                                            });
                                        // END GET DATA \\
                                    }
                                </script>
                            @endpush
                        </div>
                        <!--end::Input group-->

                        <!--begin::Action buttons-->
                        <div class="row mt-12">
                            <div id="passmessage"></div>
                            <div class="col-md-9 offset-md-3">
                                <!--begin::Button-->
                                <button type="button" onclick="submitform()" class="btn btn-primary" id="submit">
                                    <span class="indicator-label">
                                        Proceed
                                    </span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                        <!--begin::Action buttons-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->

        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
@endpush
@push('script')
    <script>
        // START BUY AIRTIME \\
        function submitform() {
            $("#passmessage").html(` <span
                                                      class="spinner-border spinner-border-sm"
                                                      role="status"
                                                      aria-hidden="true"></span>
                                                    <span class="visually-hidden">Loading...</span>
                                                    </button>`);

            var raw = JSON.stringify({
                _token: "{{ csrf_token() }}",
                password: document.getElementById('password').value,
                amount: document.getElementById('amount').value,
                phone: document.getElementById('phone').value,
                operator: localStorage.getItem('operatorId'),
                wallet: localStorage.getItem('wallet'),
            });

            var requestOptions = {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: raw
            };
            fetch("{{ route('user.buy.airtime') }}", requestOptions)
                .then(response => response.text())
                .then(result => {
                    resp = JSON.parse(result);
                    $("#passmessage").html(
                        `<div class="alert alert-${resp.status}" role="alert"><strong>${resp.status} - </strong> ${resp.message}</div>`
                        );
                })
                .catch(error => {

                });
        }
        // END BUY AIRTIME \\
    </script>
@endpush
