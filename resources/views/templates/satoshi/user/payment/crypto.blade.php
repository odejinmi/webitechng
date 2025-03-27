@extends($activeTemplate . 'layouts.app')

@section('panel')

<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-6 justify-content-center">
    <div class="col">
        <div class="card card-pricing text-bg-primary border-0 shadow-4 shadow-6-hover">
            <div class="p-6">
                <h3 class="text-reset ls-tight mb-1">{{ $data->gateway->alias }}</h3>
                <img src="{{ getImage(imagePath()['gateway']['path'] . '/' . @$data->gateway->image, imagePath()['gateway']['size']) }}"
                        width="50" />
                <div class="d-flex align-items-center my-5"><span class="d-block display-5 text-reset">
                            {{ showAmount($data->final_amo) }} {{ __($data->method_currency) }}
                        </span></div>
                <ul class="list-unstyled mt-7">
                    <li class="py-2 d-flex align-items-center">
                        <div
                            class="icon icon-xs text-base icon-shape rounded-circle bg-primary-subtle text-primary me-3">
                            <i class="bi bi-check"></i>
                        </div>
                        <p>Fee: {{ showAmount($data->charge) }}
                            {{ __($data->method_currency) }}</p>
                    </li>
                    <li class="py-2 d-flex align-items-center">
                        <div
                            class="icon icon-xs text-base icon-shape rounded-circle bg-primary-subtle text-primary me-3">
                            <i class="bi bi-check"></i>
                        </div>
                        <p>Amount: {{ showAmount($data->amount) }}
                            {{ __($general->cur_text) }}</p>
                    </li>
                </ul>
                <div class="mt-7 mb-2 d-flex justify-content-between align-items-center"><span
                            class="text-sm fw-semibold">{{ @$data->gateway->alias }}!</span>
                         
                      <div class="card-body card-body-deposit text-center">
                        <h4 class="my-2"> @lang('PLEASE SEND EXACTLY') <span class="text--success"> {{ $data->amount }}</span>
                            {{ __($data->currency) }}</h4>
                        <h5 class="mb-2">@lang('TO') <span class="text--success"> {{ $data->sendto }}</span></h5>
                        <img src="{{ $data->img }}" alt="@lang('Image')">
                        <h4 class="text-white bold my-4">@lang('SCAN TO SEND')</h4>
                    </div>
                         
                </div>
            </div>
        </div>

    </div>
</div>
 
@endsection
