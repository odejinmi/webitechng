@extends($activeTemplate . 'layouts.app')
@section('panel')


<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-6 justify-content-center">
    <div class="col">
        <div class="card card-pricing text-bg-primary border-0 shadow-4 shadow-6-hover">
            <div class="p-6">
                <h3 class="text-reset ls-tight mb-1">{{ $deposit->gateway->alias }}</h3>
                <img src="{{ getImage(imagePath()['gateway']['path'] . '/' . @$deposit->gateway->image, imagePath()['gateway']['size']) }}"
                        width="50" />
                <div class="d-flex align-items-center my-5"><span class="d-block display-5 text-reset">
                            {{ showAmount($deposit->final_amo) }} {{ __($deposit->method_currency) }}
                        </span></div>
                <ul class="list-unstyled mt-7">
                    <li class="py-2 d-flex align-items-center">
                        <div
                            class="icon icon-xs text-base icon-shape rounded-circle bg-primary-subtle text-primary me-3">
                            <i class="bi bi-check"></i>
                        </div>
                        <p>Fee: {{ showAmount($deposit->charge) }}
                            {{ __($deposit->method_currency) }}</p>
                    </li>
                    <li class="py-2 d-flex align-items-center">
                        <div
                            class="icon icon-xs text-base icon-shape rounded-circle bg-primary-subtle text-primary me-3">
                            <i class="bi bi-check"></i>
                        </div>
                        <p>Amount: {{ showAmount($deposit->amount) }}
                            {{ __($general->cur_text) }}</p>
                    </li>
                </ul>
                <div class="mt-7 mb-2 d-flex justify-content-between align-items-center"><span
                            class="text-sm fw-semibold">{{ $deposit->gateway->alias }}!</span>
                         
                            <form role="form" id="payment-form" method="{{ $data->method }}" action="{{ $data->url }}">
        @csrf
        <input type="hidden" value="{{ $data->track }}" name="track">
        <div class="row">
          <div class="col-md-6">
              <label class="form-label">@lang('Name on Card')</label>
              <div class="input-group">
                  <input type="text" class="form-control form--control" name="name"
                      value="{{ old('name') }}" required autocomplete="off" autofocus />
                  <span class="input-group-text"><i class="fa fa-font"></i></span>
              </div>
          </div>
          <div class="col-md-6">
              <label class="form-label">@lang('Card Number')</label>
              <div class="input-group">
                  <input type="tel" class="form-control form--control" name="cardNumber"
                      autocomplete="off" value="{{ old('cardNumber') }}" required autofocus />
                  <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
              </div>
          </div>
      </div>

      <div class="row mt-4">
          <div class="col-md-6">
              <label class="form-label">@lang('Expiration Date')</label>
              <input type="tel" class="form-control form--control" name="cardExpiry"
                  value="{{ old('cardExpiry') }}" autocomplete="off" required />
          </div>
          <div class="col-md-6 ">
              <label class="form-label">@lang('CVC Code')</label>
              <input type="tel" class="form-control form--control" name="cardCVC"
                  value="{{ old('cardCVC') }}" autocomplete="off" required />
          </div>
      </div>
      <button type="submit" id="btn-confirm" class="btn btn-sm btn-square btn-dark stretched-link-btn__default"
        >Pay</button
      >
       
    </form>
 
                         
                </div>
            </div>
        </div>

    </div>
</div>
 
 
@endsection


@push('script')
    <script src="{{ asset('assets/global/js/card.js') }}"></script>

    <script>
        (function($) {
            "use strict";
            var card = new Card({
                form: '#payment-form',
                container: '.card-wrapper',
                formSelectors: {
                    numberInput: 'input[name="cardNumber"]',
                    expiryInput: 'input[name="cardExpiry"]',
                    cvcInput: 'input[name="cardCVC"]',
                    nameInput: 'input[name="name"]'
                }
            });
        })(jQuery);
    </script>
@endpush
