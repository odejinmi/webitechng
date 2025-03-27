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


                            <form action="{{ route('user.escrow.step.two.submit') }}" method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <label class="d-block mb-2 sm-text">
                                        @if ($escrowInfo['type'] == 1)
                                            @lang('Buyer\'s')
                                        @else
                                            @lang('Seller\'s')
                                        @endif @lang('Email')
                                    </label>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="@lang('Enter email')" class="form-control form--control" required>
                                </div>
                                <div class="form-group">
                                    <label class="d-block mb-2 sm-text">@lang('Title')</label>
                                    <input type="text" name="title" value="{{ old('title') }}" placeholder="@lang('Enter title')" class="form-control form--control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="d-block mb-2 sm-text">@lang('Amount')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form--control" value="{{ getAmount($escrowInfo['amount']) }}" readonly>
                                        <span class="input-group-text">{{ __($general->cur_text) }}</span>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="d-block mb-2 sm-text">@lang('Charge')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form--control" value="{{ getAmount($escrowInfo['charge']) }}" readonly>
                                        <span class="input-group-text">{{ __($general->cur_text) }}</span>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="d-block mb-2 sm-text">@lang('Charge will Pay')</label>
                                    <div class="form--select-light">
                                        <select name="charge_payer" class="form-select form--select" required>
                                            <option value="1">@lang('Seller')</option>
                                            <option value="2">@lang('Buyer')</option>
                                            <option value="3">@lang('50% - 50%')</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group mb-3">
                                    <label class="d-block mb-2 sm-text">@lang('Details')</label>
                                    <textarea name="details" class="form-control form--control-textarea" rows="5" placeholder="@lang('Enter details')">{{ old('details') }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 h-45">@lang('Next')</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
