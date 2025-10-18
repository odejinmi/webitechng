@extends($activeTemplate . 'layouts.app')
@section('panel')

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
    <div class="vstacks">
        <div class="px-3s px-md-8s pt-8s">

            <div class="row row-cols-xl-4 row-cols-md-2 g-6 mt-6">

                @foreach ($networks as $network)
                    <div class="col">
                        <div class="{{$network["class"]}}">
                            <div class="p-5">
                                <div class="d-flex gap-3 mb-5"><img src="{{ url('/') }}/assets/images/provider/{{$network["logo"]}}" class="avatar"
                                                                    alt="...">
                                    <div class=""><a class="d-inline-block text-sm text-heading fw-semibold"
                                                     href="#">{{$network["name"]}}
                                        </a><span class="d-block text-xs text-muted">{{$network["description"]}}</span></div>
                                </div>
                                <div class="d-flex align-items-end">
                                    <div class="hstack gap-2">
                                        <span class="badge bg-primary bg-opacity-25 text-primary">{{$general->cur_sym}}{{number_format($dstv,2)}}</span>
                                        <span class="badge badge-count bg-primary text-xs rounded-circle"><i
                                                class="bi bi-wallet"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

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
                            <th class="w-md-32" scope="col">Customer</th>
                            <th class="w-md-20 d-none d-sm-table-cell">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                      @forelse($educationlog as $data)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3"><img src="{{ url('/') }}/assets/images/provider/img-03.png"
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

                            <td class="d-non d-sm-table-cell">{{$data->val_1}}<br>
                            <small>{{$data->val_2}}</small>
                            </td>
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
            @if ($educationlog->hasPages())
            <div class="py-4 px-6">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-6 d-none d-md-block">
                        <span class="text-muted text-sm"></span>
                    </div>
                    <div class="col-md-auto">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-spaced gap-1">

                                {{ $educationlog->links() }}

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
                                    <h1 class="modal-title h4" id="topUpModalLabel">Buy Cable TV Subsctiption Plan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body undefined">
                                    <form class="vstack gap-8">




                                        <div class="bg-body-secondary rounded-3 p-4">
                                            <div class="d-flex justify-content-between text-xs text-muted">
                                                <span class="fw-semibold">Phone Number</span> </div>

                                            <div class="d-flex justify-content-between gap-2 mt-4">
                                              <input type="tel" id="decodernumber" class="form-control form-control-flush text-xl fw-bold w-rem-40" placeholder="123********">
                                                <button class="btn btn-sm btn-neutral rounded-pill shadow-none flex-none d-flex align-items-center gap-2 p-2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <a id="networkimage"><img src="{{ url('/') }}/assets/images/provider/img-03.png" class="w-rem-6 h-rem-6 rounded-circle" alt="..."></a>  <i class="bi bi-chevron-down text-xs me-1"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-sm">
                                                      @foreach (($networks) as $plan)
                                                        <li onclick="verifynetwork(`{{ $plan['logo'] }}`,`{{ $plan['serviceID'] }}`)"><a class="dropdown-item d-flex align-items-center gap-2" href="#"><img src="{{ url('/') }}/assets/images/provider/{{ $plan['logo'] }}" class="w-rem-6 h-rem-6 rounded-circle" alt="...">
                                                                <span>{{ strToUpper($plan['name']) }}</span>
                                                            </a>
                                                        </li>
                                                      @endforeach
                                                         @push('script')
                                                          <script>
                                                            function verifynetwork(logo,decoder)
                                                            {
                                                                document.getElementById("profilecodediv").hidden = !decoder.includes('jamb');
                                                              document.getElementById("decodernumber").value = null;
                                                              document.getElementById("networkimage").innerHTML = `<img src="{{ url('/') }}/assets/images/provider/${logo}" class="w-rem-6 h-rem-6 rounded-circle"/>`;
                                                              document.getElementById("decodertype").value = decoder;
                                                              this.getplans(logo,decoder);
                                                            }
                                                            function getplans(logo,decoder) {
                                                              var raw = JSON.stringify({
                                                                _token: "{{ csrf_token() }}",
                                                                decoder: decoder
                                                              });
                                                                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                                                                const url = `{{ route('user.education.operators') }}?decoder=${encodeURIComponent(decoder)}&_token=${csrfToken}`;
                                                              var requestOptions = {
                                                                method: 'GET',
                                                                headers: {
                                                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                },
                                                              };
                                                              fetch(url, requestOptions).then(response =>
                                                                response.text()).then(result => {
                                                                    console.log("result from validation");
                                                                    console.log(result);
                                                                  let html = '';
                                                                  const data = JSON.parse(result);
                                                                var plans = data.content;
                                                                // var image = data.image;
                                                                  plans.map(plan => {

                                                                      let htmlSegment =
                                                                        `
                                                                        <div class="form-item-checkable">
                                                                          <input class="form-item-check" type="radio" id="${plan['variation_code']}"  onchange="networkprovider('${plan['variation_code']}')" value="${plan['variation_code']}|${plan['variation_amount']}">
                                                                          <label class="form-item cursor-pointer" for="${plan['variation_code']}"><span class="form-item-click d-inline-flex flex-column gap-3 align-items-center justify-content-center form-control w-rem-24 h-rem-24 text-center text-muted">
                                                                            <img style="border-radius: 50%;"
                                                            src="{{ url('/') }}/assets/images/provider/${logo}"
                                                            width="30" /> <span class="fw-semibold text-xs"><b>${plan['name'].substring(0, 13)}</b><br><small class="text-muted"> <b>₦${plan['variation_amount']}</b></small></span></span></label>
                                                                        </div>`;
                                                                      html += htmlSegment;

                                                                  });
                                                                  document.getElementById("planlist").innerHTML =
                                                                    `  <div class="row align-items-center g-3">
                                                              <div class="">
                                                                  <div class="d-flex gap-3 scrollable-x">${html}</div></div></div>`;
                                                                }).catch(error => {
                                                                  console.log(error);
                                                                });
                                                            }
                                                          </script>
                                                          <script>
                                                            function setamount(input) {
                                                              document.getElementById("phone").disabled = false;
                                                              document.getElementById("amount").value = input.value;
                                                              document.getElementById("networkname").value = input.value.split('|')[3];
                                                              document.getElementById("data_plan").value = input.value.split('|')[2];
                                                            }
                                                          </script>
                                                          <script>
                                                                function networkprovider(network) {
                                                                document.getElementById("plan").value = `${network}`;
                                                                document.getElementById("decodernumber").disabled = false;
                                                                }
                                                            </script>
                                                          @endpush

                                                      <input id="amount" hidden>
                                                        <input id="plan" hiddens>
                                                        <input id="decodertype" hidden>

                                                    </ul>
                                            </div>
                                            <div id="profilecodediv" hidden>
                                                 <div class="d-flex justify-content-between text-xs text-muted" >
                                                        <span class="fw-semibold">Profile Code</span> </div>

                                                <div class="d-flex justify-content-between gap-2 mt-4" >
                                                      <input type="tel" id="profilecode" onkeyup="validatedecoder()" class="form-control form-control-flush text-xl fw-bold w-rem-40" placeholder="123********">
                                                    </div>
                                            </div>
                                        </div>
                                        <p id="customer"></p>


                        <input id="customername" hidden>

                                                                       <a id="planlist"></a>


                                            @push('script')
                                            <script>
                                            function validatedecoder() {
                                                var decodernumber = document.getElementById("profilecode").value;
                                                document.getElementById("submit").disabled = true;
                                                document.getElementById("customer").innerHTML = null;
                                                document.getElementById("customername").value = null;

                                                if (decodernumber.length > 9) {
                                                // START GET DATA \\
                                                $("#networkimage").html(`<center><i class="fa fa-spinner fa-spin"></i></center>`);
                                                document.getElementById("customer").innerHTML = `<center><i class="fa fa-spinner fa-spin"></i></center>`;
                                                var decoder = document.getElementById("decodertype").value;
                                                var plan = document.getElementById("plan").value;
                                                var _token = $("input[name='_token']").val();
                                                document.getElementById("customer").innerHTML = '';
                                                $.ajax({
                                                    url: "{{ route('user.education.verifydecoder') }}",
                                                    type: 'GET',
                                                    async: true,
                                                    data: {
                                                    _token: _token,
                                                    number: decodernumber,
                                                    decoder: decoder,
                                                    type: plan
                                                    },
                                                    async: true,
                                                    cache: false,
                                                    dataType: "json",
                                                    success: function (data) {
                                                    if (data.ok === true) {
                                                        document.getElementById("customer").innerHTML = `<br>
                                                                            <span class="badge font-medium bg-primary">Customer Name: ${data.content
                                                        }</span
                                                                            >`;
                                                        document.getElementById("customername").value = data.content;
                                                        document.getElementById("submit").disabled = false;
                                                        $("#networkimage").html(`<i class="fa fa-check text-success"></i>`);

                                                    } else {
                                                        $("#networkimage").html(`<i class="fa fa-info text-danger"></i>`);
                                                        document.getElementById("customer").innerHTML = `<br>
                                                                                <span class="mb-1 badge font-medium bg-light-danger text-danger">Customer Name: ${data.message
                                                        }</span
                                                                                >`;
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
              number: document.getElementById('decodernumber').value,
              customername: document.getElementById('customername').value,
              plan: document.getElementById('plan').value,
              profilecode: document.getElementById('profilecode').value,
              decoder: document.getElementById('decodertype').value,
                wallet: "main"
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
            fetch("{{ route('user.buy.education') }}", requestOptions).then(response => response.text()).then(
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


