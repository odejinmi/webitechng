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
                            <div class="form-group col-md-6">
                                <label>@lang('Batch Size') <small class="text-muted">(@lang('Emails per batch, default'):</small> {{ $batchSize }})</label>
                                <input type="number" class="form-control" name="batch_size" min="1" max="100"
                                    value="{{ old('batch_size', $batchSize) }}" />
                                <small class="form-text text-muted">@lang('Number of emails to send in each batch (1-100)')</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label>@lang('Delay Between Batches') <small class="text-muted">(@lang('Minutes, default'):</small> {{ $delayMinutes }})</label>
                                <input type="number" class="form-control" name="delay_minutes" min="1" max="60"
                                    value="{{ old('delay_minutes', $delayMinutes) }}" />
                                <small class="form-text text-muted">@lang('Minutes to wait between batches (1-60)')</small>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="test_mode" id="test_mode" value="1">
                                    <label class="form-check-label" for="test_mode">
                                        <strong>@lang('Test Mode')</strong> - @lang('Simulate email sending without actually sending emails')
                                    </label>
                                </div>
                                <small class="form-text text-warning">
                                    <i class="fas fa-exclamation-triangle"></i> @lang('When enabled, emails will be logged but not actually sent. Use for testing batch processing and timing.')
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.subscriber.index') }}" />
@endpush
