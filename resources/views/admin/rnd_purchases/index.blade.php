@extends($activeTemplate . 'layouts.app')
@section('panel')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3>{{ $pageTitle }}</h3>
                <a href="{{ route('admin.rnd.exchange.rate') }}" class="btn btn-info">
                    <i class="fas fa-exchange-alt"></i> Manage Exchange Rate
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if($purchases->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>RND Amount</th>
                                        <th>Exchange Rate</th>
                                        <th>Total Amount</th>
                                        <th>Vendor</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchases as $purchase)
                                        <tr>
                                            <td>#{{ $purchase->id }}</td>
                                            <td>
                                                <a href="{{ route('admin.users.detail', $purchase->user_id) }}">
                                                    {{ $purchase->user->fullname }}
                                                </a>
                                                <br>
                                                <small class="text-muted">{{ $purchase->user->email }}</small>
                                            </td>
                                            <td>{{ number_format($purchase->rnd_amount, 8) }} RND</td>
                                            <td>{{ number_format($purchase->exchange_rate, 2) }}</td>
                                            <td>{{ number_format($purchase->total_amount, 8) }}</td>
                                            <td>{{ $purchase->vendor_name }}</td>
                                            <td>{!! $purchase->status_badge !!}</td>
                                            <td>{{ showDateTime($purchase->created_at) }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('admin.rnd.purchases.show', $purchase) }}"
                                                       class="btn btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if($purchase->payment_proof)
                                                        <a href="{{ route('admin.rnd.purchases.download.payment-proof', $purchase) }}"
                                                           class="btn btn-primary" title="Download Payment Proof">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    @endif
                                                    @if($purchase->receipt)
                                                        <a href="{{ route('admin.rnd.purchases.download.receipt', $purchase) }}"
                                                           class="btn btn-success" title="Download Receipt">
                                                            <i class="fas fa-file-invoice"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $purchases->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-coins fa-3x text-muted mb-3"></i>
                            <h4>No RND Purchase Requests</h4>
                            <p class="text-muted">No RND purchase requests have been submitted yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
