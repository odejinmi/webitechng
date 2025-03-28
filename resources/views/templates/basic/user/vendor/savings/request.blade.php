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
                                <h2 class="fw-bold text-dark">@lang('Create Savings Plan')</h2>
                                <!--end::Title-->


                            </div>
                            <!--end::Heading-->


                            <div class="mb-1 col-md-12">
                                <div class="alert alert-warning" role="alert">
                                  <div class="alert-body"><strong>Note!</strong>Please note that your savings plan will be serviced from the fund from your deposit wallet..</div>
                                </div>
                            </div>



                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Savings Type ')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                 <select id="first" name="type" class="form-control">
                                    <option selected disabled>Select An Option</option>
                                    <option value="1">Recurrent Savings</option>
                                    <option value="2">Target Savings</option>
                                    <option value="3">Fixed Savings</option>
                                </select>
                                <label class="form-check-label" for="value">
                                    <small class="text-danger" id="value"></small>
                                </label>
                            </div>
                            <!--end::Input group-->

                                 <div class="mb-10 fv-row red box">

                                <div class="alert alert-primary" role="alert">
                                  <div class="alert-body"><strong>Note!</strong> Choosing this plan implies that any amount entered in the amount field below will be charged from your deposit wallet at interval using the set recurrent cycle. You wont have access to this fund until the recurrent cycle is complete</div>
                                </div>
                              </div>

                              <div class="mb-10 fv-row red box">

                                  <label class="form-label" for="email">Recurrent Cycle</label>
                                  <select name="cycle" class="form-control">
                                  <option selected disabled>Select An Option</option>
                                   <option value="1">Daily</option>
                                <option value="7">Weekly</option>
                                <option value="30">Monthly</option>
                                  </select>
                                </div>



                                <div class="mb-10 fv-row red box">
                                    <label class="form-label" for="Min">Recurrent Times</label>
                                  <input
                                    type="number"
                                    name="recurrent"

                                    class="form-control"
                                    placeholder="Enter the number of recurrent"
                                  />
                                </div>

                                <!--begin::Input group-->
                            <div class="mb-10 fv-row  red box">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center form-label mb-3">
                                    @lang('Select Amount')
                                    <span class="ms-1" data-bs-toggle="tooltip" title="Select a fixed amount">
                                        <i class="ti ti-alert-circle text-gray-500 fs-6">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </span>
                                 </label>
                                <!--end::Label-->

                                <!--begin::Row-->
                                <div class="row mb-2" data-kt-buttons="true">
                                    <!--begin::Col-->
                                    <div class="col">
                                        <!--begin::Option-->
                                        <label for="200" class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                                            <input type="radio" id="200" onchange="fixeamount(this)"  class="btn-check" value="200" />

                                            <span class="fw-bold fs-3">200</span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col">
                                        <!--begin::Option-->
                                        <label  for="500"  class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4 active">
                                            <input  id="500" type="radio"  onchange="fixeamount(this)"  class="btn-check" value="500" />
                                            <span class="fw-bold fs-3">500</span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col">
                                        <!--begin::Option-->
                                        <label for="1000" class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                                            <input  id="1000"  type="radio"  onchange="fixeamount(this)"  class="btn-check" value="1000" />
                                            <span class="fw-bold fs-3">1000</span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col">
                                        <!--begin::Option-->
                                        <label for="2000" class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                                            <input type="radio" id="2000" onchange="fixeamount(this)"  class="btn-check" value="2000" />
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

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row  red box">
                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Enter Recurrent Amount')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" onkeyup="fixeamount(this)" id="amount" class="form-control form-control-lg form-control-solid  amount @error('ramount') is-invalid @enderror" value="{{ old('ramount') }}" name="ramount" placeholder="0.00" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                              </div>

                              <div class="mb-10 fv-row green box">

                               <div class="demo-spacing-0">
                                <div class="alert alert-primary" role="alert">
                                  <div class="alert-body"><strong>Note!</strong> Please note that you will not have access to any fund saved on this plan until it completes the targeted amount or the maturity date elapses..</div>
                                </div>
                              </div>
                              <br>


                                <div class="mb-1 form-password-toggle col-md-12">
                                <br>
                                  <label class="form-label" for="Min">Enter Target Amount </label>
                                  <input
                                    type="number"
                                    name="tamount"

                                    class="form-control"
                                    placeholder="0.00"
                                  />
                                </div>



                                <div class="mb-1 form-password-toggle col-md-12">
                                    <br>
                                      <label class="form-label">Select A Reason </label>
                                      <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="reason" id="reason1" value="Accomodation" checked>
                                        <label class="form-check-label" for="reason1">
                                          Accomodation
                                        </label>
                                      </div>
                                      <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="reason" id="reason2" value="Appliances">
                                        <label class="form-check-label" for="reason2">
                                            Appliances
                                        </label>
                                      </div>
                                      <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="reason" id="reason3" value="Business">
                                        <label class="form-check-label" for="reason3">
                                          Business
                                        </label>
                                      </div>
                                      <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="reason" id="reason4" value="Car">
                                        <label class="form-check-label" for="reason4">
                                          Car
                                        </label>
                                      </div>
                                      <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="reason" id="reason5" value="Education">
                                        <label class="form-check-label" for="reason5">
                                          Education
                                        </label>
                                      </div>
                                      <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="reason" id="reason6" value="Emergency">
                                        <label class="form-check-label" for="reason6">
                                          Emergency
                                        </label>
                                      </div>

                                      <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="reason" id="reason7" value="Travel">
                                        <label class="form-check-label" for="reason7">
                                          Travel
                                        </label>
                                      </div>

                                      <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="reason" id="reason8" value="Wedding">
                                        <label class="form-check-label" for="reason8">
                                          Wedding
                                        </label>
                                      </div>

                                      <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="reason" id="reason9" value="Others">
                                        <label class="form-check-label" for="reason9">
                                          Others
                                        </label>
                                      </div>



                                </div>

                                <div class="mb-1 form-password-toggle col-md-12">
                                <br>
                                  <label class="form-label" for="Min">Enter Maturity Date </label>
                                  <input
                                    type="date"
                                    name="mature"

                                    class="form-control"
                                    placeholder="Enter Date"
                                  />
                                </div>



                        </div>
                        <!--end::Wrapper-->

                        <div class="mb-10 fv-row blue box">

                          <div class="demo-spacing-0">
                           <div class="alert alert-primary" role="alert">
                             <div class="alert-body"><strong>Note!</strong> Please note that your specified amount will be fixed unti the maturity date with a return on investment.</div>
                           </div>
                         </div>
                         <br>


                           <div class="mb-1 form-password-toggle col-md-12">
                           <br>
                             <label class="form-label" for="Min">Enter Target Amount </label>
                             <input
                               type="number"
                               name="famount"

                               class="form-control"
                               placeholder="0.00"
                             />
                           </div>

                        <div class="mb-1 form-password-toggle col-md-12">
                          <br>
                          @foreach($plans as $data)
                            <label class="form-label">Select Saving Plan </label>
                            <div class="form-check mb-3">
                              <input class="form-check-input" type="radio" name="plan" id="reason{{$data->id}}" value="{{$data->id}}" checked>
                              <label class="form-check-label" for="reason{{$data->id}}">
                                {{$data->name}}
                              </label>
                            </div>
                          @endforeach
                      </div>
                        </div>
                    </div>
                    <!--end::Step 2-->

                    @push('script')
                        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
                        <script type="text/javascript">
                        $(document).ready(function(){
                        $("#first").change(function(){
                            $(this).find("option:selected").each(function(){
                                if($(this).attr("value")=="1"){
                                    $(".box").not(".red").hide();
                                    $(".red").show();
                                }
                                else if($(this).attr("value")=="2"){
                                    $(".box").not(".green").hide();
                                    $(".green").show();
                                }
                                else if($(this).attr("value")=="3"){
                                    $(".box").not(".blue").hide();
                                    $(".blue").show();
                                }

                                else{
                                    $(".box").hide();
                                }
                            });
                        }).change();
                        });
                        </script>

                    @endpush

                    @push('script')
                    <script>
                        function fixeamount(e)
                        {
                        document.getElementById("amount").value = e.value;
                        document.getElementById("value").innerHTML = ''
                        document.getElementById("unit").value = ''
                        return;
                        }

                        function getvalue(e)
                        {
                        var unit = e.value;
                        var amount = document.getElementById("amount").value;
                        if(amount < 1)
                        {
                            SlimNotifierJs.notification('error', 'error', 'Enter and amount first', 3000);
                            return;
                        }
                        var balance = "{{Auth::user()->balance}}";
                        var total = unit*amount;
                        if(total > balance)
                        {
                            SlimNotifierJs.notification('error', 'error', 'Insufficient wallet balance', 3000);
                            document.getElementById("value").innerHTML = ''
                            return;
                        }
                        document.getElementById("value").innerHTML =
                        `<br><div class="alert alert-primary" role="alert">
                            <strong>The total value of this voucher will be : </strong> {{$general->cur_sym}} ${parseInt(total).toLocaleString()}<br>
                            Ensure you have enough balance to generate this voucher
                        </div>`
                        }
                    </script>
                    @endpush

                    <!--begin::Actions-->
                    <div class="d-flex flex-stack pt-15">
                        <!--begin::Wrapper-->
                        <div>
                            <button type="submit" class="btn btn-lg btn-primary" type="button" id="submit">@lang('Proceed')
                                <i class="ti ti-arrow-right fs-4 ms-1 me-0"><span class="path1"></span><span class="path2"></span></i>
                            </button>
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
