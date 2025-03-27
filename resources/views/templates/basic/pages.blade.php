@extends(checkTemplate().'layouts.frontend')
@include(checkTemplate() . 'partials.breadcrumb')
@section('content')
    @if($sections != null)
        @foreach(json_decode($sections) as $sec)
            @include(checkTemplate().'sections.'.$sec)
        @endforeach
    @endif
@endsection
