@extends(checkTemplate() . 'layouts.frontend')
@section('content')
@include(checkTemplate() . 'partials.breadcrumb')

			<!-- CARDS-3
			============================================= -->
			<section id="cards-3" class="pt-80 pb-60 cards-section division">
				<div class="container">
			 		<div class="cards-3-wrapper">
						<div class="row">


							<!-- CARD-1 -->
							<div class="col-sm-6 col-lg-4 col-xl-2">
								<a href="#">
									<div class="card-3 bg-white radius-06 text-center">

										<!-- Icon -->
										<div class="coin-icon"><img src="{{ asset(checkTemplate(true) . 'front/images/btc.png')}}"
										class="img-fluid" alt=""></div>

										<!-- Text -->
										<h6 class="h3-xs">BITCOIN</h3>

									</div>
								</a>
							</div>	<!-- END CARD-1 -->


							<!-- CARD-2 -->
							<div class="col-sm-6 col-lg-4 col-xl-2">
								<a href="#">
									<div class="card-3 bg-white radius-06 text-center">

										<!-- Icon -->
										<div class="coin-icon"><img src="{{ asset(checkTemplate(true) . 'front/images/ETH.png')}}"
										class="img-fluid" alt=""></div>

										<!-- Text -->
										<h6 class="h3-xs">ETHEREUM</h3>

									</div>
								</a>
							</div>	<!-- END CARD-1 -->


							<!-- CARD-4 -->
							<div class="col-sm-6 col-lg-4 col-xl-2">
								<a href="#">
									<div class="card-3 bg-white radius-06 text-center">

										<!-- Icon -->
										<div class="coin-icon"><img src="{{ asset(checkTemplate(true) . 'front/images/ltc.png')}}"
										class="img-fluid" alt=""></div>

										<!-- Text -->
										<h6 class="h3-xs">LITECOIN</h3>

									</div>
								</a>
							</div>	<!-- END CARD-1 -->


							<!-- CARD-5 -->
						    <div class="col-sm-6 col-lg-4 col-xl-2">
								<a href="#">
									<div class="card-3 bg-white radius-06 text-center">

										<!-- Icon -->
										<div class="coin-icon"><img src="{{ asset(checkTemplate(true) . 'front/images/usdt.png')}}"
										class="img-fluid" alt=""></div>

										<!-- Text -->
										<h6 class="h6-xs">TETHER USDT</h6>

									</div>
								</a>
							</div>	<!-- END CARD-1 -->



							<!-- CARD-6 -->
							<div class="col-sm-6 col-lg-4 col-xl-2">
								<a href="#">
									<div class="card-3 bg-white radius-06 text-center">

										<!-- Icon -->
										<div class="coin-icon"><img src="{{ asset(checkTemplate(true) . 'front/images/doge.png')}}"
										class="img-fluid" alt=""></div>

										<!-- Text -->
										<h6 class="h3-xs">DODGE COIN</h3>

									</div>
								</a>
							</div>	<!-- END CARD-1 -->

							<!-- CARD-6 -->
							<div class="col-sm-6 col-lg-4 col-xl-2">
								<a href="#">
									<div class="card-3 bg-white radius-06 text-center">

										<!-- Icon -->
										<div class="coin-icon"><img src="{{ asset(checkTemplate(true) . 'front/images/bnb.png')}}"
										class="img-fluid" alt=""></div>

										<!-- Text -->
										<h6 class="h3-xs">BINANCE COIN</h3>

									</div>
								</a>
							</div>	<!-- END CARD-1 -->


						</div>  <!-- End row -->
					</div>	<!-- END CARDS-3 WRAPPER -->
				</div>	   <!-- End container -->
			</section>	<!-- End CARDS-3 -->





			<!-- SERVICE DETAILS
			============================================= -->
			<section id="service-details" class="pb-80 single-service division">
				<div class="container">


					<!-- SERVICE DISCRIPTION -->
					<div class="row">
						<div class="col-xl-10 offset-xl-1">
							<div class="service-txt mb-70">



@include(checkTemplate() . 'sections.about')

							</div>
						</div>
					</div>	<!-- END SERVICE DISCRIPTION -->


					<!-- SERVICE IMAGES -->
					<div class="row d-flex align-items-center">

						<!-- IMAGE #1 -->
						<div class="col-md-8">
							<div class="project-image">
								<img class="img-fluid" src="{{ asset(checkTemplate(true) . 'front/images/service-img-1.jpg')}}" alt="service-image" />
							</div>
						</div>

						<!-- IMAGE #2 -->
						<div class="col-md-4">
							<div class="project-image">
								<img class="img-fluid" src="{{ asset(checkTemplate(true) . 'front/images/service-img-2.jpg')}}" alt="pservice-image" />
							</div>
						</div>

					</div>	<!-- END SERVICE IMAGES -->


					<!-- SERVICE DISCRIPTION -->
					<div class="row">
						<div class="col-xl-10 offset-xl-1">
							<div class="service-txt mt-30">

								<!-- Small Title -->
								<h5 class="h5-sm">WHY THOUSANDS OF PEOPLE TRUST {{$general->site_name}} CRYPTO</h5>

								<!-- List -->
								<ul class="simple-list">

									<li class="list-item">
										<p class="p-md">{{$general->site_name}} makes it easy for you to buy and sell digital assets. Convenience is the watch word
										</p>
									</li>

									<li class="list-item">
										<p class="p-md">You can count on us when it come to security. Built with advanced technology, our Bank-Level Encryption from end-to-end keeps your digital assets safe when buying, selling or storing.
										</p>
									</li>

									<li class="list-item">
										<p class="p-md">We are Fast. Our {{$general->site_name}} solutions provides near-instant BUY and SELL orders for newbies and seasoned traders.
										</p>
									</li>

									<li class="list-item">
										<p class="p-md">We are reliable. Of course we know how hectic life can be but managing your crypto should not be. We operate a 100% uptime system. {{$general->site_name}} is always operational and available to serve you because you come first
										</p>
									</li>

								</ul>	<!-- End List -->

							</div>
						</div>
					</div>	<!-- END SERVICE DISCRIPTION -->



				</div>     <!-- End container -->
			</section>	<!-- END SERVICE DETAILS -->




			<!-- PROMO-3
			============================================= -->
			<div id="promo-3" class="promo-section division">
				<div class="container">
					<div class="row d-flex align-items-center">


						<!-- PROMO IMAGE-1 -->
						<div class="col-md-4">
							<a href="pricing.html">
								<div id="pb-1-1" class="pbox-1 radius-06 wow fadeInUp" data-wow-delay="0.4s">
									<img class="img-fluid" src="{{ asset(checkTemplate(true) . 'front/images/offer-01.jpg')}}" alt="promo-image" />
								</div>
							</a>
						</div>


						<!-- PROMO IMAGE-2 -->
						<div class="col-md-4">
							<a href="pricing.html">
								<div id="pb-1-2" class="pbox-1 radius-06 wow fadeInUp" data-wow-delay="0.6s">
									<img class="img-fluid" src="{{ asset(checkTemplate(true) . 'front/images/offer-02.jpg')}}" alt="promo-image" />
								</div>
							</a>
						</div>


						<!-- PROMO IMAGE-3 -->
						<div class="col-md-4">
							<a href="pricing.html">
								<div id="pb-1-3" class="pbox-1 radius-06 wow fadeInUp" data-wow-delay="0.8s">
									<img class="img-fluid" src="{{ asset(checkTemplate(true) . 'front/images/offer-03.jpg')}}" alt="promo-image" />
								</div>
							</a>
						</div>

					</div>    <!-- End row -->
				</div>	   <!-- End container -->
			</div>	<!-- END PROMO-3 -->




			<!-- CONTENT-12
			============================================= -->
			<section id="content-12" class="pt-100 content-section division">
			 	<div class="container">


			 		<!-- TEXT BLOCK -->
			 		<div class="row">
			 			<div class="col-md-11 col-lg-8 col-xl-7">
			 				<div class="txt-block">

					 			<!-- Title -->
								<h3 class="h3-sm">WE ARE COMMITTED TO SERVE YOU BETTER</h3>

								<!-- Text -->
								<p class="p-md grey-color">We are committed to providing reliable and trustworthy solutions and professional customer care services any day and any time.
								</p>

					 		</div>
					 	</div>
			 		</div>


			 		<!-- IMAGE BLOCK -->
			 		<div class="row">
						<div class="col-md-12">
							<div class="img-block rel text-center">

								<!-- Image -->
								<img class="img-fluid" src="{{ asset(checkTemplate(true) . 'front/images/collage-cars.png')}}" alt="content-image">

								<!-- Text Block -->
								<div class="content-12-txt bg-01 white-color">

									<!-- Title -->
									<h4 class="h4-sm">Join the {{$general->site_name}} family today</h4>

									<!-- Text -->
									<p class="p-md">Download {{$general->site_name}} Crypto Mobile application and take advantage of the COIN LOCK feature. Input your preferred Btc amount in USD to lock!

									</p>

								</div>

							</div>
						</div>
					</div>


			 	</div>      <!-- End container -->
			</section>	 <!-- END CONTENT-12 -->



			<br><br><br><br><br><br>




			<!-- CALL TO ACTION-6
			============================================= -->
			<section id="cta-6" class="cta-6-cars bg-fixed wide-60 cta-section division">
				<div class="container">
					<div class="row d-flex align-items-center">


						<!-- CALL TO ACTION TEXT -->
						<div class="col-lg-8">
							<div class="cta-6-txt pc-20 mb-40 white-color">

								<!-- Title -->
								<h3 class="h2-sm">SUBSCRIBE TO GET UPDATES</h3>

								<!-- Text -->
								<p class="p-md">Stay up to date with what's trending on {{$general->site_name}} CRYPTO
								</p>

							</div>
						</div>




						<!-- CALL TO ACTION BUTTON -->
						<div class="col-lg-4">
							<div class="cta-6-btn text-right">
								<div class="btns-group">
									<a href="tel:123456789" class="btn btn-md btn-tra-white theme-hover">yourmail@mail.com</a>
									<a href="mailto:yourdomain@mail.com" class="btn btn-md btn-theme tra-white-hover">SUBSCRIBE NOW</a>
								</div>
							</div>
						</div>




					</div>    <!-- End row -->
				</div>	   <!-- End container -->
			</section>	<!-- END CALL TO ACTION-6 -->



@endsection
