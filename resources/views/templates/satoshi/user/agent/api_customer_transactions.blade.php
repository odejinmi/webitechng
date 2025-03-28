@extends($activeTemplate . 'layouts.app')
@section('panel')
    <!-- File export -->
    <div class="row">
        <div class="col-12">

            <div class="card responsive-filter-card mb-4">
                <div class="card-body mb-4">
                    <form action="">
                        <div class="d-flex flex-wrap gap-4">
                            <div class="flex-grow-1">
                                <label>@lang('TRX')</label>
                                <input class="form-control" name="search" type="text" value="{{ request()->search }}">
                            </div>
                            <div class="flex-grow-1">
                                <label>@lang('Type')</label>
                                <select class="form-control" name="trx_type">
                                    <option value="">@lang('All')</option>
                                    <option value="+" @selected(request()->trx_type == '+')>@lang('Plus')</option>
                                    <option value="-" @selected(request()->trx_type == '-')>@lang('Minus')</option>
                                </select>
                            </div>
                            <div class="flex-grow-1">
                                <label>@lang('Remark')</label>
                                <select class="form-control" name="remark">
                                    <option value="">@lang('Any')</option>
                                    @foreach ($remarks as $remark)
                                        <option value="{{ $remark->remark }}" @selected(request()->remark == $remark->remark)>
                                            {{ __(keyToTitle($remark->remark)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex-grow-1">
                                <label>@lang('Date')</label>
                                <input class="datepicker-here form-control" name="date" data-range="true" data-multiple-dates-separator=" - " data-language="en" data-position='bottom right' type="text" value="{{ request()->date }}" placeholder="@lang('Start date - End date')" autocomplete="off">
                            </div>
                            <div class="flex-grow-1 align-self-end">
                                <button class="btn btn-primary w-100 btn-sm h-45"><i class="ti ti-search"></i>
                                    @lang('Filter')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ---------------------
                              start File export
                          ---------------- -->

                          <div class="row">
                            <div class="col-md-6">
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex flex-row">
                                    <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center text-bg-success">
                                      <i class="ti ti-credit-card fs-6"></i>
                                    </div>
                                    <div class="ms-3 align-self-center">
                                      <h4 class="mb-0 fs-5">Transaction Value</h4>
                                      <span>Total Collection</span>
                                    </div>
                                    <div class="ms-auto align-self-center">
                                      <h2 class="fs-7 mb-0">{{$general->cur_sym}}{{number_format($total,2)}}</h2>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>


                            <div class="col-md-6">
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex flex-row">
                                    <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center text-bg-success">
                                      <i class="ti ti-box fs-6"></i>
                                    </div>
                                    <div class="ms-3 align-self-center">
                                      <h4 class="mb-0 fs-5">Transaction Count</h4>
                                      <span>Total Collection</span>
                                    </div>
                                    <div class="ms-auto align-self-center">
                                      <h2 class="fs-7 mb-0">{{$count}}</h2>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>

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
                                    <th>@lang('Detail')</th>
                                    <td>Webhook</td>
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
                                    <td>
                                    <button class="btn me-1 mb-1 bg-primary-subtle text-primary px-4 fs-4 " data-bs-toggle="modal" data-bs-target="#bs-example-modal-md{{$trx->trx}}">
                                    View
                                  </button>
                                  <!-- sample modal content -->
                                  <div id="bs-example-modal-md{{$trx->trx}}" class="modal fade" tabindex="-1" aria-labelledby="bs-example-modal-md" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                      <div class="modal-content">
                                        <div class="modal-header d-flex align-items-center">
                                          <h4 class="modal-title" id="myModalLabel">
                                            Webhook Response
                                          </h4>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <code>
                                              {{$trx->webhook}}
                                          </code>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn bg-danger-subtle text-danger  waves-effect" data-bs-dismiss="modal">
                                            Close
                                          </button>
                                        </div>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
                                </div>
                                <div>
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
