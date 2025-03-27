@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-body">
                	<form action="{{route('admin.event.info.update', $event->id)}}" method="POST" enctype="multipart/form-data">
                		@csrf
                		<div class="row mb-4">
                             <div class="col-lg-12">
                                <div class="card border--primary mt-2">
                                    <h5 class="card-header bg--primary">@lang('Event Information')</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-2 mb-3">
                                                <div class="form-group">
                                                    <label for="unit" class="font-weight-bold">@lang('Total Unit')</label>
                                                    <input type="number" name="unit" id="unit" value="{{@$eventInfo->unit}}" class="form-control form-control-lg" placeholder="@lang('Enter Total Unit')" required="">
                                                </div>
                                            </div>

                                            <div class="col-lg-2 mb-3">
                                                <div class="form-group">
                                                    <label for="left" class="font-weight-bold">@lang('Total Left')</label>
                                                    <input type="number" name="left" id="left" value="{{@$eventInfo->lefts}}" class="form-control form-control-lg" placeholder="@lang('Enter Total Left')" required="">
                                                </div>
                                            </div>

                                            <div class="col-lg-2 mb-3">
                                                <div class="form-group">
                                                    <label for="room" class="font-weight-bold">@lang('Total Room')</label>
                                                    <input type="number" name="room" id="room" value="{{@$eventInfo->room}}" class="form-control form-control-lg" placeholder="@lang('Enter Total Room')" required="">
                                                </div>
                                            </div>

                                             <div class="col-lg-2 mb-3">
                                                <div class="form-group">
                                                    <label for="bathroom" class="font-weight-bold">@lang('Total Bathroom')</label>
                                                    <input type="number" name="bathroom" id="bathroom" value="{{@$eventInfo->bathroom}}" class="form-control form-control-lg" placeholder="@lang('Enter Total Bathroom')" required="">
                                                </div>
                                            </div>

                                            <div class="col-lg-2 mb-3">
                                                <div class="form-group">
                                                    <label for="kitchen" class="font-weight-bold">@lang('Total Kitchen')</label>
                                                    <input type="number" name="kitchen" id="kitchen" value="{{@$eventInfo->kitchen}}" class="form-control form-control-lg" placeholder="@lang('Enter Total Kitchen')" required="">
                                                </div>
                                            </div>

                                            <div class="col-lg-2 mb-3">
                                                <div class="form-group">
                                                    <label for="car_parking" class="font-weight-bold">@lang('Total Car Parkings')</label>
                                                    <input type="number" name="car_parking" id="car_parking" value="{{@$eventInfo->car_parking}}" class="form-control form-control-lg" placeholder="@lang('Enter Total Car Parkings')" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-lg-2 mb-3">
                                                <div class="form-group">
                                                    <label for="car_parking" class="font-weight-bold">@lang('Total Floor')</label>
                                                    <input type="number" name="floor" id="car_parking" value="{{@$eventInfo->floor}}" class="form-control form-control-lg" placeholder="@lang('Enter Total Floor')" required="">
                                                </div>
                                            </div>

                                            <div class="col-lg-2 mb-3">
                                                <div class="form-group">
                                                    <label for="car_parking" class="font-weight-bold">@lang('Total Car Parkings')</label>
                                                    <input type="number" name="car_parking" id="car_parking" value="{{@$eventInfo->car_parking}}" class="form-control form-control-lg" placeholder="@lang('Enter Total Car Parkings')" required="">
                                                </div>
                                            </div>

                                             <div class="col-lg-2 mb-3">
                                                <div class="form-group">
                                                    <label for="square_feet" class="font-weight-bold">@lang('Total Square Feet')</label>
                                                    <input type="text" name="square_feet" id="square_feet" value="{{getAmount(@$eventInfo->square_feet)}}" class="form-control form-control-lg" placeholder="@lang('Enter Total Square Feet')" required="">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <div class="form-group">
                                                    <label for="price" class="form-control-label font-weight-bold">@lang('Price')</label>
                                                    <div class="input-group mb-3">
                                                          <input type="text" id="price"  value="{{getAmount(@$eventInfo->price)}}" class="form-control form-control-lg" placeholder="@lang('Enter Price')" name="price" aria-label="Recipient's username" aria-describedby="basic-addon2" required="">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">{{__($general->cur_text)}}</span>
                                                          </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <div class="form-group">
                                                    <label for="available_time" class="font-weight-bold">@lang('Available Time')</label>
                                                    <input type="text" name="available_time" id="available_time" value="{{showDateTime(@$eventInfo->available_time, 'Y-m-d')}}" data-language="en" class="form-control form-control-lg datepicker-here" placeholder="@lang('Enter Available Time')" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="card border-primary mt-2">
                                    <h5 class="card-header bg--primary">@lang('Property Optional Image')
                                        <button type="button" class="btn btn-sm btn-outline-light float-right addUserData">
                                            <i class="la la-fw la-plus"></i>@lang('Add New')
                                        </button>
                                    </h5>
                                    <div class="card-body">
                                        <div class="row addedField">
                                            @if(!empty($eventInfo))
                                                @foreach($eventInfo->propertyOptionalImage as $value)
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <div class="image-upload">
                                                                <div class="thumb">
                                                                    <div class="avatar-preview">
                                                                        <a href="javascript:void(0)" class="remove-avatar imageRemove" data-id="{{$value->id}}"><i class="las la-times"></i></a>
                                                                        <div class="profilePicPreview" style="background-image: url({{getImage('assets/images/property/'. $value->image, imagePath()['property']['size'])}})">
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-edit">
                                                                        <input type="file" class="profilePicUpload h-0 p-0" name="optional_image[]" id="profilePicUpload${id}" accept=".png, .jpg, .jpeg">
                                                                        <label for="profilePicUpload${id}" class="bg--success">@lang('Upload Image')</label>
                                                                        <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg')</b>. @lang('Image will be resized into') {{imagePath()['property']['size']}}@lang('px'). </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                
                        <div class="row mb-4">
                             <div class="col-lg-12">
                                <div class="card border--primary mt-2">
                                    <h5 class="card-header bg--primary">@lang('Amenities and Features (Optional)')
                                        <button type="button" class="btn btn-sm btn-outline-light float-right addAmenities">
                                            <i class="la la-fw la-plus"></i>@lang('Add New')
                                        </button>
                                    </h5>
                                    <div class="card-body">
                                        <div class="row amenitiesField">
                                            @if(!empty($eventInfo))
                                                @foreach($eventeventInfo->propertyAmenities as $proValue)
                                                    <div class="col-md-12 data-amenities">
                                                        <div class="form-group">
                                                            <div class="input-group mb-md-0 mb-4">
                                                                <div class="col-md-10">
                                                                    <input name="features[]" class="form-control form-control-lg" type="text" required placeholder="@lang('Enter Amenities or Features')" value="{{$proValue->name}}">
                                                                </div>
                                                                <div class="col-md-2 mt-md-0 mt-2 text-right">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn--danger btn-lg removeAmenities w-100" type="button">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="card border--primary mt-2">
                                    <h5 class="card-header bg--primary">@lang('Event Description')</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea rows="10" class="form-control nicEdit" name="description">@php echo @$eventInfo->description @endphp</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       	<div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-lg"><i class="fa fa-fw fa-paper-plane"></i> @lang('Create Property')</button>
                        </div>
                	</form>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="imageRemoveBy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Optional Image Confirmation')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{route('admin.event.image.delete')}}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to remove this image?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('breadcrumb-plugins')
    <a href="{{route('admin.event.index')}}" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="las la-angle-double-left"></i>@lang('Go Back')</a>
@endpush

@push('script-lib')
  <script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
@endpush
@push('script')
    <script>
        "use strict";
        if(!$('.datepicker-here').val()){
            $('.datepicker-here').datepicker({
                autoClose: true,
                dateFormat: 'yyyy-mm-dd',
            });
        }
        var id = 0;
        $('.addUserData').on('click', function () {
            id++;
            var html = `<div class="col-lg-3 optionalImage">
                <div class="form-group">
                    <div class="image-upload">
                        <div class="thumb">
                            <div class="avatar-preview">
                                <a href="javascript:void(0)" class="remove-avatar removeBtn"><i class="las la-times"></i></a>
                                <div class="profilePicPreview" style="background-image: url({{getImage(imagePath()['event']['path'],imagePath()['event']['size'])}})">
                                </div>
                            </div>
                            <div class="avatar-edit">
                                <input type="file" class="profilePicUpload h-0 p-0" name="optional_image[]" id="profilePicUpload${id}" accept=".png, .jpg, .jpeg">
                                <label for="profilePicUpload${id}" class="bg--success">@lang('Upload Image')</label>
                                <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg')</b>. @lang('Image will be resized into') {{imagePath()['event']['size']}}@lang('px'). </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
            $('.addedField').append(html);
        });

        $(document).on('click', '.removeBtn', function () {
            $(this).closest('.optionalImage').remove();
        });

        function proPicURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var preview = $(input).parents('.thumb').find('.profilePicPreview');
                    $(preview).css('background-image', 'url(' + e.target.result + ')');
                    $(preview).addClass('has-image');
                    $(preview).hide();
                    $(preview).fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).on('change','.profilePicUpload',function () {
            proPicURL(this);
        });

        $('.addAmenities').on('click', function () {
            var html = `
            <div class="col-md-12 data-amenities">
                <div class="form-group">
                    <div class="input-group mb-md-0 mb-4">
                        <div class="col-md-10">
                            <input name="features[]" class="form-control form-control-lg" type="text" required placeholder="@lang('Enter Amenities or Features')">
                        </div>
                        <div class="col-md-2 mt-md-0 mt-2 text-right">
                            <span class="input-group-btn">
                                <button class="btn btn--danger btn-lg removeAmenities w-100" type="button">
                                    <i class="fa fa-times"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>`;
            $('.amenitiesField').append(html);
        });

        $(document).on('click', '.removeAmenities', function () {
            $(this).closest('.data-amenities').remove();
        });


        $('.imageRemove').on('click', function () {
            var modal = $('#imageRemoveBy');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });
    </script>
@endpush


@push('style')
<style>
    .image-upload .thumb .profilePicPreview {
        height: 250px;
    }
    .avatar-preview {
        position: relative;
    }
    .remove-avatar {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        background-color: red;
        color: #fff;
        font-size: 22px;
        z-index: 3;
    }
    .remove-avatar:hover {
        color: #fff;
    }
</style>
@endpush