@extends(checkTemplate() . 'layouts.app')
@section('panel')
    <!-- File export -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-2">
                    <h5 class="mb-0">{{ $pageTitle }}</h5>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="body">
                        <div id="card-design" class="p-4 d-flex text-white flex-column mx-auto mb-4" style="max-width:300px;border-radius: .55em; background: #2a43aa;">
                            <div class="mb-4 d-flex flex-row justify-content-between">
                                <span class="h5">LTECHNG</span>
                                <span>
                                    ${{ number_format($cardDetails['balance'] ?? 0, 2) }}
                                </span>
                            </div>
                         <span style="font-size: 23px;">
                            {{ isset($cardDetails['card_number']) ? chunk_split($cardDetails['card_number'], 4, '  ') : 'N/A' }}
                        </span>
                            <div class="d-flex flex-row justify-content-between">
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row">
                                        <span class="mr-2" style="font-size:8px;">{{__('VALID')}}<br>{{__('TILL')}}</span>
                                        <div class="align-self-center">{{ $cardDetails['expiry'] ?? 'N/A' }}</div>
                                    </div>
                                    <div>
                                       {{ $cardDetails['card_holder_name'] ?? 'N/A' }}
                                    </div>
                                </div>
                                <img class="align-self-end mb-2" src="https://strowallet.com/assets/visa.png" alt="" width="15%" height="15%">
                            </div>
                        </div>
                        <div class="card">

                            <div class="body d-flex flex-column">
                                <div class="d-flex flex-row">
                                    <div>
    <p><strong>{{ __('Card Number:') }}</strong> {{ $cardDetails['card_number'] ?? 'N/A' }}</p>
    <p><strong>{{ __('CVV:') }}</strong> {{ $cardDetails['cvv'] ?? 'N/A' }}</p>
    <p><strong>{{ __('Card Type:') }}</strong> {{ $cardDetails['card_type'] ?? 'N/A' }}</p>
    <p><strong>{{ __('Valid Until:') }}</strong> {{ $cardDetails['expiry'] ?? 'N/A' }}</p>
    <p><strong>{{ __('Card Brand:') }}</strong> {{ $cardDetails['card_brand'] ?? 'N/A' }}</p>
    <p><strong>{{ __('Card Status:') }}</strong> {{ $cardDetails['card_status'] ?? 'N/A' }}</p>
    <p><strong>{{ __('Reference:') }}</strong> {{ $cardDetails['reference'] ?? 'N/A' }}</p>
    <p><strong>{{ __('Street:') }}</strong> 3401 N. Miami, Ave. Ste 230</p>
    <p><strong>{{ __('State:') }}</strong> Florida</p>
    <p><strong>{{ __('City:') }}</strong> Miami</p>
    <p><strong>{{ __('Zip:') }}</strong> 33127</p>
    <p><strong>{{ __('Country:') }}</strong> USA</p>
    <p><strong>{{ __('Date of Creation:') }}</strong> {{ $cardDetails['card_created_date'] ?? 'N/A' }}</p>
</div>

                            </div>
                            <div class="footer">


                            </div>
                        </div>
                           @if(session('success'))
                                <div class="alert alert-success">
                                    @if(is_array(session('success')))
                                        {!! implode('<br>', session('success')) !!}
                                    @else
                                        {{ session('success') }}
                                    @endif
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    @if(is_array(session('error')))
                                        {!! implode('<br>', session('error')) !!}
                                    @else
                                        {{ session('error') }}
                                    @endif
                                </div>
                            @endif
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <h5><strong>Fund Card</strong></h5>
                                    <form action="{{ route('user.post_fund.card', $vcards->card_id) }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="amount">Amount in USD </label>
                                                    <input type="number" class="form-control" id="amount" name="amount" required>
                                                    Rate #{{ $general->virtualcard_usd_rate }} = $1
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-primary" style="margin-top:20px">Add Funds</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h6>Transaction History</h6>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Method</th>
                                                <th>Narrative</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @if(isset($cardTransactions->response->card_transactions))
                                                @foreach($cardTransactions->response->card_transactions as $transaction)
                                                    <tr>
                                                        <td>{{ date('Y-m-d H:i:s', strtotime($transaction->createdAt)) }}</td>
                                                        <td>{{ $transaction->type }}</td>
                                                        <td>{{ $transaction->method }}</td>
                                                        <td>{{ $transaction->narrative }}</td>
                                                        <td>${{ number_format(($transaction->centAmount ?? 0) / 100, 2) }}</td>
                                                        <td>{{ $transaction->status }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6">No transactions found.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
