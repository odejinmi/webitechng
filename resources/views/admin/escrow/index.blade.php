@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12 ">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Escrow Number')</th>
                                    <th>@lang('Title')</th>
                                    <th>@lang('Buyer')</th>
                                    <th>@lang('Seller')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Type')</th>
                                    <th>@lang('Charge')</th>
                                    <th>@lang('Charge Payer')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($escrows as $escrow)
                                    <tr>

                                        <td>{{ $escrow->escrow_number }}</td>
                                        <td>{{ __($escrow->title) }}</td>
                                        <td>
                                            @if ($escrow->buyer)
                                                <span class="fw-bold d-block">{{ __(@$escrow->buyer->fullname) }}</span>

                                                <span class="small">
                                                    <a href="{{ route('admin.users.detail', $escrow->buyer->id) }}">
                                                        <span>@</span>{{ __(@$escrow->buyer->username) }}
                                                    </a>
                                                </span>
                                            @else
                                                {{ $escrow->invitation_mail }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($escrow->seller)
                                                <span class="fw-bold d-block">{{ __($escrow->seller->fullname) }}</span>
                                                <span class="small">
                                                    <a href="{{ route('admin.users.detail', $escrow->seller->id) }}">
                                                        <span>@</span>{{ __($escrow->seller->username) }}
                                                    </a>
                                                </span>
                                            @else
                                                {{ $escrow->invitation_mail }}
                                            @endif
                                        </td>
                                        <td>{{ $general->cur_sym }}{{ showAmount($escrow->amount) }}</td>
                                        <td>{{ $escrow->category->name }}</td>
                                        <td>{{ $general->cur_sym }}{{ showAmount($escrow->charge) }}</td>
                                        <td>
                                            @if ($escrow->charge_payer == Status::CHARGE_PAYER_SELLER)
                                                <span class="badge bg-primary">@lang('Seller')</span>
                                            @elseif($escrow->charge_payer == Status::CHARGE_PAYER_BUYER)
                                                <span class="badge bg-dark">@lang('Buyer')</span>
                                            @else
                                                <span class="badge bg-success">@lang('50%-50%')</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php echo $escrow->escrowStatus @endphp
                                        </td>
                                        <td>
                                            @can(['admin.escrow.details*'])
                                            <a href="{{ route('admin.escrow.details', $escrow->id) }}" class="btn btn-sm btn-outline--primary">
                                                <i class="las la-desktop"></i> @lang('Details')
                                            </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($escrows->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($escrows) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Title / Category name" />
@endpush
