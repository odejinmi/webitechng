@extends(checkTemplate() . 'layouts.app')
@section('panel')
    <!-- content @s
        -->
        <!--begin::Container-->
        <div id="kt_content_container" class=" container-xxl ">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Stepper-->
                    <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">


                        <!--begin::Form-->
                        <form class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" action="" method="post">
                            @csrf

                            <!--begin::Step 2-->
                            <div data-kt-stepper-element="scontent">

                                <!--begin::Wrapper-->
                                <div class="w-100">
                                    <!--begin::Heading-->
                                    <div class="pb-10 pb-lg-15">
                                        <!--begin::Title-->
                                        <h2 class="fw-bold text-dark">@lang('Bank Transfer')</h2>
                                        <!--end::Title-->

                                        <!--begin::Notice-->
                                        <div class="text-muted fw-semibold fs-6">
                                            @lang('If you need more info, please check out')
                                            <a href="#" class="link-primary fw-bold">Help Page</a>.
                                        </div>
                                        <!--end::Notice-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-2">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Option-->
                                                <input type="radio" class="btn-check" name="wallet" value="act_wallet"
                                                    onchange="selectwallet('main')" id="act_wallet" />
                                                <label
                                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10"
                                                    for="act_wallet">
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
                                                <input type="radio" class="btn-check" name="wallet"  value="ref_wallet"
                                                    onchange="selectwallet('ref')"
                                                    id="ref_wallet" />
                                                <label
                                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center"
                                                    for="ref_wallet">
                                                    <i class="ti ti-cash fs-3x me-5"><span class="path1"></span><span
                                                            class="path2"></span></i>
                                                    <!--begin::Info-->
                                                    <span class="d-block fw-semibold text-start">
                                                        <span class="text-dark fw-bold d-block fs-4 mb-2">
                                                            @lang('Referral Wallet')</span>
                                                        <span
                                                            class="text-muted fw-semibold fs-6">{{ $general->cur_sym }}{{ showAmount(Auth::user()->ref_balance) }}</span>
                                                    </span>
                                                    <!--end::Info-->
                                                </label>
                                                <!--end::Option-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center form-label mb-3">
                                            @lang('Fixed Amount')
                                            <span class="ms-1" data-bs-toggle="tooltip" title="Select a fixed amount">
                                                <i class="ti ti-alert-circle text-gray-500 fs-6"><span
                                                        class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span></i></span> </label>
                                        <!--end::Label-->

                                        <!--begin::Row-->
                                        <div class="row mb-2" data-kt-buttons="true">
                                            <!--begin::Col-->
                                            <div class="col">
                                                <!--begin::Option-->
                                                <label for="first"
                                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                                                    <input id="first" type="radio" onchange="fixeamount(200)" class="btn-check"
                                                        value="200" />

                                                    <span class="fw-bold fs-3">200</span>
                                                </label>
                                                <!--end::Option-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col">
                                                <!--begin::Option-->
                                                <label for="second"
                                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4 active">
                                                    <input id="second" type="radio" onchange="fixeamount(500)" class="btn-check"
                                                        value="500" />
                                                    <span class="fw-bold fs-3">500</span>
                                                </label>
                                                <!--end::Option-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col">
                                                <!--begin::Option-->
                                                <label for="third"
                                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                                                    <input id="third" type="radio" onchange="fixeamount(1000)" class="btn-check"
                                                        value="1000" />
                                                    <span class="fw-bold fs-3">1000</span>
                                                </label>
                                                <!--end::Option-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col">
                                                <!--begin::Option-->
                                                <label for="fourth"
                                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                                                    <input id="fourth" type="radio" onchange="fixeamount(2000)" class="btn-check"
                                                        value="2000" />
                                                    <span class="fw-bold fs-3">2000</span>
                                                </label>
                                                <!--end::Option-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->

                                        <!--begin::Hint-->
                                        <div class="form-text">
                                            @lang('Select a fixed amount above or enter a custom amount below')
                                        </div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Input group-->
                                    @push('script')
                                        <script>
                                            function fixeamount(e) {
                                                document.getElementById("amount").value = e;
                                            }
                                        </script>
                                    @endpush
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3">@lang('Enter Amount')</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" id="amount"
                                            class="form-control form-control-lg form-control-solid  amount @error('amount') is-invalid @enderror"
                                            value="{{ old('amount') }}" name="amount" placeholder="0.00" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3">@lang('Recipient\'s Bank')</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="form-control form-control-lg form-control-solid name="bank"
                                            data-control="select2" id="banklist" data-hide-search="false"
                                            onchange="validatebank()" />
                                        <option selected disabled>Select Bank</option>
                                        @foreach ($banks['responseBody'] as $data)
                                            <option data-code="{{ $data['code'] }}"
                                               data-name="{{ $data['name'] }}"
                                                value="{{ $data['code'] }}|{{ $data['name'] }}">{{ $data['name'] }}
                                            </option>
                                        @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3">@lang('Account Number')</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" onkeyup="validatebank()"
                                            class="form-control form-control-lg form-control-solid  username @error('account') is-invalid @enderror"
                                            id="account" name="account" value="{{ old('account') }}"
                                            placeholder="Please enter NUBAN account number" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <div id="beneficiary"></div>


                                      <!--begin::Input group-->
                                      <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3">@lang('Narration')</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text"
                                            class="form-control form-control-lg form-control-solid  username @error('account') is-invalid @enderror"
                                            id="narration" value="{{ old('narration') }}"
                                            placeholder="Please enter transfer narration" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->


                                    <!--begin::Section-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="form-label mb-3"
                                            data-kt-translate="two-step-label">@lang('Type your 6 digit transaction code')</label>
                                        <!--end::Label-->

                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap flex-stack">
                                            <input type="text" id="pin1" name="code_1"
                                                data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1"
                                                class="form-control form-control-solid h-40px w-40px fs-2qx text-center border-primary border-hover mx-1 my-2"
                                                value="" />
                                            <input type="text" id="pin2" name="code_2"
                                                data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1"
                                                class="form-control form-control-solid h-40px w-40px fs-2qx text-center border-primary border-hover mx-1 my-2"
                                                value="" />
                                            <input type="text" id="pin3" name="code_3"
                                                data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1"
                                                class="form-control form-control-solid h-40px w-40px fs-2qx text-center border-primary border-hover mx-1 my-2"
                                                value="" />
                                            <input type="text" id="pin4" name="code_4"
                                                data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1"
                                                class="form-control form-control-solid h-40px w-40px fs-2qx text-center border-primary border-hover mx-1 my-2"
                                                value="" />
                                            <input type="text" id="pin5" name="code_5"
                                                data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1"
                                                class="form-control form-control-solid h-40px w-40px fs-2qx text-center border-primary border-hover mx-1 my-2"
                                                value="" />
                                            <input type="text" id="pin6" name="code_6"
                                                data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1"
                                                class="form-control form-control-solid h-40px w-40px fs-2qx text-center border-primary border-hover mx-1 my-2"
                                                value="" />
                                        </div>
                                        <!--begin::Input group-->
                                    </div>
                                    <!--end::Section-->

                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Step 2-->



                            <!--begin::Actions-->
                            <div class="d-flex flex-stack pt-15">

                                <!--begin::Wrapper-->
                                <div>
                                    <input id="wallet" hidden>
                                    <input id="account_name" hidden>
                                    <input id="bank_name" hidden>
                                    <button type="button" disabled onclick="sendmoney()" class="btn btn-lg btn-primary"
                                        id="submit">@lang('Proceed')

                                        <i class="ti ti-arrow-right fs-4 ms-1 me-0"><span class="path1"></span><span
                                                class="path2"></span></i> </button>
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Stepper-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
        @push('script')
            <script>
                function selectwallet(wallet) {
                   document.getElementById("wallet").value = wallet;
                }
            </script>
            <script>
                function validatebank() {
                    var bankcode = $("#banklist option:selected").attr('data-code');
                    var bankname = $("#banklist option:selected").attr('data-name');
                    var account = document.getElementById("account").value;
                    if (account.length < 10 || bankcode == '') {
                        return;
                    }
                    // START VALIDATE \\
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
                    var raw = JSON.stringify({
                        _token: "{{ csrf_token() }}",
                        bankcode: bankcode,
                        account: account,
                    });
                    var requestOptions = {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: raw
                    };
                    fetch("{{ route('user.bank.validate.monnify') }}", requestOptions)
                        .then(response => response.text())
                        .then(result => {
                            const reply = JSON.parse(result);
                            if (reply.ok != true)
                            {
                                document.getElementById("submit").disabled = true;
                            }
                            if (reply.ok != false) {
                                document.getElementById("submit").disabled = false;
                                document.getElementById("account_name").value = reply.message;
                                document.getElementById("bank_name").value = bankname;
                            }
                            $("#beneficiary").html(
                                `<div class="alert alert-${reply.status} d-flex align-items-center p-5">
                                <i class="ti ti-alert-circle fs-2hx text-${reply.status} me-4"><span class="path1"></span><span class="path2"></span></i>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-dark"></h4>
                                    <span>${reply.message}</span>
                                </div>
                                </div>`
                            );
                            KTApp.hidePageLoading();
                            loadingEl.remove();
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            </script>

            <script>
            function sendmoney() {
            var bankcode = $("#banklist option:selected").attr('data-code');
            var account = document.getElementById("account").value;
            var amount = document.getElementById("amount").value;
            var wallet = document.getElementById("wallet").value;
            var narration = document.getElementById("narration").value;
            var account_name = document.getElementById("account_name").value;
            var bank_name = document.getElementById("bank_name").value;
            var pin1 = document.getElementById("pin1").value;
            var pin2 = document.getElementById("pin2").value;
            var pin3 = document.getElementById("pin3").value;
            var pin4 = document.getElementById("pin4").value;
            var pin5 = document.getElementById("pin5").value;
            var pin6 = document.getElementById("pin6").value;
            var pin = pin1+pin2+pin3+pin4+pin5+pin6;
            if (account.length < 10 || bankcode == '' || amount < 1 || wallet == '') {
                return;
            }
            // START VALIDATE \\
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
            var raw = JSON.stringify({
                _token: "{{ csrf_token() }}",
                account_name: account_name,
                bank_name: bank_name,
                bankcode: bankcode,
                account: account,
                amount: amount,
                wallet: wallet,
                narration: narration,
                pin: pin,
            });
            var requestOptions = {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: raw
            };
            fetch("{{ route('user.bank.transfer.monnify') }}", requestOptions)
                .then(response => response.text())
                .then(result => {
                    const reply = JSON.parse(result);
                        document.getElementById("submit").disabled = false;
                    $("#beneficiary").html(
                        `<div class="alert alert-${reply.status} d-flex align-items-center p-5">
                        <i class="ti ti-alert-circle fs-2hx text-${reply.status} me-4"><span class="path1"></span><span class="path2"></span></i>
                        <div class="d-flex flex-column">
                            <h4 class="mb-1 text-dark"></h4>
                            <span>${reply.message}</span>
                        </div>
                        </div>`
                    );
                    KTApp.hidePageLoading();
                    loadingEl.remove();
                })
                .catch(error => {
                    console.log(error);
                });
            }
            </script>
        @endpush
    @endsection

    @push('breadcrumb-plugins')
        <a class="btn btn-sm btn-primary" href="{{ route('user.bank.transfer.history') }}"> <i class="ti ti-printer"></i> @lang('Bank Transfer Log')</a>
    @endpush
