@extends($activeTemplate . 'layouts.app')
@section('panel')
    @push('style')

        <style>
            .coupon {

                border-style: dotted;
                border-color: blue;
            }

            .coupon .kanan {
                border-left: 1px dashed #ddd;
                width: 40% !important;
                position: relative;
            }

            .coupon .kanan .info::after,
            .coupon .kanan .info::before {
                content: '';
                position: absolute;
                width: 20px;
                height: 20px;
                background: #dedede;
                border-radius: 100%;
            }

            .coupon .kanan .info::before {
                top: -10px;
                left: -10px;
            }

            .coupon .kanan .info::after {
                bottom: -10px;
                left: -10px;
            }
 
        </style>
    @endpush
    <!-- File export -->
    <div class="row">
        <div class="col-12">
            <!-- ---------------------
                                  start File export
                              ---------------- -->
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <h5 class="mb-0">{{ $pageTitle }}</h5>
                    </div>
                    <p class="card-subtitle mb-3">
                        @lang('Please find below your card details below')
                    </p>
                    <div class="table-responsive">




                        <!------ Include the above in your HEAD tag ---------->

                        <div class="container my-5">
                            <div class="row">
                                <div id="mylist"></div>

                            </div>
                        </div>


                    </div>

                </div>
            </div>
            <!-- ---------------------
                                  end File export
                              ---------------- -->
        @endsection

        @push('breadcrumb-plugins')
        @endpush
        @push('script')
            @include($activeTemplate . 'partials.loader')
           
            <script>
                $(document).ready(function() {


                    if("{{$card->details}}" != null && "{{$card->transaction_id}}" != null)
                    { 
                            redeemcode();
                    }
                    else
                    {
                        var giftcard = "{{$card->details}}";
                        redeemcodeDB(giftcard);
                    }
                });

                function redeemcodeDB(giftcard) {
                   var giftcard = JSON.parse(giftcard.replace(/&quot;/g,'"'));
                    console.info(giftcard);
                            let html = '';
                            giftcard.map(card => {
                                let htmlSegment = `
                                 <div class="col-sm-12">
                                    <div class="coupon bg-white rounded mb-3 d-flex justify-content-between">
                                        <div class="kiri p-3">
                                            <div class="icon-container ">
                                                <div class="icon-container_box">
                                                    <img src="{{ $card->product_logo }}" width="85" alt="totoprayogo.com" class="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tengah py-3 d-flex w-100 justify-content-start">
                                            <div>
                                                <span class="badge bg-success">{{ $card->product_name }}</span>
                                                <h4 class="lead">Card Number: ${card.cardNumber} </h4>
                                                <p class="text-muted mb-0">Pin Code: ${card.pinCode}</p>
                                            </div>
                                        </div>
                                        <div class="kanan">
                                            <div class="info m-3 d-flex align-items-center">
                                                <div class="w-100">
                                                    <div class="block">
                                                        <span class="time font-weight-light">
                                                            <span>{{ getAmount($card->price) }}{{ $card->currency }}</span>
                                                        </span>
                                                    </div>
                                                    <a href="#" target="_blank" class="btn btn-sm btn-outline-danger btn-block">
                                                        {{ diffForHumans($card->created_at) }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                                html += htmlSegment;
                            });

                            document.getElementById('mylist').innerHTML = '<div class="row">' + html + '</div>';
                }

                function redeemcode() {
                    let url = `{{ route('user.giftcard.redeem', $card->deposit_code) }}`;
                    document.getElementById('mylist').innerHTML = `  
                    <div class="main-page">
                        <div class="loader">
                            <div class="spin-blend"></div>
                            <div class="spin-blend"></div>
                            <div class="spin-blend"></div>
                            <div class="spin-blend"></div>
                            <div class="spin-blend"></div>
                        </div>
                        <div class="loading-text">
                            <div class="letter">L</div>
                            <div class="letter">o</div>
                            <div class="letter">a</div>
                            <div class="letter">d</div>
                            <div class="letter">i</div>
                            <div class="letter">n</div>
                            <div class="letter">g</div>
                            <div class="letter">.</div>
                            <div class="letter">.</div>
                            <div class="letter">.</div>
                        </div>
                    </div>`;

                    fetch(url)
                        .then((response) => {
                            return response.json();
                        })
                        .then((data) => {
                            if (data.data === null) {
                                document.getElementById('mylist').innerHTML = `{!! emptyData2() !!}`;
                                return;
                            }


                            if (data.status != true) {
                                document.getElementById("mylist").innerHTML = `
                                <div class="alert alert-danger" role="alert">
                                ${data.message}
                                </div><br>
                                {!! emptyData2() !!}
                                `;
                            }
                            let resultTRX = data.data;
                            let html = '';
                            resultTRX.map(card => {
                                let htmlSegment = `
                                 <div class="col-sm-12">
                                    <div class="coupon bg-white rounded mb-3 d-flex justify-content-between">
                                        <div class="kiri p-3">
                                            <div class="icon-container ">
                                                <div class="icon-container_box">
                                                    <img src="{{ $card->product_logo }}" width="85" alt="totoprayogo.com" class="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tengah py-3 d-flex w-100 justify-content-start">
                                            <div>
                                                <span class="badge bg-success">{{ $card->product_name }}</span>
                                                <h4 class="lead">Card Number: ${card.cardNumber} </h4>
                                                <p class="text-muted mb-0">Pin Code: ${card.pinCode}</p>
                                            </div>
                                        </div>
                                        <div class="kanan">
                                            <div class="info m-3 d-flex align-items-center">
                                                <div class="w-100">
                                                    <div class="block">
                                                        <span class="time font-weight-light">
                                                            <span>{{ getAmount($card->price) }}{{ $card->currency }}</span>
                                                        </span>
                                                    </div>
                                                    <a href="#" target="_blank" class="btn btn-sm btn-outline-danger btn-block">
                                                        {{ diffForHumans($card->created_at) }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                                html += htmlSegment;
                            });

                            document.getElementById('mylist').innerHTML = '<div class="row">' + html + '</div>';
                        })
                }
            </script>
        @endpush
