@extends(checkTemplate() . 'layouts.app')
@section('panel')
    <div class="row g-3 g-xl-6">
        <div class="col-xl-4 col-sm-4">
            <div class="card">
                <div class="card-body pb-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="avatar-group"><img src="{{ url('/') }}/assets/images/country/ngn.png"
                                class="avatar border border-2 border-body rounded-circle" alt="...">
                            <img src="{{ url('/') }}/assets/images/country/usa.svg"
                                class="avatar border border-2 border-body rounded-circle" alt="...">
                        </div>
                        <div class="text-end">
                            <span class="badge text-bg-body-secondary fw-semibold"></span>
                        </div>
                    </div>
                    <div class="mt-6"><a href="#depositLiquidityModal" class="d-block stretched-link h6 mb-2"
                            data-bs-toggle="modal">NGN/USD</a>
                        <div class="d-flex justify-content-between gap-4">
                            <div class=""><span class="d-block text-sm text-muted">Total Sent</span>
                                <span class="d-block text-sm text-heading fw-bold">{{number_format($ngnusds,2)}}NGN</span>
                            </div>
                            <div class=""><span class="d-block text-sm text-muted">Total Received</span>
                                <span class="d-block text-sm text-heading fw-bold">{{number_format($ngnusdr,2)}}USD</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-4">
            <div class="card">
                <div class="card-body pb-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="avatar-group"><img src="{{ url('/') }}/assets/images/country/ngn.png"
                                class="avatar border border-2 border-body rounded-circle" alt="...">
                            <img src="{{ url('/') }}/assets/images/country/uk.webp"
                                class="avatar border border-2 border-body rounded-circle" alt="...">
                        </div>
                        <div class="text-end">
                            <span class="badge text-bg-body-secondary fw-semibold"></span>
                        </div>
                    </div>
                    <div class="mt-6"><a href="#depositLiquidityModal" class="d-block stretched-link h6 mb-2"
                            data-bs-toggle="modal">NGN/GBP</a>
                        <div class="d-flex justify-content-between gap-4">
                            <div class=""><span class="d-block text-sm text-muted">Total Sent</span>
                                <span class="d-block text-sm text-heading fw-bold">{{number_format($ngngbps,2)}}NGN</span>
                            </div>
                            <div class=""><span class="d-block text-sm text-muted">Total Received</span>
                                <span class="d-block text-sm text-heading fw-bold">{{number_format($ngngbpr,2)}}GBP</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-4 col-sm-4">
            <div class="card">
                <div class="card-body pb-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="avatar-group"><img src="{{ url('/') }}/assets/images/country/usa.svg"
                                class="avatar border border-2 border-body rounded-circle" alt="...">
                            <img src="{{ url('/') }}/assets/images/country/uk.webp"
                                class="avatar border border-2 border-body rounded-circle" alt="...">
                        </div>
                        <div class="text-end">
                            <span class="badge text-bg-body-secondary fw-semibold"></span>
                        </div>
                    </div>
                    <div class="mt-6"><a href="#depositLiquidityModal" class="d-block stretched-link h6 mb-2"
                            data-bs-toggle="modal">USD/GBP</a>
                        <div class="d-flex justify-content-between gap-4">
                            <div class="d-flex justify-content-between gap-4">
                            <div class=""><span class="d-block text-sm text-muted">Total Sent</span>
                                <span class="d-block text-sm text-heading fw-bold">{{number_format($usdgbps,2)}}USD</span>
                            </div>
                            <div class=""><span class="d-block text-sm text-muted">Total Received</span>
                                <span class="d-block text-sm text-heading fw-bold">{{number_format($usdgbpr,2)}}GBP</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="mt-6">
        <div class="row align-items-center g-6 mt-0 mb-6">
            <div class="col-sm-6">
                <div class="d-flex flex-wrap gap-2">
                    <div class="input-group input-group-sm input-group-inline w-100 w-md-50">
                        <span class="input-group-text"><i class="bi bi-search me-2"></i> </span><input type="search"
                            class="form-control ps-0" placeholder="Search all assets" aria-label="Search">
                    </div>
                </div>
            </div>
        </div>
        <div class="vstack gap-3">
            @forelse($log as $data)
            <div class="card border-primary-hover shadow-soft-3-hover">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-xl-row gap-10 justify-content-xl-between align-items-xl-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-group">
                                @if($data->from == 'NGN')
                                <img class="avatar avatar-lg border border-2 border-body rounded-circle" width="30" src="{{url('/')}}/assets/images/country/ngn.png" alt="">
                                @elseif($data->from == 'USD')
                                <img class="avatar avatar-lg border border-2 border-body rounded-circle" width="30" src="{{url('/')}}/assets/images/country/usa.svg" alt="">
                                @elseif($data->from == 'GBP')
                                <img class="avatar avatar-lg border border-2 border-body rounded-circle" width="30" src="{{url('/')}}/assets/images/country/gbp.webp" alt="">
                                @endif
                                @if($data->to == 'NGN')
                                <img class="avatar avatar-lg border border-2 border-body rounded-circle" width="30" src="{{url('/')}}/assets/images/country/ngn.png" alt="">
                                @elseif($data->to == 'USD')
                                <img class="avatar avatar-lg border border-2 border-body rounded-circle" width="30" src="{{url('/')}}/assets/images/country/usa.svg" alt="">
                                @elseif($data->to == 'GBP')
                                <img class="avatar avatar-lg border border-2 border-body rounded-circle" width="30" src="{{url('/')}}/assets/images/country/gbp.webp" alt="">
                                @endif

                            </div>
                            <div class="">
                                <h6>{{ __(@strToUpper($data->from)) }}/{{ __(@strToUpper($data->to)) }}</h6>
                                <span class="d-inline-block text-muted text-xs">1 {{ ($data->from) }} =
                                      {{ __($data->rate) }} {{$data->to}}</span>
                            </div>
                        </div>
                        <div class="row g-10 gx-xl-16 align-items-center justify-content-between">
                            <div class="col-6 col-sm-auto col-xl-auto">
                                <span class="d-block text-xs text-muted">From</span>
                                <span class="d-block text-heading text-sm fw-bold">{{$data->from}}{{ showAmount($data->amount) }}</span>
                            </div>
                            <div class="col-6 col-sm-auto col-xl-auto">
                                <span class="d-block text-xs text-muted">Received</span>
                                <span class="d-block text-heading text-sm fw-bold">{{$data->to}}{{ ($data->paid) }}</span>
                            </div>
                            <div class="col-6 col-sm-auto col-xl-auto">
                                <span class="d-block text-xs text-muted">TRX</span>
                                <span class="d-block text-heading text-sm fw-bold">{{$data->trx}}</span>
                            </div>
                            <div class="col-6 col-sm-auto col-xl-auto">
                                <span class="d-block text-xs text-muted">Date</span>
                                <span class="d-block text-heading text-sm fw-bold">{{ showDate($data->created_at) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             @empty
              {!! emptyData2() !!}
              @endforelse
              @if ($log->hasPages())
            <div class="d-flex align-items-center justify-content-between mt-4">
                <nav aria-label="Page navigation example">
                    {{ $log->links() }}
                </nav>
            </div>
            @endif
        </div>
    </div>


    <div class="modal fade" id="depositLiquidityModal" tabindex="-1" aria-labelledby="depositLiquidityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content overflow-hidden">
                <div class="modal-header pb-0 border-0">
                    <h1 class="modal-title h4" id="depositLiquidityModalLabel">Swap Currency</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body undefined">
                         <form  class="vstack gap-6" method="post" id="otpform" action="">
                         @csrf
                        <div class="vstack gap-1">
                            <div class="bg-body-secondary rounded-3 p-4">
                                <div class="d-flex justify-content-between text-xs text-muted">
                                    <span class="fw-semibold">From</span> <span id="balance">Balance: {{number_format(Auth::user()->balance,2)}}NGN</span>
                                </div>
                                <div class="d-flex justify-content-between gap-2 mt-4"><input type="tel"
                                        class="form-control form-control-flush text-xl fw-bold flex-fill" name="amount" onkeyup="shownext()" id="amount"
                                        placeholder="0.00">

                                         <button class="btn btn-sm btn-neutral rounded-pill shadow-none flex-none d-flex align-items-center gap-2 p-2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <a id="fromimage"><img src="{{url('/')}}/assets/images/country/ngn.png" class="w-rem-6 h-rem-6 rounded-circle" alt="..."></a>  <i class="bi bi-chevron-down text-xs me-1"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-sm">
                                                        <li onclick="from(`NGN`,`{{number_format(Auth::user()->balance,2)}}`,`ngn.png`)" ><a class="dropdown-item d-flex align-items-center gap-2"
                                                                href="#"><img src="{{url('/')}}/assets/images/country/ngn.png" class="w-rem-6 h-rem-6 rounded-circle" alt="...">
                                                                <span>NGN</span></a></li>
                                                        <li onclick="from(`USD`,`{{number_format(Auth::user()->usd_balance,2)}}`,`usa.svg`)"><a class="dropdown-item d-flex align-items-center gap-2"
                                                                href="#"><img src="{{url('/')}}/assets/images/country/usa.svg" class="w-rem-6 h-rem-6 rounded-circle" alt="...">
                                                                <span>USD</span></a>
                                                        </li>
                                                        <li onclick="from(`GBP`,`{{number_format(Auth::user()->gbp_balance,2)}}`,`gbp.png`)"><a class="dropdown-item d-flex align-items-center gap-2"
                                                                href="#"><img src="{{url('/')}}/assets/images/country/gbp.png" class="w-rem-6 h-rem-6 rounded-circle" alt="...">
                                                                <span>GBP</span></a></li>
                                                    </ul>

                                </div>
                                <input name="from" id="from" value="ngn"  hidden>
                                <input name="to" id="to" value="ngn" hidden>
                            </div>
                            @push('script')
                                <script>
                                    function from(from,balance,logo) {
                                    document.getElementById('fromimage').innerHTML =`<img src="{{url('/')}}/assets/images/country/${logo}" class="w-rem-6 h-rem-6 rounded-circle" alt=".."/>`;
                                    document.getElementById('balance').innerHTML = `Balance: ${balance} ${from}`,
                                    document.getElementById('from').value = from;
                                    this.getrate();
                                    }
                                </script>
                                @endpush
                            <div class="position-relative text-center my-n4 overlap-10">
                                <div
                                    class="icon icon-sm icon-shape bg-body shadow-soft-3 rounded-circle text-sm text-body-tertiary">
                                    <i class="bi bi-arrow-down-up"></i>
                                </div>
                            </div>
                            <div class="bg-body-secondary rounded-3 p-4">
                                <div class="d-flex justify-content-between text-xs text-muted">
                                    <span class="fw-semibold">To</span> <span id="tobalance">Balance: {{number_format(Auth::user()->balance,2)}}NGN</span>
                                </div>
                                <div class="d-flex justify-content-between gap-2 mt-4"><input type="tel" id="toamount"
                                        class="form-control form-control-flush text-xl fw-bold flex-fill"
                                        placeholder="0.00">
                                    <button class="btn btn-sm btn-neutral rounded-pill shadow-none flex-none d-flex align-items-center gap-2 p-2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <a id="toimage"><img src="{{url('/')}}/assets/images/country/ngn.png" class="w-rem-6 h-rem-6 rounded-circle" alt="..."></a>  <i class="bi bi-chevron-down text-xs me-1"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-sm">
                                                        <li onclick="to(`NGN`,`{{number_format(Auth::user()->balance,2)}}`,`ngn.png`)" ><a class="dropdown-item d-flex align-items-center gap-2"
                                                                href="#"><img src="{{url('/')}}/assets/images/country/ngn.png" class="w-rem-6 h-rem-6 rounded-circle" alt="...">
                                                                <span>NGN</span></a></li>
                                                        <li onclick="to(`USD`,`{{number_format(Auth::user()->usd_balance,2)}}`,`usa.svg`)"><a class="dropdown-item d-flex align-items-center gap-2"
                                                                href="#"><img src="{{url('/')}}/assets/images/country/usa.svg" class="w-rem-6 h-rem-6 rounded-circle" alt="...">
                                                                <span>USD</span></a>
                                                        </li>
                                                        <li onclick="to(`GBP`,`{{number_format(Auth::user()->gbp_balance,2)}}`,`gbp.png`)"><a class="dropdown-item d-flex align-items-center gap-2"
                                                                href="#"><img src="{{url('/')}}/assets/images/country/gbp.png" class="w-rem-6 h-rem-6 rounded-circle" alt="...">
                                                                <span>GBP</span></a></li>
                                                    </ul>
                                </div>
                                @push('script')
                                <script>
                                    function to(from,balance,logo) {
                                    document.getElementById('toimage').innerHTML =`<img src="{{url('/')}}/assets/images/country/${logo}" class="w-rem-6 h-rem-6 rounded-circle" alt=".."/>`;
                                    document.getElementById('tobalance').innerHTML = `Balance: ${balance} ${from}`,
                                    document.getElementById('to').value = from;
                                    this.getrate();
                                    }
                                </script>

                                <script>
                                    function getrate() {
                                        var amount = document.getElementById('amount').value;
                                        if(amount.length < 1)
                                        {
                                            Toastify({
                                            text: `Please enter amount`,
                                            className: "info",
                                            style: {
                                                background: "linear-gradient(to right, #D22B2B, #000000)",
                                            }
                                            }).showToast();
                                        }
                                        var raw = JSON.stringify({
                                            _token: "{{ csrf_token() }}",
                                            amount: document.getElementById('amount').value,
                                            from: document.getElementById('from').value,
                                            to: document.getElementById('to').value,
                                        });
                                        var requestOptions = {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            body: raw
                                        };
                                        $("#toamount").html(``);
                                        fetch("{{ route('user.currencygetrate') }}", requestOptions).then(response => response.text()).then(
                                            result => {
                                                resp = JSON.parse(result);
                                                document.getElementById('toamount').value = `${resp.message}`;
                                            }).catch(error => {});
                                    }
                                </script>
                                @endpush
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Exchange</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('breadcrumb')
        <button type="button" class="btn btn-sm btn-neutral d-nones d-sm-inline-flex" data-bs-target="#depositLiquidityModal"
            data-bs-toggle="modal"><span class="pe-2">
            </span><span>Exchange</span></button>
    @endpush
@endsection
@push('script')
@endpush
