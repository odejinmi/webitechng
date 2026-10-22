@extends('admin.layouts.app')

@section('panel')
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card b-radius--10">
                <div class="card-body">
                    <h4 class="mb-3">@lang('Run Pending Database Migrations')</h4>
                    <p class="text-muted">
                        @lang('This runs only pending Laravel migrations. Disable this temporary page immediately after it completes.')
                    </p>

                    <form method="POST" action="{{ route('admin.system.migration.run') }}">
                        @csrf
                        <button type="submit" class="btn btn--primary w-100">
                            @lang('Run Migration Now')
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
