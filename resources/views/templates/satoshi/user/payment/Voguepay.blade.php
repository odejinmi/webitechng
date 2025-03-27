@extends(checkTemplate() . 'layouts.app')
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
                    <form action="{{ route('ipn.' . $deposit->gateway->alias) }}" method="POST" class="text-center">
                        @csrf
                        <button type="button" id="btn-confirm"
                                class="btn btn-sm btn-square btn-dark stretched-link">Pay</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>




@endsection
@push('script')
    <script src="//pay.voguepay.com/js/voguepay.js"></script>
    <script>
        "use strict";
        var closedFunction = function() {}
        var successFunction = function(transaction_id) {
            window.location.href = '{{ route(gatewayRedirectUrl()) }}';
        }
        var failedFunction = function(transaction_id) {
            window.location.href = '{{ route(gatewayRedirectUrl()) }}';
        }

        function pay(item, price) {
            //Initiate voguepay inline payment
            Voguepay.init({
                v_merchant_id: "{{ $data->v_merchant_id }}",
                total: price,
                notify_url: "{{ $data->notify_url }}",
                cur: "{{ $data->cur }}",
                merchant_ref: "{{ $data->merchant_ref }}",
                memo: "{{ $data->memo }}",
                recurrent: true,
                frequency: 10,
                developer_code: '60a4ecd9bbc77',
                custom: "{{ $data->custom }}",
                customer: {
                    name: 'Customer name',
                    country: 'Country',
                    address: 'Customer address',
                    city: 'Customer city',
                    state: 'Customer state',
                    zipcode: 'Customer zip/post code',
                    email: 'example@example.com',
                    phone: 'Customer phone'
                },
                closed: closedFunction,
                success: successFunction,
                failed: failedFunction
            });
        }
        (function($) {
            $('#btn-confirm').on('click', function(e) {
                e.preventDefault();
                pay('Buy', {{ $data->Buy }});
            });
        })(jQuery);
    </script>
@endpush
