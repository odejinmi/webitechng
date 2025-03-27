@extends($activeTemplate . 'layouts.app')
@section('panel')
@push('style')
        <link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    @endpush
    <!-- File export -->
    <div class="row">
        <div class="col-12">

            <div class="show-filter mb-3 text-end">
                <a class="btn btn-primary btn-sm" href="{{ route('user.bank.transfer.start') }}"><i class="ti ti-send"></i>
                    @lang('Transfer Money')</a>
            </div>
            <div class="card responsive-filter-card mb-4">
                <div class="card-body mb-4">
                    <form action="">
                        <div class="d-flex flex-wrap gap-4">
                            <div class="flex-grow-1">
                                <label>@lang('TRX')</label>
                                <input class="form-control" name="search" type="text" value="{{ request()->search }}">
                            </div>
                             
                            <div class="flex-grow-1">
                                <label>@lang('Date')</label>
                                <input class="datepicker-here form-control" name="date" data-range="true" data-multiple-dates-separator=" - " data-language="en" data-position='bottom right' type="text" value="{{ request()->date }}" placeholder="@lang('Start date - End date')" autocomplete="off">
                            </div>
                            <div class="flex-grow-1 align-self-end">
                                <button class="btn btn-primary w-100 h-45"><i class="ti ti-search"></i>
                                    @lang('Filter')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ---------------------
                              start File export
                          ---------------- -->
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <h5 class="mb-0">{{ $pageTitle }}</h5>
                    </div>
                    <p class="card-subtitle mb-3">
                        @lang('A table showing all the ') {{ $pageTitle }} @lang('on your account. You can export transaction record')
                    </p>
                    <div class="table-responsive">
                        <table id="file_export" class="table border table-striped table-bordered display text-nowrap">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th>@lang('Trx')</th>
                                    <th>@lang('Transacted')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Post Balance')</th>
                                    <th>@lang('Narration')</th>
                                    <th>@lang('Beneficiary')</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>

                                @forelse($transactions as $trx)
                                <tr>
                                    <td>
                                        <strong>{{ $trx->trx }}</strong>
                                    </td>

                                    <td>
                                        {{ showDateTime($trx->created_at) }}<br>{{ diffForHumans($trx->created_at) }}
                                    </td>

                                    <td class="budget">
                                        <span
                                            class="fw-bold @if ($trx->trx_type == '+') text--success @else text--danger @endif">
                                            {{ $trx->trx_type }} {{ showAmount($trx->amount) }}
                                            {{ $general->cur_text }}
                                        </span>
                                    </td>

                                    <td class="budget">
                                        {{ showAmount($trx->post_balance) }} {{ __($general->cur_text) }}
                                    </td>

                                    <td class="break_line">{{ __($trx->details) }}</td>
                                    <td class="break_line">
                                        @lang('Bank Name '):{{ @$trx->val_1->bank }}<br>
                                        @lang('Account Name '):{{ @$trx->val_1->account_name }}<br>
                                        @lang('Account Number '):{{ @$trx->val_1->account_number }}<br>
                                    </td>
                                </tr>
                                @empty
                                    {!! emptyData2() !!}
                                @endforelse
                                <!-- end row -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>@lang('Trx')</th>
                                    <th>@lang('Transacted')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Post Balance')</th>
                                    <th>@lang('Detail')</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-footer">
                        @if ($transactions->hasPages())
                            <div class="card-footer">
                                {{ $transactions->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- ---------------------
                              end File export
                          ---------------- -->


@endsection
@push('style-lib')
    <link href="{{ asset('assets/thirdparty/css/vendor/datepicker.min.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
<script src="{{ asset('assets/assets/dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>
<script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/assets/dist/js/datatable/datatable-advanced.init.js') }}"></script>

    <script src="{{ asset('assets/thirdparty/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/thirdpary/js/vendor/datepicker.en.js') }}"></script>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            if (!$('.datepicker-here').val()) {
                $('.datepicker-here').datepicker();
            }
        })(jQuery)
    </script>
@endpush
