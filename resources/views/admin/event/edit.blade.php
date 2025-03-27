@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-body">
                	<form action="{{route('admin.event.update', $event->id)}}" method="POST" enctype="multipart/form-data">
                		@csrf
                		<div class="row">
                             <div class="col-lg-12">
                                <div class="card border--primary mt-2">
                                    <h5 class="card-header bg-primary">@lang('Event Details')</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label for="title" class="font-weight-bold">@lang('Name')</label>
                                                    <input type="text" name="title" id="title" value="{{$event->title}}" class="form-control form-control-lg" placeholder="@lang('Enter Event Title')" maxlength="255" required="">
                                                </div>
                                                
                                                <div class="form-group mb-3">
                                                    <label for="title" class="font-weight-bold">@lang('Description')</label>
                                                    <textarea type="text" name="eventdescription" id="description" class="form-control form-control-lg" placeholder="@lang('Enter Event Description')" maxlength="500" required="">{{$event->description}}</textarea>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="event_type" class="font-weight-bold">@lang('Event Type')</label>
                                                    <select name="event_type" id="event_type" class="form-control form-control-lg" required="">
                                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                                        @foreach($eventTypes as $eventType)
                                                            <option @if($event->event_type == $eventType->id) selected @endif value="{{$eventType->id}}">{{__($eventType->name)}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="city" class="font-weight-bold">@lang('Event City')</label>
                                                    <select name="city" id="city" class="form-control form-control-lg" required="">
                                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                                        @foreach($cities as $city)
                                                            <option value="{{$city->id}}"  @if($event->city_id == $city->id) selected @endif data-locations="{{ json_encode($city->location) }}">{{__($city->name)}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="location" class="font-weight-bold">@lang('Event Location')</label>
                                                    <select name="location" id="location" class="form-control form-control-lg" required="">
                                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                                    </select>
                                                </div> 

                                                <input name="type" value="1" id="type" class="form-control form-control-lg" hidden required=""> 
 
                                                <div class="form-group mb-3">
                                                    <label for="video_link" class="font-weight-bold">@lang('Event Video Link')</label>
                                                    <input type="text" name="video_link" id="video_link" value="{{$event->video_link}}" class="form-control form-control-lg" placeholder="@lang('https://www.youtube.com/embed/example')" maxlength="255" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4 mb-4">
                             <div class="col-lg-12">
                                <div class="card border--primary mt-2">
                                    <h5 class="card-header bg-primary">@lang('Event Time')</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label for="name" class="font-weight-bold">@lang('Timezone')</label>
                                                    <select class="form-control select2-basic" name="timezone">
                                                        @foreach($timezones as $timezone)
                                                        <option value="'{{ @$timezone}}'" @if(config('app.timezone') == $timezone) selected @endif>{{ __($timezone) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="facebook" class="form-control-label font-weight-bold">@lang('Start Date')</label>
                                                    <div class="input-group mb-3"> 
                                                          <input type="date" id="sdate" class="form-control form-control-lg" value="{{$event->start_date}}" placeholder="@lang('Start Date')" name="sdate" aria-label="Start Date" aria-describedby="basic-sdate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="facebook" class="form-control-label font-weight-bold">@lang('Start Time')</label>
                                                    <div class="input-group mb-3"> 
                                                          <input type="time" id="stime" class="form-control form-control-lg"  value="{{$event->start_time}}" placeholder="@lang('Start Time')" name="stime" aria-label="Start Time" aria-describedby="basic-stime">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="facebook" class="form-control-label font-weight-bold">@lang('End Date')</label>
                                                    <div class="input-group mb-3"> 
                                                          <input type="date" id="edate" class="form-control form-control-lg"  value="{{$event->end_date}}" placeholder="@lang('End Date')" name="edate" aria-label="End Date" aria-describedby="basic-edate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="facebook" class="form-control-label font-weight-bold">@lang('End Time')</label>
                                                    <div class="input-group mb-3"> 
                                                          <input type="time" id="etime" class="form-control form-control-lg"  value="{{$event->end_time}}" placeholder="@lang('End Time')" name="etime" aria-label="End Time" aria-describedby="basic-etime">
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>  
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                       <div class="card border-primary mt-2">
                                           <div class="card-header bg-primary text-white"><h5 class=" text-white">@lang('Event Image')</h5> 
                                            <p class="">Upload JPEG, PNG Image. Ensure you provide image that relates with the theme event</p>
                                        </div><br>
                                           
                                           <div class="card-body">
                                               <div class="row">
                                                <center>
                                                   <div class="col-lg-6">
                                                       <div class="form-group mb-3">
                                                           <div class="image-upload">
                                                            <div class="thumb">
                                                                <div class="avatar-preview">
                                                                    <div class="profilePicPreview" style="background-image: url({{getImage(imagePath()['event']['path'] .'/'.$event->image,imagePath()['event']['size'])}})">
                                                                        <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                                    </div>
                                                                </div>
                                                                <div class="avatar-edit">
                                                                    <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                                    <label for="profilePicUpload1" class="bg--success">@lang('Upload Image')</label>
                                                                    <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg')</b>. @lang('Image will be resized into') {{imagePath()['event']['size']}}@lang('px'). </small>
                                                                </div>
                                                            </div>
                                                           </div>
                                                       </div>
                                                   </div> 
                                                </center>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>

                            <div class="row">
                               <div class="col-lg-12">
                                <div class="card border--primary mt-2">
                                    <h5 class="card-header bg-primary">@lang('Event Tickets')
                                        <button type="button" class="btn btn-sm btn-outline-light float-right addUserData">
                                            <i class="la la-fw la-plus"></i>@lang('Add New')
                                        </button>
                                    </h5>

                                    <div class="card-body">
                                        <div class="row addedField">
                                            @if($event->tickets != null)
                                            @php
                                            $tickets = json_encode($event->tickets, true);
                                            $tickets = json_decode($tickets, true);
                                            @endphp
                                            @foreach($tickets as $k => $v)
                                                <div class="col-md-12 user-data">
                                                    <div class="col-md-12 user-data">
                                                        <div class="form-group">
                                                            <div class="input-group mb-md-0 mb-4">
                                
                                                                <div class="col-md-12 mb-3">
                                                                    <label>Ticket Name</label>
                                                                    <input name="field_name[]" value="{{$v['name']}}" class="form-control" type="text" required placeholder="@lang('Ticket Name')">
                                                                </div>
                                
                                                                <div class="col-md-12 mt-md-0 mb-3">
                                                                    <label>Ticket Description</label>
                                                                    <textarea name="description[]" class="form-control" type="text" required placeholder="@lang('Ticket Description')">{{$v['description']}}</textarea>
                                                                </div>
                                
                                                                <div class="col-md-4 mt-md-0 mb-3">
                                                                    <label>Ticket Price</label>
                                                                    <input name="price[]" value="{{$v['price']}}" class="form-control" type="number" required placeholder="@lang('0.00')">
                                                                </div>
                                
                                                                <div class="col-md-4 mt-md-0 mb-3">
                                                                    <label>Ticket Type</label>
                                                                    <select name="type[]" required class="form-control">
                                                                        <option selected disabled > @lang('Select Purchase Limit') </option>
                                                                        <option @if($v['type'] == 'unlimited') selected @endif value="unlimited"> @lang('Unlimited') </option>
                                                                        <option @if($v['type'] == 'limited') selected @endif  value="limited" > @lang('Limited') </option>
                                                                    </select>
                                                                </div>
                                                                
                                                                <div class="col-md-4 mt-md-0 mb-3">
                                                                    <label>Ticket Limit</label>
                                                                    <input name="limit[]"  value="{{$v['limit']}}" class="form-control" type="number" required placeholder="@lang('0')">
                                                                </div>
                                
                                                                <div class="col-md-4 mt-md-0 mb-3">
                                                                    <label>Available Tickets</label>
                                                                    <input name="available[]" class="form-control" value="{{$v['available']}}"  type="number" required placeholder="@lang('0')">
                                                                </div>
                                                                <input name="trx[]" class="form-control" value="{{$v['trx']}}"  hidden>
                                                                
                                                                <div class="col-md-4 mt-md-0  mb-3">
                                                                    <label>Ticket Benefits</label>
                                                                    <small class="ml-2 mt-2 text-facebook">@lang('Separate multiple keywords by') <code>,</code>(@lang('comma'))</small>
                                                                    <input name="benefits[]" value="{{$v['benefits']}}" class="form-control" type="text" required placeholder="@lang('Enter Benefits')">
                                                                </div>
                                                                
                                                                 
                                                                <div class="col-md-4 mt-md-0 mb-3">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-danger btn-lg removeBtn w-100" type="button">
                                                                            <i class="ti ti-trash"></i>
                                                                        </button>
                                                                    </span>
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

                            </div>
                        </div>

                       	<div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-lg"><i class="fa fa-fw fa-check"></i> @lang('Update Event')</button>
                        </div>
                	</form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <a href="{{route('admin.event.index')}}" class="btn btn-sm btn-primary box--shadow1 text--small"><i class="las la-angle-double-left"></i>@lang('Go Back')</a>
@endpush

@push('script')
    <script>
        "use strict";
        $('select[name=city]').change(function() {
            $('select[name=location]').html('<option value="" selected="" disabled="">@lang('Select One')</option>');
            var locations = $('select[name=city] :selected').data('locations');
            var html = '';
            locations.forEach(function myFunction(item, index) {
                if (item.id == {{$event->location_id}}) {
                    html += `<option value="${item.id}" selected>${item.name}</option>`
                }else{
                    html += `<option value="${item.id}">${item.name}</option>`
                }
            });
            $('select[name=location]').append(html);
        }).change();
    </script>

     
<script>
    "use strict";
    $('select[name=city]').on('change',function() {
        $('select[name=location]').html('<option value="" selected="" disabled="">@lang('Select One')</option>');
        var locations = $('select[name=city] :selected').data('locations');
        var html = '';
        locations.forEach(function myFunction(item, index) {
            html += `<option value="${item.id}">${item.name}</option>`
        });
        $('select[name=location]').append(html);
    });
</script>

<script>
    (function ($) {
        "use strict";
        $('.select2-auto-tokenize').select2({
        dropdownParent: $('.card-body'),
        tags: true,
        tokenSeparators: [',']
        }); 

        $('input[name=currency]').on('input', function () {
            $('.currency_symbol').text($(this).val());
        });
        $('.addUserData').on('click', function () {
            var html = `
                <div class="col-md-12 user-data">
                    <div class="form-group">
                        <div class="input-group mb-md-0 mb-4">

                            <div class="col-md-12 mb-2">
                                <label>Ticket Name</label>
                                <input name="field_name[]" class="form-control" type="text" required placeholder="@lang('Ticket Name')">
                            </div>

                            <div class="col-md-12 mt-md-0 mb-2">
                                <label>Ticket Description</label>
                                <textarea name="description[]" class="form-control" type="text" required placeholder="@lang('Ticket Description')"></textarea>
                            </div>

                            <div class="col-md-4 mt-md-0 mb-2">
                                <label>Ticket Price</label>
                                <input name="price[]" class="form-control" type="number" required placeholder="@lang('0.00')">
                            </div>

                            <div class="col-md-4 mt-md-0 mb-2">
                                <label>Ticket Type</label>
                                <select name="type[]" class="form-control">
                                    <option selected disabled > @lang('Select Purchase Limit') </option>
                                    <option value="unlimited"> @lang('Unlimited') </option>
                                    <option value="limited" > @lang('Limited') </option>
                                </select>
                            </div>
                            
                            <div class="col-md-4 mt-md-0 mb-2">
                                <label>Ticket Limit</label>
                                <input name="limit[]" class="form-control" type="number" required placeholder="@lang('0')">
                            </div>

                            
                            <div class="col-md-4 mt-md-0 mb-2">
                                    <label>Available Tickets</label>
                                    <input name="available[]" class="form-control" type="number" required placeholder="@lang('0')">
                            </div>


                            <div class="col-md-4 mt-md-0 mb-2">
                                <label>Ticket Benefits</label>
                                <small class="ml-2 mt-2 text-facebook">@lang('Separate multiple keywords by') <code>,</code>(@lang('comma'))</small>
                                <input name="benefits[]" class="form-control" type="text" required placeholder="@lang('Enter Benefits')">
                            </div>
                            
                             
                            <div class="col-md-4 mt-md-0 mb-2">
                                <span class="input-group-btn">
                                    <button class="btn btn--danger btn-lg removeBtn w-100" type="button">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>`;

            $('.addedField').append(html);
        });

        $(document).on('click', '.removeBtn', function () {
            $(this).closest('.user-data').remove();
        });
        @if(old('currency'))
        $('input[name=currency]').trigger('input');
        @endif
    })(jQuery);

</script>

@endpush


