

@php
      $subscribeContent = getContent('subscribe.content', true);
@endphp
<!-- ============================ Call To Action ================================== -->
<section class="bg-cover call-action-container bg-primary position-relative">
    <div class="position-absolute top-0 end-0 z-0">
        <img src="{{asset( $activeTemplateTrue . 'img/alert-bg.png')}}" alt="SVG" width="300">
    </div>
    <div class="position-absolute bottom-0 start-0 me-10 z-0">
        <img src="{{asset( $activeTemplateTrue . 'img/circle.png')}}" alt="SVG" width="150">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-10 col-md-12 col-sm-12">

                <div class="call-action-wrap wow animated fadeInUp">
                    <div class="call-action-caption">
                        <h2 class="text-light">{{ __(@$subscribeContent->data_values->heading) }}</h2>
                        <p class="text-light">{{ __(@$subscribeContent->data_values->sub_heading) }}</p>
                    </div>
                    <div class="call-action-form">
                        <form class="subscribe-form subscribeForm" method="post" action="{{ route('subscribe') }}" id="subscribeForm">
                        @csrf
                            <div class="newsltr-form rounded-3">
                                <input id="subscribe" name="email" value="{{ old('email') }}" placeholder="@lang('Your Email Address')" required class="form-control" placeholder="Enter Your email">
                                <button type="submit" class="subscribe-btn btn btn-dark">@lang('Subscribe')</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- ============================ Call To Action End ================================== -->


@push('script')
<script>
    (function($) {
        "use strict";

        $("#subscribeForm").on("submit", function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                url: '{{ route('subscribe') }}',
                method: 'post',
                data: data,
                success: function(response) {
                    if (response.success) {
                        $('#subscribeForm').trigger("reset");
                        notify('success', response.message);
                    } else {
                        $.each(response.error, function(key, value) {
                            notify('error', value);
                        });
                    }
                },
                error: function(error) {
                    console.log(error)
                }
            });
        });

    })(jQuery);
</script>

@endpush

