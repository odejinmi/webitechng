@extends($activeTemplate . 'layouts.app')
@section('panel')
<div class="row">
    <!-- Weekly Stats -->
    <div class="col-lg-4 d-flex align-items-strech">
      <div class="card w-100">
        <div class="card-body">
          <h5 class="card-title fw-semibold">Weekly Stats</h5>
          <p class="card-subtitle mb-0">Average sales</p>
          <div id="stats" class="my-4"></div>

          <div class="position-relative">
            <div class="d-flex align-items-center justify-content-between mb-7">
 

              <div class="d-flex">
                <div class="p-6 bg-light-primary rounded me-6 d-flex align-items-center justify-content-center">
                  <i class="ti ti-grid-dots text-primary fs-6"></i>
                </div>
                <div>
                  <h6 class="mb-1 fs-4 fw-semibold">@lang('Request Amount')</h6>
                  <p class="fs-3 mb-0"></p>
                </div>
              </div>
              <div class="bg-light-primary badge">
                <p class="fs-3 text-primary fw-semibold mb-0">{{showAmount($withdraw->amount)  }} {{__($general->cur_text)}}</p>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-7">
              <div class="d-flex">
                <div class="p-6 bg-light-success rounded me-6 d-flex align-items-center justify-content-center">
                  <i class="ti ti-grid-dots text-success fs-6"></i>
                </div>
                <div>
                  <h6 class="mb-1 fs-4 fw-semibold">@lang('Payout Charge')</h6>
                  <p class="fs-3 mb-0"></p>
                </div>
              </div>
              <div class="bg-light-success badge">
                <p class="fs-3 text-success fw-semibold mb-0">{{showAmount($withdraw->charge) }} {{__($general->cur_text)}}</p>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-7">
                <div class="d-flex">
                <div class="p-6 bg-light-danger rounded me-6 d-flex align-items-center justify-content-center">
                  <i class="ti ti-grid-dots text-danger fs-6"></i>
                </div>
                <div>
                  <h6 class="mb-1 fs-4 fw-semibold">@lang('After Charge')</h6>
                  <p class="fs-3 mb-0"></p>
                </div>
              </div>
              <div class="bg-light-danger badge">
                <p class="fs-3 text-danger fw-semibold mb-0">{{showAmount($withdraw->after_charge) }} {{__($general->cur_text)}}</p>
              </div>
            </div>


            <div class="d-flex align-items-center justify-content-between mb-7">
                <div class="d-flex">
                  <div class="p-6 bg-light-danger rounded me-6 d-flex align-items-center justify-content-center">
                    <i class="ti ti-grid-dots text-danger fs-6"></i>
                  </div>
                  <div>
                    <h6 class="mb-1 fs-4 fw-semibold">@lang('Conversion Rate')</h6>
                    <p class="fs-3 mb-0"></p>
                  </div>
                </div>
                <div class="bg-light-danger badge">
                  <p class="fs-3 text-danger fw-semibold mb-0">1 {{__($general->cur_text)}} = {{showAmount($withdraw->rate)  }} {{__($withdraw->currency)}}</p>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-7">
                <div class="d-flex">
                  <div class="p-6 bg-light-danger rounded me-6 d-flex align-items-center justify-content-center">
                    <i class="ti ti-grid-dots text-danger fs-6"></i>
                  </div>
                  <div>
                    <h6 class="mb-1 fs-4 fw-semibold">@lang('What You Get')</h6>
                    <p class="fs-3 mb-0"></p>
                  </div>
                </div>
                <div class="bg-light-danger badge">
                  <p class="fs-3 text-danger fw-semibold mb-0">{{showAmount($withdraw->final_amount) }} {{__($withdraw->currency)}}</p>
                </div>
            </div>


          </div>
        </div>
      </div>
    </div>


    <!-- Top Performers -->
    <div class="col-lg-8 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold">{{$withdraw->method->name}}</h5>
                <p class="card-subtitle mb-0">{!!$withdraw->method->description!!}</p>
              </div>
              <div>
                <img width="50" src="{{getImage(imagePath()['withdraw']['method']['path'].'/'. $withdraw->method->image,imagePath()['withdraw']['method']['size'])}}">

              </div>
            </div>
            <form action="{{route('user.withdraw.submit')}}" method="post" enctype="multipart/form-data">
                @csrf
                @if($withdraw->method->user_data)
                @foreach($withdraw->method->user_data as $k => $v)
                    @if($v->type == "text")
                        <div class="form-group mb-3">
                            <label><strong>{{strtoUpper($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                            <input type="text" name="{{$k}}" class="form-control" value="{{old($k)}}" placeholder="{{__($v->field_level)}}" @if($v->validation == "required") required @endif>
                            @if ($errors->has($k))
                                <span class="text-danger">{{ __($errors->first($k)) }}</span>
                            @endif
                        </div>
                    @elseif($v->type == "textarea")
                        <div class="form-group mb-3">
                            <label><strong>{{strtoUpper($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                            <textarea name="{{$k}}"  class="form-control"  placeholder="{{__($v->field_level)}}" rows="3" @if($v->validation == "required") required @endif>{{old($k)}}</textarea>
                            @if ($errors->has($k))
                                <span class="text-danger">{{ __($errors->first($k)) }}</span>
                            @endif
                        </div>
                    @elseif($v->type == "file")
                        <label><strong>{{strtoUpper($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                        <div class="form-group mb-3">
                            <div class="fileinput fileinput-new " data-provides="fileinput">
                                <div class="fileinput-new thumbnail withdraw-thumbnail"
                                     data-trigger="fileinput">
                                    <img class="w-100" src="{{ getImage('/')}}" alt="@lang('Image')">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail wh-200-150"></div>
                                <div class="img-input-div">
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new "> @lang('Select') {{__($v->field_level)}}</span>
                                        <span class="fileinput-exists"> @lang('Change')</span>
                                        <input type="file" class="form-control" name="{{$k}}" accept="image/*" @if($v->validation == "required") required @endif>
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists"
                                    data-dismiss="fileinput"> @lang('Remove')</a>
                                </div>
                            </div>
                            @if ($errors->has($k))
                                <br>
                                <span class="text-danger">{{ __($errors->first($k)) }}</span>
                            @endif
                        </div>
                    @endif
                @endforeach
                @endif

                <button type="submit" class="btn w-100 btn-block btn-primary mt-3" id="btn-confirm">@lang('Confirm')</button></li>
 
            </form>
          </div>
        </div>
      </div>


</div>

 
@endsection


@push('script-lib')
<script src="{{asset($activeTemplateTrue.'/js/bootstrap-fileinput.js')}}"></script>
@endpush
@push('style-lib')
<link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/bootstrap-fileinput.css')}}">
@endpush

@push('script')
<script>

    (function($){

        "use strict";

            $('.withdraw-thumbnail').hide();

            $('.clickBtn').on('click', function() {

                var classNmae = $('.fileinput').attr('class');

                if(classNmae != 'fileinput fileinput-exists'){
                    $('.withdraw-thumbnail').hide();
                }else{

                    $('.fileinput-preview img').css({"width":"100%", "height":"300px", "object-fit":"contain"});

                    $('.withdraw-thumbnail').show();

                }

            });

    })(jQuery);

</script>
@endpush

@push('style')
<style>
    .fileinput .thumbnail{
        max-height: 300px;
        width: 100%;
    }
</style>
@endpush
