@extends(checkTemplate() . 'layouts.app')
@section('panel')
<div class="tab-pane fsade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab" tabindex="0">
    <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
      <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">@lang('Downlines') <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">{{count($ref)}}</span></h3>
    </div>
    <div class="row">
        @forelse($ref as $data)
      <div class=" col-md-6 col-xl-4">
        <div class="card">
          <div class="card-body p-4 d-flex align-items-center gap-3">
            <img src="{{ getImage(getFilePath('userProfile') . '/' . $data->image, getFileSize('userProfile')) }}" alt="" class="rounded-circle" width="40" height="40">
            <div>
              <h5 class="fw-semibold mb-0">{{ @$data->username }}</h5>
              <span class="fs-2 d-flex align-items-center"><i class="ti ti-calendar text-dark fs-3 me-1"></i>{{ diffForHumans($data->created_at) }}</span>
            </div>
           </div>
        </div>
      </div>
      @empty
      {!!emptyData2()!!}
      @endforelse

    </div>
  </div>

   <!-- Transaction Log -->
   <div class="col-lg-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
          <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold">@lang('Referral Earning Transaction')</h5>
          </div>
        </div>
        <div class="table-respon2sive">
          <table class="table align-middle text-nowrap mb-0">
            <thead>
              <tr class="text-muted fw-semibold">
                <th scope="col" class="ps-0">@lang('TRX')</th>
                <th scope="col">@lang('TRX ID')</th>
                <th scope="col">@lang('Amount')</th>
                <th scope="col">@lang('Balance')</th>
              </tr>
            </thead>
            <tbody class="border-top">
                @forelse($transactions as $data)
                <tr>
                <td class="ps-0">
                  <div class="d-flex align-items-center">
                    <div class="me-2 pe-1">
                      @if($data->trx_type == '-')
                      <div class="p-6 bg-light-danger rounded me-6 d-flex align-items-center justify-content-center">
                          <i class="ti ti-wallet-off text-danger fs-6"></i>
                        </div>
                      @else
                      <div class="p-6 bg-light-success rounded me-6 d-flex align-items-center justify-content-center">
                          <i class="ti ti-wallet text-success fs-6"></i>
                        </div>
                      @endif
                    </div>
                    <div>
                      <h6 class="fw-semibold mb-1">{{$data->remark}}</h6>
                      <p class="fs-2 mb-0 text-muted">{{ diffForHumans($data->created_at) }}</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="mb-0 fs-3">{{$data->trx}}</p>
                </td>
                <td>
                  <span class="badge fw-semibold py-1 w-85 @if($data->trx_type == '-') bg-light-primary text-danger @else bg-light-success text-success @endif">{{ __($general->cur_sym) }}{{ showAmount($data->fee) }}</span>
                </td>
                <td>
                  <p class="fs-3 text-dark mb-0">{{ __($general->cur_sym) }}{{ showAmount($data->post_balance) }}</p>
                </td>
              </tr>
              @empty
              {!!emptyData()!!}
              @endforelse

            </tbody>
          </table>
        </div>
        @if ($transactions->hasPages())
                    <div class="card-footer">
                        {{ $transactions->links() }}
                    </div>
        @endif

      </div>
    </div>
  </div>





@endsection
@push('breadcrumb-plugins')

@endpush
