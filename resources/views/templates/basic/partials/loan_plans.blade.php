<div class="row justify-content-center">
    <div class="col-lg-6 text-center">
      <h2 class="fw-bolder mb-0   lh-base">@lang('Flexible Loan & Mortgage Plans Tailored to Fit Your Pocket!')</h2>
    </div>
  </div>
   
  <div class="row">
    @foreach ($plans as $plan)
    <div class="col-sm-6 col-lg-4">
      <div class="card">
        <div class="card-body">
          <span class="fw-bolder text-uppercase fs-2 d-block mb-7">{{ __(@$plan->name) }}</span>
          <div class="my-4">
            <img src="{{ asset('assets/assets/dist/images/backgrounds/silver.png')}}" alt="" class="img-fluid" width="80" height="80">
          </div>
          <h4 class="fw-bolder  mb-3">
            {{ getAmount($plan->per_installment) }}%      <span class="text-small">&nbsp;/ {{ $plan->installment_interval }} @lang('Days')</span>        
          </h4>
          
          <ul class="list-unstyled mb-7">
            <li class="d-flex align-items-center gap-2 py-2">
              <i class="ti ti-cash text-primary fs-4"></i>
              <span class="text-dark">@lang('Minimum'): {{ __($general->cur_sym) }}{{ __(showAmount($plan->minimum_amount)) }}</span>
            </li>
            <li class="d-flex align-items-center gap-2 py-2">
              <i class="ti ti-cash text-primary fs-4"></i>
              <span class="text-dark">@lang('Maximum'): {{ __($general->cur_sym) }}{{ __(showAmount($plan->maximum_amount)) }}</span>
            </li>
            <li class="d-flex align-items-center gap-2 py-2">
              <i class="ti ti-cash text-muted fs-4"></i>
              <span class="text-muted">@lang('Per Installment'): {{ __(getAmount($plan->per_installment)) }}%</span>
            </li>
            <li class="d-flex align-items-center gap-2 py-2">
              <i class="ti ti-cash text-muted fs-4"></i>
              <span class="text-muted">@lang('Payment Interval'): {{ __($plan->installment_interval) }} @lang('Days')</span>
            </li>
            <li class="d-flex align-items-center gap-2 py-2">
              <i class="ti ti-cash text-muted fs-4"></i>
              <span class="text-muted">@lang('Total Instalment'): {{ __($plan->total_installment) }}</span>
            </li>
          </ul>
          <button data-id="{{ $plan->id }}" data-minimum="{{ $general->cur_sym }}{{ showAmount($plan->minimum_amount) }}" data-maximum="{{ $general->cur_sym }}{{ showAmount($plan->maximum_amount) }}" class="btn loanBtn btn btn-primary fw-bolder rounded-2 py-6 w-100 text-capitalize">Select {{$plan->name}}</button>
        </div>
      </div>
    </div>
    @endforeach
     
  </div>
 
@push('script')
    <script>
        (function($) {
            "use strict";
            $('.loanBtn').on('click', (e) => {
                var modal = $('#loanModal');
                let data = e.currentTarget.dataset;
                modal.find('.min-limit').text(`Minimum Amount ${data.minimum}`);
                modal.find('.max-limit').text(`Maximum Amount ${data.maximum}`);
                let form = modal.find('form')[0];
                form.action = `{{ route('user.loan.apply', '') }}/${data.id}`;
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush

    <div class="modal fade custom--modal" id="loanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" method="post">
                    @auth
                        <div class="modal-header">
                            <h5 class="modal-title method-name" id="exampleModalLabel">@lang('Apply for Loan')</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="" class="required">@lang('Amount')</label>
                                <div class="input-group custom-input-group">
                                    <input type="number" step="any" name="amount" class="form-control form--control" placeholder="@lang('Enter An Amount')" required>
                                    <span class="input-group-text"> {{ $general->cur_text }} </span>
                                </div>
                                <p><small class="text--danger min-limit"></small></p>
                                <p><small class="text--danger max-limit"></small></p>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">@lang('Confirm')</button>
                        </div>
                    @else
                        <div class="modal-body">
                            <div class="text-center"><i class="la la-times-circle text--danger la-6x" aria-hidden="true"></i></div>
                            <h3 class="text-center mt-3">@lang('You are not logged in!')</h3>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal" aria-label="Close">@lang('Close')</button>
                        </div>
                    @endauth
                </form>
            </div>
        </div>
    </div>
