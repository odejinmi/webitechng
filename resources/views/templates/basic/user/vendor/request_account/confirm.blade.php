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



                    <!--begin::Step 2-->
                    <div data-kt-stepper-element="scontent">
                        <div class="row justify-content-center gy-4">
                            <div class="col-lg-8">
                                <div class="card custom--card">
                                    <div class="card-header">
                                        <h5 class="card-title">@lang('Confirm Payment')</h5>
                                    </div>
                                    <div class="card-body ">
                                        <form action="" method="POST" class="text-centers"  enctype="multipart/form-data">
                                            @csrf
                                            <ul class="list-group text-center">
                                                <li class="list-group-item d-flex justify-content-between">
                                                    @lang('Account Type '):
                                                    <strong> {{ __($account->account->name) }}</strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    @lang('Account Details '):
                                                    <strong> {{ __($account->account->details) }}</strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    @lang('Account Currency '):
                                                    <strong> {{ __($account->account->currency) }}</strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    @lang('Transaction Amount '):
                                                    <strong>{{ showAmount($account->amount) }} {{ __($account->account->currency) }}</strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    @lang('Transaction Fee '):
                                                    <strong> {{ __($account->account->fee) }}%</strong>
                                                </li>

                                                <li class="list-group-item d-flex justify-content-between">
                                                    @lang('Transaction Rate '):
                                                    <strong>1 {{ __($account->account->currency) }} = {{ showAmount($account->rate) }}
                                                        {{ __($general->cur_text) }}</strong>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    @lang('You will get '):
                                                    <strong>{{ showAmount($account->pay) }} {{ __($general->cur_text) }}</strong>
                                                </li>
                                            </ul>
                                            <br>
                                            <div class="alert alert-primary" role="alert">
                                                <strong>Hello - </strong> @lang('Please make payment into the account details above and upload a proof of payment along. Our system will validate your payment and act accordingly')
                                              </div>
                                            <div class="form-group">
                                                <label class="form-label mb-3">@lang('Upload Proof Of Payment ')</label>
                                                <input type="file" name="proof" class="form-control">

                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-lg btn-primary" type="button" id="submit">@lang('Proceed')

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Step 2-->




            </div>
            <!--end::Stepper-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Container-->

@endsection
