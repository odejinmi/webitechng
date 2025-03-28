@extends($activeTemplate . 'layouts.app')
@section('panel')
<div class="tab-pane fsade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab" tabindex="0">
    <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
      <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">@lang('Total Customers') <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">{{count($customers)}}</span></h3>
    </div>

  </div>

   <!-- Transaction Log -->
   <div class="col-lg-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
          <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold">@lang('Customers Transaction')</h5>
          </div>
        </div>
        <div class="table-respon2sive">
          <table class="table align-middle text-nowrap mb-0">
            <thead>
              <tr class="text-muted fw-semibold">
                <th scope="col" class="ps-0">@lang('Customer ID')</th>
                <th scope="col">@lang('Customer Email')</th>
                <th scope="col">@lang('Customer Phone')</th>
                <th scope="col">@lang('Customer Name')</th>
                <th scope="col">@lang('Account Number')</th>
                <th scope="col">@lang('Bank Name')</th>
                <th scope="col">@lang('Date Created')</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="border-top">
                @forelse($customers as $data)
                <tr>
                <td class="ps-0">
                      <h6 class="fw-semibold mb-1">{{$data->customer_id}}</h6>
                </td>
                <td class="ps-0">
                      <h6 class="fw-semibold mb-1">{{$data->email}}</h6>
                </td>
                <td class="ps-0">
                      <h6 class="fw-semibold mb-1">{{$data->phone}}</h6>
                </td>
                <td>
                  <p class="mb-0 fs-3">{{$data->account_name}}</p>
                </td>
                <td>
                  <p class="mb-0 fs-3">{{$data->account_number}}</p>
                </td>
                <td>
                  <p class="mb-0 fs-3">{{$data->bank_name}}</p>
                </td>

                <td class="ps-0">
                      <p class="fs-2 mb-0 text-muted">{{ ($data->created_at) }}</p>
                      <p class="fs-2 mb-0 text-muted">{{ diffForHumans($data->created_at) }}</p>
                </td>
                <td><a class="btn btn-sm btn-primary" href="{{route('user.api.customer.transactions',$data->customer_id)}}">View Transactions</a></td>
              </tr>
              @empty
              {!!emptyData()!!}
              @endforelse

            </tbody>
          </table>
        </div>
        @if ($customers->hasPages())
                    <div class="card-footer">
                        {{ $customers->links() }}
                    </div>
        @endif

      </div>
    </div>
  </div>





@endsection
@push('breadcrumb-plugins')

@endpush
