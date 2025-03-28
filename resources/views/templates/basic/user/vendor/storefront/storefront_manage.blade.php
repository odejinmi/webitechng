@extends($activeTemplate . 'layouts.app')
@section('panel')
 <!-- content @s
-->
<!--begin::Container-->

<div class="row">
    <!-- Column -->
    <div class="col-sm-12 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-row">
            <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-success">
              <i class="ti ti-credit-card fs-6"></i>
            </div>
            <div class="ms-3 align-self-center">
              <h4 class="mb-0 fs-5">@lang('Total Products')</h4>
              <span class="text-muted"></span>
            </div>
            <div class="ms-auto align-self-center">
              <h2 class="fs-7 mb-0">{{ $products }}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-sm-12 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-row">
            <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-info">
              <i class="ti ti-credit-card fs-6"></i>
            </div>
            <div class="ms-3 align-self-center">
              <h4 class="mb-0 fs-5">@lang('Total Sales')</h4>
              <span class="text-muted"></span>
            </div>
            <div class="ms-auto align-self-center">
              <h2 class="fs-7 mb-0">{{ showAmount($sales) }} {{ __($general->cur_text) }}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Column -->

    <div class="col-12">

        <!-- ---------------------
                    start File export
                ---------------- -->
        <div class="card">
          <div class="card-body">
            <div>
              <label>@lang('Storefront Link')</label>
              <div class="input-group">
                <input type="text"id="referralURL"
                    value="{{route('storefront',strToLower($storefront->trx))}}" readonly
                    class="form-control" placeholder="Right Side"
                    aria-describedby="basic-addon2">
                <button onclick="myFunction()" class="btn btn-primary" type="button">
                  <a class="ti ti-link text-white"></a>
                </button>
            </div>
            </div>
          </div>
        </div>
</div>

<div class="col-12">

    <!-- ---------------------
                start File export
            ---------------- -->
    <div class="card">
      <div class="card-body">

        <div class="mb-2">
          <h5 class="mb-0">{{$pageTitle}}</h5>
        </div>
        <p class="card-subtitle mb-3">
          @lang('A table showing all the ') {{$pageTitle}} @lang('on your account. You can export transaction record')
        </p>
        <div class="table-responsive">
          <table
            id="file_export"
            class="table border table-striped table-bordered display text-nowrap"
          >
            <thead>
              <!-- start row -->
              <tr>
                  <th>@lang('TRX')</th>
                  <th>@lang('Product')</th>
                  <th>@lang('Buyer')</th>
                  <th class="text-center">@lang('Date')</th>
                  <th class="text-center">@lang('Amount')</th>
                  <th class="text-center">@lang('')</th>
              </tr>
              <!-- end row -->
            </thead>
            <tbody>

              @forelse(@$order as $data)
              @php
                            $product = App\Models\Product::whereId($data->product_id)->first();
                            @endphp
                      <tr>
                        <td>
                            <span class="">{{ __($data->trx) }}</span>
                            <div class="d-flex align-items-center">
                                <span class="@if($data->status == 'deliver') text-bg-success @else text-bg-danger @endif p-1 rounded-circle"></span>
                                <p class="mb-0 ms-2">{{$data->status}}</p>
                            </div>
                        </td>
                        <td>
                         {{$product->name}}<br>
                         QTY: {{$data->quantity}}
                        </td>
                        <td>
                         Name: {{$data->user->fullname}}
                         <br>
                         Email: {{$data->user->email}}
                         <br>
                        Phone:  {{$data->user->mobile}}
                        </td>

                          <td class="text-center">
                              {{ showDateTime($data->created_at) }}<br>{{ diffForHumans($data->created_at) }}
                          </td>
                          <td class="text-center">
                              <strong>{{ showAmount($data->price) }} {{ __($general->cur_text) }}</strong>
                          </td>
                          <td>
                            @if($data->status == 'pending')
                            <div class="d-flex align-items-center">

                                <div class="btn-group mb-2">
                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                      data-bs-toggle="dropdown" aria-expanded="false">
                                      Action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <li><a class="dropdown-item" href="{{route('user.storefront.order.status',$data->trx.'?status=deliver')}}">Mark As Delivered</a></li>
                                      <li>
                                        <a class="dropdown-item" href="{{route('user.storefront.order.status',$data->trx.'?status=decline')}}">Mark As Declined</a>
                                      </li>
                                    </ul>
                                  </div>
                              </div>
                            @endif
                          </td>
                      </tr>
                  @empty
                      {!!emptyData()!!}
                  @endforelse
              <!-- end row -->
              <!-- end row -->
            </tbody>
            <tfoot>
              <tr>
                <th>@lang('TRX')</th>
                <th>@lang('Payer')</th>
                <th class="text-center">@lang('Date')</th>
                <th class="text-center">@lang('Amount')</th>
              </tr>
            </tfoot>
          </table>
        </div>
        @if ($order->hasPages())
      <div class="card-footer">
          {{ $order->links() }}
      </div>
      @endif
      </div>
    </div>

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Stepper-->
            <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">
                <!--begin::Form-->
                    <form  class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" action="" method="post"  enctype="multipart/form-data">
                    @csrf

                    <!--begin::Step 2-->
                    <div data-kt-stepper-element="scontent">

                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-10 pb-lg-15">
                                <!--begin::Title-->
                                <h2 class="fw-bold text-dark">@lang('Update Storefront')</h2>
                                <!--end::Title-->

                                <!--begin::Notice-->
                                <div class="text-muted fw-semibold fs-6">
                                    @lang('Please fill the form below to update your storefront.')
                                    <a href="#" class="link-primary fw-bold">Help Page</a>.
                                </div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Heading-->

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Storefront Name')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" id="name" class="form-control form-control-lg form-control-solid  name @error('name') is-invalid @enderror" value="{{ $storefront->name}}" name="name" placeholder="Enter Name" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Storefont Details ')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea type="text" class="form-control form-control-lg form-control-solid  details @error('details') is-invalid @enderror" id="details"
                                    name="details" value="{{ old('details') }}" placeholder="Enter Storefont Details" >{{ $storefront->details}}</textarea>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">

                                <div class="p-3 bg--white">
                                    <div class="">
                                        <img src="{{getImage(imagePath()['storefront_logo']['path'].'/'. $storefront->logo,imagePath()['storefront_logo']['size'])}}" width="100" alt="@lang('Image')" class="b-radius--10" >
                                    </div>
                                </div>

                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Storefront Logo')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="file" id="logo" class="form-control form-control-lg form-control-solid  logo @error('logo') is-invalid @enderror" name="logo" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <div class="p-3 bg--white">
                                    <div class="">
                                        <img src="{{getImage(imagePath()['storefront_header']['path'].'/'. $storefront->header,imagePath()['storefront_header']['size'])}}" width="100" alt="@lang('Image')" class="b-radius--10" >
                                    </div>
                                </div>
                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Storefront Header Image')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="file"  class="form-control form-control-lg form-control-solid  @error('header') is-invalid @enderror" name="header" />
                                <!--end::Input-->
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="logo" class="control-label">Storefront Status:</label>
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" @if ($storefront->status) checked @endif name="status" id="status" />
                                </div>
                                </div>
                            </div>
                            <!--end::Input group-->

                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 2-->




                    <!--begin::Actions-->
                    <div class="d-flex flex-stack pt-15">
                        <!--begin::Wrapper-->
                        <div>
                            <button type="submit" class="btn btn-lg btn-primary" type="button" id="submit">@lang('Update')
                               <i class="ti ti-arrow-right fs-4 ms-1 me-0"><span class="path1"></span><span class="path2"></span></i>
                            </button>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Stepper-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Container-->
@endsection

@push('breadcrumb-plugins')
<a href="{{route('user.storefront.products',$storefront->trx)}}" class="btn btn-sm btn-primary">Add Products</a>

@endpush
@push('script')
<script>

  function myFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/
            document.execCommand("copy");
            SlimNotifierJs.notification('success', 'Storefront Link Copied');

        }
 </script>
@endpush
