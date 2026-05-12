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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('Sending Mode')</label>
                                    <select name="sending_mode" class="form-control" id="sending_mode" required>
                                        <option value="live">@lang('Live Mode (With Progress Bar - No Cron Needed)')</option>
                                        <option value="queue">@lang('Background Mode (Queued - Needs Cron Job)')</option>
                                    </select>
                                    <small class="form-text text-muted">@lang('Choose "Live Mode" if your cPanel cron jobs are not working.')</small>
                                </div>
                            </div>

                            <div id="batch_settings_area" class="row w-100 d-none">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('Batch Size') <small class="text-muted">(@lang('Emails per batch, default'):</small> 30)</label>
                                        <input type="number" class="form-control" name="batch_size" min="1" max="100"
                                            value="30" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('Delay Between Batches') <small class="text-muted">(@lang('Minutes, default'):</small> 15)</label>
                                        <input type="number" class="form-control" name="delay_minutes" min="1" max="60"
                                            value="15" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn w-100 h-45 btn--primary me-2">@lang('Start Sending')</button>
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

            $('#sending_mode').on('change', function() {
                if ($(this).val() == 'queue') {
                    $('#batch_settings_area').removeClass('d-none');
                } else {
                    $('#batch_settings_area').addClass('d-none');
                }
            }).change();

            $('.notify-form').on('submit', function(e) {
                if ({{ $users }} <= 0) {
                    notify('error', 'Users not found');
                    return false;
                }
                e.preventDefault();

                var formData = $(this).serializeArray();
                var message = $(this).find('.nicEdit-main').html();
                formData.push({name: 'message', value: message});

                $('#notificationSending').modal('show');
                $('.progress-bar').css('width', '0%').text('0%');
                $('.sent').text('0');

                $.post("{{ route('admin.users.notification.all.send') }}", formData, function(response) {
                    if (response.error) {
                        response.error.forEach(error => {
                            notify('error', error)
                        });
                        $('#notificationSending').modal('hide');
                    } else if(response.live_mode) {
                        sendBatchLive();
                    } else {
                        $('.progress-bar').css('width', '100%').text('100%');
                        $('.sent').text(response.total_sent);
                        setTimeout(() => {
                            $('#notificationSending').modal('hide');
                            notify('success', response.success)
                        }, 1000);
                    }
                }).fail(function() {
                    notify('error', 'An error occurred while processing your request');
                    $('#notificationSending').modal('hide');
                });
            });

            function sendBatchLive() {
                $.post("{{ route('admin.users.notification.all.send.live') }}", {
                    _token: "{{ csrf_token() }}"
                }, function (response) {
                    if (response.complete) {
                        $('.progress-bar').css('width', '100%').text('100%');
                        setTimeout(() => {
                            $('#notificationSending').modal('hide');
                            notify('success', 'Notifications sent successfully');
                        }, 1000);
                    } else {
                        let percent = response.percent;
                        $('.progress-bar').css('width', percent + '%').text(percent + '%');
                        $('.sent').text(response.sent);
                        setTimeout(sendBatchLive, 1000);
                    }
                }).fail(function (xhr) {
                    notify('error', 'Live sending failed');
                    $('#notificationSending').modal('hide');
                });
            }

        })(jQuery);
    </script>
@endpush
