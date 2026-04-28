@extends($activeTemplate . 'layouts.app')
@section('panel')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3>{{ $pageTitle }}</h3>
                <a href="{{ route('user.rnd.purchases.index') }}" class="btn btn-secondary">
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
                            <p><strong>RMB Amount:</strong> {{ number_format($purchase->rnd_amount, 8) }} RMB</p>
                            <p><strong>Exchange Rate:</strong> {{ number_format($purchase->exchange_rate, 2) }}</p>
                            <p><strong>Total Amount:</strong> {{ number_format($purchase->total_amount, 8) }}</p>
                        </div>
                        <div class="col-md-6">
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
                            <a href="{{ route('user.rnd.purchases.download.receipt', $purchase) }}"
                               class="btn btn-sm btn-success mt-2">
                                <i class="fas fa-download"></i> Download Receipt
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
