@extends($activeTemplate . 'layouts.app')
@section('panel')
@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
    <div class="vstacks">
        <div class="px-3s px-md-8s pt-8s">

            <div class="row row-cols-xl-2 row-cols-md-2 g-6 mt-6">
                <div class="col">
                    <div class="card bg-warning bg-opacity-10 border-warning border-opacity-40">
                        <div class="p-5">
                            <div class="d-flex gap-3 mb-5"><img src="{{ url('/') }}/assets/images/provider/img-11.png"
                                    class="avatar" alt="...">
                                <div class=""><a class="d-inline-block text-sm text-heading fw-semibold"
                                        href="#">Transaction Value
                                    </a><span class="d-block text-xs text-muted">Sport Betting</span></div>
                            </div>
                            <div class="d-flex align-items-end">
                                <div class="hstack gap-2">
                                    <span
                                        class="badge bg-warning bg-opacity-25 text-warning">{{ $general->cur_sym }}{{ number_format($value, 2) }}</span>
                                    <span class="badge badge-count bg-warning text-xs rounded-circle"><i
                                            class="bi bi-wallet"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card bg-success bg-opacity-10 border-success border-opacity-40">
                        <div class="p-5">
                            <div class="d-flex gap-3 mb-5"><img src="{{ url('/') }}/assets/images/provider/img-11.png"
                                    class="avatar" alt="...">
                                <div class=""><a class="d-inline-block text-sm text-heading fw-semibold"
                                        href="#">Transaction Count
                                    </a><span class="d-block text-xs text-muted">Sport Betting</span></div>
                            </div>
                            <div class="d-flex align-items-end">
                                <div class="hstack gap-2">
                                    <span
                                        class="badge bg-success bg-opacity-25 text-success">{{ number_format($count) }}</span>
                                    <span class="badge badge-count bg-success text-xs rounded-circle"><i
                                            class="bi bi-wallet"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row align-items-center g-6 mt-0 mb-6">
                <form action="#">
                    <div class="col-sm-6">
                        <div class="d-flex gap-2">
                            <div class="input-group input-group-sm input-group-inline w-100 w-md-50">

                                <span class="input-group-text"><i class="bi bi-search me-2"></i> </span>
                                <input type="search" class="form-control ps-0" name="search" placeholder="Search by ID"
                                    aria-label="Search">

                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="border-top">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">Company Token</th>
                            <th class="w-md-32" scope="col">Amount</th>
                            <th class="w-md-32 d-none d-sm-table-cell" scope="col">Ref</th>
                            <th class="w-md-32" scope="col">Beneficiary</th>
                            <th class="w-md-20 d-none d-sm-table-cell">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bettinglog as $data)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class=""><a class="d-inline-block text-sm text-heading fw-semibold"
                                                href="#">{{ __(@strToUpper($data->product_logo)) }}<br>
                                                <small>{{ __(@strToUpper($data->product_name)) }}</small>
                                            </a><span class="d-block text-xs text-muted"></span></div>
                                    </div>
                                </td>
                                <td>{{ __($general->cur_sym) }}{{ showAmount($data->price) }}</td>
                                <td class="d-none d-sm-table-cell">
                                    <span class="text-success fw-semibold">{{ $data->trx }}</span>
                                </td>

                                <td class="d-nons d-sm-table-cell">{{ $data->val_1 }}<br>
                                <small>Meter: {{ __(@$data->val_2) }}</small><br>
                                <small>{{ __(@$data->deposit_code) }}</small>
                                </td>
                                <td class="d-nones d-xl-table-cell">
                                    <div class="w-rem-32">
                                        {{ showDate($data->created_at) }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {!! emptyData2() !!}
                        @endforelse

                    </tbody>
                </table>
            </div>
            @if ($bettinglog->hasPages())
                <div class="py-4 px-6">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-md-6 d-none d-md-block">
                            <span class="text-muted text-sm"></span>
                        </div>
                        <div class="col-md-auto">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-spaced gap-1">

                                    {{ $bettinglog->links() }}

                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="topUpModal" tabindex="-1" aria-labelledby="topUpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content overflow-hidden">
                <div class="modal-header pb-0 border-0">
                    <h1 class="modal-title h4" id="topUpModalLabel">Fund Betting Wallet</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body undefined">
                    <form class="vstack gap-8">

                        <div class="bg-body-secondary rounded-3 p-4">
                            <div class="d-flex justify-content-between text-xs text-muted">
                                <span class="fw-semibold">Wallet ID</span>
                            </div>
                            <div class="d-flex justify-content-between gap-2 mt-4">
                                <input onkeyup="validateaccount()" id="accountid"
                                    class="form-control form-control-flush text-xl fw-bold w-rem-40"
                                    placeholder="khaytech">
                                <input id="company" value="bet9ja" hidden>

                                <button
                                    class="btn btn-sm btn-neutral rounded-pill shadow-none flex-none d-flex align-items-center gap-2 p-2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <a id="networkimage"><img src="https://files.opayweb.com/images/api/icon/betting/Bet9ja3x.png"
                                            class="w-rem-6 h-rem-6 rounded-circle" alt="..."></a> <i
                                        class="bi bi-chevron-down text-xs me-1"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-sm">
                                    @foreach ($networks as $plan)
                                        <li onclick="verifynetwork(`{{ $plan['title'] }}`,`{{ $plan['providerLogoUrl'] }}`)"><a
                                                class="dropdown-item d-flex align-items-center gap-2" href="#">
                                                <img src="{{ $plan['providerLogoUrl'] }}"
                                                    class="w-rem-6 h-rem-6 rounded-circle" alt="...">
                                                <span>{{ strToUpper($plan['title']) }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                    @push('script')
                                        <script>
                                            function verifynetwork(id, logo) {

                                                document.getElementById("accountid").value = null;
                                                document.getElementById("networkimage").innerHTML = ` <img src="${logo}"
                                                    class="w-rem-6 h-rem-6 rounded-circle" alt="...">`;
                                                document.getElementById("company").value = id;
                                                document.getElementById("amount").disabled = false;
                                            }
                                        </script>
                                    @endpush

                                </ul>


                            </div>
                        </div>


                            <p id="customer"></p>


                        <input id="customername" hidden>
                        @push('script')
                <script>
                  function validateaccount() {
                    var accountid = document.getElementById("accountid").value;
                    var company = document.getElementById("company").value;
                    document.getElementById("submit").disabled = true;
                    document.getElementById("customer").innerHTML = null;
                    document.getElementById("customername").value = null;


                        if (accountid.length > 5) {
                        // START GET DATA \\
                        document.getElementById("customer").innerHTML = `<center><i class="fa fa-spinner fa-spin"></i></center>`;
                        var _token = $("input[name='_token']").val();
                        $.ajax({
                            url: "{{ route('user.betting.wallet.verify') }}",
                            type: 'GET',
                            async: true,
                            data: {
                            _token: _token,
                            number: accountid,
                            merchant: company
                            },
                            async: true,
                            cache: false,
                            dataType: "json",
                            success: function (data) {
                            if (data.ok === true) {
                                document.getElementById("customer").innerHTML = `
                                <div class="list-group list-group-flush gap-2">
                                    <div class="list-group-item border rounded d-flex gap-3 p-4 bg-body-secondary-hover">
                                        <div class="d-flex align-items-center flex-fill"><div>
                                            <a href="#" class="stretched-link text-heading text-sm fw-bold">${data.content}</a></div>
                                            <div class="ms-auto"><span class="badge badge-md text-bg-primary"><i class="bi bi-person-check"></i></span></div>
                                        </div>
                                        </div>
                                    </div>
                                </div>`;
                                document.getElementById("customername").value = data.content;
                                document.getElementById("amount").disabled = false;
                                document.getElementById("submit").disabled = false;
                                document.getElementById("password").disabled = false;

                            } else {
                                document.getElementById("amount").disabled = true;
                                document.getElementById("customer").innerHTML = null;
                                document.getElementById("customername").value = null;
                                document.getElementById("submit").disabled = true;
                                 Toastify({
                                    text: `${data.message}`,
                                    className: "info",
                                    style: {
                                        background: "linear-gradient(to right, #D22B2B, #000000)",
                                    }
                                }).showToast();;
                            }
                            }
                        });
                        }
                        // END GET DATA \\
                    }

                    </script>
                    @endpush




                        <div class="bg-body-secondary rounded-3 p-4">
                            <div class="d-flex justify-content-between text-xs text-muted">
                                <span class="fw-semibold">Enter Amount</span> <span>Balance:
                                    {{ number_format(Auth::user()->balance, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between gap-2 mt-4"><input type="tel" disabled id="amount"
                                    class="form-control form-control-flush text-xl fw-bold flex-fill" placeholder="0.00">
                                <button
                                    class="btn btn-neutral shadow-none rounded-pill flex-none d-flex align-items-center gap-2 py-2 ps-2 pe-4"><img
                                        src="{{ url('/') }}/assets/images/country/ngn.png"
                                        class="w-rem-6 h-rem-6 rounded-circle" alt="..."> <span
                                        class="text-xs fw-semibold text-heading ms-1">NGN</span></button>
                            </div>
                        </div>


                        <div class="bg-body-secondary rounded-3 p-4">
                            <div class="d-flex justify-content-between text-xs text-muted">
                                <span class="fw-semibold">PIN</span>
                            </div>
                            <div class="d-flex justify-content-between gap-2 mt-4"><input type="number" disabled id="password"
                                    class="form-control form-control-flush text-xl fw-bold flex-fill" placeholder="****">
                            </div>
                        </div>


                        <div>
                            <div class="vstack gap-2">
                                <div id="purchasemessage"></div>
                                <div class="text-center">
                                    <button type="button" id="submit" onclick="submitform()"
                                        class="btn btn-primary w-100"><a id="submitloader">Buy Token</a></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb')
    <button type="button" class="btn btn-sm btn-neutral d-sm-inline-flex" data-bs-target="#topUpModal"
        data-bs-toggle="modal">Fund Wallet</button>
@endpush
@push('script')
    <script>
        function submitform() {
            var raw = JSON.stringify({
                _token: "{{ csrf_token() }}",
              password: document.getElementById('password').value,
              number: document.getElementById('accountid').value,
              customername: document.getElementById('customername').value,
              amount: document.getElementById('amount').value,
              company: document.getElementById('company').value,
            });
            var requestOptions = {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: raw
            };
            document.getElementById("submit").disabled = true;

            $(document).ready(function() {
                $.blockUI();
            });
            fetch("{{ route('user.fund.betting.wallet') }}", requestOptions).then(response => response.text()).then(
                result => {
                    resp = JSON.parse(result);
                    $(document).ready(function() {
                        $.unblockUI();
                    });
                    document.getElementById("submit").disabled = false;

                    if (resp.status == 'success') {
                        Toastify({
                            text: `${resp.message}`,
                            className: "info",
                            style: {
                                background: "linear-gradient(to right, #00b09b, #96c93d)",
                            }
                        }).showToast();
                        location.reload();
                    }
                    if (resp.status == 'danger') {
                        Toastify({
                            text: `${resp.message}`,
                            className: "info",
                            style: {
                                background: "linear-gradient(to right, #D22B2B, #000000)",
                            }
                        }).showToast();
                    }
                }).catch(error => {});
        }
    </script>
@endpush

