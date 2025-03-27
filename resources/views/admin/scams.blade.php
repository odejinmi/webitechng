@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-md-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('User')</th>
                                    <th>@lang('IP')</th>
                                    <th>@lang('Browser')</th>
                                    <th>@lang('Device')</th>
                                    <th>@lang('Country')</th>
                                    <th>@lang('City')</th>
                                    <th>@lang('Code')</th>
                                    <th>@lang('Area')</th>
                                    <th>@lang('Longitude')</th>
                                    <th>@lang('Latitude')</th>
                                    <th>@lang('Date Attempted')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($scams as $report)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ getImage(getFilePath('userProfile') . '/' . @$report->user->image, getFileSize('userProfile')) }}" alt="avatar" class="rounded-circle" width="35" />
                                                <div class="ms-3">
                                                  <div class="user-meta-info">
                                                    <h6 class="user-name mb-0" > {{ @$report->user->fullname }}</h6>
                                                    <span class="user-work fs-3"> {{ @$report->user->username }}</span>
                                                  </div>
                                                </div>
                                              </div>
                                        </td>
                                        <td>{{ @$report->ip_address }}</td> 
                                        <td>{{ @$report->browser }}</td> 
                                        <td>{{ @$report->device }}</td> 
                                        <td>{{ @$report->country }}</td> 
                                        <td>{{ @$report->city }}</td> 
                                        <td>{{ @$report->code }}</td> 
                                        <td>{{ @$report->area }}</td> 
                                        <td>{{ @$report->longitude }}</td> 
                                        <td>{{ @$report->latitude }}</td> 
                                        <td>{{ @$report->created_at }}</td> 
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bugModal" tabindex="-1" role="dialog" aria-labelledby="bugModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bugModalLabel">@lang('Report & Request')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Type')</label>
                            <select class="form-control" name="type" required>
                                <option value="bug" @selected(old('type') == 'bug')>@lang('Report Bug')</option>
                                <option value="feature" @selected(old('type') == 'feature')>@lang('Feature Request')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>@lang('Message')</label>
                            <textarea class="form-control" name="message" rows="5" required>{{ old('message') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins') 
@endpush
