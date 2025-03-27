@extends($activeTemplate.'layouts.frontend2')
@section('content')
@include($activeTemplate . 'partials.breadcrumb2')

<br><br>
    @if($sections != null)
        @foreach(json_decode($sections) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif
    <br>
                                  <section>
                                 <div class="container">
                                    <div class="row bg-pattern bg-primary-gradient rounded-3 p-7 g-0">
                                       <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-12 col-12">
                                          <div class="position-relative z-1 my-lg-5">
                                             <div class="mb-5 text-center">
                                                <h3 class="h2 text-white-stable mb-1">Try our powerful work management tools</h3>
                                                <p class="mb-0 text-white-stable">Sign up for a free two-week trial of Block today — no credit card required.</p>
                                             </div>
                                             <form class="row g-2 needs-validation d-flex mx-lg-7" novalidate>
                                                <div class="col-md-7 col-xl-7 col-12">
                                                   <label for="notificationEmail" class="visually-hidden"></label>
                                                   <input
                                                      type="email"
                                                      id="notificationEmail"
                                                      class="form-control"
                                                      placeholder="Enter your business email"
                                                      aria-label="Enter your business email"
                                                      required />
                                                   <div class="invalid-feedback text-start">Please choose a email.</div>
                                                </div>
                                                <div class="col-md-5 col-xl-5 col-12">
                                                   <div class="d-grid">
                                                      <button class="btn btn-dark" type="submit">Get notified for free</button>
                                                   </div>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </section>

@endsection
