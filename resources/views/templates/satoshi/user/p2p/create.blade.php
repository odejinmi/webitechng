@extends($activeTemplate . 'layouts.app')
@section('panel')
    @push('style')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @endpush
    <div class="vstack gap-3 gap-xl-6 mt-8">
        <div class="row row-cols-md-2 g-6">
            <div class="col">
                <form class="crancy-wallet-form" method="post" id="otpform" action="">
                    @csrf
                    <div class="card border-0 border-xxl">
                        <div class="card-body p-0 p-xxl-6">
                            <div class="d-flex gap-8 justify-content-center mb-5"><a href="#"
                                    class="text-lg fw-bold text-heading">Transfer Fund</a></div>
                            <div class="vstack gap-2">


                                <div id="loader"></div>
                                <div class="bg-body-secondary rounded-3 p-4">
                                    <div class="d-flex justify-content-between text-xs text-muted">
                                        <span class="fw-semibold">Beneficiary</span>
                                    </div>
                                    <div class="d-flex justify-content-between mt-4">
                                        <input name="recipient" id="account" onkeyup="verifybeneficiary()"
                                            value="{{ old('recipient') }}"
                                            class="form-control form-control-flush text-xl fw-bold w-rem-40"
                                            placeholder="1234567890">
                                        <div id="beneficiaryimage"></div>
                                    </div>
                                </div>


                                <span class="fw-semibold text-sm" id="beneficiary"></span>



                                <div class="bg-body-secondary rounded-3 p-4">
                                    <div class="d-flex justify-content-between text-xs text-muted">
                                        <span class="fw-semibold">Amount</span>
                                    </div>
                                    <div class="d-flex justify-content-between mt-4"><input type="tel" id="amount"
                                            name="amount" placeholder="{{ $general->cur_sym }} 0.00"
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
                                        <span class="fw-semibold">Transaction PIN</span>
                                    </div>
                                    <div class="d-flex justify-content-between mt-4"><input id="pin" name="pin"
                                            placeholder="****"
                                            class="form-control form-control-flush text-xl fw-bold w-rem-40">
                                    </div>
                                </div>





                                <button type="submit" disabled id="submit" class="btn btn-lg btn-dark w-100">Send
                                    Fund</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col">
                <div class="card border-0 border-xxl h-md-100">
                    <div class="card-body p-0 p-xxl-6">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div>
                                <h5>Order history</h5>
                            </div>
                            <div class="hstack align-items-center"><a href="#" class="text-muted"><i
                                        class="bi bi-arrow-repeat"></i></a>
                            </div>
                        </div>
                        <div class="vstack gap-6">
                            @forelse($p2plog as $trx)
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
                                                                {{ @$trx->beneficiary->fullname }}<br>
                                                                {{ @$trx->beneficiary->username }}<br>
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
@endsection
@push('script')
    <script>
        function verifybeneficiary() {
            var account = document.getElementById("account").value;
            $("#beneficiary").html(``);
            document.getElementById("submit").disabled = true;
            $("#beneficiaryimage").html(`<center><i class="fa fa-spinner fa-spin"></i></center>`);
            $('.showinput').addClass('d-none');
            var raw = JSON.stringify({
                _token: "{{ csrf_token() }}",
                account: account,
            });
            var requestOptions = {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: raw
            };
            fetch("{{ route('user.validate.username') }}", requestOptions)
                .then(response => response.text())
                .then(result => {
                    const reply = JSON.parse(result);
                    if (reply.ok != true) {
                        document.getElementById("submit").disabled = true;
                        var status = 'danger';
                        $("#beneficiaryimage").html(``);
                    }
                    if (reply.ok != false) {
                        document.getElementById("submit").disabled = false;
                        var status = 'success';

                        document.getElementById("amount").disabled = false;
                        $("#beneficiaryimage").html(`<img src="${reply.image}" width="30" />`);
                    }
                    $("#beneficiary").html(`<span class="badge bg-${status} text-white">${reply.message}</span>`);

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
                toastr.error('Incomplete Input', 'OOPS');
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
