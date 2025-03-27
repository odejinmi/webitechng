@extends($activeTemplate . 'layouts.auth')
@section('content')
 
<center>
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
</center>
     
 
@endsection
