@extends(checkTemplate() . 'layouts.app')

@section('panel')
    <div class="row justify-content-center gy-4">
        <div class="col-lg-8">
            <div class="card b-radius--10">
                <div class="card-body  p-4 ">
                    <form action="{{ route('user.deposit.manual.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <p class="text-center mt-2">@lang('You have requested') <b
                                        class="text--success">{{ showAmount($data['amount']) }}
                                        {{ __($general->cur_text) }}</b> , @lang('Please pay')
                                    <b class="text--success">{{ showAmount($data['final_amo']) . ' ' . $data['method_currency'] }}
                                    </b> @lang('for successful payment')
                                </p>
                                <h4 class="text-center mb-4">@lang('Please follow the instruction below')</h4>

                                <p class="my-4 text-center">@php echo  $data->gateway->description @endphp</p>

                            </div>
                           {{-- <x-payment-form identifier="id" identifierValue="{{ $gateway->form_id }}" /> --}}
                            @if($formData)

                                    @foreach($formData as $k => $v)

                                        @if($v->type == "text")
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong>{{__(@inputTitle($v->name))}} @if(@$v->is_required == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                    <input type="text" class="form-control form-control-lg"
                                                           name="{{$k}}"  value="{{old($k)}}" placeholder="{{__(@$v->name)}}">
                                                </div>
                                            </div>
                                            @elseif($v->type == "checkbox")
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong>{{__(@inputTitle($v->name))}} @if(@$v->is_required == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                    <input  class="form-check-input" type="checkbox"
                                                           name="{{$k}}"  value="{{old($k)}}" placeholder="{{__(@$v->name)}}">
                                                </div>
                                            </div>
                                            @elseif($v->type == "select")
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong>{{__(@inputTitle($v->name))}} @if(@$v->is_required == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                    <select class="form-control select2" name="{{$k}}"  value="{{old($k)}}">
                                                        @foreach($v->options as $data)
                                                        <option>{{$data}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @elseif($v->type == "radio")
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong>{{__(@inputTitle($v->name))}} @if(@$v->is_required == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                    @foreach($v->options as $data)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="{{$k}}" value="{{$data}}" name="exampleRadios" id="{{$data}}" value="option1" checked>
                                                        <label class="form-check-label" for="{{$data}}">
                                                            {{$data}}
                                                        </label>
                                                      </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                           @elseif($v->type == "textarea")
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <label><strong>{{__(inputTitle($v->name))}}
                                                            @if($v->is_required == 'required')
                                                            <span class="text-danger">*</span>
                                                            @endif</strong>
                                                        </label>
                                                        <textarea name="{{$k}}"  class="form-control"  placeholder="{{__($v->name)}}" rows="3">{{old($k)}}</textarea>

                                                    </div>
                                                </div>
                                        @elseif($v->type == "file")
                                            <div class="col-md-12 mb-3">

                                                <label class="text-uppercase">
                                                    <strong>
                                                        {{__($v->name)}} @if($v->is_required == 'required') <span class="text-danger">*</span>  @endif
                                                    </strong>
                                                </label>
                                                <div class="verification-img">
                                                    <div class="image-upload">
                                                        <div class="image-edit">
                                                            <input type='file' name="{{$k}}" id="imageUpload" class="form-control" accept=".png, .jpg, .jpeg" />
                                                            <label for="imageUpload"></label>
                                                        </div>
                                                        <div class="image-preview">
                                                            <div id="imagePreview" style="background-image: url({{ asset(imagePath()['image']['default']) }});">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    @endforeach
                                @endif

                            <div class="col-md-12">
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-outline-primary w-100 h-45">@lang('Pay Now')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
