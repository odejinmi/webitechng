<script src="{{ asset('assets/global/js/slim_notifier.js') }}"></script>
@if(session()->has('notify'))
    @foreach(session('notify') as $msg)
        <script>
            "use strict";
            SlimNotifierJs.notification('{{ $msg[0] }}', '{{ __($msg[0]) }}', '{{ __($msg[1]) }}', 15000);
        </script>
    @endforeach
@endif
<script>
</script>
@if (isset($errors) && $errors->any())
    @php
        $collection = collect($errors->all());
        $errors = $collection->unique();
    @endphp

    <script>
        "use strict";
        @foreach ($errors as $error)
        SlimNotifierJs.notification('error', 'Oops', '{{ __($error) }}', 15000);
        @endforeach
    </script>

@endif
<script>
    "use strict";
    function notify(status,message) {
        SlimNotifierJs.notification([status], 'Hello', message, 15000);
    }
</script>

