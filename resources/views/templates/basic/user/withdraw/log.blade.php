@extends(checkTemplate() . 'layouts.app')
@section('panel')
    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    @endpush
    <!-- File export -->
    <div class="row">
        <div class="col-12">
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
                                    <th>@lang('Gateway')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Charge')</th>
                                    <th>@lang('Rate')</th>
                                    <th>@lang('Receivable')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Time')</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>

                                @forelse(@$withdraws as $data)
                                    <tr>
                                        <td data-label="#@lang('Trx')">{{ $data->trx }}</td>
                                        <td data-label="@lang('Gateway')">{{ __($data->method->name) }}</td>
                                        <td data-label="@lang('Amount')">
                                            <strong>{{ showAmount($data->amount) }} {{ __($general->cur_text) }}</strong>
                                        </td>
                                        <td data-label="@lang('Charge')" class="text-danger">
                                            {{ showAmount($data->charge) }} {{ __($general->cur_text) }}
                                        </td>
                                        <td data-label="@lang('Rate')">
                                            {{ showAmount($data->rate) }} {{ __($data->currency) }}
                                        </td>
                                        <td data-label="@lang('Receivable')" class="text--base">
                                            <strong>{{ showAmount($data->final_amount) }}
                                                {{ __($data->currency) }}</strong>
                                        </td>
                                        <td data-label="@lang('Status')">
                                            @if ($data->status == 2)
                                                <span class="badge bg-warning">@lang('Pending')</span>
                                            @elseif($data->status == 1)
                                                <span class="badge bg-success">@lang('Completed')</span>
                                                <button class="btn btn-info btn-rounded  badge approveBtn"
                                                    data-admin_feedback="{{ $data->admin_feedback }}"><i
                                                        class="fa fa-info"></i></button>
                                            @elseif($data->status == 3)
                                                <span class="badge bg-danger">@lang('Rejected')</span>
                                                <button class="btn btn-info btn-rounded badge approveBtn"
                                                    data-admin_feedback="{{ $data->admin_feedback }}"><i
                                                        class="fa fa-info"></i></button>
                                            @endif

                                        </td>
                                        <td data-label="@lang('Time')">
                                            {{ showDateTime($data->created_at) }}
                                        </td>
                                    </tr>
                                @empty
                                    {!! emptyData2() !!}
                                @endforelse
                                <!-- end row -->
                                <!-- end row -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>@lang('Trx')</th>
                                    <th>@lang('Gateway')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Charge')</th>
                                    <th>@lang('Rate')</th>
                                    <th>@lang('Receivable')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Time')</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $withdraws->links() }}
                    </div>
                </div>
            </div>
            <!-- ---------------------
                                  end File export
                              ---------------- -->




            {{-- Detail MODAL --}}
            <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">@lang('Details')</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="withdraw-detail"></div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger"
                                data-bs-dismiss="modal">@lang('Close')</button>
                        </div>
                    </div>
                </div>
            </div>
        @endsection

        @push('breadcrumb-plugins')
            <a href="{{ route('user.withdraw') }}" class="btn btn-outline-primary">
                <i class="las la-plus"></i>
                @lang('Request Payout')
            </a>
        @endpush
        @push('script')
            <script src="{{ asset('assets/assets/dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js') }}"></script>
            <script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js') }}"></script>
            <script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>
            <script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js') }}"></script>
            <script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js') }}"></script>
            <script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js') }}"></script>
            <script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js') }}"></script>
            <script src="{{ asset('assets/assets/dist/js/datatable/datatable-advanced.init.js') }}"></script>

            <script>
                (function($) {
                    "use strict";
                    $('.approveBtn').on('click', function() {
                        var modal = $('#detailModal');
                        var feedback = $(this).data('admin_feedback');
                        feedback = feedback ? feedback : 'Data Not Found';
                        modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                        modal.modal('show');
                    });
                })(jQuery);
            </script>
        @endpush
