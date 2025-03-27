@extends($activeTemplate . 'layouts.app')
@section('panel')
    <!-- File export -->
    <div class="row">
        <div class="col-12">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Heading-->
                    <div class="card-px text-center pt-15 pb-15">
                        <!--begin::Alert-->

                        <!--begin::Notice-->
                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6">
                            <!--begin::Icon-->
                            <i class="ti ti-alert-circle fs-2tx text-warning me-4"><span class="path1"></span><span
                                    class="path2"></span><span class="path3"></span></i> <!--end::Icon-->

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1 ">
                                <!--begin::Content-->
                                <div class=" fw-semibold">
                                    <h4 class="text-gray-900 fw-bold">@lang('Create Voucher')</h4>

                                    <div class="fs-6 text-gray-700 ">@lang('Welcome to our voucher generation portal where you can generate and redeem voucher code from users on the platform<br>
                                   <b> You can click on the voucher log button at the top right corner of your screen to view your voucher log</b>
                                    ')
                                        <br> <br>

                                        <!--begin::Action-->
                                        <a href="{{ route('user.voucher.create') }}" class="btn btn-primary er fs-6 px-8 py-4">
                                            @lang('Generate Voucher') </a>
                                        
                                            &nbsp;&nbsp;&nbsp;

                                        <!--begin::Action-->
                                        <a href="#"  data-bs-toggle="modal" data-bs-target="#redeem-modal"  class="btn btn-success er fs-6 px-8 py-4">
                                            @lang('Redeem Voucher') </a>
                                        <br> <br>
                                        <!--end::Action-->
                                    </div>
                                </div>
                                <!--end::Content-->

                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Notice-->
                        <!--end::Alert-->


                    </div>
                    <!--end::Heading-->

                    <!--begin::Illustration-->
                    <div class="text-center pb-15 px-5">
                        <img src="{{ asset('assets/assets/dist/images/backgrounds/voucher.jpeg') }}" alt="" class="mw-100 h-200px h-sm-325px" />
                    </div>
                    <!--end::Illustration-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>

         <!-- SignIn modal content -->
         <div id="redeem-modal" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="text-center mt-2 mb-4">
                    <a href="#" class="text-success">
                      <span><img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" class="me-3" width="80" alt="" />
                      </span>
                    </a>
                  </div>

                  <form action="{{route('user.voucher.redeem')}}" method="post" class="ps-3 pr-3"> 
                    @csrf 
                    <div class="mb-3">
                      <label for="password1">Voucher Code</label>
                      <input class="form-control" type="password" required="" name="code" id="code"
                        placeholder="**********" />
                    </div> 
                    <div class="mb-3 text-center">
                      <button class="btn btn-rounded bg-info-subtle text-info font-medium" type="submit">
                        Redeem Voucher
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
    @endsection

    @push('breadcrumb-plugins')
        <a class="btn btn-sm btn-primary" href="{{ route('user.voucher.history') }}"> <i class="ti ti-printer"></i> @lang('My Voucher')</a>
    @endpush
    @push('script')
    @endpush
