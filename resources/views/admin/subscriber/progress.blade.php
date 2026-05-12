@extends('admin.layouts.app')

@section('panel')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="mb-4">@lang('Sending Emails to') {{ $total }} @lang('Subscribers')</h4>

                    <div class="progress mb-3" style="height: 30px;">
                        <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>

                    <p id="status-text" class="mb-0">@lang('Starting...')</p>
                    <p class="text-muted"><small>@lang('Please do not close this window until the process is complete.')</small></p>

                    <div id="finish-area" class="mt-4 d-none">
                        <a href="{{ route('admin.subscriber.index') }}" class="btn btn-primary">@lang('Go Back')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    (function ($) {
        "use strict";

        $(document).ready(function () {
            sendBatch();
        });

        function sendBatch() {
            $.post("{{ route('admin.subscriber.send.email.live') }}", {
                _token: "{{ csrf_token() }}"
            }, function (response) {
                if (response.complete) {
                    $('#progress-bar').css('width', '100%').text('100%').removeClass('progress-bar-animated');
                    $('#status-text').html('<span class="text-success font-weight-bold">@lang("Sending Completed!")</span>');
                    $('#finish-area').removeClass('d-none');
                    notify('success', 'Emails sent successfully');
                } else {
                    let percent = response.percent;
                    $('#progress-bar').css('width', percent + '%').text(percent + '%');
                    $('#status-text').text('@lang("Sent"): ' + response.sent + ' / ' + response.total);

                    // Small delay to prevent hitting server too fast
                    setTimeout(sendBatch, 1000);
                }
            }).fail(function (xhr) {
                $('#status-text').html('<span class="text-danger">@lang("Error"): ' + (xhr.responseJSON.error || '@lang("Unknown error occurred")') + '</span>');
                $('#progress-bar').addClass('bg-danger').removeClass('progress-bar-animated');
            });
        }
    })(jQuery);
</script>
@endpush
