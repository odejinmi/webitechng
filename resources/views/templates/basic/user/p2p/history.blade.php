@extends($activeTemplate . 'layouts.app')
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
                                    <th>@lang('TRX ID')</th>
                                    <th>@lang('Beneficiary')</th>
                                    <th>@lang('Wallet')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Date')</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>

                                @forelse(@$p2p as $item)
                                    <tr>
                                        <td>{{ $item->trx }}</td>
                                        <td class="break_line">{{ __($item->beneficiary->fullname) }}<br>
                                            <small>{{ __($item->beneficiary->username) }}</small>
                                        </td>
                                        <td class="break_line">
                                            {{ __($item->trx_type) }}</td>
                                        <td>{{ number_format($item->amount, 2) }}</td>
                                        <td>{{ showDateTime($item->created_at) }}</td>

                                    </tr>
                                @empty
                                    {!! emptyData2() !!}
                                @endforelse
                                <!-- end row -->
                                <!-- end row -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>@lang('TRX ID')</th>
                                    <th>@lang('Beneficiary')</th>
                                    <th>@lang('Wallet')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Date')</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-footer">
                        @if ($p2p->hasPages())
                            <div class="card-footer">
                                {{ paginateLinks($p2p) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- ---------------------
                              end File export
                          ---------------- -->
        @endsection

        @push('breadcrumb-plugins')
            <x-search-form placeholder="Search by Trx" />
            <a href="{{ route('user.p2p') }}" class="btn btn-primary">
                <i class="ti ti-plus"></i>
                @lang('New Transfer')
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
        @endpush
