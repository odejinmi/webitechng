@extends($activeTemplate . 'layouts.app')
@section('panel')
<!-- content @s -->
<!--begin::Container-->
<div id="kt_content_container" class=" container-xxl ">
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Stepper-->
            <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-body p-4">
                          <h4 class="fw-semibold mb-3">@lang('Account Verification')</h4>
                          <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">@lang('Document Type')</label>
                                  <select name="type"
                                  class="select2 form-control form-control-lg"
                                  style="width: 100%; height: 36px"
                                  >
                                  <option>Select</option>
                                  <option>Voters Card</option>
                                  <option>International Passport</option>
                                  <option>Drivers Licence</option>
                                  <option>NIN Card</option>
                                </select>
                                </div>


                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">@lang('Front View')*</label>
                                  <input type="file" class="form-control" name="front"  id="front">
                                </div>
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">@lang('Back View')*</label>
                                  <input type="file" class="form-control" name="back" id="back">
                                </div>


                              <br>
                              <div class="mb-4">
                              <button type="submit" class="mt-4 btn btn-primary">@lang('Submit')</button>
                              </div>
                              </div>
                              @if($user->kyc_complete == 3 || $user->kyc_complete == 1)
                              <div class="col-lg-6 d-flex align-items-stretch">
                                <div class="card w-100 position-relative overflow-hidden">

                                  <div class="card-body p-4">

                                    <div class="text-center">
                                       <p class="mb-0">{{@$user->kyc->type}}</p>
                                    @if($user->kyc_complete == 3)
                                    <badge class="badge bg-warning">@lang('Pending')</badge>
                                    @elseif($user->kyc_complete == 1)
                                    <badge class="badge bg-success">@lang('Approved')</badge>
                                    @elseif($user->kyc_complete == 2)
                                    <badge class="badge bg-danger">@lang('Rejected')</badge>
                                    @lang('Please proceed to reupload file')
                                    @endif
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                      <img src="{{asset('assets/images/kyc')}}/{{$user->username}}/front_kyc_image.png" alt="" class="img-fluid rounded-circle" width="120" height="120">
                                       <p class="mb-0">@lang('Front View Image')</p>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <img src="{{asset('assets/images/kyc')}}/{{$user->username}}/back_kyc_image.png" alt="" class="img-fluid rounded-circle" width="120" height="120">
                                         <p class="mb-0">@lang('Back View Image')</p>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            @endif
                          </form>
                        </div>
                      </div>
                    </div>
            </div>
            <!--end::Stepper-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Container-->
@endsection
