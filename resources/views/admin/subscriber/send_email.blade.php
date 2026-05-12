@extends('admin.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <form action="{{ route('admin.subscriber.send.email') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>@lang('Subject')</label>
                                <input type="text" class="form-control" name="subject" required
                                    value="{{ old('subject') }}" />
                            </div>
                            <div class="form-group col-md-12">
                                <label>@lang('Body')</label>
                                <textarea name="body" rows="10" class="form-control nicEdit">{{ old('body') }}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>@lang('Sending Mode')</label>
                                <select name="sending_mode" class="form-control" id="sending_mode" required>
                                    <option value="live">@lang('Live Mode (With Progress Bar - No Cron Needed)')</option>
                                    <option value="queue">@lang('Background Mode (Queued - Needs Cron Job)')</option>
                                </select>
                                <small class="form-text text-muted">@lang('Choose "Live Mode" if your cPanel cron jobs are not working.')</small>
                            </div>

                            <div id="batch_settings_area" class="row w-100 d-none">
                                <div class="form-group col-md-6">
                                    <label>@lang('Batch Size') <small class="text-muted">(@lang('Emails per batch, default'):</small> {{ $batchSize }})</label>
                                    <input type="number" class="form-control" name="batch_size" min="1" max="100"
                                        value="{{ old('batch_size', $batchSize) }}" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label>@lang('Delay Between Batches') <small class="text-muted">(@lang('Minutes, default'):</small> {{ $delayMinutes }})</label>
                                    <input type="number" class="form-control" name="delay_minutes" min="1" max="60"
                                        value="{{ old('delay_minutes', $delayMinutes) }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary w-100 h-45">@lang('Start Sending')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    (function ($) {
        "use strict";
        $('#sending_mode').on('change', function() {
            if ($(this).val() == 'queue') {
                $('#batch_settings_area').removeClass('d-none');
            } else {
                $('#batch_settings_area').addClass('d-none');
            }
        }).change();
    })(jQuery);
</script>
@endpush

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.subscriber.index') }}" />
@endpush
