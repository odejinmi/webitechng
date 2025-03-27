@php
    $counterContent = getContent('counter.content', true);
    $counterElements = getContent('counter.element', null, false, true);
@endphp
<!-- ============================ Our Counters Start ================================== -->
<section class="bg position-relative">
    <div class="position-absolute top-0 start-0 me-4 mt-3 z-0 opcity-25">
        <img src="{{ asset($activeTemplateTrue . 'img/shape-1-soft-light.svg')}}" alt="img" width="250">
    </div>
    <div class="container">
        
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-7 col-lg-7 col-md-11 mb-3">
                <div class="sec-heading text-center lsight">
                    <div class="label text-light bg-primary d-inline-flex rounded-4 mb-2 font--medium"><span>Our Counters</span></div>
                    <h2 class="mb-1">{{ __(@$counterContent->data_values->heading) }}</h2>
                    <p class="test-muted fs-6">{{ __(@$counterContent->data_values->sub_heading) }}</p>
                  </div>
            </div>
        </div>
        
        <div class="row justify-content-center g-4">
            @forelse($counterElements as $item)
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="lios-parts text-center">
                    <div class="px-2 py-2 d-inline-flex align-items-center justify-content-center fs-4 bg-light-primary text-primary rounded-circle">
                        @php echo @$item->data_values->icon @endphp
                    </div> 
                    <h4 class="text-lights"><span class="ctr me-1">{{ @$item->data_values->number }}</span></h4>
                    <h6 class="text-lights opacity-75">{{ @$item->data_values->title }}</h6>
                </div>
            </div>
            @empty
            {!!emptyData!!}
            @endforelse  
        </div>
        
    </div>
</section>
<div class="clearfix"></div>
<!-- ============================ Our Counters End ================================== -->
 
