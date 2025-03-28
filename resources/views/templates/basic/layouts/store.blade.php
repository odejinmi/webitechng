@extends($activeTemplate . 'layouts.master')

@section('content')
    <!-- page-wrapper start -->
    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme">
        @yield('panel')
    </div>
@endsection
