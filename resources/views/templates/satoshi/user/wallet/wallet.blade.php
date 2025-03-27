@extends($activeTemplate . 'layouts.app')
@section('panel')
      <!-- crancy Dashboard -->
      <section class="crancy-adashboard crancy-show">
        <div class="container p-0">
          <div class="row row__bscreen">
            <div class="col-xxl-3 col-12 crancy-main__sidebar">
              <!-- Sidebar -->
              <div class="crancy-sidebar mg-top-30">
                <div class="row">
                  <div
                    class="col-xxl-12 col-xl-6 col-12 crancy-sidebar__widget"
                  >
                    <!-- crancy Single Sidebar -->
                    <div class="crancy-sidebar__single">
                      <!-- Sidebar Heading -->
                      <div class="crancy-sidebar__heading">
                        <h4 class="crancy-sidebar__title">My Wallet</h4>
                        <a href="#" class="crancy-sidebar__toggles"
                          ><img src="{{ asset($activeTemplateTrue . 'dashboard/img/inline-toggle.svg')}}"
                        /></a>
                      </div>

                      <!-- Wallet Card -->
                      <div
                        class="crancy-wallet-card crancy-bg-cover"
                        style="
                          background-image: url('{{ asset($activeTemplateTrue . 'dashboard/img/wallet-card-shape.svg')}}');
                        "
                      >
                        <div class="crancy-wallet-card__inner">
                          <div class="crancy-wallet-card__left">
                            <div class="crancy-wallet-card__amount">
                              <h4 class="crancy-wallet-card__title">
                                <span> {{ $coin->symbol }} @lang('Balance')</span>
                                <b>{{ $wallet->balance }}<small>{{ strToUpper($coin->symbol) }}</small></b>
                              </h4>
                            </div>
                          </div>
                          <div class="crancy-wallet-card__right">
                            <img src="{{ asset($activeTemplateTrue . 'dashboard/img/wallet-card-statics.svg')}}" />
                            <span
                              class="crancy-progress-card__percent crancy-color1"
                            >
                              <svg
                                class="crancy-color1__fill"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M15.4308 3.30786L14.4437 3.30786L10.5548 3.30786L9.56762 3.30786C8.2813 3.30786 7.47984 4.70322 8.12798 5.81431L11.0596 10.8399C11.7027 11.9424 13.2957 11.9424 13.9389 10.8399L16.8705 5.81431C17.5186 4.70322 16.7171 3.30786 15.4308 3.30786Z"
                                ></path>
                                <path
                                  opacity="0.4"
                                  d="M4.16878 15.8335L5.15594 15.8335L9.04483 15.8335L10.032 15.8335C11.3183 15.8335 12.1198 14.4381 11.4716 13.327L8.54002 8.30144C7.89689 7.19893 6.30389 7.19892 5.66076 8.30143L2.72915 13.327C2.08101 14.4381 2.88247 15.8335 4.16878 15.8335Z"
                                ></path>
                              </svg>
                              <a id="USDBALANCE"><i class="fa fa-spinner fa-spin"></i></a>
                            </span>
                          </div>
                        </div>
                        <div class="crancy-wallet-card__buttons">
                          <a
                            data-bs-toggle="modal"
                            data-bs-target="#popup_modal_1"
                            class="crancy-btn crancy-ybcolor"
                          >
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              fill="none"
                            >
                              <path
                                d="M18 11L18 7L6 7V19C6 20.1046 6.89543 21 8 21H16C17.1046 21 18 20.1046 18 19V11ZM18 11C20.2091 11 22 9.20914 22 7C22 4.79086 20.2091 3 18 3H6C3.79086 3 2 4.79086 2 7C2 9.20914 3.79086 11 6 11"
                                stroke-width="1.5"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M14 12.5858L12.7071 11.2929C12.3166 10.9024 11.6834 10.9024 11.2929 11.2929L10 12.5858M12 16.5858V11.5858"
                                stroke-width="1.5"
                                stroke-linecap="round"
                              />
                            </svg>
                            Receive
                          </a>
                          <a href="#" class="crancy-btn crancy-white"
                          data-bs-toggle="modal"
                            data-bs-target="#popup_modal_2"
                          >
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              fill="none"
                            >
                              <path
                                d="M6 13.0001L6 17.0001L18 17.0001L18 5.00009C18 3.89552 17.1046 3.00009 16 3.00009L8 3.00009C6.89543 3.00009 6 3.89552 6 5.00009L6 13.0001ZM6 13.0001C3.79086 13.0001 2 14.7909 2 17.0001C2 19.2092 3.79086 21.0001 6 21.0001L18 21.0001C20.2091 21.0001 22 19.2092 22 17.0001C22 14.791 20.2091 13.0001 18 13.0001"
                                stroke-width="1.5"
                                stroke-linejoin="round"
                              />
                              <path
                                d="M10 11.4143L11.2929 12.7072C11.6834 13.0977 12.3166 13.0977 12.7071 12.7072L14 11.4143M12 7.4143L12 12.4143"
                                stroke-width="1.5"
                                stroke-linecap="round"
                              />
                            </svg>
                            Swap
                          </a>
                        </div>
                      </div>
                      <!-- End Wallet Card -->
                    </div>
                    <!-- End crancy Single Sidebar -->
                  </div>

                  <div
                    class="col-xxl-12 col-xl-6 col-12 crancy-sidebar__widget"
                  >
                    <!-- crancy Single Sidebar -->
                    <div class="crancy-sidebar__single">
                      <form class="crancy-wallet-form" action="#"> 

                       
                        <div class="crancy-wallet-form__amount mg-top-15">
                            <span class="crancy-wallet-form__amount-label"
                              >Wallet Address</span
                            >
                            <div class="crancy-wallet-form__amount-group">
                              <input onkeyup="validatewallet()" name="address" id="address" placeholder="Beneficiary" />
                              <div class="crancy-wallet-form__amount-author">
                                <a href="#" id="getwallet"></a>
                              </div>
                            </div>
                        </div>
                          
                        <div class="mt-1" id="walletalert"></div>
                         <!-- Amount Inside -->
                         <div class="crancy-wallet-form__amount mg-top-15">
                            <span class="crancy-wallet-form__amount-label"
                              >Enter amount</span
                            >
                            <div class="crancy-wallet-form__amount-group">
                              <input onkeyup="exchange()" type="int" disabled id="amount" placeholder="$0.00" /> 
                              <div class="crancy-wallet-form__amount-author">
                                <a href="#" id="getrateloader"></a>
                              </div>
                            </div>
                          </div>
                          <div class="mt-1" id="getrate"></div>
                          <div class="mt-1" id="balance"></div>
                          <!-- End Amount Inside -->
                        <button type="button"
                          data-bs-toggle="modal" id="submit"
                          data-bs-target="#popup_modal_otp" disabled
                          class="crancy-btn crancy-full-width mg-top-20"
                        >
                          Send {{$coin->name}}
                        </button>
                      </form>

                       
                    </div>
                    <!-- End crancy Single Sidebar -->
                  </div>
                </div>
              </div>
              <!-- End Sidebar -->
            </div>
            <div class="col-xxl-8 col-12 crancy-main__column">
              <div class="crancy-body">
                <!-- Dashboard Inner -->
                <div class="crancy-dsinner">
                  <div class="row crancy-gap-30">
                    <div class="col-12">
                      <!-- Charts One -->
                      <div class="charts-main charts-home-one mg-top-30">
                        <!-- Top Heading -->
                        
                        <div class="charts-main__one">
                          <div class="tab-content" id="nav-tabContent">
                            <div
                            style="height:560px; background-color: hsl(0, 0%, 100%); overflow:hidden; box-sizing: border-box; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; padding:1px;padding: 0px; margin: 0px; width: 100%;">
                            <div style="height:540px; padding:0px; margin:0px; width: 100%;"><iframe
                                    src="https://widget.coinlib.io/widget?type=chart&theme=light&coin_id={{ $coin->code }}&pref_coin_id=1505"
                                    width="100%" height="536px" scrolling="auto" marginwidth="0" marginheight="0"
                                    frameborder="0" border="0"
                                    style="pointer-events: none;  border:0;margin:0;padding:0;line-height:14px;"></iframe></div>
                            <div
                                style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;">
                                <a href="#" target="_blank"
                                    style="font-weight: 500; color: #232183; text-decoration:none; font-size:11px">
                                    @lang('Powered') &nbsp;by {{ __($general->site_name) }}</a>
                            </div>
                        </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Charts One -->
                    </div>
                  </div>

                  <div class="crancy-table crancy-table--v3 mg-top-30">
                    <div class="crancy-customer-filter">
                      <div
                        class="crancy-customer-filter__single crancy-customer-filter__single--csearch"
                      >
                        <div
                          class="crancy-header__form crancy-header__form--customer"
                        >
                          <form class="crancy-header__form-inner" action="#">
                            <button class="search-btn" type="submit">
                              <svg
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <circle
                                  cx="9.78639"
                                  cy="9.78614"
                                  r="8.23951"
                                  stroke="#9AA2B1"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                ></circle>
                                <path
                                  d="M15.5176 15.9448L18.7479 19.1668"
                                  stroke="#9AA2B1"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                ></path>
                              </svg>
                            </button>
                            <input
                              name="search"
                              value=""
                              type="text"
                              placeholder="Search by ID"
                            />
                          </form>
                        </div>
                      </div>
                       
                      <div class="crancy-customer-filter__single">
                        <a
                          href="#"
                          class="crancy-customer-filter__single--button"
                        >
                          <img src="{{ asset($activeTemplateTrue . 'dashboard/img/download-icon2.svg')}}" />Download
                        </a>
                      </div>
                    </div>

                    <!-- crancy Table -->
                    <table
                      id="crancy-table__main"
                      class="crancy-table__main crancy-table__main-v3"
                    >
                      <!-- crancy Table Head -->
                      <thead class="crancy-table__head">
                        <tr>
                          <th class="crancy-table__column-1 crancy-table__h1">
                            <div class="crancy-wc__checkbox">
                               
                              <span>TRX ID</span>
                            </div>
                          </th>
                          <th class="crancy-table__column-2 crancy-table__h2">
                            Date
                          </th>
                          <th class="crancy-table__column-3 crancy-table__h3">
                            Amount
                          </th>
                          <th class="crancy-table__column-4 crancy-table__h4">
                            Payment
                          </th>
                          <th class="crancy-table__column-5 crancy-table__h5">
                            Status
                          </th>
                        </tr>
                      </thead>
                      <!-- crancy Table Body -->
                      <tbody class="crancy-table__body">
                        @forelse($trx as $trx)
                                  <tr>
                                    <td
                                      class="crancy-table__column-1 crancy-table__data-1"
                                    >
                                      <div class="crancy-table__customer">
                                        <div class="crancy-wc__checkbox">
                                          
                                          <label
                                            for="checkbox"
                                            class="crancy-table__customer-img"
                                          >
                                            <small>
                                                #{{@substrinput($trx->hash)}}
                                            </small>
                                          </label>
                                        </div>
                                      </div>
                                    </td>
                                    <td
                                      class="crancy-table__column-2 crancy-table__data-2"
                                    >
                                      <h4 class="crancy-table__product-title">
                                        <small>{{--{{ showDateTime($trx->created_at) }}--}}{{ diffForHumans($trx->created_at) }}</small>
                                      </h4>
                                    </td>
                                    <td
                                      class="crancy-table__column-3 crancy-table__data-3"
                                    >
                                      <h4 class="crancy-table__product-title">
                                        {{$general->cur_sym}}{{ showAmount($trx->amount) }}
                                      </h4>
                                    </td>
                                    <td
                                      class="crancy-table__column-4 crancy-table__data-4"
                                    >
                                    <div class="crancy-table__status @if($trx->type == 'receive') crancy-table__status--paid @else crancy-table__status--unpaid @endif">
                                    {{$trx->type}}
                                    </div> 
                                    </td>
                                    <td>
                                        <a href="#"  data-bs-toggle="modal" data-bs-target="#popup_modal_{{$trx->id}}" class="crancy-sidebar__toggles"><img src="{{ asset($activeTemplateTrue . 'dashboard/img/inline-toggle.svg') }}" /></a>
                                    </td>
                                    <!-- Add Currency Popup  -->
                                    <div
      class="crancy-default__modal crancy-payment__modal modal fade"
      id="popup_modal_{{$trx->id}}"
      tabindex="-1"
      aria-labelledby="popup_modal_{{$trx->id}}"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content crancy-preview__modal-content">
          <div class="row">
            <div class="col-12">
              <div class="crancy-flex__right">
                <a
                  id="crancy-main-form__close"
                  type="initial"
                  class="crancy-preview__modal--close btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                  >
                    <g clip-path="url(#clip0_989_10425)">
                      <circle cx="12" cy="12" r="12" fill="#EDF2F7" />
                      <path
                        d="M16.9498 7.05029L7.05033 16.9498"
                        stroke="#5D6A83"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M7.05029 7.05029L16.9498 16.9498"
                        stroke="#5D6A83"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </g>
                    <defs>
                      <clipPath id="clip0_989_10425">
                        <rect width="24" height="24" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>
                </a>
              </div>
              <div
                class="crancy-wc__heading crancy-flex__column-center text-center"
              >
                <h3 class="crancy-login-popup__title">Transaction Details</h3>
                <p>
                  Please find your transaction details below
                </p>
              </div>
               
              <div class="row">
                <div class="col-lg-12 col-12 mg-top-30">
                    <div
                    class="crancy-crancy-checkbox__single crancy-crancy-checkbox__payment"
                  >
                    <input
                      class="crancy-crancy-checkbox__input d-none"
                      type="radio"
                      value=""
                      id="cr-method-3"
                      name="q-question"
                      checked=""
                    />
                    <label
                      class="crancy-crancy-checkbox__label"
                      for="cr-method-3"
                    >
                      <div class="crancy-crancy-checkbox__content">
                        <span><i class="text-primary fa fa-user"></i></span>
                        <h4 class="crancy-crancy-checkbox__title">
                          Beneficiary <span>{{$trx->address}}</span>
                        </h4>
                      </div>
                      <div class="crancy-crancy-checkbox__quiz-check"></div>
                    </label>
                  </div>
                  <!-- End Single Group -->
                  <!-- Single Group -->
                  <div
                    class="crancy-crancy-checkbox__single crancy-crancy-checkbox__payment mg-btm-10"
                  >
                    <input
                      class="crancy-crancy-checkbox__input d-none"
                      type="radio"
                      value=""
                      id="cr-method-1"
                      name="q-question"
                      checked=""
                    />
                    <label
                      class="crancy-crancy-checkbox__label"
                      for="cr-method-1"
                    >
                      <div class="crancy-crancy-checkbox__content">
                        <span><i class="text-primary fa fa-serve"></i></span>
                        <h4 class="crancy-crancy-checkbox__title">
                          Currency <span>{{@$trx->coin->name}}</span>
                        </h4>
                      </div>
                      <div class="crancy-crancy-checkbox__quiz-check"></div>
                    </label>
                  </div>
                  <!-- End Single Group -->
                  <!-- Single Group -->
                  <div
                    class="crancy-crancy-checkbox__single crancy-crancy-checkbox__payment mg-btm-10"
                  >
                    <input
                      class="crancy-crancy-checkbox__input d-none"
                      type="radio"
                      value=""
                      id="cr-method-1"
                      name="q-question"
                      checked=""
                    />
                    <label
                      class="crancy-crancy-checkbox__label"
                      for="cr-method-1"
                    >
                      <div class="crancy-crancy-checkbox__content">
                        <span><i class="text-primary fa fa-usd"></i></span>
                        <h4 class="crancy-crancy-checkbox__title">
                          Amount <span>${{number_format($trx->usd,2)}}</span>
                        </h4>
                      </div>
                      <div class="crancy-crancy-checkbox__quiz-check"></div>
                    </label>
                  </div>
                  <!-- End Single Group -->
                  <!-- Single Group -->
                  <div
                    class="crancy-crancy-checkbox__single crancy-crancy-checkbox__payment mg-btm-10"
                  >
                    <input
                      class="crancy-crancy-checkbox__input d-none"
                      type="radio"
                      value=""
                      id="cr-method-2"
                      name="q-question"
                      checked=""
                    />
                    <label
                      class="crancy-crancy-checkbox__label"
                      for="cr-method-2"
                    >
                      <div class="crancy-crancy-checkbox__content">
                        <span><i class="text-primary fa fa-wallet"></i></span>
                        <h4 class="crancy-crancy-checkbox__title">
                          Value <span>{{$trx->amount}}{{@$trx->coin->symbol}}</span>
                        </h4>
                      </div>
                      <div class="crancy-crancy-checkbox__quiz-check"></div>
                    </label>
                  </div>
                  <!-- End Single Group -->
                  <!-- Single Group -->
                  <div
                    class="crancy-crancy-checkbox__single crancy-crancy-checkbox__payment"
                  >
                    <input
                      class="crancy-crancy-checkbox__input d-none"
                      type="radio"
                      value=""
                      id="cr-method-3"
                      name="q-question"
                      checked=""
                    />
                    <label
                      class="crancy-crancy-checkbox__label"
                      for="cr-method-3"
                    >
                      <div class="crancy-crancy-checkbox__content">
                        <span><i class="text-primary fa fa-code"></i></span>
                        <h4 class="crancy-crancy-checkbox__title">
                          TRX ID <span>{{$trx->trxid}}</span>
                        </h4>
                      </div>
                      <div class="crancy-crancy-checkbox__quiz-check"></div>
                    </label>
                  </div>
                  <!-- End Single Group -->
                </div>
                 
              </div>
              @if($trx->explore_url)
              <a href="{{$trx->explore_url}}"
                class="crancy-btn crancy-btn__currency crancy-full-width mg-top-40"
              >
                View Transaction
              </a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

                                     
                                  </tr>
                                   @empty
                                   {!! emptyData2() !!}
                                   @endforelse
                      </tbody>
                      <!-- End crancy Table Body -->
                    </table>
                    <!-- End crancy Table -->
                  </div>
                </div>
                <!-- End Dashboard Inner -->
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End crancy Dashboard -->
    </div>

    <!-- Add Currency Popup  -->
    <div
      class="crancy-default__modal modal fade"
      id="popup_modal_1"
      tabindex="-1"
      aria-labelledby="popup_modal_1"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content crancy-preview__modal-content">
          <div class="row">
            <div class="col-12">
              <div class="crancy-flex__right">
                <a
                  id="crancy-main-form__close"
                  type="initial"
                  class="crancy-preview__modal--close btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                  >
                    <g clip-path="url(#clip0_989_10425)">
                      <circle cx="12" cy="12" r="12" fill="#EDF2F7" />
                      <path
                        d="M16.9498 7.05029L7.05033 16.9498"
                        stroke="#5D6A83"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M7.05029 7.05029L16.9498 16.9498"
                        stroke="#5D6A83"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </g>
                    <defs>
                      <clipPath id="clip0_989_10425">
                        <rect width="24" height="24" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>
                </a>
              </div>
              <div
                class="crancy-wc__heading crancy-flex__column-center text-center"
              >
                <h3 class="crancy-login-popup__title">Receive {{ $coin->symbol }}</h3>
                <p>
                  @lang('Please scan the QR code below or copy the wallet address to receive '){{ $coin->name }}
                </p>
                <!-- Search Form -->
                <div
                  class="crancy-header__form crancy-header__form__currency mg-top-20"
                >
                  <form class="crancy-header__form-inner" action="#">
                     
                    <input type="text"id="walletaddress" value="{{ $wallet->address }}" readonly
                    class="form-control" placeholder="Right Side"
                    aria-describedby="basic-addon2">
                  </form>
                </div>
                <!-- End Search Form -->
              </div>

              <center><img src="{{ $wallet->qrcode }}" class=" w-200px" width="200" alt="" /></center>
              <button onclick="myFunction()" class="crancy-btn crancy-btn__currency crancy-full-width mt-3">
                Copy Address
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Add Currency Popup  -->

    <!-- Add SWAP Popup  -->
    <div
      class="crancy-default__modal crancy-payment__modal modal fade"
      id="popup_modal_2"
      tabindex="-1"
      aria-labelledby="popup_modal_2"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content crancy-preview__modal-content">
          <div class="row">
            <div class="col-12">
              <div class="crancy-flex__right">
                <a
                  id="crancy-main-form__close"
                  type="initial"
                  class="crancy-preview__modal--close btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                  >
                    <g clip-path="url(#clip0_989_10425)">
                      <circle cx="12" cy="12" r="12" fill="#EDF2F7" />
                      <path
                        d="M16.9498 7.05029L7.05033 16.9498"
                        stroke="#5D6A83"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M7.05029 7.05029L16.9498 16.9498"
                        stroke="#5D6A83"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </g>
                    <defs>
                      <clipPath id="clip0_989_10425">
                        <rect width="24" height="24" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>
                </a>
              </div>
              <div
                class="crancy-wc__heading crancy-flex__column-center text-center"
              >
                <h3 class="crancy-login-popup__title">Swap {{$coin->name}}</h3>
                <p>
                  Please enter an amount to swap below
                </p>
              </div>
               
              <div class="row">
                 
                <div class="col-lg-12 col-12 mg-top-30">
                 
                  <div
                    class="crancy-wallet-form__amount crancy-wallet-form__amount--v2 mg-top-15"
                  >
                    <span class="crancy-wallet-form__amount-label"
                      >Enter amount</span
                    >
                    <div class="crancy-wallet-form__amount-group">
                      <input type="number" value="" onkeyup="swap()" placeholder="0.00USD" id="swapamount" />
                      <div class="crancy-wallet-form__country">
                        <img src="{{ asset($activeTemplateTrue . 'dashboard/img/country-4.png')}}" />
                      </div>
                    </div> 
                  </div>
                  <div id="getswaprate"></div>

                  <div
                  class="crancy-wallet-form__amount crancy-wallet-form__amount--v2 mg-top-15"
                >
                  <span class="crancy-wallet-form__amount-label"
                    >Enter OTP</span
                  >
                  <div class="crancy-wallet-form__amount-group">
                    <input type="int" maxlength="4" value="" id="swappin" placeholder="****" /> 
                  </div> 
                </div>
                  
                </div>
              </div>
              <button class="mt-3 ntfmax-wc__btn ntfmax-wc__btn--login" disabled onclick="swapcoin()" id="swapbutton" type="button">
                Continue<span id="submittingswap"><i class="fa-solid fa-arrow-right"></i></span>
            </button>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- OTP Payment Popup  -->
    <div
    class="crancy-default__modal modal fade"
    id="popup_modal_otp"
    tabindex="-1"
    aria-labelledby="popup_modal_1"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content crancy-preview__modal-content">
        <div class="row">
          <div class="col-12">
            <div class="crancy-flex__right">
              <a
                id="crancy-main-form__close"
                type="initial"
                class="crancy-preview__modal--close btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                >
                  <g clip-path="url(#clip0_989_10425)">
                    <circle cx="12" cy="12" r="12" fill="#EDF2F7" />
                    <path
                      d="M16.9498 7.05029L7.05033 16.9498"
                      stroke="#5D6A83"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M7.05029 7.05029L16.9498 16.9498"
                      stroke="#5D6A83"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </g>
                  <defs>
                    <clipPath id="clip0_989_10425">
                      <rect width="24" height="24" fill="white" />
                    </clipPath>
                  </defs>
                </svg>
              </a>
            </div>
            <div
              class="crancy-wc__heading crancy-flex__column-center text-center"
            >
              <h3 class="crancy-login-popup__title">Transaction OTP</h3>
              <p>
                Please enter your transaction OTP and click on the continue button
              </p>
              <!-- Search Form -->
              <div class="crancy-header__form crancy-header__form__currency mg-top-20 mb-3" >
                <form class="crancy-header__form-inner" action="#">
                  <button class="search-btn" type="submit">
                    <i class="fa fa-lock"></i>
                  </button>
                  <input
                    type="password"
                    id="otp"
                    maxlength="4"
                    placeholder="****"
                  />
                </form>
              </div>
              <!-- End Search Form -->
            </div>
  
            <button class="ntfmax-wc__btn ntfmax-wc__btn--login" onclick="sendcoin()" id="submitbutton" type="button">
              Continue<span id="submitting"><i class="fa-solid fa-arrow-right"></i></span>
          </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Add Currency Popup  -->
     
@endsection



@push('script')
<script>
    function myFunction() {
        var copyText = document.getElementById("walletaddress");
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/
        document.execCommand("copy");
        toastr.success('Wallet Address Copied', 'Success');

    }
</script>
<script>
    const coins = async () => {
        await fetch('https://data.messari.io/api/v1/assets')
            .then(data => data.json())
            .then(res => {
                res.data.map(coin => {
                    let coinPrice = coin.metrics.market_data.price_usd
                    let coinPercent = coin.metrics.market_data.percent_change_usd_last_24_hours
                    var coinbalance = "{{ $wallet->balance }}"
                    var newBalance
                    switch (coin.symbol) {
                        case "{{ $coin->symbol }}":
                            document.getElementById("USDBALANCE").innerHTML =
                                `$${ parseInt(coinPrice*coinbalance).toLocaleString() } `
                            break;

                        default:
                            break;
                    }
                })
            })
    }

    coins()
</script>
<script>
    function validatewallet() {
        var address = document.getElementById("address").value;
        document.getElementById("walletalert").innerHTML = '';
        document.getElementById("amount").value = '';
        document.getElementById("amount").disabled = true;
        $("#getwallet").html(`
              <div class="text-center"> <i class="fa fa-spinner fa-spin"></i></div>`);
        var raw = JSON.stringify({
            _token: "{{ csrf_token() }}",
            address: address,
        });
        var requestOptions = {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: raw
        };
        fetch("{{ route('user.crypto.wallet.validate', encrypt($coin->id)) }}", requestOptions)
            .then(response => response.text())
            .then(result => {
                resp = JSON.parse(result);
                if (resp.ok == true) {
                    document.getElementById("amount").disabled = false; 
                    $("#getwallet").html(`<i class="text-success fa fa-check"></i>`);
                }
                else
                {
                    $("#getwallet").html(`<i class="text-danger fa fa-info"></i>`);
                }
                $("#walletalert").html( `<label class="badge bg-${resp.status}">${resp.message}</label>` );
            })
            .catch(error => {

            });
    };
</script>
<script>
    function exchange() {
        var amount = document.getElementById("amount").value;
        document.getElementById("submit").disabled = true;
        $("#getrateloader").html(`
            <div class="text-center">
                <i class="fa fa-spinner fa-spin"></i>
            </div>`);
        var raw = JSON.stringify({
            _token: "{{ csrf_token() }}",
            amount: amount,
        });
        var requestOptions = {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: raw
        };
        fetch("{{ route('user.crypto.exchange', encrypt($coin->id)) }}", requestOptions)
            .then(response => response.text())
            .then(result => {
                resp = JSON.parse(result);
                if (resp.balance == false) {
                    document.getElementById("submit").disabled = true;
                    $("#balance").html(
                        `<a class="badge bg-danger">You dont have enought balance to intiate this transaction</a>`
                    );
                }
                document.getElementById("submit").disabled = false;
                $("#getrate").html(
                    `<label class="badge bg-${resp.status}">${resp.message}</label>`
                );
                $("#getrateloader").html(``);
            })
            .catch(error => {

            });
    };
</script>
<script>
    function swap() {
        var amount = document.getElementById("swapamount").value;
        document.getElementById("swapbutton").disabled = true;
        $("#getswaprate").html(`
            <div class="text-center">
                <i class="fa fa-spinner fa-spin"></i>
            </div>`);

        var raw = JSON.stringify({
            _token: "{{ csrf_token() }}",
            amount: amount,
        });
        var requestOptions = {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: raw
        };
        fetch("{{ route('user.crypto.exchange', encrypt($coin->id)) }}", requestOptions)
            .then(response => response.text())
            .then(result => {
                resp = JSON.parse(result);
                if (resp.balance == false) {
                    document.getElementById("swapbutton").disabled = true;
                    $("#getswaprate").html(
                        `<a class="badge bg-danger" href="javascript:void(0);">You dont have enought balance to intiate this swap</a>`
                    );
                }
                document.getElementById("swapbutton").disabled = false;
                if(resp.ok != true)
                {
                    $("#getswaprate").html(
                    `<a class="badge bg-${resp.status}" href="javascript:void(0);">${resp.message}</a>`
                    );
                    return;
                }
                else
                {
                    var rate = "{{$coin->swap_rate}}";
                    var getvalue = amount*rate;
                    $("#getswaprate").html(`
                        <div class="text-center">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>`);
                        if(resp.ok != true)
                        {
                            document.getElementById("swapbutton").disabled = false;
                        }
                    $("#getswaprate").html(
                        `<a class="badge bg-info text-white" href="javascript:void(0);">${getvalue}{{$general->cur_text}}</a>`
                    );
                }
            })
            .catch(error => {

            });

    };
</script>
<script>
    function swapcoin() {
        var amount = document.getElementById("swapamount").value;
        document.getElementById("swapbutton").disabled = true;
        var swappin = document.getElementById("swappin").value;
        $("#submittingswap").html(`
          <div class="text-center">
            <i class="fa fa-spinner fa-spin"></i>
          </div>`);
        var raw = JSON.stringify({
            _token: "{{ csrf_token() }}",
            amount: amount,
            source: "{{ $wallet->address }}",
            swappin: swappin,

        });

        var requestOptions = {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: raw
        };
        fetch("{{ route('user.crypto.swap', encrypt($coin->id)) }}", requestOptions)
            .then(response => response.text())
            .then(result => {
                resp = JSON.parse(result);
                document.getElementById("submit").disabled = false;
                $("#submittingswap").html(
                    `<i class="fa-solid fa-arrow-right"></i>`
                );
                document.getElementById("swapbutton").disabled = false;
                if (resp.ok != true) 
                        {
                            toastr.error(resp.message, 'OOPS');
                        }
                        if (resp.ok != false) {
                            toastr.success(resp.message, 'Successful');
                            location.reload();
                        } 

            })
            .catch(error => {

            });
    };
</script>

<script>
    function sendcoin() {
        var amount = document.getElementById("amount").value;
        var address = document.getElementById("address").value;
        var otp = document.getElementById("otp").value;
        document.getElementById("submitbutton").disabled = true;
        document.getElementById("submit").disabled = true;
        $("#submitting").html(`
          <div class="text-center">
            <i class="fa fa-spinner fa-spin"></i>
          </div>`);
        var raw = JSON.stringify({
            _token: "{{ csrf_token() }}",
            amount: amount,
            address: address,
            otp: otp,
            source: "{{ $wallet->address }}",
        });

        var requestOptions = {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: raw
        };
        fetch("{{ route('user.crypto.send', encrypt($coin->id)) }}", requestOptions)
            .then(response => response.text())
            .then(result => {
                resp = JSON.parse(result);
                document.getElementById("submit").disabled = false;
                        if (resp.ok != true) 
                        {
                            toastr.error(resp.message, 'OOPS');
                        }
                        if (resp.ok != false) {
                            toastr.success(resp.message, 'Successful');
                            location.reload();
                        } 
                        document.getElementById("submitbutton").disabled = false;
                        document.getElementById("submitting").innerHTML = '<i class="fa-solid fa-arrow-right"></i>';
               
            })
            .catch(error => {

            });
    };
</script>
@endpush
