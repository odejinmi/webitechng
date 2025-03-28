@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'partials.sidenav')
    <div class="flex-lg-fill overflow-x-auto ps-lg-1 vstack vh-lg-100 position-relative">
        @include($activeTemplate . 'partials.topnav')
    <div class="flex-fill overflow-y-lg-auto scrollbar bg-body rounded-top-4 rounded-top-start-lg-4 rounded-top-end-lg-0 border-top border-lg shadow-2">
        <main class="container-fluid px-3 py-5 p-lg-6 p-xxl-8">
            <div class="mb-6 mb-xl-10">
                <div class="row g-3 align-items-center">
                    <div class="col">
                        <h1 class="ls-tight">{{@$pageTitle}}</h1>
                    </div>
                    <div class="col">
                        <div class="hstack gap-2 justify-content-end">
                            <a href="{{ route('user.deposit.history') }}" class="btn btn-sm btn-neutral d-sm-inline-flex"><span>Deposit</span></a>
                            <a href="{{ route('user.withdraw') }}" class="btn d-inline-flex btn-sm btn-dark"><span>Payout</span></a>
                                @stack('breadcrumb')
                        </div>
                    </div>
                </div>
            </div>

            @yield('panel')

        </main>
    </div>

    </div>
@endsection
