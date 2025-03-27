<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
</script>
@if(session()->has('notify'))
    @foreach(session('notify') as $msg)
        <script>
            "use strict"; 
            if('{{ $msg[0] }}' == 'success')
            {
                Toastify({
                text: "{{ __($msg[1]) }}",
                className: "info",
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                }
                }).showToast(); 
            }
            if('{{ $msg[0] }}' == 'error')
            {
                Toastify({
                text: "{{ __($msg[1]) }}",
                className: "info",
                style: {
                    background: "linear-gradient(to right, #D22B2B, #000000)",
                }
                }).showToast();
            }
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

        Toastify({
        text: "{{ __($error) }}",
        className: "info",
        style: {
            background: "linear-gradient(to right, #D22B2B, #000000)",
        }
        }).showToast(); 
        @endforeach
    </script>

@endif
<script>
    "use strict";
    function notify(status,message) {
     //   toastr.[status](message, [status]);
    }
</script>

