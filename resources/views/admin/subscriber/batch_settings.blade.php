@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <form action="{{ route('admin.subscriber.batch.settings.update') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <h5 class="card-title mb-4">@lang('Email Batch Settings')</h5>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>@lang('Default Batch Size')</label>
                                <input type="number" class="form-control" name="email_batch_size" min="1" max="100"
                                    value="{{ old('email_batch_size', $general->email_batch_size ?? 30) }}" required />
                                <small class="form-text text-muted">@lang('Number of emails to send in each batch (1-100). Recommended: 30-50 to avoid spam issues.')</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label>@lang('Default Delay Between Batches') (@lang('Minutes'))</label>
                                <input type="number" class="form-control" name="email_batch_delay" min="1" max="60"
                                    value="{{ old('email_batch_delay', $general->email_batch_delay ?? 15) }}" required />
                                <small class="form-text text-muted">@lang('Minutes to wait between batches (1-60). Recommended: 10-20 minutes to avoid spam filters.')</small>
                            </div>
                        </div>

                        <div class="alert alert-info mt-3">
                            <h6><i class="fas fa-info-circle"></i> @lang('Why Use Batch Email Sending?')</h6>
                            <ul class="mb-0">
                                <li>@lang('Prevents emails from being marked as spam')</li>
                                <li>@lang('Reduces server load and improves performance')</li>
                                <li>@lang('Better deliverability rates with email providers')</li>
                                <li>@lang('Complies with anti-spam regulations')</li>
                            </ul>
                        </div>

                        <div class="alert alert-warning mt-3">
                            <h6><i class="fas fa-exclamation-triangle"></i> @lang('Current Settings')</h6>
                            <p class="mb-0">
                                <strong>@lang('Batch Size'):</strong> {{ $general->email_batch_size ?? 30 }} @lang('emails per batch')<br>
                                <strong>@lang('Delay'):</strong> {{ $general->email_batch_delay ?? 15 }} @lang('minutes between batches')<br>
                                <strong>@lang('Example'):</strong> @lang('For 200 subscribers with current settings, emails will be sent in') {{ ceil(200 / ($general->email_batch_size ?? 30)) }} @lang('batches over approximately') {{ (ceil(200 / ($general->email_batch_size ?? 30)) - 1) * ($general->email_batch_delay ?? 15) }}, @lang('minutes').
                            </p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary w-100 h-45">@lang('Update Settings')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.subscriber.index') }}" />
@endpush
