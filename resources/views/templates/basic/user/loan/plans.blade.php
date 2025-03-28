@extends($activeTemplate . 'layouts.app')
@section('panel')

    @include($activeTemplate . 'partials.loan_plans')
@endsection

@push('breadcrumb-plugins')

    <div class="col-12 order-lg-3 order-4">
        <div class="d-flex nav-buttons flex-align gap-md-3 gap-2">
            <a href="{{ route('user.loan.list') }}" class="btn btn-dark text-white">@lang('My Loan List')</a>
        </div>
    </div>
@endpush
