@extends($activeTemplate . 'layouts.app')
@section('panel')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3>{{ $pageTitle }}</h3>
                <a href="{{ route('admin.rnd.purchases.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Requests
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Update Exchange Rate</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.rnd.exchange.rate.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="rate">Current Exchange Rate</label>
                            <div class="input-group">
                                <input type="number"
                                       step="0.00000001"
                                       min="0.00000001"
                                       class="form-control"
                                       id="rate"
                                       name="rate"
                                       value="{{ $currentRate }}"
                                       required>
                                <div class="input-group-append">
                                    <span class="input-group-text">per RND</span>
                                </div>
                            </div>
                            <small class="text-muted">1 RND = <span id="rate_display">{{ $currentRate }}</span></small>
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes (Optional)</label>
                            <textarea class="form-control"
                                      id="notes"
                                      name="notes"
                                      rows="3"
                                      placeholder="Add a note about this rate change"></textarea>
                        </div>

                        <div class="alert alert-info">
                            <strong>Current Rate:</strong> 1 RND = {{ $currentRate }}
                            <br>
                            <small>This rate will be used for all new RND purchase requests.</small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-sync"></i> Update Rate
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Rate Changes</h5>
                </div>
                <div class="card-body">
                    @if($rateHistory->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Rate</th>
                                        <th>Updated By</th>
                                        <th>Notes</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rateHistory as $rate)
                                        <tr>
                                            <td>{{ number_format($rate->rate, 2) }}</td>
                                            <td>
                                                @if($rate->updatedBy)
                                                    {{ $rate->updatedBy->name }}
                                                @else
                                                    System
                                                @endif
                                            </td>
                                            <td>{{ $rate->notes ?? '-' }}</td>
                                            <td>{{ showDateTime($rate->created_at) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-history fa-2x text-muted mb-2"></i>
                            <p class="text-muted">No rate changes recorded yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#rate').on('input', function() {
        $('#rate_display').text($(this).val());
    });
});
</script>
@endpush
