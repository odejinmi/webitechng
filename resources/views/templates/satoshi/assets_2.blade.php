@extends(checkTemplate() . 'layouts.frontend2')
@section('content')
@include(checkTemplate() . 'partials.breadcrumb2')
<!--Image start-->
         <section class>
            <div class="container">
               <div class="row gy-4">
                  <div class="col-lg-4 col-md-4 col-12">
                     <a href="{{ asset(checkTemplate(true) . 'front/images/offer-01.jpg')}}" class="glightbox rounded-3">
                        <div
                           class="rounded-3 card-lift"
                           style="background-image: url({{ asset(checkTemplate(true) . 'front/images/offer-01.jpg')}}); background-repeat: no-repeat; height: 350px; background-size: cover"></div>
                     </a>
                  </div>
                  <div class="col-lg-4 col-md-4 col-12">
                     <a href="{{ asset(checkTemplate(true) . 'front/images/offer-02.jpg')}}" class="glightbox rounded-3">
                        <div
                           class="rounded-3 card-lift"
                           style="background-image: url({{ asset(checkTemplate(true) . 'front/images/offer-02.jpg')}}); background-repeat: no-repeat; height: 350px; background-size: cover"></div>
                     </a>
                  </div>
                  <div class="col-lg-4 col-md-4 col-12">
                     <a href="{{ asset(checkTemplate(true) . 'front/images/offer-03.jpg')}}" class="glightbox rounded-3">
                        <div
                           class="rounded-3 card-lift"
                           style="background-image: url({{ asset(checkTemplate(true) . 'front/images/offer-03.jpg')}}); background-repeat: no-repeat; height: 350px; background-size: cover"></div>
                     </a>
                  </div>
               </div>
            </div>
         </section>
         <!--Image end-->

         <!--Logo start-->
         <section class="my-lg-9 my-5">
            <div class="container">
               <div class="row border-top border-bottom">
                  <div class="col-lg-4 col-md-4 col-12 border-end-md border-bottom border-bottom-md-0">
                     <div class="text-center p-5">
                        <img src="{{ asset(checkTemplate(true) . 'front/images/btc.png')}}" alt="award" class />
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-12 border-end-md border-bottom border-bottom-md-0">
                     <div class="text-center p-5">
                        <img src="{{ asset(checkTemplate(true) . 'front/images/ETH.png')}}" alt="award" class />
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-12">
                     <div class="text-center p-5">
                        <img src="{{ asset(checkTemplate(true) . 'front/images/usdt.png')}}" alt="award" class />
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!--Logo end-->

         <!--Our values start-->
         <section class="my-xl-9 my-5">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-12">
                     <div class="mb-xl-6 mb-5">
                        <h2 class="mb-0">Pay Bills</h2>
                     </div>
                  </div>
               </div>
               <div class="row d-flex align-items-center mb-md-9 mb-6">
                  <div class="col-lg-6 col-md-6 col-12">
                     <figure class="mb-4 mb-md-0">
                        <img src="{{ asset(checkTemplate(true) . 'front/images/img-11.png')}}" alt="value" class="img-fluid rounded-3" />
                     </figure>
                  </div>
                  <div class="col-lg-5 offset-lg-1 col-md-6 col-12">
                     <span class="text-primary fw-semibold">01</span>
                     <div class="mb-4">
                        <h3 class="mt-4 mb-3">Utility Bills</h3>
                        <p class="mb-0">
                          Pay your utility bills on {{$general->site_name}} effortlessly with the push of a button on your PC or your mobile devices.
                        </p>
                     </div>

                     <a href="{{route('user.login')}}" class="icon-link icon-link-hover">
                        Explore service
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                           <path
                              fill-rule="evenodd"
                              d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg>
                     </a>
                  </div>
               </div>
               <div class="row d-flex align-items-center mb-md-9 mb-6">
                  <div class="col-lg-5 col-md-6 col-12 order-2">
                     <span class="text-primary fw-semibold">02</span>
                     <div class="mb-4">
                        <h3 class="mt-4 mb-3">Airtime & Internet</h3>
                        <p class="mb-0">
                          You get to pay for internet subscription plans and airtime from the comfort of your room without lifting a finger
                        </p>
                     </div>

                     <a href="#!" class="icon-link icon-link-hover">
                        Case study
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                           <path
                              fill-rule="evenodd"
                              d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg>
                     </a>
                  </div>

                  <div class="col-lg-6 offset-lg-1 col-md-6 col-12 order-md-2">
                     <figure class="mb-4">
                        <img src="{{ asset(checkTemplate(true) . 'front/images/img-07.png')}}" alt="value" class="img-fluid rounded-3" />
                     </figure>
                  </div>
               </div>

               <div class="row d-flex align-items-center mb-md-9 mb-6">
                  <div class="col-lg-6 col-md-6 col-12">
                     <figure class="mb-4 mb-md-0">
                        <img src="{{ asset(checkTemplate(true) . 'front/images/img-03.png')}}" alt="value" class="img-fluid rounded-3" />
                     </figure>
                  </div>
                  <div class="col-lg-5 offset-lg-1 col-md-6 col-12">
                     <span class="text-primary fw-semibold">03</span>
                     <div class="mb-4">
                        <h3 class="mt-4 mb-3">Cable TV Subscription</h3>
                        <p class="mb-0">We continue to transform and experiment with methodologies and approaches. But one thing remains unchangeable — the direction of our growth.</p>
                     </div>

                     <a href="#!" class="icon-link icon-link-hover">
                        Join our team
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                           <path
                              fill-rule="evenodd"
                              d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg>
                     </a>
                  </div>
               </div>
            </div>
         </section>
         <!--Our values end-->

         <!--Behind the block start-->

@endsection
