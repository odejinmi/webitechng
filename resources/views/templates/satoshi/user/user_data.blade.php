@extends($activeTemplate . 'layouts.app')
@section('panel')
<form method="POST" action="{{ route('user.data.submit') }}" enctype="multipart/form-data">
    @csrf
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
      <div class="row">
        <div class="col-xxl-8 col-12 crancy-main__column">
          <div class="crancy-body">
            <!-- Dashboard Inner -->
            <div class="crancy-dsinner">
               
                <div class="row">
                  <div class="col-lg-6 col-12 mg-top-30">
                    <!-- Product Card -->
                    <div class="crancy-product-card">
                      <h4 class="crancy-product-card__title">
                        User Information
                        <a href="#"><img src="{{ asset($activeTemplateTrue . 'dashboard/img/alert-circle.svg')}}" /></a>
                      </h4>
                      <div class="crancy__item-form--group mg-top-25">
                        <label
                          class="crancy__item-label crancy__item-label-product"
                          >@lang('First Name')</label
                        >
                        <input
                          class="crancy__item-input"
                          type="text"
                          name="firstname" value="{{ old('firstname') }}" placeholder="@lang('Enter First Name')" 
                        />
                      </div>
                      <div class="crancy__item-form--group mg-top-25">
                        <label
                          class="crancy__item-label crancy__item-label-product"
                          >@lang('Last Name')</label
                        >
                        <input
                          class="crancy__item-input"
                          type="text"
                          name="lastname" value="{{ old('lastname') }}" placeholder="@lang('Enter Last Name')" 
                        />
                      </div>
                      <div class="crancy__item-form--group mg-top-25">
                        <label
                          class="crancy__item-label crancy__item-label-product"
                          >Username</label
                        >
                        <input
                          class="crancy__item-input"
                          type="text" value="{{ auth()->user()->username }}" disabled 
                        />
                      </div>
                    </div>
                    <!-- End Product Card -->
                  </div>
                  <div class="col-lg-6 col-12 mg-top-30">
                    <!-- Product Card -->
                    <div class="crancy-product-card">
                      <h4 class="crancy-product-card__title">
                        Product Image
                        <a href="#"><img src="{{ asset($activeTemplateTrue . 'dashboard/img/alert-circle.svg')}}" /></a>
                      </h4>
                      <p>
                        Select a suitable photo or drag and drop up to 1
                        photo at once here. Include min. 1 attractive
                        photos to make your account more attractive to
                        other users.
                      </p>
                      <div class="crancy-product-card__img">
                        <div class="row mg-btm-20">
                           
                          <div
                            class="col-lg-12 col-md-12 col-12 mg-top-form-20"
                          >
                            <div
                              class="crancy-product-card__upload crancy-product-card__upload--border"
                            >
                              <input
                                type="file"
                                class="btn-check"
                                name="image"
                                id="input-img1"
                                autocomplete="off"
                              />
                              <label
                                class="crancy-image-video-upload__label"
                                for="input-img1"
                              >
                                <img src="{{ asset($activeTemplateTrue . 'dashboard/img/upload-file.png')}}" />
                                <h4
                                  class="crancy-image-video-upload__title"
                                >
                                  Drag &amp; Drop or
                                  <span class="crancy-primary-color"
                                    >Choose File</span
                                  >
                                  to upload
                                </h4>
                              </label>
                            </div>
                          </div>
                        </div>
                        <p>
                          The image format is .jpg .jpeg .png and a minimum
                          size of 300 x 300px (For optimal images minimum
                          size of 350 x 300 px).
                        </p>
                      </div>
                    </div>
                    <!-- End Product Card -->
                  </div>
                  
                </div>
              
            </div>
            <!-- End Dashboard Inner -->
          </div>
        </div>

        <div class="col-lg-4 col-12 mg-top-30">
            <!-- Product Card -->
            <div class="crancy-product-card">
              <h4 class="crancy-product-card__title">
                Detailed Address
                <a href="#"><img src="{{ asset($activeTemplateTrue . 'dashboard/img/alert-circle.svg')}}" /></a>
              </h4>
              

              <div class="crancy__item-form--group mg-top-25">
                <label
                  class="crancy__item-label crancy__item-label-product"
                  >Address</label
                >
                <input
                  class="crancy__item-input"
                  type="text"
                  name="address" value="{{ old('address') }}"placeholder="@lang('Enter Your Address')"
                  required="required"
                />
              </div>
              <div class="crancy__item-form--group mg-top-25">
                <label
                  class="crancy__item-label crancy__item-label-product"
                  >State</label
                >
                <input
                  class="crancy__item-input"
                  type="text"
                  name="state" value="{{ old('state') }}"placeholder="@lang('Enter Your State')"
                  required="required"
                />
              </div>
              <div class="row">
                <div class="col-lg-6 col-12">
              <div class="crancy__item-form--group mg-top-25">
                <label
                  class="crancy__item-label crancy__item-label-product"
                  >City</label
                >
                <input
                  class="crancy__item-input"
                  type="text"
                  name="city" value="{{ old('city') }}"placeholder="@lang('Enter Your City')"
                  required="required"
                />
              </div>
                </div>
                <div class="col-lg-6 col-12">
              <div class="crancy__item-form--group mg-top-25">
                <label
                  class="crancy__item-label crancy__item-label-product"
                  >Zip</label
                >
                <input
                  class="crancy__item-input"
                  type="text"
                  name="zip" value="{{ old('zip') }}"placeholder="@lang('Enter Your Zip Code')"
                  required="required"
                />
              </div>
                </div>
            </div>
              
            </div>
            
            <!-- End Product Card -->
          </div>
          <div class="col-lg-12 col-12 mg-top-30">
            <!-- Product Card -->
            <div class="crancy-product-card">
                <div class="crancy__item-form--group mg-top-25">
                    <button class="crancy-btn crancy-btn--add-new">
                      <i class="fas fa-save"></i> Update Account
                    </button>
                  </div>
            </div>
          </div>
          
      </div>
    </div>
  </section>
  
</form>
  <!-- End crancy Dashboard -->
@endsection
