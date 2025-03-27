@extends(checkTemplate() . 'layouts.app')
@section('panel')

<!--  BEGIN CONTENT AREA  -->

 <div>
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-body">

<div id="content" class="main-content">
    <div class="layout-px-spacing">


        <div class="fq-header-wrapper mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 align-self-center order-md-0 order-1">
                        <div class="faq-header-content">
                            <h4 class="mb-4 mt-4">{{$pageTitle}}</h4>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="faq container">

            <div class="faq-layouting layout-spacing">

                <div class="kb-widget-section">

                    <div class="row justify-content-center">
                        @foreach($currency as $gate)

                        <div class="col-xxl-2 col-xl-3 col-lg-3 mb-lg-0 col-md-6 mb-3">
                            @if(Route::is('user.sellgift') )
                            <a href="{{ route('user.selectgiftcardsell' , $gate->id) }}" class="nk-file-link">
                            @else
                            <a href="{{ route('user.selectgiftcardbuy' , $gate->id) }}" class="nk-file-link">
                            @endif
                            <div class="card mb-3">
                                <div class="card-body">
                                    <center>
                                    <div class="card-icon mb-4">
                                        <img src="{{asset('assets/images/giftcards')}}/{{$gate->image}}" width="100">
                                    </div>
                                    <h5 class="card-title mb-0">{{$gate->name}}</h5>
                                    </center>
                                </div>
                            </div>
                        </a>
                        </div>
                        @endforeach



                    </div>

                </div>



            </div>
        </div>

    </div>
</div>
            </div>
         </div>
      </div>
   </div>



@stop

@push('breadcrumb')
@if(Route::is('user.sellgift') )
<a class="btn btn-sm btn-primary" href="{{ route('user.sellcardlog') }}"> <i class="ti ti-printer"></i> @lang('Giftcard Log')</a>
@else
<a class="btn btn-sm btn-primary" href="{{ route('user.buycardlog') }}"> <i class="ti ti-printer"></i> @lang('Giftcard Log')</a>
@endif
@endpush
