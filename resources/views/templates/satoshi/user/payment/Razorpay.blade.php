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

                    <form action="{{ $data->url }}" method="{{ $data->method }}" class="text-center">
                        @csrf
                        <input type="hidden" custom="{{ $data->custom }}" name="hidden">
                        <script src="{{ $data->checkout_js }}"
                            @foreach ($data->val as $key => $value)
                                data-{{ $key }}="{{ $value }}" @endforeach>
                        </script>
                </div>
            </div>
        </div>

    </div>
</div>



@endsection


@push('script')
    <script>
        (function($) {
            "use strict";
            $('input[type="submit"]').addClass("btn btn-sm btn-square btn-dark stretched-link");
        })(jQuery);
    </script>
@endpush
