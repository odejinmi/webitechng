@extends(checkTemplate() . 'layouts.app')
@section('panel')

@push('style')
<link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
@endpush

    <div class="header-nav">
        <x-search-form placeholder="Loan No.| Plan" btn="btn-primary" />

    </div>
    <br>
    <div class="table-responsive">
        <table
          id="file_export"
          class="table border table-striped table-bordered display text-nowrap"
        >
            <thead>
                <tr>
                    <th>@lang('S.N.')</th>
                    <th>@lang('Loan No. | Plan')</th>
                    <th>@lang('Amount')</th>
                    <th>@lang('Installment Amount')</th>
                    <th>@lang('Installment')</th>
                    <th>@lang('Next Installment')</th>
                    <th>@lang('Paid')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Action')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr>
                        <td>{{ __($loop->index + $loans->firstItem()) }}</td>

                        <td>
                            <div>
                                <span>{{ __($loan->loan_number) }}</span>
                                <br>
                                <small class="text--base">{{ __($loan->plan->name) }}</small>
                            </div>
                        </td>

                        <td>
                            <div>
                                <span>{{ $general->cur_sym . showAmount($loan->amount) }}</span>
                                <br>
                                <small class="text--base">
                                    {{ $general->cur_sym . showAmount($loan->payable_amount) }} @lang('Need to pay')
                                </small>
                            </div>
                        </td>

                        <td>
                            <div>
                                <span>{{ $general->cur_sym . showAmount($loan->per_installment) }}</span>
                                <br>
                                <small class="text--base">
                                    @lang('In Every') {{ __($loan->installment_interval) }} @lang('Days')
                                </small>
                            </div>
                        </td>

                        <td>
                            <div>
                                <span> @lang('Total') : {{ __($loan->total_installment) }}</span>
                                <br>
                                <small class="text--base">
                                    @lang('Given') : {{ __($loan->given_installment) }}
                                </small>
                            </div>
                        </td>
                        <td>
                            @if ($loan->nextInstallment)
                                {{ showDateTime($loan->nextInstallment->installment_date, 'd M, Y') }}
                            @endif
                        </td>

                        <td>
                            <div>
                                <span>{{ $general->cur_sym . showAmount($loan->paid_amount) }}</span>
                                <br>
                                <span class="text--warning">
                                    @php $remainingAmount = $loan->payableAmount - $loan->paid_amount;  @endphp
                                    <small> {{ $general->cur_sym . showAmount($remainingAmount) }} @lang('Remaining')</small>
                                </span>
                            </div>
                        </td>

                        <td>
                            <div>
                                @php echo $loan->statusBadge; @endphp
                                @if ($loan->status == 3)
                                    <span class="admin-feedback" data-feedback="{{ __($loan->admin_feedback) }}">
                                        <i class="la la-info-circle"></i>
                                    </span>
                                @endif
                            </div>
                        </td>

                        <td>
                            <a class="btn btn-primary btn--sm @disabled(!$loan->nextInstallment)" href="{{ route('user.loan.instalment.logs', $loan->loan_number) }}">
                                <i class="las la-wallet"></i> @lang('Installments')
                            </a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td class="text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($loans->hasPages())
        <div class="mt-4">
            {{ paginateLinks($loans) }}
        </div>
    @endif
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.admin-feedback').on('click', function() {
                var modal = $('#adminFeedback');
                modal.find('.modal-body').text($(this).data('feedback'));
                modal.modal('show');
            });

        })(jQuery);
    </script>
@endpush

@push('bottom-menu')
    <div class="col-12 order-lg-3 order-4">
        <div class="d-flex nav-buttons flex-align gap-md-3 gap-2">
            <a href="{{ route('user.loan.plans') }}" class="btn btn-outline--base">@lang('Loan Plans')</a>
            <a href="{{ route('user.loan.list') }}" class="btn btn--base active">@lang('My Loan List')</a>
        </div>
    </div>
@endpush

@push('modal')
    <!-- Modal -->
    <div class="modal fade" id="adminFeedback">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Reason of Rejection')!</h5>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn--dark" data-bs-dismiss="modal" type="button">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('script')
<script src="{{ asset('assets/assets/dist/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('assets/assets/dist/js/datatable/datatable-advanced.init.js')}}"></script>

@endpush

@push('breadcrumb-plugins')

    <div class="col-12 order-lg-3 order-4">
        <div class="d-flex nav-buttons flex-align gap-md-3 gap-2">
            <a href="{{ route('user.loan.plans') }}" class="btn btn-info active">@lang('Loan Plans')</a>
        </div>
    </div>
@endpush
@push('style')
    <style>
        .btn[type=submit] {
            height: unset !important;
        }

        .btn {
            padding: 12px 1.875rem;
        }
    </style>
@endpush
