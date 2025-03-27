@extends($activeTemplate . 'layouts.app')
@section('panel')
<div class="d-flex gap-2 scrollable-x py-3 px-7 border-bottom">
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
                                  <option value="+" @selected(request()->trx_type == '+')>
                                    @lang('Plus')</option>
                                  <option value="-" @selected(request()->trx_type == '-')>
                                    @lang('Minus')</option>
                                </select>
                              </div>
                              <div class="flex-grow-1">
                                <label>@lang('Remark')</label>
                                <select class="form-control" name="remark">
                                  <option value="">@lang('Any')</option>
                                  @foreach ($remarks as $remark)
                                  <option value="{{ $remark->remark }}" @selected(request()->remark == $remark->remark)>
                                    {{ __(keyToTitle($remark->remark)) }}
                                  </option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="flex-grow-1">
                                <label>@lang('Date')</label>
                                <input class="datepicker-here form-control" name="date" data-range="true"
                                  data-multiple-dates-separator=" - " data-language="en" data-position='bottom right'
                                  type="text" value="{{ request()->date }}" placeholder="@lang('Start date - End date')"
                                  autocomplete="off">
                              </div>
                              <div class="flex-grow-1 align-self-end">
                                <button class="btn btn-primary btn-sm w-100 h-45 "><i class="ti ti-search"></i>
                                  @lang('Filter')</button>
                              </div>
                            </div>
                          </form>
                    </div>

                    
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-sm table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="d-flex align-items-center gap-2 ps-1">
                                            <div class="text-base"> 
                                            </div><span>Remark</span>
                                        </div>
                                    </th>
                                    <th scope="col">TRX</th>
                                    <th scope="col">Fee</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col" class="d-none d-xl-table-cell">Date</th>
                                    <th scope="col" class="d-none d-xl-table-cell">Status</th>
                                    <th scope="col" class="d-none d-xl-table-cell">Required Action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                 @forelse($transactions as $data)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3 ps-1"> 
                                            
                                            <div class="d-none d-xl-inline-flex icon icon-shape w-rem-8 h-rem-8 rounded-circle text-sm @if ($data->trx_type == '+') bg-success text-success @else  bg-danger text-danger @endif bg-opacity-25 ">
                                                @if ($data->trx_type == '+') <i class="bi bi-download"></i> @else <i class="bi bi-upload"></i> @endif
                                                
                                            </div>
                                            <div><span class="d-block text-heading fw-bold">{{ $data->remark }}</span></div>
                                        </div>
                                    </td>
                                    <td class="text-xs">{{ ($data->trx) }}</td>
                                    <td>{{ __($general->cur_sym) }}{{ showAmount($data->charge) }}</td>
                                    <td>{{ __($general->cur_sym) }}{{ showAmount($data->amount) }}</td>
                                    <td class="d-none d-xl-table-cell">{{ showDate($data->created_at) }}</td>
                                    <td class="d-none d-xl-table-cell">
                                        <span class="badge badge-lg badge-dot"><i class="@if ($data->trx_type == '+') bg-success @else bg-danger @endif"></i>@if ($data->trx_type == '+') Credit @else Debit @endif</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell">{{$data->details}}</td>
                                    <td class="text-end">
                                        <a href="{{route('user.transaction.receipt',$data->trx)}}" class="btn btn-sm btn-square btn-neutral w-rem-6 h-rem-6"><i class="bi bi-printer"></i></a>
                                    </td>
                                </tr>
                                @empty
                                {!! emptyData() !!}
                                @endforelse
                                 
                            </tbody>
                        </table>
                    </div>
                    @if ($transactions->hasPages())
                    <div class="py-4 px-6">
                        <div class="row align-items-center justify-content-between"> 
                            <div class="col-md-auto">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pagination-spaced gap-1">
                                       {{ $transactions->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    @endif
                    
@endsection
