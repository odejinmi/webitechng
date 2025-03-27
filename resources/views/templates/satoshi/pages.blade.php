@extends($activeTemplate.'layouts.frontend')
@include($activeTemplate . 'partials.breadcrumb')
@section('content')
    @if($sections != null)
        @foreach(json_decode($sections) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif
@endsection
