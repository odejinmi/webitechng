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
                                            <h5>{{ $withdraw->method->name }}</h5>
                                        </div>
                                        <div class="hstack align-items-center"><a href="#" class="text-muted"><i
                                                    class="bi bi-arrow-repeat"></i></a>
                                        </div>
                                    </div>
                                    <div class="vstack gap-6">
                                        <div>
                                            <div class="d-flex align-items-center gap-3">
                                                <div
                                                    class="icon icon-shape flex-none text-base text-bg-dark rounded-circle">
                                                    <img src="{{ getImage(imagePath()['withdraw']['method']['path'] . '/' . $withdraw->method->image, imagePath()['withdraw']['method']['size']) }}"
                                                        class="w-rem-6 h-rem-6" alt="...">
                                                </div>
                                                <div>
                                                    <h6 class="progress-text mb-1 d-block">Rate</h6>
                                                    <p class="text-muted text-xs">Exchange Rate</p>
                                                </div>
                                                <div class="text-end ms-auto">
                                                    <span class="h6 text-sm">1 {{ __($general->cur_text) }} =
                                                        {{ showAmount($withdraw->rate) }}
                                                        {{ __($withdraw->currency) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center gap-3">
                                                <div
                                                    class="icon icon-shape flex-none text-base text-bg-dark rounded-circle">
                                                    <img src="{{ getImage(imagePath()['withdraw']['method']['path'] . '/' . $withdraw->method->image, imagePath()['withdraw']['method']['size']) }}"
                                                        class="w-rem-6 h-rem-6" alt="...">
                                                </div>
                                                <div>
                                                    <h6 class="progress-text mb-1 d-block">Amount</h6>
                                                    <p class="text-danger text-xs">Fee: {{ showAmount($withdraw->charge) }}
                                                        {{ __($general->cur_text) }}</p>
                                                </div>
                                                <div class="text-end ms-auto">
                                                    <span class="h6 text-sm">{{ showAmount($withdraw->amount) }}
                                                        {{ __($general->cur_text) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center gap-3">
                                                <div
                                                    class="icon icon-shape flex-none text-base text-bg-dark rounded-circle">
                                                    <img src="{{ getImage(imagePath()['withdraw']['method']['path'] . '/' . $withdraw->method->image, imagePath()['withdraw']['method']['size']) }}"
                                                        class="w-rem-6 h-rem-6" alt="...">
                                                </div>
                                                <div>
                                                    <h6 class="progress-text mb-1 d-block">Payment</h6>
                                                    <p class="text-muted text-xs"></p>
                                                </div>
                                                <div class="text-end ms-auto">
                                                    <span class="h6 text-sm">{{ showAmount($withdraw->final_amount) }}
                                                        {{ __($withdraw->currency) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="crancy-single-user mg-top-30">
                                <div class="alert alert-info mt-3 mb-3">


                                    <p class="card-subtitle mb-0">{!! $withdraw->method->description !!}</p>
                                </div>

                                <form action="{{ route('user.withdraw.submit') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @if ($withdraw->method->user_data)
                                        @foreach ($withdraw->method->user_data as $k => $v)
                                            @if ($v->type == 'text')
                                                <div class="form-group mb-3">
                                                    <label><strong>{{ strtoUpper($v->field_level) }} @if ($v->validation == 'required')
                                                                <span class="text-danger">*</span>
                                                            @endif
                                                        </strong>
                                                    </label>
                                                    <input type="text" name="{{ $k }}" class="form-control"
                                                        value="{{ old($k) }}"
                                                        placeholder="{{ __($v->field_level) }}"
                                                        @if ($v->validation == 'required') required @endif>
                                                    @if ($errors->has($k))
                                                        <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                    @endif
                                                </div>
                                            @elseif($v->type == 'textarea')
                                                <div class="form-group mb-3">
                                                    <label><strong>{{ strtoUpper($v->field_level) }} @if ($v->validation == 'required')
                                                                <span class="text-danger">*</span>
                                                            @endif
                                                        </strong>
                                                    </label>
                                                    <textarea name="{{ $k }}" class="form-control" placeholder="{{ __($v->field_level) }}" rows="3"
                                                        @if ($v->validation == 'required') required @endif>{{ old($k) }}</textarea>
                                                    @if ($errors->has($k))
                                                        <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                    @endif
                                                </div>
                                            @elseif($v->type == 'file')
                                                <label><strong>{{ strtoUpper($v->field_level) }} @if ($v->validation == 'required')
                                                            <span class="text-danger">*</span>
                                                        @endif
                                                    </strong></label>
                                                <div class="form-group mb-3">
                                                    <div class="fileinput fileinput-new " data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail withdraw-thumbnail"
                                                            data-trigger="fileinput">
                                                            <img class="w-100" src="{{ getImage('/') }}"
                                                                alt="@lang('Image')">
                                                        </div>
                                                        <div
                                                            class="fileinput-preview fileinput-exists thumbnail wh-200-150">
                                                        </div>
                                                        <div class="img-input-div">
                                                            <span class="btn btn-info btn-file">
                                                                <span class="fileinput-new "> @lang('Select')
                                                                    {{ __($v->field_level) }}</span>
                                                                <span class="fileinput-exists"> @lang('Change')</span>
                                                                <input type="file" class="form-control"
                                                                    name="{{ $k }}" accept="image/*"
                                                                    @if ($v->validation == 'required') required @endif>
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
