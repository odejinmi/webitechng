@extends($activeTemplate . 'layouts.app')
@section('panel')
<div class="row justify-content-center">
    <div class="col-lg-6 text-center">
      <h2 class="fw-bolder mb-0 fs-8 lh-base">@lang('Find below our asset trading pricing plan')</h2>
    </div>
  </div>

  <div class="row">

    @foreach($coins as $data)
    <div class="col-sm-6 col-lg-4">
      <div class="card">
        <div class="card-body pt-6">
          <span class="fw-bolder text-uppercase fs-2 d-block mb-7">{{$data->name}}</span>
          <div class="my-4">
            <img src="{{url('/')}}/assets/images/coins/{{$data->image}}" alt="" class="img-fluid" width="80" height="80">
          </div>
          <div class="d-flex mb-3">
             <h4 class="fw-bolder fs-6 ms-2 mb-0">{{$data->symbol}}</h4>
          </div>
          <ul class="list-unstyled mb-7">
            <li class="d-flex align-items-center gap-2 py-2">
              <i class="ti ti-check text-primary fs-4"></i>
              <span class="text-dark">Min Amount: {{number_format($data->minimum_amount,2)}}USD</span>
            </li>
            <li class="d-flex align-items-center gap-2 py-2">
              <i class="ti ti-check text-primary fs-4"></i>
              <span class="text-dark">Max Amount: {{number_format($data->maximum_amount,2)}}USD</span>
            </li>
            <li class="d-flex align-items-center gap-2 py-2">
                @if($data->buy_rate > 0)
                <i class="ti ti-check text-success fs-4"></i>
                @else
                <i class="ti ti-x text-danger fs-4"></i>
                @endif
              <span class="text-dark">@lang('Buy Rate'): {{number_format($data->buy_rate,2)}}{{$general->cur_text}}</span>
            </li>
            <li class="d-flex align-items-center gap-2 py-2">
                @if($data->sell_rate > 0)
                <i class="ti ti-check text-success fs-4"></i>
                @else
                <i class="ti ti-x text-danger fs-4"></i>
                @endif
              <span class="text-dark">@lang('Sell Rate'): {{number_format($data->sell_rate,2)}}{{$general->cur_text}}</span>
            </li>
            <li class="d-flex align-items-center gap-2 py-2">
              @if($data->swap_rate > 0)
              <i class="ti ti-check text-primary fs-4"></i>
              @else
              <i class="ti ti-x text-danger fs-4"></i>
              @endif
              <span class="text-dark">@lang('Swap Rate'): {{number_format($data->swap_rate,2)}}{{$general->cur_text}}</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    @endforeach

  </div>
@endsection

    @push('breadcrumb-plugins')

    @endpush
    @push('script')
    @endpush
