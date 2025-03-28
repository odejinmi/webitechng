@extends($activeTemplate . 'layouts.app')
@section('panel')
    @include($activeTemplate . 'partials.settings')
    <form action="{{ route('user.change.password') }}" class="form" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="" id="id4" role="tabpanel">
            <div class="row g-6 align-items-end justify-content-between">
                <div class="col">
                    <h4 class="fw-semibold mb-1">Account Password</h4>
                    <p class="text-sm text-muted">Please do not share your account password with anybody. We will not ask
                        for it.</p>
                </div>
            </div>

        </div>

        <hr class="my-6">
        <div class="vstack gap-5">
            <div class="row align-items-center g-3">
                <div class="col-md-2"><label class="form-label mb-0">Current password</label></div>
                <div class="col-md-6">
                    <div class=""><input type="password" name="current_password" class="form-control"></div>
                </div>
            </div>
            <div class="row align-items-center g-3">
                <div class="col-md-2"><label class="form-label mb-0">New password</label></div>
                <div class="col-md-6">
                    <div class=""><input type="password" name="password" class="form-control"></div>
                </div>
            </div>
            <div class="row align-items-center g-3">
                <div class="col-md-2"><label class="form-label mb-0">Confirm password</label></div>
                <div class="col-md-6">
                    <div class=""><input type="password" name="password_confirmation" class="form-control"></div>
                </div>
            </div>
        </div>
        <hr class="my-6 d-md-nones">
        <div class="d-flex d-md-nonse justify-content-end gap-2 mb-6">
            <button type="submit" class="btn btn-sm btn-primary">Update Password</button>
        </div>
    </form>


    <form action="{{ route('user.change.trxpassword') }}" class="form" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="" id="id4" role="tabpanel">
            <div class="row g-6 align-items-end justify-content-between">
                <div class="col">
                    <h4 class="fw-semibold mb-1">Transacion PIN</h4>
                    <p class="text-sm text-muted">Please do not share your transaction pin with anybody. We will not ask
                        for it.</p>
                </div>
            </div>

        </div>

        <hr class="my-6">
        <div class="vstack gap-5">
            <div class="row align-items-center g-3">
                <div class="col-md-2"><label class="form-label mb-0">Account password</label></div>
                <div class="col-md-6">
                    <div class=""><input type="password" name="password" class="form-control"></div>
                </div>
            </div>
            <div class="row align-items-center g-3">
                <div class="col-md-2"><label class="form-label mb-0">New Pin</label></div>
                <div class="col-md-6">
                    <div class=""><input type="number" name="pin" class="form-control"></div>
                </div>
            </div>
        </div>
        <hr class="my-6 d-md-nones">
        <div class="d-flex d-md-nonse justify-content-end gap-2 mb-6">
            <button type="submit" class="btn btn-sm btn-primary">Update Password</button>
        </div>
    </form>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('#copyBoard').click(function() {
                var copyText = document.getElementsByClassName("referralURL");
                copyText = copyText[0];
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                /*For mobile devices*/
                document.execCommand("copy");
                copyText.blur();
                this.classList.add('copied');
                SlimNotifierJs.notification('success', 'Copied', '2FA Code Copied Successfuly', 3000);

                setTimeout(() => this.classList.remove('copied'), 1500);
            });
        })(jQuery);
    </script>
@endpush
