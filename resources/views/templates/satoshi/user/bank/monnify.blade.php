@extends(checkTemplate() . 'layouts.app')
@section('panel')
    @push('style')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @endpush
    <div class="vstack gap-3 gap-xl-6 mt-8">
        <div class="row row-cols-sm-2 row-cols-md-6 g-3">
            <div class="col">
                <div class="card border-primary-hover">
                    <div class="card-body d-flex gap-3"><img src="{{ url('/') }}/assets/images/country/ngn.png"
                            class="w-rem-7 h-rem-7 mt-1" alt="...">
                        <div class=""><span class="d-block text-muted mb-1">Total Transfer</span>
                            <span
                                class="d-block text-lg fw-bold text-heading">{{ $general->cur_sym }}{{ number_format($totaltransfer, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex gap-3 mb-1"><span class="text-muted">Transaction Count</span>

                        </div>
                        <div class="d-flex align-items-center">
                            <span class="text-lg text-heading fw-bold">{{ number_format($totaltransfercount) }} </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card">
            <div class="card-body pb-0">
                <div class="row g-3 justify-content-between align-items-center">
                    <div class="col-12 col-sm">
                        <h5>Transaction Log</h5>
                    </div>
                </div>
                <div class="mx-n4">
                    <div id="trxchart" data-height="100"></div>
                </div>
            </div>
        </div>
        <div class="row row-cols-md-2 g-6">
            <div class="col">
                <div class="card border-0 border-xxl">
                    <div class="card-body p-0 p-xxl-6">
                        <div class="d-flex gap-8 justify-content-center mb-5"><a href="#"
                                class="text-lg fw-bold text-heading">Transfer Fund</a></div>
                        <div class="vstack gap-2">


                            <div id="loader"></div>
                            <div class="bg-body-secondary rounded-3 p-4">
                                <div class="d-flex justify-content-between text-xs text-muted">
                                    <span class="fw-semibold">Account Number</span>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <input type="tel" onkeyup="validateacct()" maxlength="10" id="account"
                                        class="form-control form-control-flush text-xl fw-bold w-rem-40"
                                        placeholder="1234567890">
                                </div>
                            </div>


                            <span class="fw-semibold text-sm" id="beneficiary"></span>

                            <div class="bg-body-secondary rounded-3 p-4">
                                <div class="d-flex justify-content-between text-xs text-muted">
                                    <span class="fw-semibold">Bank</span>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <select class="form-control" style="height: 100pxx;" id="select2"
                                        onchange="validatebank()">
                                        @foreach ($banks['responseBody'] as $data)
                                            <option data-code="{{ $data['code'] }}" data-name="{{ $data['name'] }}"
                                                value="{{ $data['code'] }}|{{ $data['name'] }}">
                                                {{ $data['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div>
                                <h6 class="progress-text mb-1 d-block"></h6>
                            </div>

                            <input id="account_name" hidden>
                            <input id="bank_name" hidden>

                            <div class="bg-body-secondary rounded-3 p-4">
                                <div class="d-flex justify-content-between text-xs text-muted">
                                    <span class="fw-semibold">Amount</span>
                                </div>
                                <div class="d-flex justify-content-between mt-4"><input type="tel" id="amount"
                                        placeholder="{{ $general->cur_sym }} 0.00"
                                        class="form-control form-control-flush text-xl fw-bold w-rem-40">
                                    <div class="d-flex align-items-center gap-2"><img
                                            src="{{ url('/') }}/assets/images/country/ngn.png"
                                            class="w-rem-6 h-rem-6 rounded-circle" alt="...">
                                        <span class="fw-semibold text-sm">NGN</span>
                                    </div>
                                </div>
                            </div>


                            <div class="bg-body-secondary rounded-3 p-4">
                                <div class="d-flex justify-content-between text-xs text-muted">
                                    <span class="fw-semibold">Narration</span>
                                </div>
                                <div class="d-flex justify-content-between mt-4"><input id="narration"
                                        placeholder="Reason for transfer"
                                        class="form-control form-control-flush text-xl fw-bold w-rem-40">
                                </div>
                            </div>

                            <div class="bg-body-secondary rounded-3 p-4">
                                <div class="d-flex justify-content-between text-xs text-muted">
                                    <span class="fw-semibold">Transaction PIN</span>
                                </div>
                                <div class="d-flex justify-content-between mt-4"><input id="otp" placeholder="****"
                                        class="form-control form-control-flush text-xl fw-bold w-rem-40">
                                </div>
                            </div>





                            <button type="button" onclick="sendmoney()" disabled id="submit"
                                class="btn btn-lg btn-dark w-100">Send Fund</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 border-xxl h-md-100">
                    <div class="card-body p-0 p-xxl-6">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div>
                                <h5>Order history</h5>
                            </div>
                            <div class="hstack align-items-center "><a href="{{route('user.transactions','Bank Transfer')}}" class="text-primary">View All</a>
                            </div>
                        </div>
                        <div class="vstack gap-6">
                            @forelse($transferlog as $trx)
                                <div data-bs-toggle="modal" data-bs-target="#popup_modal_{{ $trx->id }}">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="icon icon-shape flex-none text-base text-bg-primary rounded-circle">
                                            <i class="bi bi-bank w-rem-6 h-rem-6" alt="..."></i>
                                        </div>
                                        <div>
                                            <h6 class="progress-text mb-1 d-block">{{ $trx->trx }}</h6>
                                            <p class="text-muted text-xs">{{-- {{ showDateTime($trx->created_at) }} --}}
                                                {{ diffForHumans($trx->created_at) }}</p>
                                        </div>
                                        <div class="text-end ms-auto">
                                            <span
                                                class="h6 text-sm">-{{ $general->cur_sym }}{{ showAmount($trx->amount) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="crancy-default__modal modal fade" id="popup_modal_{{ $trx->id }}"
                                    tabindex="-1" aria-labelledby="popup_modal_{{ $trx->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content crancy-preview__modal-content">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="crancy-flex__right">
                                                        <a id="crancy-main-form__close" type="initial"
                                                            class="crancy-preview__modal--close btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none">
                                                                <g clip-path="url(#clip0_989_10425)">
                                                                    <circle cx="12" cy="12" r="12"
                                                                        fill="#EDF2F7" />
                                                                    <path d="M16.9498 7.05029L7.05033 16.9498"
                                                                        stroke="#5D6A83" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M7.05029 7.05029L16.9498 16.9498"
                                                                        stroke="#5D6A83" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_989_10425">
                                                                        <rect width="24" height="24"
                                                                            fill="white" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="crancy-wc__heading crancy-flex__column-center text-center">
                                                        <h3 class="crancy-login-popup__title">Beneficiary Details</h3>
                                                        <p>
                                                            <small>
                                                                {{ @$trx->val_1->bank }}<br>
                                                                {{ @$trx->val_1->account_name }}<br>
                                                                {{ @$trx->val_1->account_number }}<br>
                                                            </small>
                                                        </p>
                                                        <!-- Search Form -->
                                                        <div
                                                            class="crancy-header__form crancy-header__form__currency mg-top-20">

                                                        </div>
                                                        <!-- End Search Form -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @empty
                                {!! emptyData2() !!}
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            chart: {
                type: 'bar'
            },
            series: [{
                name: 'Transactions',
                data: {!! json_encode($yearTf) !!}
            }],
            xaxis: {
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
                ]
            }
        }

        var chart = new ApexCharts(document.querySelector("#trxchart"), options);
        chart.render();
    </script>
@endpush

@push('script')
    <script>
        function validateacct() {
            $("#beneficiary").html(``);
        }

        function validatebank() {
            var bankcode = $("#select2 option:selected").attr('data-code');
            var bankname = $("#select2 option:selected").attr('data-name');
            var account = document.getElementById("account").value;
            if (account.length < 10 || bankcode == '') {
                Toastify({
                    text: `Account number must be 10 digits`,
                    className: "info",
                    style: {
                        background: "linear-gradient(to right, #D22B2B, #000000)",
                    }
                }).showToast();
                return;
            }
            $("#beneficiary").html(``);
            $("#beneficiary").html(`<center><i class="fa fa-spinner fa-spin"></i></center>`);
            //$('.showinput').addClass('d-none');
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
                    if (reply.ok != true) {
                        document.getElementById("submit").disabled = true;
                        $("#beneficiary").html(``);
                        var status = 4;
                        Toastify({
                            text: `${reply.message}`,
                            className: "info",
                            style: {
                                background: "linear-gradient(to right, #D22B2B, #000000)",
                            }
                        }).showToast();
                    }
                    if (reply.ok != false) {
                        document.getElementById("submit").disabled = false;
                        document.getElementById("account_name").value = reply.message;
                        document.getElementById("bank_name").value = bankname;
                        $("#beneficiary").html(`<span class="badge bg-success text-white">${reply.message}</span>`);
                        var status = 8;

                        //$('.showinput').removeClass('d-none');
                    }


                })
                .catch(error => {
                    console.log(error);
                });
        }
    </script>

    <script>
        function sendmoney() {
            var bankcode = $("#select2 option:selected").attr('data-code');
            var account = document.getElementById("account").value;
            var amount = document.getElementById("amount").value;
            var narration = document.getElementById("narration").value;
            var account_name = document.getElementById("account_name").value;
            var bank_name = document.getElementById("bank_name").value;
            var otp = document.getElementById("otp").value;
            if (account.length < 10 || bankcode == '' || amount < 1) {
                Toastify({
                                            text: `Incomplete input`,
                                            className: "info",
                                            style: {
                                                background: "linear-gradient(to right, #D22B2B, #000000)",
                                            }
                                            }).showToast();
                                            return false;
            }
            // START VALIDATE \\
            document.getElementById("submit").disabled = true;
            var raw = JSON.stringify({
                _token: "{{ csrf_token() }}",
                account_name: account_name,
                bank_name: bank_name,
                bankcode: bankcode,
                account: account,
                amount: amount,
                narration: narration,
                pin: otp,
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

                    if (reply.ok != true) {
                        Toastify({
                            text: `${reply.message}`,
                            className: "info",
                            style: {
                                background: "linear-gradient(to right, #D22B2B, #000000)",
                            }
                        }).showToast();
                        // toastr.error(reply.message, 'OOPS');
                    }
                    if (reply.ok != false) {

                        Toastify({
                            text: `${reply.message}`,
                            className: "info",
                            style: {
                                background: "linear-gradient(to right, #00b09b, #96c93d)",
                            }
                        }).showToast();
                        location.reload();
                    }

                })
                .catch(error => {
                    console.log(error);
                });
        }
    </script>
@endpush
