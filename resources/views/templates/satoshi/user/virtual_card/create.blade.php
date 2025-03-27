@extends($activeTemplate . 'layouts.app')
@section('panel')
   <!-- Transaction Log -->
 <div class="col-lg-12 d-flex align-items-strech">
  <div class="card w-100">
    <div class="card-body">
      <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
        <div class="mb-3 mb-sm-0">
          <h5 class="card-title fw-semibold">@lang('Create Customer')</h5>
        </div> 
        @if(!empty($customer))
          <div class="mb-3 mb-sm-0">
            <a href="{{url('/user/create/card')}}" class="btn btn-primary">Create New Card</a>
            <a href="{{url('/user/list/card')}}" class="btn btn-info">View Cards</a>
          </div>
        @endif
      </div>
      <div class="col-lg-9">
        <div class="card">
          <div class="card-body p-4">
            @if(!empty($customer))
              <div class="row">
                <div class="col-sm-6">
                    <p><strong>First Name:</strong> @isset($customer->first_name){{$customer->first_name}}@endisset</p>
                </div>
                <div class="col-sm-6">
                    <p><strong>Last Name:</strong> @isset($customer->last_name){{$customer->last_name}}@endisset</p>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                    <p><strong>Email:</strong> @isset($customer->customer_email){{$customer->customer_email}}@endisset</p>
                </div>
                <div class="col-sm-6">
                    <p><strong>Phone number:</strong> @isset($customer->phone_number){{$customer->phone_number}}@endisset</p>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                    <p><strong>Date of Birth:</strong> @isset($customer->date_of_birth){{$customer->date_of_birth}}@endisset</p>
                </div>
                <div class="col-sm-6">
                    <p><strong>House number:</strong> @isset($customer->house_number){{$customer->house_number}}@endisset</p>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                    <p><strong>Customer Id:</strong> @isset($customer->bitvcard_customer_id){{$customer->bitvcard_customer_id}}@endisset</p>
                </div>
              </div>
            @else
              <form action="{{route('user.create.customer.add')}}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
                @endif    -->                      
                <div class="row">
                    <div class="col-sm-6">
                      <label for="house_number" class="form-label fw-semibold">@lang('House Number')</label>
                      <input type="text" class="form-control" name="house_number">
                    </div>
                      <div class="col-sm-6">
                          <label for="phone_number" class="form-label fw-semibold">@lang('Phone Number')*</label>
                          <input type="text" class="form-control" name="phone_number">
                      </div>
                  </div>
                  <div class="row">                              
                    <div class="col-sm-6">
                      <label for="date_of_birth" class="form-label fw-semibold">@lang('Date of Birth YYYY-MM-DD')</label>
                      <input type="text" class="form-control" name="date_of_birth">
                    </div>
                     <div class="col-sm-6">
                      <label for="idImage" class="form-label fw-semibold">@lang('Id Image')*</label>
                      <input type="text" class="form-control" name="idImage" value="{{ asset('assets/images/kyc') }}/{{ auth()->user()->username }}/front_kyc_image.png" readonly>

                    </div> 
                    <div class="col-sm-6">
                        <label for="line" class="form-label fw-semibold">@lang('Address')*</label>
                        <input type="text" class="form-control" name="line">
                    </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <label for="userPhoto" class="form-label fw-semibold">@lang('User Photo')</label>
                         <input type="text" class="form-control" name="idImage" value="{{ asset('assets/images/kyc') }}/{{ auth()->user()->username }}/back_kyc_image.png" readonly>
                    </div> 
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="mb-4">
                        <label for="zip_code" class="form-label fw-semibold">@lang('Zip Code')*</label>
                        <input type="text" class="form-control" name="zip_code">
                      </div>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <button typ="submit" class="btn btn-primary">Create CardHolder</button>
                  </div>
              </form>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('breadcrumb-plugins') 
@endpush