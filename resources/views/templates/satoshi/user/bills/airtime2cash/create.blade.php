@extends($activeTemplate . 'layouts.app')
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
                <div class="alert alert-info">
                    PLEASE TAKE NOTE:

                We do not accept stolen airtime. If you attempt to convert stolen airtime to cash, we will hand over Your details to the appropriate authorities.
                eGold.ng does not deduct airtime from you automatically.
                You are to transfer the airtime to the phone number displayed in our phone number field in the form below. Only.
                You must not send a different amount different from the amount you filled in the form below.
                You must successfully transfer the airtime to us before clicking the ‘Convert Airtime to Cash’ button or within 20 minutes after clicking the ‘Convert Airtime to Cash’ button or the transaction will be canceled automatically.
                Your account will be blocked permanently if you submit this form without sending the airtime.
                We accept only airtime transfers only (MTN Share ’N’ Sell). You must NOT send Airtime to us as VTU, instead, send it as a transfer (MTN Share ‘N’ Sell).
                If you want to send us an airtime PIN, kindly load it on any MTN SIM and then transfer the airtime to us.
                HOW TO TRANSFER AIRTIME WITH MTN SHARE N SELL
                MTN Share ’N’ Sell – Default PIN: 0000
                If you don’t have a PIN, to use 1234 as your PIN Dial: *321*0000*1234*1234# or Send an SMS with your Default PIN New PIN New PIN to 321. For example, send an SMS with ‘0000 1234 1234’ to 321.

                To Transfer Dial: <b>*321*UR_PHONE_NUMBER*Amount*PIN#</b><br>
                <b>MTN</b> placed has a limit of <b>5,000</b> per airtime transfer. So if you want to convert more than 5,000 airtime at once, you should enter the amount below, and then send the airtime in batches until it is completed.
                Example: If you want to convert <b>19,000</b> airtime to cash, you should enter <b>19000</b> below inside the ‘amount’ field; then transfer 5,000 airtime three times to us and also transfer another 4,000 airtime to us to make it 19,000.
                KINDLY NOTE THAT

                It takes approximately 10 minutes for the transferred airtime amount to be verified and credited to your Wallet.
                You can now withdraw your wallet balance to your bank account any time you want.
                Network* MTN, AIRTEL
                Phone Number* Enter the phone number you are sending from
                Amount* Enter the Total Amount you want to convert to cash
                You are to receive (mtn is 81%, airtel is 71%) = Echo the amount the person will receive 
                Our phone number is (Mtn is 08131956308, and airtel is 09022577104) Kindly send the airtime to <echo the number for the selected network>
                WARNING!
                We have zero tolerance for FRAUD. Do not ever think about sending stolen airtime to us. You will be handed over to the appropriate authorities immediately. You are seriously Warned
                </div>
                <br><br>
                <!--begin::Form-->
                    <form  class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" action="" method="post">
                    @csrf

                    <!--begin::Step 2-->
                    <div data-kt-stepper-element="scontent">
                        
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-10 pb-lg-15">
                                <!--begin::Title-->
                                <h2 class="fw-bold text-dark">@lang('Airtime To Cash')</h2>
                                <!--end::Title-->

                                <!--begin::Notice-->
                                <div class="text-muted fw-semibold fs-6">
                                    @lang('Please note that you will be charged a transaction fee of in ')
                                    <a href="#" class="link-danger fw-bold">%</a> for this airtime to cash transaction.
                                </div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Heading-->  
                           
                            @push('script')
                            
                            <script> 
                            
                                document.getElementById("code").disabled = true;
                                document.getElementById("pin").disabled = true;
                                function fixeamount(e)
                                {
                                if(e.name == 'amount')
                                {
                                    document.getElementById("amount").value = e.value;
                                }
                                
                                if(document.getElementById("network").value != 'empty' && e.name == 'network')
                                {
                                    document.getElementById("amount").value = null;
                                    getNetwork();
                                    return;
                                }
                                submitform();
                                // START AIRTIME FEE \\
                                function getNetwork() { 
                                    //loadingEl.innerHTML = ` <span class="spinner-border text-primary" role="status"></span> <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>`;
                                    // Show page loading
                                     var network_input = document.getElementById('network').value; 
                                    var raw = JSON.stringify({
                                        _token: "{{ csrf_token() }}",
                                        network: network_input,
                                        fee: true,
                                    });

                                    var requestOptions = {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        body: raw
                                    };
                                    fetch("{{ route('user.airtime.tocash.fee') }}", requestOptions)
                                        .then(response => response.text())
                                        .then(result => {
                                            resp = JSON.parse(result);
                                            var plans = resp.range;
                                            var html = '';
                                                if (resp.ok != false) {
                                                    plans.map(plan => {
                                                        let htmlSegment =
                                                        `
                                                        <li class="list-group-item d-flex align-items-center">
                                                        <i class="ti ti-gift fs-4 me-2 text-primary"></i>
                                                        {{$general->cur_sym}} ${plan['min']} - {{$general->cur_sym}}${plan['max']}
                                                        <span class="badge bg-light-danger text-danger font-medium rounded-pill ms-auto"
                                                            >${plan['fee']}%</span>
                                                        </li> `;  
                                                        html += htmlSegment; 
                                                    }); 
                                                    
                                                    document.getElementById("amount").disabled = false;
                                                    document.getElementById('networkfee').innerHTML =
                                                    `
                                                    <div class="col-lg-12">
                                                      <div class="card">
                                                        <div class="card-body">
                                                        <div class="mb-3">
                                                            <h5 class="mb-0">Airtime Conversion Rate</h5>
                                                        </div>
                                                        <ul class="list-group"> 
                                                        ${html}
                                                        </ul>
                                                        </div>
                                                       </div>
                                                    </div> 
                                                    `;
                                                }
                                                else
                                                {
                                                    
                                                    document.getElementById("amount").disabled = true;
                                                    document.getElementById('networkfee').innerHTML = "";
                                                    Toastify({
                                                        text: `${resp.message}`,
                                                        className: "info",
                                                        style: {
                                                            background: "linear-gradient(to right, #D22B2B, #000000)",
                                                        }
                                                    }).showToast();
                                                }
                                        })
                                        .catch(error => {
                                             
                                        });
                                        
                                        document.getElementById("commision").innerHTML = '';
                                        document.getElementById("worth").innerHTML = '';
                                        return;

                                }

                                function submitform() {
                                    //loadingEl.innerHTML = ` <span class="spinner-border text-primary" role="status"></span> <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>`;
                                    // Show page loading
                                    var amount_input = document.getElementById('amount').value; 
                                    var network_input = document.getElementById('network').value; 
                                    var raw = JSON.stringify({
                                        _token: "{{ csrf_token() }}",
                                        network: network_input,
                                        amount: amount_input, 
                                        fee: false,
                                    });

                                    var requestOptions = {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        body: raw
                                    };
                                    fetch("{{ route('user.airtime.tocash.fee') }}", requestOptions)
                                        .then(response => response.text())
                                        .then(result => {
                                            resp = JSON.parse(result);
                                            //SlimNotifierJs.notification(`${resp.status}`, `${resp.status}`,`${resp.message}`, 3000);
                                            //KTApp.hidePageLoading();
                                            //loadingEl.remove();
                                                if (resp.ok != true) 
                                                {
                                                    document.getElementById("code").disabled = true;
                                                    document.getElementById("pin").disabled = true;
                                                    document.getElementById("commision").innerHTML = '';
                                                    document.getElementById("worth").innerHTML = '';
                                                    
                                                    document.getElementById("submit").disabled = true;
                                                }
                                                if (resp.ok != false) {
                                                    var fee = resp.range.fee;
                                                    var commission = (amount_input / 100) * fee; // Correct Calculation
                                                    var worth = amount_input - commission;
                                                    document.getElementById("commision").innerHTML = `<span class="badge bg-danger text-white" id="commision">Fee: ${commission}</span>`;
                                                    document.getElementById("worth").innerHTML = `<span class="badge bg-success text-white" id="worth">Value: {{$general->cur_text}} ${worth}</span>`;
                                                    document.getElementById("code").disabled = false;
                                                    document.getElementById("pin").disabled = false;
                                                    
                                                    document.getElementById("submit").disabled = false;
                                                }
                                        })
                                        .catch(error => {
                                           // KTApp.hidePageLoading();
                                           // loadingEl.remove();
                                        });

                                }
                                // END AIRTIME FEE \\
                               
                                }
                                
                            </script>
                            @endpush
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Select Network')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select type="text"  onchange="fixeamount(this)" class="form-control form-control-lg form-control-solid  network @error('network') is-invalid @enderror" id="network"
                                    name="network" placeholder="network" >
                                    <option selected disabled value="empty">Select A Network</option>
                                    <option value="airtel">AIRTEL</option>
                                    <option value="mtn">MTN</option>
                                    <option  value="glo">GLOBACOM</option>
                                    <option value="9mobile">9MOBILE</option>
                                </select>
                                <!--end::Input-->

                                <div id="networkfee"></div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Enter Amount')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" id="amount"  onkeyup="fixeamount(this)"  class="form-control form-control-lg form-control-solid  amount @error('amount') is-invalid @enderror" value="{{ old('amount') }}" name="amount" placeholder="0.00" />
                                <span id="commision"></span>
                                <br>
                                <span class="badge bg-success text-white" id="worth"></span>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group--> 

                            
                            <!--begin::Section-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3" data-kt-translate="two-step-label">@lang('Aitime Code')</label>
                                <!--end::Label-->
                                <!--begin::Input group-->
                                <div class="d-flex flex-wrap flex-stack">  
                                    <input type="text" class="form-control form-control-lg form-control-solid  username @error('code') is-invalid @enderror" id="code"
                                    name="code" value="{{ old('code') }}" placeholder="XXXX-XXXX-XXXX-XXXX-XXXX" /> 
                                </div>                
                                <!--begin::Input group-->
                            </div>
                            <!--end::Section-->


                            <!--begin::Section-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3" data-kt-translate="two-step-label">@lang('Type your transaction code')</label>
                                <!--end::Label-->

                                <!--begin::Input group-->
                                <div class="d-flex flex-wrap flex-stack">  
                                    <input type="text" class="form-control form-control-lg form-control-solid  username @error('pin') is-invalid @enderror" id="pin" name="pin" value="{{ old('pin') }}" placeholder="****" /> 
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

                            <button type="submit" class="btn btn-lg btn-primary" disabled type="button" id="submit">@lang('Proceed')
                                
                                <i class="ti ti-arrow-right fs-4 ms-1 me-0"><span class="path1"></span><span class="path2"></span></i> </button>
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
@endsection

@push('breadcrumb')
    <a href="{{route('user.airtime.tocash.history')}}" class="btn btn-info btn-sm text-white">History</a> 
@endpush