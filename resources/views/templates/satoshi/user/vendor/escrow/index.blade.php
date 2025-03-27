@extends(checkTemplate() . 'layouts.app')
@section('panel')

@push('style')
<link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
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
                        <h5 class="mb-0">{{$pageTitle}}</h5>
                      </div>
                      <p class="card-subtitle mb-3">
                        @lang('A table showing all the ') {{$pageTitle}} @lang('on your account. You can export transaction record')
                      </p>
                      <div class="table-responsive">

                        <table
                        id="file_export"
                        class="table border table-striped table-bordered display text-nowrap"
                      >                        <thead>
                            <tr>
                                <th>@lang('Escrow Number')</th>
                                <th>@lang('Title')</th>
                                <th>@lang('Buyer - Seller')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Category')</th>
                                <th>@lang('Charge')</th>
                                <th>@lang('Charge Payer')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($escrows as $escrow)
                                <tr>
                                    <td>{{ $escrow->escrow_number }}</td>
                                    <td>{{ __($escrow->title) }}</td>
                                    <td>
                                        @lang('I\'m') @if ($escrow->buyer_id == auth()->user()->id)
                                            @lang('buying from')
                                            {{ __(@$escrow->seller->username ?? $escrow->invitation_mail) }}
                                        @else
                                            @lang('selling to')
                                            {{ __(@$escrow->buyer->username ?? $escrow->invitation_mail) }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $general->cur_sym }}{{ showAmount($escrow->amount) }}</td>
                                    <td>{{ @$escrow->category->name ?? 'N/A' }}</td>
                                    <td>
                                        {{ $general->cur_sym }}{{ showAmount($escrow->charge) }}</td>
                                    <td>
                                        @if ($escrow->charge_payer == Status::CHARGE_PAYER_SELLER)
                                            <span class="badge bg-primary text-white">@lang('Seller')</span>
                                        @elseif($escrow->charge_payer == Status::CHARGE_PAYER_BUYER)
                                            <span class="badge bg-info text-white">@lang('Buyer')</span>
                                        @else
                                            <span class="badge bg-success text-white">@lang('50%-50%')</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php echo $escrow->escrowStatus @endphp
                                    </td>
                                    <td>
                                        <a href="{{ route('user.escrow.details', $escrow->id) }}" class="btn btn-sm btn-primary btn-sm detailBtn "><i class="ni ni-desktop"></i> @lang('Details')</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($escrows->hasPages())
                    <div class="mt-5">
                        {{ $escrows->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection


@push('breadcrumb-plugins')
    <x-search-form placeholder="Search by Trx" />
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
