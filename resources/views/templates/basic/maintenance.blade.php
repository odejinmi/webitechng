@extends($activeTemplate . 'layouts.master')
@section('content')
 <!--  Body Wrapper -->
 <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-lg-4">
            <div class="text-center">
              <img src="{{ asset('assets/assets/dist/images/backgrounds/website-under-construction.gif')}}" alt="" class="img-fluid">
              <h1 class="fw-semibold mb-7 fs-9">{{ __(@$maintenance->data_values->heading) }}</h1>
              <h4 class="fw-semibold mb-7">@php echo $maintenance->data_values->description @endphp</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('style')

@endpush
