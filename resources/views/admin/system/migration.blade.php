@extends('admin.layouts.app')

@section('panel')
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card b-radius--10">
                <div class="card-body">
                    <h4 class="mb-3">@lang('Install PayVessel Database Changes')</h4>
                    <p class="text-muted">
                        @lang('This runs only the PayVessel provider migration. Existing application tables are not recreated.')
                    </p>

                    <form method="POST" action="{{ route('admin.system.migration.run') }}">
                        @csrf
                        <button type="submit" class="btn btn--primary w-100">
                            @lang('Install PayVessel Changes')
                        </button>
                    </form>

                    @if (session('migration_output'))
                        <div class="mt-4">
                            <h5>@lang('Migration Output')</h5>
                            <pre class="bg-dark text-white p-3 rounded" style="white-space: pre-wrap;">{{ session('migration_output') }}</pre>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
