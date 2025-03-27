@extends(checkTemplate() . 'layouts.app')
@section('panel')
   <!-- Transaction Log -->
 <div class="col-lg-12 d-flex align-items-strech">
  <div class="card w-100">
    <div class="card-body">
      <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
        <div class="d-flex justify-content-between align-items-center mb-7">
    <!-- Left side: Create Card Title -->
    <h5 class="card-title fw-semibold mb-0">@lang('Create Card')</h5>

    <!-- Right side: Rate and Card Creation Fee -->
    <div class="text-end">
        <strong>Rate: &#8358;{{ $general->virtualcard_usd_rate }} = $1</strong><br>
        <strong>Card Creation Fee - 1.99% + $1.99</strong>
    </div>
</div>

      </div>
      <div class="col-lg-9">
        <div class="card">
          <div class="card-body p-4">
            <form action="{{ route('user.create.card.add') }}" method="post" enctype="multipart/form-data">
              @csrf
              @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
              @endif
              <div class="row">
                <!-- Card Holder Name Field -->
                <div class="col-sm-6">
                  <div class="mb-4">
                    <label for="card_holder_name" class="form-label fw-semibold">@lang('Card Holder Name')</label>
                    <input type="text" class="form-control" name="card_holder_name" required="">
                  </div>
                </div>
              </div>

              <div class="row">
                <!-- Amount in USD Field -->
                <div class="col-sm-6">
                  <div class="mb-4">
                    <label for="amount" class="form-label fw-semibold">@lang('Amount in USD') (Minimum of $3)</label>
                    <input type="text" id="amount" class="form-control" name="amount" required="" oninput="calculateTotal()">
                  </div>
                </div>
              </div>


              <!-- Total Charge Display -->
              <div class="col-sm-6">
              <div class="mb-4">
                <label for="total_charge" class="form-label fw-semibold">@lang('Total Charge in NGN')</label>
                <input type="text" id="total_charge" class="form-control" readonly>
              </div>
              </div>

              <div class="mb-4">
                <button type="submit" class="mt-4 btn btn-primary">@lang('Submit')</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('breadcrumb-plugins')
@endpush

@push('script')
<script>
    function calculateTotal() {
        // Get rate and amount input values
        const rate = {{ $general->virtualcard_usd_rate }};
        const amount = parseFloat(document.getElementById('amount').value);

        if (isNaN(amount) || amount < 3) {
            document.getElementById('total_charge').value = 'Amount must be at least $3';
            return;
        }

        // Calculate total charge
        const feePercentage = 1.99 / 100;
        const fixedFee = 1.99;
        const fee = (amount * feePercentage) + fixedFee;
        const totalUSD = amount + fee;

        // Convert to NGN
        const totalNGN = totalUSD * rate;

        // Display total charge
        document.getElementById('total_charge').value = totalNGN.toFixed(2);
    }
</script>
@endpush
