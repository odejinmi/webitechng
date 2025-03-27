@extends(checkTemplate() . 'layouts.app')

@section('panel')


    <section class="crancy-adashboard crancy-shows">
        <div class="container container__bscreen">
            <div class="row">
                <div class="col-8" style="
      margin-left: auto;
      margin-right: auto;">
                    <div class="crancy-body">
                        <!-- Dashboard Inner -->
                        <div class="crancy-dsinner">

                            <!-- Single User -->

                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <div>
                                            <h5>{{ @$data->gateway->name }}</h5>
                                        </div>
                                    </div>
                                    <div class="vstack gap-6">

                                        <div>
                                            <div class="d-flex align-items-center gap-3">
                                                <div
                                                    class="icon icon-shape flex-none text-base text-bg-dark rounded-circle">
                                                    <img src="{{ getImage(imagePath()['gateway']['path'] . '/' . @$data->gateway->image, imagePath()['gateway']['size']) }}"
                                                        class="w-rem-6 h-rem-6" alt="...">
                                                </div>
                                                <div>
                                                    <h6 class="progress-text mb-1 d-block">Amount</h6>
                                                    <p class="text-danger text-xs">Fee: {{ showAmount($data->charge) }}
                                                        {{ __($general->cur_text) }}</p>
                                                </div>
                                                <div class="text-end ms-auto">
                                                    <span class="h6 text-sm">{{ showAmount($data->final_amo) }}
                    {{ __($data->method_currency) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center gap-3">
                                                <div
                                                    class="icon icon-shape flex-none text-base text-bg-dark rounded-circle">
                                                    <img src="{{ getImage(imagePath()['gateway']['path'] . '/' . @$data->gateway->image, imagePath()['gateway']['size']) }}"
                                                        class="w-rem-6 h-rem-6" alt="...">
                                                </div>
                                                <div>
                                                    <h6 class="progress-text mb-1 d-block">Payment</h6>
                                                    <p class="text-muted text-xs"></p>
                                                </div>
                                                <div class="text-end ms-auto">
                                                    <span class="h6 text-sm">{{ showAmount($data->amount) }} {{ __($general->cur_text) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="crancy-single-user mg-top-30">
                                <div class="alert alert-info mt-3 mb-3">


                                    <p class="card-subtitle mb-0">@php echo  $data->gateway->description @endphp</p>
                                </div>

                                <form action="{{ route('user.deposit.manual.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

          @if($formData)

                                    @foreach($formData as $k => $v)

                                        @if($v->type == "text")
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong>{{__(@inputTitle($v->name))}} @if(@$v->is_required == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                    <input type="text" class="form-control reason"
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
                                        @endif

                                    @endforeach
                                @endif

                                    <button type="submit" id="btn-confirm" class="btn btn-primary btn-xm">Confirm</button>

                            </div>
                            <!-- End Single User -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
