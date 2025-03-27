@extends($activeTemplate . 'layouts.app')
@section('panel')
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="card">
                        <div class="card-body">


                            <div class="buy-sell-widget">

                                <div class="tab-content tab-content-default">
                                    <div class="tab-pane fade show active" id="buy" role="tabpanel">



                                        <div class="col-12 layout-spacing">
                                            <div class="widget widget-table-two">

                                                <div class="widget-heading">
                                                    <h5 class="">{{ $pageTitle }}</h5>
                                                </div>

                                                <div class="widget-content">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        <div class="th-content">Customer</div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="th-content">Product</div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="th-content">Invoice</div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="th-content th-heading">Price</div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="th-content">Status</div>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($card as $k=>$data)
                                                                    @php
                                                                        $gcard = App\Models\Giftcard::whereId($data->card_id)->first();
                                                                    @endphp
                                                                    <tr>
                                                                        <td>
                                                                            <div class="td-content customer-name"><img width="50"
                                                                                    src="{{ asset('assets/images/giftcards') }}/{{ @$gcard->image }}"
                                                                                    alt="avatar"><span>{{ @$gcard->name }}</span>
                                                                            </div>

                                                                        </td>
                                                                        <td>
                                                                            <div
                                                                                class="td-content product-brand text-primary">
                                                                                {!! date(' d/M/Y', strtotime($data->created_at)) !!}<br>
                                                                                {{ Carbon\Carbon::parse($data->updated_at)->diffForHumans() }}
                                                                            </div>
                                                                        </td>
                                                                        <td> 
                                                                            <a href="#tranxDetails{{ $data->id }}"
                                                                                class="badge bg-primary"
                                                                                data-bs-toggle="modal">View More <small>({{ $data->trx }})</small></a>
                                                                        </td>
                                                                        <td>
                                                                            <div class="td-content pricing"><span
                                                                                    class="">
                                                                                    <span>{{ $data->country }}</span>{{ $data->amount }}</span>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="td-content">
                                                                                @if ($data->status == 1)
                                                                                    <span
                                                                                        class="badge badge-success">Approved</span>
                                                                                @elseif($data->status == 0)
                                                                                    <span
                                                                                        class="badge badge-warning">Pending</span>
                                                                                @elseif($data->status == 2)
                                                                                    <span
                                                                                        class="badge badge-danger">Declined</span>
                                                                                @endif
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <div class="modal fade" tabindex="-1"
                                                                        id="tranxDetails{{ $data->id }}">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <a href="#" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close"><em
                                                                                        class="icon ni ni-cross"></em></a>
                                                                                <div class="modal-body modal-body-md">
                                                                                    <div class="nk-modal-head mb-3 mb-sm-5">
                                                                                        <h4 class="nk-modal-title title">
                                                                                            Transaction <small
                                                                                                class="text-primary">#{{ $data->trx }}</small>
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div class="nk-tnx-details">
                                                                                        <div
                                                                                            class="nk-block-between flex-wrap g-3">
                                                                                            <div class="nk-tnx-type">
                                                                                                @if ($data->status == 1)
                                                                                                    <div
                                                                                                        class="nk-tnx-type-icon bg-success-dim text-success">
                                                                                                    @elseif($data->status == 0)
                                                                                                        <div
                                                                                                            class="nk-tnx-type-icon bg-warning-dim text-warning">
                                                                                                        @elseif($data->status == 2)
                                                                                                            <div
                                                                                                                class="nk-tnx-type-icon bg-danger-dim text-danger">
                                                                                                @endif


                                                                                                <em
                                                                                                    class="icon ni ni-wallet"></em>
                                                                                            </div>
                                                                                            <div class="nk-tnx-type-text">
                                                                                                <h5 class="title">
                                                                                                    {{ $data->country }}{{ number_format($data->amount, 2) }}
                                                                                                </h5>
                                                                                                <span
                                                                                                    class="sub-text mt-n1">{!! date('D, d/M, Y: h:m A', strtotime($data->created_at)) !!}</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <ul
                                                                                            class="align-center flex-wrap gx-3">
                                                                                            <li>
                                                                                                @if ($data->status == 1)
                                                                                                    <span
                                                                                                        class="badge badge-sm badge-success">Completed</span>
                                                                                                @elseif($data->status == 0)
                                                                                                    <span
                                                                                                        class="badge badge-sm badge-warning">Pending</span>
                                                                                                @elseif($data->status == 2)
                                                                                                    <span
                                                                                                        class="badge badge-sm badge-danger">Declined</span>
                                                                                                @endif
                                                                                            </li>
                                                                                        </ul>

                                                                                    </div>
                                                                                    <div
                                                                                        class="nk-modal-head mt-sm-5 mt-4 mb-4">
                                                                                        <h5 class="title"><b>Transaction Info</b>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="row gy-3">
                                                                                        <div class="col-lg-6"><span
                                                                                                class="sub-text">Gift
                                                                                                Card: </span><span
                                                                                                class="caption-text">{{ isset(App\Models\Giftcard::whereId($data->card_id)->first()->id) ? App\Models\Giftcard::whereId($data->card_id)->first()->name : 'N/A' }}</span>
                                                                                        </div>
                                                                                        <div class="col-lg-6"><span
                                                                                                class="sub-text">Gift Card
                                                                                                Type: </span><span
                                                                                                class="caption-text text-break">{{ isset(App\Models\Giftcardtype::whereId($data->currency)->first()->id) ? App\Models\Giftcardtype::whereId($data->currency)->first()->name : 'N/A' }}</span>
                                                                                        </div>
                                                                                        <div class="col-lg-6"><span
                                                                                                class="sub-text">Exchange
                                                                                                Rate: </span><span
                                                                                                class="caption-text">1{{ $data->country }}
                                                                                                =
                                                                                                {{ $general->cur_sym }}{{ number_format($data->rate, 2) }}</span>
                                                                                        </div>
                                                                                        <div class="col-lg-6"><span
                                                                                                class="sub-text">Calculated
                                                                                                Value: </span><span
                                                                                                class="caption-text">{{ $general->cur_sym }}{{ number_format($data->amount * $data->rate, 2) }}
                                                                                            </span></div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="nk-modal-head mt-sm-5 mt-4 mb-4">
                                                                                        <h5 class="title"><b>Transaction
                                                                                            Details</b></h5>
                                                                                    </div>
                                                                                    <div class="row gy-3">
                                                                                        @if($data->status == 2)
                                                                                        <div class="col-lg-6"><span
                                                                                            class="sub-text">Decline Reason: </span><span
                                                                                            class="caption-text">{{ $data->val_1 }}</span>
                                                                                        </div>
                                                                                        @endif

                                                                                        <div class="col-lg-6"><span
                                                                                                class="sub-text">Card
                                                                                                Type: </span><span
                                                                                                class="caption-text">{{ $data->type }}</span>
                                                                                        </div>
                                                                                        <div class="col-lg-6">
                                                                                            <span class="sub-text">Card
                                                                                                Number: </span><span
                                                                                                class="caption-text align-center"><span
                                                                                                    class="badge badge-primary ml-2 text-white">{{ isset($data->code) ? $data->code : '**********' }}
                                                                                                </span></span>
                                                                                        </div>

                                                                                        @if ($data->image)
                                                                                            <div class="col-lg-6">
                                                                                                <span class="sub-text">Card
                                                                                                    Front View: </span><span
                                                                                                    class="caption-text align-center"><img width="40"
                                                                                                        src="{{ asset('assets/images/giftcards/' . $data->image) }}"
                                                                                                        wdith="70"
                                                                                                        alt="passport"></span>
                                                                                            </div>
                                                                                        @endif
                                                                                        @if ($data->image2)
                                                                                            <div class="col-lg-6">
                                                                                                <span class="sub-text">Card
                                                                                                    Back View: </span><span
                                                                                                    class="caption-text align-center"><img width="40"
                                                                                                        src="{{ asset('assets/images/giftcards/' . $data->image2) }}"
                                                                                                        wdith="70"
                                                                                                        alt="passport"></span>
                                                                                            </div>
                                                                                        @endif 
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                    </div>
                                                @empty
                                                    Data Not Found
                                                    @endforelse
                                                    </tbody>
                                                    </table>
                                                </div>

                                                <ul class="pagination justify-content-center justify-content-md-start">
                                                    {{ @$card->links() }}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
