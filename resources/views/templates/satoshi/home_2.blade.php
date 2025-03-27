@extends($activeTemplate . 'layouts.frontend2')
@section('content')
 <!--Hero start-->
         <section class="bg-primary-dark pt-9 right-slant-shape" data-cue="fadeIn">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-lg-5 col-12">
                     <div class="text-center text-lg-start mb-7 mb-lg-0" data-cues="slideInDown">
                        <div class="mb-4">
                           <h1 class="mb-5 display-5 text-white-stable">
                              Meet the next gen<br>
                              <span class="text-pattern-line text-warning">Bills Payment Solution</span>
                           </h1>
                           <p class="mb-0 text-white-stable lead">Exceptional Bill Payment Experience: Your Satisfaction Guaranteed</p>
                        </div>
                        <div data-cues="slideInDown">
                           <a href="{{route('user.register')}}" class="btn btn-primary me-2">Get Started</a>
                           <a href="{{route('user.login')}}" class="btn btn-outline-warning">My Account</a>
                        </div>
                     </div>
                  </div>
                  <div class="offset-lg-1 col-lg-6 col-12">
                     <div class="position-relative z-1 pt-lg-9" data-cue="slideInRight">
                        <div class="position-relative">
                           <img src="{{ asset($activeTemplateTrue . 'front/images/img-01.png') }}" alt="video" class="img-fluid rounded-3" width="837" />
                           <a
                              href="#"
                              class="play-btn glightbox position-absolute top-50 start-50 translate-middle icon-shape icon-xl rounded-circle text-primary">
                              <i class="bi bi-play-fill"></i>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!--Hero start-->

         

         <!--Your finance start-->
         <section class="my-xl-9 my-5">
            <div class="container" data-cue="fadeIn">
               <div class="row">
                  <div class="col-xl-8 offset-xl-2">
                     <div class="text-center mb-xl-7 mb-5">
                        <h2 class="mb-3">
                           A one-stop shop for
                           <span class="text-primary">your finances.</span>
                        </h2>
                        <p class="mb-0">Your Financial Partner: Dedicated to Your Payment Needs</p>
                     </div>
                  </div>
               </div>
               <div class="table-responsive-lg">
                  <div class="row flex-nowrap pb-4 pb-lg-0 me-5 me-lg-0">
                     <div class="col-lg-4 col-md-6" data-cue="zoomIn">
                        <div class="card border-0 card-primary">
                           <div class="card-body p-5">
                              <div class="position-relative d-inline-block mb-5">
                                 <img src="{{ asset($activeTemplateTrue . 'front2/images/landings/finance/feature-img-1.jpg')}}" alt="feature" class="avatar avatar-xl rounded-circle border-2 border border-white shadow-sm" />

                                 <div class="position-absolute bottom-0 end-0">
                                    <div class="icon-md icon-shape rounded-circle bg-white me-n2 mb-n2 shadow-sm">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-bank2 text-primary" viewBox="0 0 16 16">
                                          <path
                                             d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916l-7.5-5zM12.375 6v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2zM.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1H.5z" />
                                       </svg>
                                    </div>
                                 </div>
                              </div>
                              <div class="mb-5">
                                 <h4 class="card-title">Bank Transfer</h4>
                                 <p class="mb-0 card-text">Lightning-Fast, Secure Money Transfers at Your Fingertips. Send and Receive Money Instantly, Anytime, Anywhere.</p>
                              </div>

                              <a href="{{route('user.login')}}" class="icon-link icon-link-hover card-link">
                                 Start Now
                                 <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path
                                       fill-rule="evenodd"
                                       d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                 </svg>
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6" data-cue="zoomIn">
                        <div class="card border-0 card-primary">
                           <div class="card-body p-5">
                              <div class="position-relative d-inline-block mb-5">
                                 <img src="{{ asset($activeTemplateTrue . 'front2/images/landings/finance/feature-img-2.jpg')}}" alt="feature" class="avatar avatar-xl rounded-circle border-2 border border-white shadow-sm" />

                                 <div class="position-absolute bottom-0 end-0">
                                    <div class="icon-md icon-shape rounded-circle bg-white me-n2 mb-n2 shadow-sm">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-credit-card-2-front-fill text-primary" viewBox="0 0 16 16">
                                          <path
                                             d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z" />
                                       </svg>
                                    </div>
                                 </div>
                              </div>
                              <div class="mb-5">
                                 <h4 class="card-title">Credit cards</h4>
                                 <p class="mb-0 card-text">Effortless Online Shopping: Create Virtual Cards for One-Time Use or Recurring Payments.</p>
                              </div>

                              <a href="#!" class="icon-link icon-link-hover card-link">
                                 Apply Credit Cards
                                 <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path
                                       fill-rule="evenodd"
                                       d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                 </svg>
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6" data-cue="zoomIn">
                        <div class="card border-0 card-primary">
                           <div class="card-body p-5">
                              <div class="position-relative d-inline-block mb-5">
                                 <img src="{{ asset($activeTemplateTrue . 'front2/images/landings/finance/feature-img-3.jpg')}}" alt="feature" class="avatar avatar-xl rounded-circle border-2 border border-white shadow-sm" />

                                 <div class="position-absolute bottom-0 end-0">
                                    <div class="icon-md icon-shape rounded-circle bg-white me-n2 mb-n2 shadow-sm">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cash-stack text-primary" viewBox="0 0 16 16">
                                          <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                          <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z" />
                                       </svg>
                                    </div>
                                 </div>
                              </div>
                              <div class="mb-5">
                                 <h4 class="card-title">Bills Payment</h4>
                                 <p class="mb-0 card-text">Simplify your life with our all-in-one bill payment solution. Manage multiple bills, automate payments, and track your spending effortlessly.</p>
                              </div>

                              <a href="{{route('user.login')}}" class="icon-link icon-link-hover card-link">
                                 Pay Bills Now
                                 <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path
                                       fill-rule="evenodd"
                                       d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                 </svg>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row mt-6" data-cue="fadeIn">
                  <div class="col-xl-10 offset-xl-1">
                     <ul class="list-inline">
                        <li class="list-inline-item d-inline-flex align-items-center me-3 mb-2 mb-lg-0">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                              <path
                                 d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                           </svg>
                           <span class="ms-2">24/7 account monitoring</span>
                        </li>
                        <li class="list-inline-item d-inline-flex align-items-center me-3 mb-2 mb-lg-0">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                              <path
                                 d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                           </svg>
                           <span class="ms-2 me-3">Protection & peace of mind</span>
                        </li>
                        <li class="list-inline-item d-inline-flex align-items-center me-3 mb-2 mb-lg-0">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                              <path
                                 d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                           </svg>
                           <span class="ms-2">Anytime, anywhere support</span>
                        </li>
                        <li class="list-inline-item d-inline-flex align-items-center me-3">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                              <path
                                 d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                           </svg>
                           <span class="ms-2">Serious security</span>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </section>
         <!--Your finance end-->

         <!--5m member start-->
         <section class="py-xl-9 py-5 bg-primary-dark">
            <div class="container" data-cue="fadeIn">
               <div class="row">
                  <div class="col-xl-8 offset-xl-2 col-12">
                     <div class="text-center mb-xl-7 mb-5">
                        <h2 class="text-white-stable mb-3">Why do over 5M members love?</h2>
                        <p class="mb-0 text-white-50">
                           Enim sed parturient sem enim nunc sit erat velit eget hac nulla nullam et id praesent nisi ornare risus risus consequat nunc nisl pellentesque diam neque.
                        </p>
                     </div>
                  </div>
               </div>
               <div class="row mb-7 pb-4 g-5 text-center text-lg-start">
                  <div class="col-md-4" data-cue="fadeIn">
                     <h4 class="text-white-stable">Innovation at the Core:</h4>
                     <p class="text-white-50 mb-0">We're constantly innovating and developing new features to enhance your financial experience. We stay ahead of the curve by embracing the latest technologies and industry trends</p>
                  </div>
                  <div class="col-md-4" data-cue="fadeIn">
                     <h4 class="text-white-stable">Security First:</h4>
                     <p class="text-white-50 mb-0">Our advanced encryption technology protects your data around the clock.</p>
                  </div>
                  <div class="col-md-4" data-cue="fadeIn">
                     <h4 class="text-white-stable">Unwavering Customer Support</h4>
                     <p class="text-white-50 mb-0">Our dedicated customer support team is available 24/7 to answer your questions and address any concerns you may have. We believe in providing exceptional service and building trust with our customers.</p>
                  </div>
               </div>
               <div class="row border-primary border-top g-5 g-lg-0 text-center text-lg-start" data-cue="fadeIn">
                  <div class="col-lg-3 col-6 border-end-lg border-md-0 border-lg-primary" data-cue="fadeIn">
                     <div class="p-lg-5">
                        <h5 class="h1 text-white-stable mb-0">5M+</h5>
                        <span class="text-white-50">Members</span>
                     </div>
                  </div>
                  <div class="col-lg-3 col-6 border-end-lg border-md-0 border-lg-primary" data-cue="fadeIn">
                     <div class="p-lg-5">
                        <h5 class="h1 text-white-stable mb-0">95%</h5>
                        <span class="text-white-50">Customer satisfaction</span>
                     </div>
                  </div>
                  <div class="col-lg-3 col-6 border-end-lg border-md-0 border-lg-primary" data-cue="fadeIn">
                     <div class="p-lg-5">
                        <h5 class="h1 text-white-stable mb-0">73%</h5>
                        <span class="text-white-50">Over year growth</span>
                     </div>
                  </div>
                  <div class="col-lg-3 col-6" data-cue="fadeIn">
                     <div class="p-lg-5">
                        <h5 class="h1 text-white-stable mb-0">250B</h5>
                        <span class="text-white-50">Money managed</span>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!--5m member end-->

         <!--Product designer start-->
         <section class="my-xl-9 my-5">
            <div class="container">
               <div class="row">
                  <div class="col-lg-8 offset-lg-2">
                     <div class="text-center mb-xl-7 mb-5" data-cue="fadeIn">
                        <h2 class="mb-3">
                           Join the future of finance with 
                           <span class="text-primary">{{$general->site_name}}</span>
                        </h2>
                        <p class="mb-0">At {{$general->site_name}}, we're revolutionizing the way you manage your money. We understand that security is a major concern for many people when it comes to using financial services, and that's why we created a platform designed to make your financial life easier, faster, and more secure.</p>
                     </div>
                  </div>
               </div>
               <div class="row align-items-center">
                  <div class="col-xl-5 col-md-6 col-12">
                     <div class="nav flex-column nav-pills mb-5 mb-lg-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a
                           href="#"
                           class="nav-link active d-flex text-start align-items-center align-items-lg-start p-xl-4 p-3"
                           id="v-pills-small-business-tab"
                           data-bs-toggle="pill"
                           data-bs-target="#v-pills-small-business"
                           role="tab"
                           aria-controls="v-pills-small-business"
                           aria-selected="true">
                           <div class="d-flex">
                              <div class="icon-md icon-shape rounded-circle bg-white shadow-sm">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-bank2 text-primary" viewBox="0 0 16 16">
                                    <path
                                       d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916l-7.5-5zM12.375 6v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2zM.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1H.5z" />
                                 </svg>
                              </div>
                           </div>
                           <div class="ms-4">
                              <h4 class="mb-0">Trade crypto assets</h4>
                              <p class="mb-0 mt-lg-3 d-none d-lg-block">Buy and sell digital assets with your wallet balance or pay with credit card to experience a premium user journey</p>
                           </div>
                        </a>
                        <a
                           href="#"
                           class="nav-link d-flex text-start align-items-center align-items-lg-start p-xl-4 p-3"
                           id="v-pills-profile-tab"
                           data-bs-toggle="pill"
                           data-bs-target="#v-pills-profile"
                           role="tab"
                           aria-controls="v-pills-profile"
                           aria-selected="false">
                           <div class="d-flex">
                              <div class="icon-md icon-shape rounded-circle bg-white shadow-sm">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-credit-card-2-front-fill text-primary" viewBox="0 0 16 16">
                                    <path
                                       d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z" />
                                 </svg>
                              </div>
                           </div>
                           <div class="ms-4">
                              <h4 class="mb-0">Virtual Digital Cards</h4>
                              <p class="mb-0 mt-lg-3 d-none d-lg-block">Seamlessly create digital virtual cards and enjoy better online payments or recurring billing using our virtial cards.</p>
                           </div>
                        </a>
                        <a
                           href="#"
                           class="nav-link d-flex text-start p-xl-4 p-3 align-items-center align-items-lg-start"
                           id="v-pills-enterprises-tab"
                           data-bs-toggle="pill"
                           data-bs-target="#v-pills-enterprises"
                           role="tab"
                           aria-controls="v-pills-enterprises"
                           aria-selected="false">
                           <div class="d-flex">
                              <div class="icon-md icon-shape rounded-circle bg-white shadow-sm">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cash-stack text-primary" viewBox="0 0 16 16">
                                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                    <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z" />
                                 </svg>
                              </div>
                           </div>
                           <div class="ms-4">
                              <h4 class="mb-0">Bills Payment</h4>
                              <p class="mb-0 mt-lg-3 d-none d-lg-block">
                                 Pay bills from the comfort of your room and enjoy mouth watering discount on our various plans.
                              </p>
                           </div>
                        </a>
                     </div>
                  </div>
                  <div class="col-xl-6 offset-xl-1 col-md-6 col-12">
                     <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-small-business" role="tabpanel" aria-labelledby="v-pills-small-business-tab" tabindex="0">
                           <div class="position-relative scene" data-relative-input="true">
                              <figure><img src="{{ asset($activeTemplateTrue . 'front2/images/landings/finance/mobile-hero-img-light.png') }}" alt="finance" class="img-fluid rounded-3" data-cue="fadeIn" /></figure>

                              <div class="position-relative" data-depth="0.05">
                                 <img src="{{ asset($activeTemplateTrue . 'front2/images/landings/finance/card.svg')}}" alt="" class="position-absolute bottom-0 end-0 px-4" />
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                           <div class="position-relative scene" data-relative-input="true">
                              <figure><img src="{{ asset($activeTemplateTrue . 'front2/images/landings/finance/finance-tab-2.jpg')}}" alt="finance" class="img-fluid rounded-3" data-cue="fadeIn" /></figure>

                              <div class="position-relative" data-depth="0.05">
                                 <img src="{{ asset($activeTemplateTrue . 'front2/images/landings/finance/card.svg')}}" alt="" class="position-absolute bottom-0 start-0 px-4" />
                              </div>
                           </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-enterprises" role="tabpanel" aria-labelledby="v-pills-enterprises-tab" tabindex="0">
                           <div class="position-relative scene" data-relative-input="true">
                              <figure><img src="{{ asset($activeTemplateTrue . 'front/images/img-03.png') }}" alt="finance" class="img-fluid rounded-3" /></figure>

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!--Product designer end-->

         <!--Get block card start-->
         <section class="my-xl-7 py-5">
            <div class="container" data-cue="fadeIn">
               <div class="row">
                  <div class="col-lg-5 col-md-12" data-cue="fadeIn">
                     <div class="mb-xl-7 mb-5">
                        <h2 class="mb-3">
                           How to get started with {{$general->site_name}} in a
                           <span class="text-primary">simple 3 steps</span>
                        </h2>
                        <p class="mb-0">Designed to work better together erat velit eget hac nulla nullam et id praesent nisi ornare risus risus consequat nunc nisl pellentesque diam neque.</p>
                     </div>
                  </div>
               </div>
               <div class="table-responsive-xl">
                  <div class="row flex-nowrap pb-4 pb-lg-0 me-5 me-lg-0">
                     <div class="col-lg-4 col-md-6 col-12" data-cue="slideInLeft">
                        <div class="p-xl-5">
                           <div class="d-flex align-items-center justify-content-between mb-5">
                              <div class="icon-xl icon-shape rounded-circle bg-primary border border-primary-subtle border-4 text-white-stable fw-semibold fs-3">1</div>
                              <span>
                                 <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right text-body-tertiary" viewBox="0 0 16 16">
                                    <path
                                       fill-rule="evenodd"
                                       d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                 </svg>
                              </span>
                           </div>

                           <h3 class="h4">Sign up for a free account</h3>
                           <p class="mb-0">Apply online on {{$general->site_name}} website and fill the form by telling us your name, email, password.</p>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6 col-12" data-cue="slideInLeft">
                        <div class="p-xl-5">
                           <div class="d-flex align-items-center justify-content-between mb-5">
                              <div class="icon-xl icon-shape rounded-circle bg-primary border border-primary-subtle border-4 text-white-stable fw-semibold fs-3">2</div>
                              <span>
                                 <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right text-body-tertiary" viewBox="0 0 16 16">
                                    <path
                                       fill-rule="evenodd"
                                       d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                 </svg>
                              </span>
                           </div>

                           <h3 class="h4">Fill in your details</h3>
                           <p class="mb-0">Complete your KYC process where necessary to give you premium access to the app's premium features</p>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6 col-12" data-cue="slideInLeft">
                        <div class="p-xl-5">
                           <div class="d-flex align-items-center justify-content-between mb-5">
                              <div class="icon-xl icon-shape rounded-circle bg-primary border border-primary-subtle border-4 text-white-stable fw-semibold fs-3">3</div>
                              <span>
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                                    <path
                                       d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                 </svg>
                              </span>
                           </div>

                           <h3 class="h4">Start making payment!</h3>
                           <p class="mb-0">Get started on {{$general->site_name}} or log into the mobile app to transfer money, paybills and many more.</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12" data-cue="zoomIn">
                     <div class="text-center my-5">
                        <a href="{{route('user.register')}}" class="btn btn-outline-primary">Open an Account</a>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!--Get block card end-->
        @php
        $testimonialContent = getContent('testimonial.content', true);
        $testimonialElements = getContent('testimonial.element', null, false, true);
        @endphp
         <!--Customer stories start-->
         <section class="py-xl-9 py-5 bg-gray-100">
            <div class="container" data-cue="fadeIn">
               <div class="row">
                  <div class="col-lg-6 offset-lg-3">
                     <div class="text-center mb-xl-7 mb-5">
                        <h2 class="mb-3">{{ __(@$testimonialContent->data_values->heading) }}</h2>
                        <p class="mb-0">{{ __(@$testimonialContent->data_values->sub_heading) }}</p>
                     </div>
                  </div>
               </div>
               <div class="row g-4">
                @forelse($testimonialElements as $item)
                  <div class="col-lg-6 col-md-12">
                     <!-- Testimonials with logo -->
                     <div class="card shadow-sm" data-cue="slideInLeft">
                        <div class="card-body">
                           <p class="mb-5 lead">
                              “{{ __(@$item->data_values->review) }}”
                           </p>
                           <div class="d-md-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center mb-3 mb-lg-0">
                                 <div>
                                    <img src="{{ getImage('assets/images/frontend/testimonial/' . @$item->data_values->image, '70x70') }}" alt="Avatar" class="avatar avatar-lg rounded-circle" />
                                 </div>
                                 <div class="ms-3">
                                    <h6 class="mb-0 h5">{{ __(@$item->data_values->name) }}</h6>
                                    <span class="small text-body-tertiary">{{ __(@$item->data_values->designation) }}</span>
                                 </div>
                              </div> 
                           </div>
                        </div>
                     </div>
                  </div>
                  @empty
						{!!emptyData()!!}
				  @endforelse
                   
               </div>
            </div>
         </section>
         <!--Customer stories end-->

         <!--Call to action start-->
         <section>
            <div style="background-image: url({{ asset($activeTemplateTrue . 'front2/images/pattern/cta-pattern.png')}}"); background-position: center; background-repeat: no-repeat; background-size: cover" class="py-7 bg-primary-dark">
               <div class="container my-lg-7" data-cue="zoomIn">
                  <div class="row">
                     <div class="col-lg-8 offset-lg-2">
                        <div class="text-center mb-5">
                           <h2 class="text-white-stable mb-3">Experience the next-gen banking</h2>
                           <p class="mb-0 text-white-50">
                              Join us today to experience the great user journey with us.
                           </p>
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="text-center">
                           <a href="{{route('user.register')}}" class="btn btn-primary">Open an account today</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!--Call to action end-->
@endsection
