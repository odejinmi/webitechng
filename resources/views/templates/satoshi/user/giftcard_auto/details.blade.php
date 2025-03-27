@extends($activeTemplate . 'layouts.app')

@section('panel')
    @push('style')
        <link id="themeColors" rel="stylesheet" href="{{ asset('assets/assets/dist/css/product.min.css') }}" />
    @endpush
    @include($activeTemplate . 'partials.breadcrumb')

    <section class="py-24" data-aos="fade-up">
        <div class="container">

            <div class="shop-detail">
                <div class="card shadow-none border d-none" id="showproduct">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div id="sync1" class="owl-scarousel owl-stheme">
                                    <div class="item rounded overflow-hidden">
                                        <div id="productImage2"></div>
                                    </div>
                                </div>

                                <div id="sync2" class="owl-caroussel owl-tsheme">
                                    <div class="item rounded overflow-hidden">
                                        <div id="productImage"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="shop-content">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="badge text-bg-success fs-2 fw-semibold rounded-3"
                                            id="productCountry"></span>
                                        <span class="fs-2" id="productBrand"></span>
                                    </div>
                                    <h4 class="fw-semibold" id="productName"></h4>
                                    <p class="mb-3" id="productinfo"></p>
                                    <h4 class="fw-semibold mb-3" id="productAmount"></h4>
                                    <form role="form" method="POST" action="{{route('user.giftcard.auto.buy',4)}}">

                                    {{ csrf_field() }}
                                    <input name="product_id" hidden required id="product_id">
                                    <input name="product_amount" hidden required id="product_amount">
                                    <input name="productName" hidden required id="productNameValue">
                                    <input name="logoUrls" hidden required id="logoUrls">
                                    <input name="recipientCurrencyCode" hidden required id="recipientCurrencyCode">

                                    <div class="d-flex align-items-center gap-7 pb-7 mb-7 border-bottom">
                                        <h6 class="mb-0 fs-4 fw-semibold">QTY:</h6>
                                        <div class="input-group input-group-sm rounded">
                                            <button onclick="removeamount()"
                                                class="btn minus min-width-40 py-0 border-end border-secondary fs-5 border-end-0 text-secondary"
                                                type="button" id="add1"><i class="ti ti-minus"></i></button>
                                            <input name="quantity" readonly id="quantity" type="text" value="1"
                                                class="min-width-40 flex-grow-0 border border-secondary text-secondary fs-4 fw-semibold form-control text-center qty"
                                                placeholder="" aria-label="Example text with button addon"
                                                aria-describedby="add1">
                                            <button onclick="addamount()"
                                                class="btn min-width-40 py-0 border border-secondary fs-5 border-start-0 text-secondary add"
                                                type="button" id="addo2"><i class="ti ti-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="d-sm-flex align-items-center gap-3 pt-8 mb-7">
                                        <button type="submit" class="btn d-block btn-primary px-5 py-8 mb-2 mb-sm-0">@lang('Checkout')</button>
                                        <div id="loading"></div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-none border d-none" id="showproductdetails">
                    <div class="card-body p-4">
                        <ul class="nav nav-pills user-profile-tab border-bottom" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                                    id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description"
                                    type="button" role="tab" aria-controls="pills-description" aria-selected="true">
                                    @lang('Description')
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content pt-4" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-description" role="tabpanel"
                                aria-labelledby="pills-description-tab" tabindex="0">
                                <h5 class="fs-5 fw-semibold mb-7" id="productconcise"> </h5>
                                <p class="mb-0" id="productoverview"> </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="loader"></div>
                <div class="related-products pt-7 d-none" id="showrelatedproduct">
                    <h4 class="mb-3 fw-semibold">@lang('Related Products')</h4>
                    <div id="mylist"></div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    @include($activeTemplate . 'partials.loader')
     
    <script>
        $(document).ready(function() {
            fetch_data();
        });

        function removeamount() {
            qantity = document.getElementById('quantity').value;
            document.getElementById('quantity').value = qantity - 1;
        }

        function addamount() {
            qantity = document.getElementById('quantity').value;
            document.getElementById('quantity').value = +qantity + 1;
        }

        function fetch_data() {
            let ur = window.location.href;
            let urll = new URL(ur);
            let search_params = urll.searchParams;
            var productID = search_params.get('id');

            //console.info(ur);
            let url = `{{ route('user.giftcardbyid') }}?product=${productID}`;
            let loader = `  <div class="main-page">
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
            document.getElementById('loader').innerHTML = loader;

            fetch(url)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    let result = data.data;
                    let amount = result.fixedRecipientDenominations;
                    let amountMAP = result.fixedRecipientToSenderDenominationsMap;

                    let html = '';
                    amount.map(card => {
                        let htmlSegment =
                            `
                            
                  <label onclick="setamount(${result.productId}, ${card})" class="btn btn-sm btn-light-primary text-primary font-medium" style="margin-right: 10px;">
                    <div class="form-check">
                      <input type="radio" id="customRadio${card}" name="customRadio" class="form-check-input" />
                      <label class="form-check-label" for="customRadio${card}"><span class="d-block d-md-none">3</span><span
                          class="d-none d-md-block">${Intl.NumberFormat().format(card)} <small>${result.recipientCurrencyCode}</small></span></label>
                    </div>
                  </label>
                  `;
                        html += htmlSegment;
                    });

                    let showdiv = $('#showproduct');
                    let showdivdet = $('#showproductdetails');

                    let showrelateddiv = $('#showrelatedproduct');
                    //$(showdiv).addClass('is-valid');
                    $(showdiv).removeClass('d-none')
                    $(showdivdet).removeClass('d-none')
                    $(showrelateddiv).removeClass('d-none')
                    this.relatedproducts(result.brand.brandName);
                    document.getElementById('productAmount').innerHTML = `<h6 class="mb-0 fs-4 fw-semibold">Amount:</h6>

                    <div class="btn-group" data-bs-toggle="buttons">${html}</div>`;
                    document.getElementById('productCountry').innerHTML = result.country.name;
                    document.getElementById('productName').innerHTML = result.productName;
                    document.getElementById('productNameValue').value = result.productName;
                    document.getElementById('recipientCurrencyCode').value = result.recipientCurrencyCode;
                    document.getElementById('logoUrls').value = result.logoUrls;
                    document.getElementById('productBrand').innerHTML = result.brand.brandName;
                    document.getElementById('productconcise').innerHTML = result.redeemInstruction.concise;
                    document.getElementById('productoverview').innerHTML = result.redeemInstruction.verbose;
                    document.getElementById('loader').innerHTML = '';
                    document.getElementById('productImage').innerHTML =
                        `<img src="${result.logoUrls}" width="410" class="img-fluid" alt="Shop Single Image"/>`;
                    document.getElementById('productinfo').innerHTML = result.redeemInstruction.concise;

                })
        }

        function setamount(product, amount, name, image) {
            document.getElementById("product_id").value = product;
            document.getElementById("product_amount").value = amount;
        }

        function relatedproducts(brand) {
            let loader = `  
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
            let url = `{{ route('user.fecthgiftcards') }}?productName=${brand ? brand : 'null'}`;
            document.getElementById('mylist').innerHTML = loader;
            fetch(url)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    if (!data.data) 
                    {
                    document.getElementById("mylist").innerHTML = 
                    `{!! emptyData() !!}`;
                    return;
                    }
                    let resultTRX = data.data.content;
                    let html = '';

                    resultTRX.map(card => {
                        let htmlSegment = 
                        `<div class="col-sm-6 col-xl-3 col-6">
                          <div class="card hover-img overflow-hidden rounded-2">
                            <div class="position-relative">
                              <a href="{{ route('user.giftcard') }}?id=${card.productId}"><img src="${card.logoUrls}" class="card-img-top rounded-0" alt="..."></a>
                            </div>
                            <div class="card-body pt-3 p-4">
                              <h6 class="fw-semibold fs-4">${card.productName}</h6>
                              <p class="text-gray-500">${card.brand.brandName}</p>
                            </div>
                          </div>
                        </div>`;
                        html += htmlSegment;
                    });

                    document.getElementById('mylist').innerHTML =
                    '<div class="row">' + html + '</div>';
                })
        }
    </script>
@endpush
