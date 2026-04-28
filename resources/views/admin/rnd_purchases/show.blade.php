@extends($activeTemplate . 'layouts.app')
@section('panel')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3>{{ $pageTitle }}</h3>
                <a href="{{ route('admin.rnd.purchases.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Purchase Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Request ID:</strong> #{{ $purchase->id }}</p>
                            <p><strong>User:</strong>
                                <a href="{{ route('admin.users.detail', $purchase->user_id) }}">
                                    {{ $purchase->user->fullname }}
                                </a>
                            </p>
                            <p><strong>Email:</strong> {{ $purchase->user->email }}</p>
                            <p><strong>User Balance:</strong> {{ number_format($purchase->user->balance, 8) }}</p>
                            <p><strong>RND Amount:</strong> {{ number_format($purchase->rnd_amount, 8) }} RND</p>
                            <p><strong>Exchange Rate:</strong> {{ number_format($purchase->exchange_rate, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Total Amount:</strong> {{ number_format($purchase->total_amount, 8) }}</p>
                            <p><strong>Vendor Name:</strong> {{ $purchase->vendor_name }}</p>
                            <p><strong>Status:</strong> {!! $purchase->status_badge !!}</p>
                            <p><strong>Created:</strong> {{ showDateTime($purchase->created_at) }}</p>
                            <p><strong>Updated:</strong> {{ showDateTime($purchase->updated_at) }}</p>
                        </div>
                    </div>

                    @if($purchase->vendor_payment_details)
                        <div class="mt-3">
                            <p><strong>Vendor Payment Details:</strong></p>
                            <div class="bg-light p-3 rounded">
                                {{ $purchase->vendor_payment_details }}
                            </div>
                        </div>
                    @endif

                    @if($purchase->admin_note)
                        <div class="mt-3">
                            <p><strong>Admin Note:</strong></p>
                            <div class="bg-light p-3 rounded">
                                {{ $purchase->admin_note }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if($purchase->status == 'processing')
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Process Request</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.rnd.purchases.process', $purchase) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exchange_rate">Exchange Rate</label>
                                        <input type="number"
                                               step="0.00000001"
                                               min="0.00000001"
                                               class="form-control"
                                               id="exchange_rate"
                                               name="exchange_rate"
                                               value="{{ $currentRate }}"
                                               required>
                                        <small class="text-muted">Current rate: {{ $currentRate }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Calculated Total</label>
                                        <div class="form-control bg-light">
                                            <span id="calculated_total">{{ number_format($purchase->rnd_amount * $currentRate, 8) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-warning">
                                <strong>Warning:</strong> This will deduct the calculated amount from the user's wallet.
                            </div>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-cog"></i> Process Request
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            @if($purchase->status == 'pending')
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Approval Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Approve Request</h6>
                                <form action="{{ route('admin.rnd.purchases.approve', $purchase) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="receipt">Upload Receipt</label>
                                        <input type="file"
                                               class="form-control"
                                               id="receipt"
                                               name="receipt"
                                               accept="image/*"
                                               required>
                                    </div>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <h6>Decline Request</h6>
                                <form action="{{ route('admin.rnd.purchases.decline', $purchase) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="admin_note">Reason for Decline</label>
                                        <textarea class="form-control"
                                                  id="admin_note"
                                                  name="admin_note"
                                                  rows="3"
                                                  required
                                                  placeholder="Enter reason for declining this request"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-times"></i> Decline
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Documents</h5>
                </div>
                <div class="card-body">
                    @if($purchase->payment_proof)
                        <div class="mb-3">
                            <p><strong>Payment Proof:</strong></p>
                            <img src="{{ getFile('rnd_payment_proof', $purchase->payment_proof) }}"
                                 alt="Payment Proof"
                                 class="img-fluid rounded"
                                 style="max-height: 200px; cursor: pointer;"
                                 onclick="window.open(this.src, '_blank')">
                            <br>
                            <a href="{{ route('admin.rnd.purchases.download.payment-proof', $purchase) }}"
                               class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>
                    @endif

                    @if($purchase->receipt)
                        <div class="mb-3">
                            <p><strong>Receipt:</strong></p>
                            <img src="{{ getFile('rnd_receipt', $purchase->receipt) }}"
                                 alt="Receipt"
                                 class="img-fluid rounded"
                                 style="max-height: 200px; cursor: pointer;"
                                 onclick="window.open(this.src, '_blank')">
                            <br>
                            <a href="{{ route('admin.rnd.purchases.download.receipt', $purchase) }}"
                               class="btn btn-sm btn-success mt-2">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Status Flow</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Processing</span>
                        <i class="fas {{ $purchase->status == 'processing' ? 'fa-check-circle text-success' : 'fa-circle text-muted' }}"></i>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Pending Approval</span>
                        <i class="fas {{ in_array($purchase->status, ['pending', 'approved']) ? 'fa-check-circle text-success' : 'fa-circle text-muted' }}"></i>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>{{ $purchase->status == 'approved' ? 'Approved' : ($purchase->status == 'declined' ? 'Declined' : 'Completed') }}</span>
                        <i class="fas {{ in_array($purchase->status, ['approved', 'declined']) ? 'fa-check-circle text-' . ($purchase->status == 'approved' ? 'success' : 'danger') : 'fa-circle text-muted' }}"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#exchange_rate').on('input', function() {
        const exchangeRate = parseFloat($(this).val()) || 0;
        const rndAmount = {{ $purchase->rnd_amount }};
        const total = rndAmount * exchangeRate;
        $('#calculated_total').text(total.toFixed(8));
    });
});
</script>
@endpush
