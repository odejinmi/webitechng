@extends($activeTemplate . 'layouts.auth')
@section('content')

<!--begin::Authentication - Signup Welcome Message -->
<div class="d-flex flex-column flex-center flex-column-fluid">    
    <!--begin::Content-->
    <div class="d-flex flex-column flex-center text-center p-10">        
        <!--begin::Wrapper-->
        <div class="card card-flush w-lg-650px py-5">
            <div class="card-body py-15 py-lg-20">
                
    <!--begin::Logo-->
    <div class="mb-14">
        <a href="#" class="">
            <img alt="Logo" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" class="h-40px"/> 
        </a> 
    </div>
    <!--end::Logo-->

    <!--begin::Title-->
    <h1 class="fw-bolder text-gray-900 mb-5">
        @lang('Your account is deactivated')
    </h1>
    <!--end::Title--> 
    
    <!--begin::Text-->
    <div class="fw-semibold fs-6 text-gray-500 mb-8">
        {{ __($user->ban_reason) }}
    </div>
    <!--end::Text--> 
    
    <!--begin::Link-->
    <div class="mb-11">
        <a href="{{ route('user.logout') }}" class="btn btn-sm btn-primary">@lang('Logout')</a>
    </div>    
    <!--end::Link-->
    
    <!--begin::Illustration-->
    <div class="mb-0">
        <img src="{{ asset('assets/assets/dist/images/backgrounds/lock.png')}}" class="mw-100 mh-300px theme-light-show" alt=""/>
    </div>
    <!--end::Illustration-->   

            </div>
        </div>
        <!--end::Wrapper-->        
    </div>
    <!--end::Content-->    
</div>
<!--end::Authentication - Signup Welcome Message-->
 
@endsection
