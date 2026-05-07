@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <form action="" class="notify-form">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('Subject') </label>
                                    <input type="text" class="form-control" placeholder="@lang('Email subject')" name="subject"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('Message') </label>
                                    <textarea name="message" rows="10" class="form-control nicEdit"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Batch Size') <small class="text-muted">(@lang('Emails per batch, default'):</small> 30)</label>
                                    <input type="number" class="form-control" name="batch_size" min="1" max="100"
                                        value="30" />
                                    <small class="form-text text-muted">@lang('Number of emails to send in each batch (1-100)')</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Delay Between Batches') <small class="text-muted">(@lang('Minutes, default'):</small> 15)</label>
                                    <input type="number" class="form-control" name="delay_minutes" min="1" max="60"
                                        value="15" />
                                    <small class="form-text text-muted">@lang('Minutes to wait between batches (1-60)')</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="test_mode" id="test_mode_users" value="1">
                                        <label class="form-check-label" for="test_mode_users">
                                            <strong>@lang('Test Mode')</strong> - @lang('Simulate email sending without actually sending emails')
                                        </label>
                                    </div>
                                    <small class="form-text text-warning">
                                        <i class="fas fa-exclamation-triangle"></i> @lang('When enabled, emails will be logged but not actually sent. Use for testing batch processing and timing.')
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn w-100 h-45 btn--primary me-2">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" data-bs-backdrop="static" id="notificationSending">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Notification Sending')</h5>
                </div>
                <div class="modal-body">
                    <h4 class="text--danger text-center">@lang('Don\'t close or refresh the window till finish')</h4>
                    <div class="mail-wrapper">
                        <div class="mail-icon world-icon"><i class="las la-globe"></i></div>
                        <div class='mailsent'>
                            <div class='envelope'>
                                <i class='line line1'></i>
                                <i class='line line2'></i>
                                <i class='line line3'></i>
                                <i class="icon fa fa-envelope"></i>
                            </div>
                        </div>
                        <div class="mail-icon mail-icon"><i class="las la-envelope-open-text"></i></div>
                    </div>
                    <div class="mt-3">
                        <div class="progress">
                            <div class="progress-bar" style="width: 0%"></div>
                        </div>
                        <p>@lang('Email sent') <span class="sent">0</span> @lang('users out of') {{ $users }}
                            @lang('users')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')

    <span class="text--primary">@lang('Notification will send via ') @if ($general->en)
            <span class="badge badge--warning">@lang('Email')</span>
            @endif @if ($general->sn)
                <span class="badge badge--warning">@lang('SMS')</span>
            @endif
    </span>

@endpush


@push('script')
    <script>
        (function($) {
            "use strict"
            $('.notify-form').on('submit', function(e) {
                if ({{ $users }} <= 0) {
                    notify('error', 'Users not found');
                    return false;
                }
                e.preventDefault();
                
                var _token = $(this).find('[name=_token]').val();
                var subject = $(this).find('[name=subject]').val();
                var message = $(this).find('.nicEdit-main').html();
                var batchSize = $(this).find('[name=batch_size]').val() || 30;
                var delayMinutes = $(this).find('[name=delay_minutes]').val() || 15;
                var testMode = $(this).find('[name=test_mode]').is(':checked') ? 1 : 0;

                // Show progress modal
                $('.progress-bar').css('width', `100%`);
                $('.progress-bar').text(`100%`);
                $('.sent').text({{ $users }});
                $('#notificationSending').modal('show');

                $.post("{{ route('admin.users.notification.all.send') }}", {
                    "subject": subject,
                    "_token": _token,
                    "message": message,
                    "batch_size": batchSize,
                    "delay_minutes": delayMinutes,
                    "test_mode": testMode
                }, function(response) {
                    if (response.error) {
                        response.error.forEach(error => {
                            notify('error', error)
                        });
                        $('#notificationSending').modal('hide');
                    } else {
                        // Show success message
                        setTimeout(() => {
                            $('#notificationSending').modal('hide');
                            $('form.notify-form')[0].reset();
                            $('.nicEdit-main').html('<span></span>');
                            notify('success', response.success)
                        }, 2000);
                    }
                }).fail(function() {
                    notify('error', 'An error occurred while processing your request');
                    $('#notificationSending').modal('hide');
                });
            });

        })(jQuery);
    </script>
@endpush
