@extends($activeTemplate . 'layouts.app')
@section('panel')


   <!-- Transaction Log -->
   <div class="col-lg-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
          <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold">@lang('API Key')</h5>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="card">
            <div class="card-body p-4">
              <div class="d-flex align-items-center justify-content-between mt-7">
                <div class="d-flex align-items-center gap-3">
                  <div class="icon icon-shape rounded-circle icon-sm flex-none w-rem-10 h-rem-10 text-sm bg-primary bg-opacity-25 text-primary"><i class="bi bi-key"></i></div>
                  <div>
                    <h5 class="fs-4 fw-semibold">API Secret Key</h5>
                    <p class="mb-0 text-dark" id="sk">{{@$key}}</p>
                  </div>
                </div>
                <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Show Key"
                onclick="showkey('{{$key}}')">
                <i class="ti ti-eye"></i>
                </a>
                @push('script')
                <script>
                  function showkey(e)
                  {
                    document.getElementById("sk").innerHTML = e;
                  }
                </script>
                @endpush
              </div>

              <hr>
              <div class="alert alert-primary mb-3" role="alert">
                <strong>Note - </strong> @lang('Please note, do not share your API Keys with anyone, we will not request for it, should you have any reason to doubt your API key, please feel free to generate
                new API keys using the button below')
              </div>

              <div class="d-flex align-items-center gap-3">
                <a class="btn btn-primary" href="{{route('user.api.key.generate')}}">Generate New Key</a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>



   <!-- Transaction Log -->
   <div class="col-lg-12 d-flex align-items-strech mt-3">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
          <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold">@lang('Webhook Settings')</h5>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="card">
            <div class="card-body p-4">
              <div id="kt_signin_email_edit" class="flex-row-fluid">
                <!--begin::Form-->
                <form id="kt_change_pin" action="{{route('user.api.webhook')}}" class="form" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-6">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="fv-row mb-0">
                                <label for="webhhook" class="form-label fs-6 fw-bold mb-3">@lang('Enter Your Webhook URL')</label>
                                <input type="text" name="webhook" value="{{$user->webhook_url }}"
                                    class="form-control form-control-lg form-control-solid"
                                    id="webhhook" placeholder="https://example.webhook.com" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="fv-row mb-0">
                                <label for="callback"
                                    class="form-label fs-6 fw-bold mb-3">@lang('Enter Your Callback URL')</label>
                                <input type="text" value="{{$user->redirect_url }}"
                                    class="form-control form-control-lg form-control-solid"
                                    name="callback" id="callback" placeholder="https://example.callback.com" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <button id="kt_pin_submit" type="submit"
                            class="btn btn-primary  me-2 px-6">@lang('Update Settings')</button>

                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Edit-->
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>



@endsection
@push('breadcrumb-plugins')

@endpush
