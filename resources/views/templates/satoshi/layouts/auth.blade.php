<!doctype html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">
<!--begin::Head-->

<head>

    <title> {{ $general->siteName(__($pageTitle)) }}</title>
    @include('partials.seo')
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />

    <!--  Stylesheet -->

    <link rel="stylesheet" type="text/css" href="{{asset( $activeTemplateTrue . 'agent/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset( $activeTemplateTrue . 'agent/css/utility.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://api.fontshare.com/v2/css?f=satoshi@900,700,500,300,401,400&display=swap">
    <link rel="stylesheet" href="{{asset( $activeTemplateTrue . 'dashboard/css/toast.min.css')}}" />
</head>
<body>

        @yield('content')

</body>
    <!--  Scripts -->
     <div class="d-flex align-items-center gap-2 position-fixed bottom-0 end-0 mb-6 me-6 px-2 py-2 rounded-pill shadow-4 bg-white z-2">
        <img src="https://webpixels.s3.eu-central-1.amazonaws.com/public/brand/dark-sm.svg" class="avatar avatar-xs">
          <a href="#" class="me-1 text-heading fw-bold text-xs ls-tight stretched-link" target="_blank">Built by Khaytech Digitalz</a>
      </div>
    <script src="{{asset( $activeTemplateTrue . 'agent/js/main.js')}}"></script>
    <script src="{{asset( $activeTemplateTrue . 'dashboard/js/toast.min.js') }}"></script>
    <script src="{{ asset('assets/assets/dist/libs/jquery/dist/jquery.min.js')}}"></script>


        @stack('script')
        @include('partials.plugins')
        @include('partials.toast')

</body>

</html>
