@extends($activeTemplate . 'layouts.app')
@section('panel')
<!-- crancy Dashboard -->
<section class="crancy-adashboard crancy-show">
  <div class="container container__bscreen">
    <div class="row">
      <div class="col-12">
        <div class="crancy-body">
          <!-- Dashboard Inner -->
          <div class="crancy-dsinner">
            <div class="row mg-top-10">
              <div class="col-lg-12 col-12">
                <div class="crancy-user-search mg-top-40">
                  <!-- Single Search -->
                  <div
                    class="crancy-user-search__single crancy-user-search__single--sform"
                  >
                    <div
                      class="crancy-header__form crancy-header__form--user"
                    >
                      <form class="crancy-header__form-inner" action="#">
                        <button class="search-btn" type="submit"  onclick="myFunction()">
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
                            />
                            <path
                              d="M15.5176 15.9448L18.7479 19.1668"
                              stroke="#9AA2B1"
                              stroke-width="1.5"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                          </svg>
                        </button>
                        <input onclick="myFunction()"
                          id="referralURL"
                          value="{{ route('user.register', Auth::user()->username) }}" readonly
                        />
                      </form>
                    </div>
                  </div>
                  <!-- End Single Search --> 
                </div>

                <div class="row">
                  @forelse($ref as $data)
                  <div class="col-xxl-3 col-lg-4 col-md-6 col-12">
                    <!-- Single User -->
                    <div class="crancy-single-user mg-top-30">
                     
                      <div class="crancy-single-user__head">
                        <img src="{{ getImage(getFilePath('userProfile') . '/' . $data->image, getFileSize('userProfile')) }}" />
                        <h4 class="crancy-single-user__title">
                          {{ @$data->username }}
                        </h4>
                        <p class="crancy-single-user__label">Downline</p>
                      </div>
                      <div class="crancy-single-user__info">
                        <ul class="crancy-single-user__list">
                          <li>
                            Email: <a href="#">{{ @showEmailAddress($data->email) }}</a>
                          </li>
                          <li>Phone: <a href="#">{{ @showMobileNumber($data->mobile) }}</a></li>
                        </ul>
                      </div>
                      <a href="inbox.html" class="crancy-btn__default"
                        >Message</a
                      >
                    </div>
                    <!-- End Single User -->
                  </div>
                  @empty
                  {!!emptyData2()!!}
                  @endforelse
                   
                </div>
                 
              </div>
               
            </div>
          </div>
          <!-- End Dashboard Inner -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End crancy Dashboard -->


    
@endsection
@push('script') 
<script>
  function myFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/
            document.execCommand("copy");
            toastr.info('Ref link copied', 'Hello');


        } 
</script>
@endpush