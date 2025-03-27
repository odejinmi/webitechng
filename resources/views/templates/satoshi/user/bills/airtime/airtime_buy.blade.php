@extends($activeTemplate . 'layouts.app')
@section('panel')
    <div class="vstacks">
        <div class="px-3s px-md-8s pt-8s">

             
            <div class="row row-cols-xl-4 row-cols-md-2 g-6 mt-6">
                <div class="col">
                    <div class="card bg-warning bg-opacity-10 border-warning border-opacity-40">
                        <div class="p-5">
                            <div class="d-flex gap-3 mb-5"><img src="{{ url('/') }}/assets/images/provider/mtn.png" class="avatar"
                                    alt="...">
                                <div class=""><a class="d-inline-block text-sm text-heading fw-semibold"
                                        href="#">MTN Network
                                    </a><span class="d-block text-xs text-muted">Airtime</span></div>
                            </div>
                            <div class="d-flex align-items-end">
                                <div class="hstack gap-2">
                                    <span class="badge bg-warning bg-opacity-25 text-warning">{{$general->cur_sym}}{{number_format($mtn,2)}}</span>
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
                            <div class="d-flex gap-3 mb-5"><img src="{{ url('/') }}/assets/images/provider/glo.jpeg" class="avatar"
                                    alt="...">
                                <div class=""><a class="d-inline-block text-sm text-heading fw-semibold"
                                        href="#">GLO Network
                                    </a><span class="d-block text-xs text-muted">Airtime</span></div>
                            </div>
                            <div class="d-flex align-items-end">
                                <div class="hstack gap-2">
                                    <span class="badge bg-success bg-opacity-25 text-success">{{$general->cur_sym}}{{number_format($glo,2)}}</span>
                                    <span class="badge badge-count bg-success text-xs rounded-circle"><i
                                            class="bi bi-wallet"></i></span>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-danger bg-opacity-10 border-danger border-opacity-40">
                        <div class="p-5">
                            <div class="d-flex gap-3 mb-5"><img src="{{ url('/') }}/assets/images/provider/airtel.jpeg" class="avatar"
                                    alt="...">
                                <div class=""><a class="d-inline-block text-sm text-heading fw-semibold"
                                        href="#">Airtel Network
                                    </a><span class="d-block text-xs text-muted">Airtime</span></div>
                            </div>
                            <div class="d-flex align-items-end">
                                <div class="hstack gap-2">
                                    <span class="badge bg-danger bg-opacity-25 text-danger">{{$general->cur_sym}}{{number_format($airtel,2)}}</span>
                                    <span class="badge badge-count bg-danger text-xs rounded-circle"><i
                                            class="bi bi-wallet"></i></span>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-dark bg-opacity-10 border-dark border-opacity-40">
                        <div class="p-5">
                            <div class="d-flex gap-3 mb-5"><img src="{{ url('/') }}/assets/images/provider/9mobile.jpeg" class="avatar"
                                    alt="...">
                                <div class=""><a class="d-inline-block text-sm text-heading fw-semibold"
                                        href="#">9Mobile Network
                                    </a><span class="d-block text-xs text-muted">Airtime</span></div>
                            </div>
                            <div class="d-flex align-items-end">
                                <div class="hstack gap-2">
                                    <span class="badge bg-dark bg-opacity-25 text-dark">{{$general->cur_sym}}{{number_format($etisalat,2)}}</span>
                                    <span class="badge badge-count bg-dark text-xs rounded-circle"><i
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
                            <input type="search" class="form-control ps-0" name="search" placeholder="Search by ID" aria-label="Search">
                            
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
                            <th scope="col">Network</th>
                            <th class="w-md-32" scope="col">Amount</th>
                            <th class="w-md-32 d-none d-sm-table-cell" scope="col">Ref</th>
                            <th class="w-md-32" scope="col">Beneficiary</th> 
                            <th class="w-md-20 d-none d-sm-table-cell"></th>
                        </tr>
                    </thead>
                    <tbody>
                      @forelse($airtimelog as $data)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ url('/') }}/assets/images/provider/{{$data->product_name}}.jpeg"
                                        class="avatar avatar-sm rounded-circle" alt="...">
                                    <div class=""><a class="d-inline-block text-sm text-heading fw-semibold"
                                            href="#">{{ __(@strToUpper($data->product_name)) }}
                                        </a><span class="d-block text-xs text-muted"></span></div>
                                </div>
                            </td>
                            <td>{{ __($general->cur_sym) }}{{ showAmount($data->price) }}</td>
                            <td class="d-none d-sm-table-cell">
                                <span class="text-success fw-semibold">{{ $data->trx }}</span>
                            </td>
                            
                            <td class="d-non d-sm-table-cell">{{$data->val_1}}</td>
                            <td class="d-none d-xl-table-cell">
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
            @if ($airtimelog->hasPages())
            <div class="py-4 px-6">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-6 d-none d-md-block">
                        <span class="text-muted text-sm"></span>
                    </div>
                    <div class="col-md-auto">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-spaced gap-1">
                               
                                {{ $airtimelog->links() }}
                              
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            @endif 
        </div>
    </div>

    <div class="modal fade" id="topUpModal" tabindex="-1" aria-labelledby="topUpModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content overflow-hidden">
                                <div class="modal-header pb-0 border-0">
                                    <h1 class="modal-title h4" id="topUpModalLabel">Buy Airtime</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body undefined">
                                    <form class="vstack gap-8">
                                       
                                         
 

                                        <div class="bg-body-secondary rounded-3 p-4">
                                            <div class="d-flex justify-content-between text-xs text-muted">
                                                <span class="fw-semibold">Phone Number</span> </div>
                                            <div class="d-flex justify-content-between gap-2 mt-4">
                                              <input type="tel" id="phone" class="form-control form-control-flush text-xl fw-bold w-rem-40" placeholder="080********">
                                                <input id="networkid" value="mtn" hidden>
                                                
                                                <button class="btn btn-sm btn-neutral rounded-pill shadow-none flex-none d-flex align-items-center gap-2 p-2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <a id="networkimage"><img src="{{ url('/') }}/assets/images/provider/mtn.png" class="w-rem-6 h-rem-6 rounded-circle" alt="..."></a>  <i class="bi bi-chevron-down text-xs me-1"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-sm">
                                                      @foreach (json_decode($networks) as $plan)
                                                        <li onclick="verifynetwork(`{{ $plan->logo }}`,`{{ $plan->networkid }}`)"><a class="dropdown-item d-flex align-items-center gap-2" href="#"><img src="{{ url('/') }}/assets/images/provider/{{ $plan->logo }}" class="w-rem-6 h-rem-6 rounded-circle" alt="...">
                                                                <span>{{ $plan->name }}</span>
                                                            </a>
                                                        </li>
                                                      @endforeach
                                                         @push('script')
                                                          <script>
                                                            function verifynetwork(logo,networkid) 
                                                            {
                                                              document.getElementById("networkimage").innerHTML = `<img src="{{ url('/') }}/assets/images/provider/${logo}" class="w-rem-6 h-rem-6 rounded-circle"/>`;
                                                              document.getElementById("networkid").value = networkid;
                                                              document.getElementById("amount").disabled = false;
                                                            }
                                                          </script>
                                                          @endpush
                                                         
                                                    </ul>
                                            </div>
                                        </div>
 
                                        <div class="bg-body-secondary rounded-3 p-4">
                                            <div class="d-flex justify-content-between text-xs text-muted">
                                                <span class="fw-semibold">Enter Amount</span> <span>Balance: {{number_format(Auth::user()->balance,2)}}</span></div>
                                            <div class="d-flex justify-content-between gap-2 mt-4"><input type="tel" id="amount" class="form-control form-control-flush text-xl fw-bold flex-fill" placeholder="0.00">
                                                <button class="btn btn-neutral shadow-none rounded-pill flex-none d-flex align-items-center gap-2 py-2 ps-2 pe-4"><img src="{{ url('/') }}/assets/images/country/ngn.png" class="w-rem-6 h-rem-6 rounded-circle" alt="..."> <span class="text-xs fw-semibold text-heading ms-1">NGN</span></button>
                                            </div>
                                        </div>


                                        <div class="bg-body-secondary rounded-3 p-4">
                                            <div class="d-flex justify-content-between text-xs text-muted">
                                                <span class="fw-semibold">PIN</span></div>
                                            <div class="d-flex justify-content-between gap-2 mt-4"><input type="tel" id="password" class="form-control form-control-flush text-xl fw-bold flex-fill" placeholder="****">
                                            </div>
                                        </div>


                                        <div>
                                            <div class="vstack gap-2">
                                                 <div id="purchasemessage"></div>
                                                <div class="text-center">
                                                    <button type="button" id="submit" onclick="submitform()" class="btn btn-primary w-100"><a id="submitloader">Buy</a></button>
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
    <button type="button" class="btn btn-sm btn-neutral d-sm-inline-flex" data-bs-target="#topUpModal" data-bs-toggle="modal">Recharge</button> 
@endpush
@push('script')
    <script>
        function submitform() {
            var raw = JSON.stringify({
                _token: "{{ csrf_token() }}",
                password: document.getElementById('password').value,
                amount: document.getElementById('amount').value,
                phone: document.getElementById('phone').value,
                operator: document.getElementById('networkid').value,
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
                //$.blockUI();
            });
            fetch("{{ route('user.buy.airtime.local.post') }}", requestOptions).then(response => response.text()).then(
                result => {
                    resp = JSON.parse(result);
                    $(document).ready(function() {
                       // $.unblockUI();
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
                    if (resp.status == 'danger') 
                    {
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
