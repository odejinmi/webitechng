@extends('admin.layouts.app')

@section('panel')


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">@lang('Transaction Bonus Settings')</h5>
                </div>
                <form action="{{ route('admin.bonus.update') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="table-responsive--md">
                            <table class="table table--light style--two">
                                <thead>
                                <tr>
                                    <th>@lang('Transaction Type')</th>
                                    <th>@lang('Bonus Percentage')</th>
                                    <th>@lang('Bonus Amount')</th>
                                    <th>@lang('Bonus Type')</th>
                                    <th>@lang('Status')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bonuses as $bonus)
                                    <tr>
                                        <td>
                                            <strong>{{ ucfirst($bonus->transaction_type) }}</strong>
                                            <input type="hidden" name="bonuses[{{ $loop->index }}][id]" value="{{ $bonus->id }}">
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" step="0.01" min="0" max="100"
                                                       class="form-control"
                                                       name="bonuses[{{ $loop->index }}][bonus_percentage]"
                                                       value="{{ $bonus->bonus_percentage }}" required>
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" step="0.01"
                                                       class="form-control"
                                                       name="bonuses[{{ $loop->index }}][bonus_amount]"
                                                       value="{{ $bonus->bonus_amount }}" required>
                                            </div>
                                        </td>
                                        <td>
                                            <select class="form-select bonus-type-select"
                                                    name="bonuses[{{ $loop->index }}][bonus_type]"
                                                    data-width="100%"
                                                    data-size="large"
                                                    data-onstyle="-success"
                                                    data-offstyle="-danger">
                                                <option value= "0" @if($bonus->bonus_type == 0) selected @endif>Percentage</option>
                                                <option value="1" @if($bonus->bonus_type == 1) selected @endif>Fixed Amount</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="hidden" name="bonuses[{{ $loop->index }}][is_active]" value="0">
                                            <input type="checkbox"
                                                   data-width="100%"
                                                   data-size="large"
                                                   data-onstyle="-success"
                                                   data-offstyle="-danger"
                                                   data-bs-toggle="toggle"
                                                   data-on="Active"
                                                   data-off="Inactive"
                                                   name="bonuses[{{ $loop->index }}][is_active]"
                                                   value="1"
                                                   @if($bonus->is_active) checked @endif>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn--primary w-100">@lang('Update Settings')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@push('breadcrumb-plugins')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn--primary box--shadow1 text--small">
        <i class="la la-fw la-backward"></i> @lang('Go Back')
    </a>
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";
            $('select[name=type]').on('change', function() {
                $('.search-fields').addClass('d-none');
                const selectedValue = $(this).val();
                $(`.search-fields[data-type="${selectedValue}"]`).removeClass('d-none');
            }).change();
        })(jQuery);

        $('.bonus-type-select').select2({
            minimumResultsForSearch: Infinity,
            theme: 'bootstrap',
            width: '100%'
        });
    </script>
@endpush

@endsection
