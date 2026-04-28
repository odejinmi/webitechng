@extends($activeTemplate . 'layouts.app')
@section('panel')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $pageTitle }}</h4>
                    <p class="text-muted">Current Exchange Rate: 1 RMB = {{ $currentRate }} </p>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.rnd.purchases.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="rnd_amount">RMB Amount</label>
                            <input type="number"
                                   step="0.00000001"
                                   min="0.00000001"
                                   class="form-control"
                                   id="rnd_amount"
                                   name="rnd_amount"
                                   required
                                   placeholder="Enter RMB amount">
                            <small class="text-muted">Amount of RMB tokens you want to purchase</small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="vendor_name">Vendor Name</label>
                            <input type="text"
                                   class="form-control"
                                   id="vendor_name"
                                   name="vendor_name"
                                   required
                                   placeholder="Enter vendor name">
                        </div>

                        <div class="form-group mb-3">
                            <label for="vendor_payment_details">Vendor Payment Details</label>
                            <textarea class="form-control"
                                      id="vendor_payment_details"
                                      name="vendor_payment_details"
                                      rows="3"
                                      required
                                      placeholder="Enter payment details (e.g., Alipay ID, bank account, etc.)"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="payment_proof">Payment Proof</label>
                            <input type="file"
                                   class="form-control"
                                   id="payment_proof"
                                   name="payment_proof"
                                   accept="image/*"
                                   required>
                            <small class="text-muted">Upload screenshot of payment proof (JPG, PNG, max 2MB)</small>
                        </div>

                        <div class="alert alert-info">
                            <strong>Important:</strong>
                            <ul class="mb-0">
                                <li>Your wallet will be charged: <span id="total_amount">0.00</span></li>
                                <li>Calculation: RMB Amount × {{ $currentRate }} = Total Amount</li>
                                <li>Make sure you have sufficient balance in your wallet</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i> Submit Purchase Request
                            </button>
                            <a href="{{ route('user.rnd.purchases.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.card {
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}
.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('#rnd_amount').on('input', function() {
        const rndAmount = parseFloat($(this).val()) || 0;
        const exchangeRate = {{ $currentRate }};
        const totalAmount = rndAmount * exchangeRate;
        $('#total_amount').text(totalAmount.toFixed(8));
    });
});
</script>
@endpush
