@extends($activeTemplate . 'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')

<section>
    <div class="container">

        <div class="row align-items-center justify-content-center mt-4">
            <div class="col-xl-7 col-lg-7 col-md-11 mb-3">
                <div class="sec-heading text-center">
                    <div class="label text-success bg-light-success d-inline-flex rounded-4 mb-2 font--medium"><span>@lang('Choose Rate')</span></div>
                    <h2 class="mb-1">@lang('Our Competitive Rates')</h2>
                    <p class="test-muted fs-6">@lang('Please find below our juicy rates')</p>
                  </div>
            </div>
        </div>

        <div class="row justify-content-center g-lg-4 g-md-2 g-4">
            @foreach($coins as $data)
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card border-0 gray-simple rounded-4 p-lg-4 p-3">
                    <div class="prcs-headlines text-center py-3">
                        <h4 class="mb-1">{{$data->name}}</h4>
                        <p class="mb-0">{{$data->symbol}}</p>
                    </div>
                    <div class="prcs-currency text-center py-3">
                        <div class="my-4">
                            <img src="{{url('/')}}/assets/images/coins/{{$data->image}}" alt="" class="img-fluid" width="80" height="80">
                          </div>
                    </div>
                    <div class="prcs-body bg-white py-4 px-lg-4 px-md-2 px-4 rounded-3">
                        <div class="prcs-list mb-3">
                            <ul class="p-0 m-0">
                                <li class="py-2 font--medium"><i class="fa-regular fa-circle-check text-primary me-2"></i>Min Amount: {{number_format($data->minimum_amount,2)}}USD</li>
                                <li class="py-2 font--medium"><i class="fa-regular fa-circle-check text-primary me-2"></i>Max Amount: {{number_format($data->maximum_amount,2)}}USD</li>
                                <li class="py-2 font--medium"><i class="fa-regular  @if($data->buy_rate > 0) fa-circle-check text-primary @else  fa fa-x text-danger @endif me-2"></i>@lang('Buy Rate'): {{number_format($data->buy_rate,2)}}{{$general->cur_text}}</li>
                                <li class="py-2 font--medium"><i class="fa-regular  @if($data->sell_rate > 0) fa-circle-check text-primary @else  fa fa-x text-danger @endif me-2"></i>@lang('Sell Rate'): {{number_format($data->sell_rate,2)}}{{$general->cur_text}}</li>
                                <li class="py-2 font--medium"><i class="fa-regular   @if($data->swap_rate > 0) fa-circle-check text-primary @else  fa fa-x text-danger @endif  me-2"></i>@lang('Swap Rate'): {{number_format($data->swap_rate,2)}}{{$general->cur_text}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>


        <div class="row justify-content-center g-lg-4 g-md-2 g-4">
            @foreach($giftcards as $data)
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card border-0 gray-simple rounded-4 p-lg-4 p-3">
                    <div class="prcs-headlines text-center py-3">
                        <h4 class="mb-1">{{$data->name}}</h4>
                        <p class="mb-0">{{$data->symbol}}</p>
                    </div>
                    <div class="prcs-currency text-center py-3">
                        <div class="my-4">
                            <img src="{{asset('assets/images/giftcards')}}/{{$data->image}}" alt="" class="img-fluid" width="80" height="80">
                          </div>
                    </div>
                    @forelse($data->types as $type)
                    <div class="prcs-body bg-white py-4 px-lg-4 px-md-2 px-4 rounded-3">
                        <div class="prcs-list mb-3">
                            <ul class="p-0 m-0">

                                <li class="py-2 font--medium"><i class="fa-regular fa-circle-check text-primary me-2"></i>Name: {{$type->name}}</li>
                                <li class="py-2 font--medium"><i class="fa-regular fa-circle-check text-primary me-2"></i>Sell Rate: {{number_format($type->sell_rate,2)}}{{$general->cur_text}}</li>
                                <li class="py-2 font--medium"><i class="fa-regular fa-circle-check text-primary me-2"></i>Buy Rate: {{number_format($type->buy_rate,2)}}{{$general->cur_text}}</li>

                            </ul>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-danger">
                        There is not card type at the moment.
                    </div>
                    @endforelse
                </div>
            </div>
            @endforeach

        </div>

    </div>
</section>

@endsection
