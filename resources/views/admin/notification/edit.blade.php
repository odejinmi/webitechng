@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-md-12">
            <div class="card overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive table-responsive--sm">
                        <table class="table align-items-center table--light">
                            <thead>
                                <tr>
                                    <th>@lang('Short Code')</th>
                                    <th>@lang('Description')</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse($template->shortcodes as $shortcode => $key)
                                    <tr>
                                        <th><span class="short-codes">@php echo "{{". $shortcode ."}}"  @endphp</span></th>
                                        <td>{{ __($key) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-muted text-center">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- card end -->

            <h6 class="mt-4 mb-2">@lang('Global Short Codes')</h6>
            <div class="card overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive table-responsive--sm">
                        <table class=" table align-items-center table--light">
                            <thead>
                                <tr>
                                    <th>@lang('Short Code') </th>
                                    <th>@lang('Description')</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($general->global_shortcodes as $shortCode => $codeDetails)
                                    <tr>
                                        <td><span class="short-codes">@{{@php echo $shortCode @endphp}}</span></td>
                                        <td>{{ __($codeDetails) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <form action="{{ route('admin.setting.notification.template.update', $template->id) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card mt-4">
                    <div class="card-header bg-light-primary">
                        <h5 class="card-title text-primary">@lang('Email Template')</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label>@lang('Subject')</label>
                                    <input type="text" class="form-control form-control-lg"
                                        placeholder="@lang('Email subject')" name="subject" value="{{ $template->subj }}"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>@lang('Status') <span class="text--danger">*</span></label>
                                    <div class="form-check form-switch form-check-success">
                                        <input type="checkbox" class="form-check-input"  @if ($template->email_status) checked @endif name="email_status"
                                         id="email_status" /> 
                                    </div> 
 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>@lang('Message') <span class="text--danger">*</span></label>
                                    <textarea name="email_body" rows="10" class="form-control nicEdit" placeholder="@lang('Your message using short-codes')">{{ $template->email_body }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mt-4">
                    <div class="card-header bg-light-primary">
                        <h5 class="card-title text-primary">@lang('SMS Template')</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>@lang('Status') <span class="text--danger">*</span></label>
                                    <div class="form-check form-switch form-check-success">
                                        <input type="checkbox" class="form-check-input"  @if ($template->sms_status) checked @endif name="sms_status"
                                         id="sms_status" /> 
                                    </div>  
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>@lang('Message')</label>
                                    <textarea name="sms_body" rows="10" class="form-control" placeholder="@lang('Your message using short-codes')" required>{{ $template->sms_body }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-primary w-100 h-45 mt-4">@lang('Submit')</button>
    </form>
@endsection


@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.setting.notification.templates') }}" />
@endpush
