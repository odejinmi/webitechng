@extends(checkTemplate() . 'layouts.frontend')
@section('content')

<section id="hero-3" class="bg-fixed hero-section division">
    <div class="container">
        <div class="row d-flex align-items-center m-row">


            <!-- HERO TEXT -->
            <div class="col-md-7 col-lg-6 m-top">
                <div class="hero-3-txt pc-10 mb-40 wow fadeInRight" data-wow-delay="0.4s">


                    <!-- Title -->
                    <h2 class="h2-xl">Welcome To {{$general->site_name}}</h2>

                    <!-- Text -->
                    <p class="p-md">{{ $general->site_name }} {{$general->site_name}} makes it safe and easy to buy and sell Cryptocurrencies, Trade Gift card, shop with our Virtual USD and NGN dollar card, savings with interest and enjoy other bill payment services such as Cable, Electricity,Insurance, data and Airtime all using your local currency.
                    </p>

                    <!-- STORE BADGES -->
                    <div class="stores-badge">

                        <!-- AppStore -->
                        <a href="#" class="store">
                            <img class="appstore-original"
                                src="{{ asset(checkTemplate(true) . 'front/images/appstore.png') }}"
                                alt="appstore-badge" />
                        </a>

                        <!-- Google Play -->
                        <a href="#" class="store">
                            <img class="googleplay-original"
                                src="{{ asset(checkTemplate(true) . 'front/images/googleplay.png') }}"
                                alt="googleplay-badge" />
                        </a>


                    </div> <!-- END STORE BADGES -->

                </div>
            </div> <!-- END HERO TEXT -->


            <!-- HERO IMAGE -->
            <div class="col-md-5 col-lg-6 m-bottom">
                <div class="hero-3-img text-center mb-40 wow fadeInLeft" data-wow-delay="0.6s">
                    <img class="img-fluid" src="{{ asset(checkTemplate(true) . 'front/images/img-01.png') }}"
                        alt="hero-image">
                </div>
            </div>


        </div> <!-- End row -->
    </div> <!--End container -->
</section> <!-- END HERO-3 -->
{{--}}
<!-- HERO-1
			============================================= -->
			<section id="hero-1" class="hero-section division">


				<!-- SLIDER -->
				<div class="slider">
			    	<ul class="slides">
				     	<!-- SLIDE #1 -->
				      	<li id="slide-1">
					        <!-- Background Image -->
				        	<img src="{{ asset(checkTemplate(true) . 'front/images/slider/cryptocurrency-mining-technology-gold-coins-bitcoin-symbol-financial-graph-hologram-golden-bitcoin_890077-3219.jpeg')}}" alt="slide-background">
							<!-- Image Caption -->
		       				<div class="caption d-flex align-items-center center-align">
		       					<div class="container">
		       						<div class="row">
		       							<div class="col-lg-10 offset-lg-1">
		       								<div class="caption-txt white-color">

						       					<!-- Title -->
								         	 	<h2>Digital Asset Trading With Ease</h2>

									          	<!-- Text -->
												<p>Trade your digital assets at a juicy rate</p>

												<!-- Button -->
												<a href="{{route('user.login')}}" class="btn btn-md btn-theme tra-white-hover">Get Started</a>

											</div>
										</div>
									</div>  <!-- End row -->
								</div>  <!-- End container -->
					        </div>	<!-- End Image Caption -->

					    </li>	<!-- END SLIDE #1 -->


				      	<!-- SLIDE #2 -->
				      	<li id="slide-2">
				        	<!-- Background Image -->
				        	<img src="{{ asset(checkTemplate(true) . 'front/images/slider/guft.jpeg')}}" alt="slide-background">
							<!-- Image Caption -->
	        				<div class="caption d-flex align-items-center center-align">
	        					<div class="container">
		       						<div class="row">
		       							<div class="col-lg-10 offset-lg-1">
		       								<div class="caption-txt white-color">

					        					<!-- Title -->
								         	 	<h2>Giftcard Excahange</h2>

									          	<!-- Text -->
												<p>Convert your digital and physical giftcards to cash seamlessly</p>

												<!-- Button -->
                                                 <a href="{{route('user.login')}}" class="btn btn-md btn-theme tra-white-hover">Get Started</a>


											</div>
				         				</div>
									</div>  <!-- End row -->
								</div>  <!-- End container -->
					        </div>	<!-- End Image Caption -->

				     	</li>	<!-- END SLIDE #2 -->


				     	<!-- SLIDE #3 -->
				      	<li id="slide-3">
				      		<!-- Background Image -->
				        	<img src="{{ asset(checkTemplate(true) . 'front/images/slider/amazon-prime-day-sale_1100041-5291.jpeg')}}" alt="slide-background">
				        	<!-- Image Caption -->
		       			 	<div class="caption d-flex align-items-center center-align">
		       			 		<div class="container">
		       						<div class="row">
		       							<div class="col-lg-10 offset-lg-1">
		       								<div class="caption-txt white-color">

						       			 		<!-- Title -->
								         	 	<h2>Seamless Bills Payment</h2>

				                               	<!-- Text -->
												<p>Seamlessly make payment for all bills</p>

												<!-- Button -->
												<a href="{{route('user.login')}}" class="btn btn-md btn-theme tra-white-hover">Get Started</a>

											</div>
					        			</div>
									</div>  <!-- End row -->
								</div>  <!-- End container -->
					        </div>	<!-- End Image Caption -->

				     	</li>	<!-- END SLIDE #3 -->

				    </ul>
			  	</div>	<!-- END SLIDER -->


			</section>	<!-- END HERO-1 -->

--}}



    <!-- CONTENT-2
       ============================================= -->
    <section id="content-2" class="wide-60 content-section division">
        <div class="container">
            <div class="row d-flex align-items-center">


                <!-- IMAGE BLOCK -->
                <div class="col-md-5 col-lg-6">
                    <div class="img-block left-column mb-40 wow fadeInRight" data-wow-delay="0.6s">
                        <img class="img-fluid" src="{{ asset(checkTemplate(true) . 'front/images/frontapp2.png') }}"
                            alt="content-image">
                    </div>
                </div>


                <!-- TEXT BLOCK -->
                <div class="col-md-7 col-lg-6">
                    <div class="txt-block right-column pc-30 mb-40 wow fadeInLeft" data-wow-delay="0.4s">

                        <!-- Title -->
                        <h3 class="h3-sm">Trade Crypto With Convinience</h3>

                        <!-- List -->
                        <ul class="simple-list grey-color">

                            <li class="list-item">
                                <p class="p-md">Enjoy crypto trade with us either on Btc, Eth, Usdt and a host of other coins at the best rates and fast transaction process with full convinience and confidence anytime, anywhere.
                                </p>
                            </li>

                            <li class="list-item">
                                <p class="p-md">With {{$general->site_name}}, you can trade cryptocurrencies confidently, knowingthat yourtransactions are protected by robust security measures, safeguarding your assests and personal information
                                </p>
                            </li>

                            <li class="list-item">
                                <p class="p-md">Beyond Trading, {{$general->site_name}} offers a range of additional services such as Gift card Trades, Bill Payment, Virtual USD Cards, Savings Plan and a host of other needs that are met in a convenient platform
                                </p>
                            </li>

                        </ul>

                        <!-- Button -->
                        <a href="#content-4" class="btn btn-md btn-tra-grey theme-hover">Best Solutions</a>

                    </div>
                </div> <!-- END TEXT BLOCK -->


            </div> <!-- End row -->
        </div> <!-- End container -->
    </section> <!-- END CONTENT-2 -->




    <!-- FEATURES-3
       ============================================= -->
    <section id="features-3" class="bg-lightgrey wide-60 features-section division">
        <div class="container">


            <!-- SECTION TITLE -->
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="section-title text-center mb-60">

                        <!-- Title -->
                        <h2 class="h2-xs">Why Choose {{ $general->site_name }}</h2>

                        <!-- Text -->
                        <p class="p-xl">Choose {{$general->site_name}} for its comprehensive suite of Diverse services covering eveything, all convenietly accessible in one platform
                        </p>

                    </div>
                </div>
            </div>


            <!-- FEATURES-3 WRAPPER -->
            <div class="fbox-3-wrapper pc-30">
                <div class="row">


                    <!-- FEATURE BOX #1 -->
                    <div class="col-md-6">
                        <div class="fbox-3 pc-25 mb-40 wow fadeInUp" data-wow-delay="0.4s">

                            <!-- Icon -->
                            <div class="fbox-ico grey-color ico-65"><span class="flaticon-piggy-bank"></span></div>

                            <!-- Text -->
                            <div class="fbox-txt">

                                <!-- Title -->
                                <h5 class="h5-xs">Savings Plan</h5>

                                <!-- Text -->
                                <p class="p-md grey-color">Choosing {{$general->site_name}} for a savings plan means more personalized options, competitive interest rates and convinient features, ultimately helping you reach your financial goal efficiently.
                                </p>

                            </div>

                        </div>
                    </div>


                    <!-- FEATURE BOX #2 -->
                    <div class="col-md-6">
                        <div class="fbox-3 pc-25 mb-40 wow fadeInUp" data-wow-delay="0.6s">

                            <!-- Icon -->
                            <div class="fbox-ico grey-color ico-65"><span class="flaticon-wallet"></span></div>

                            <!-- Text -->
                            <div class="fbox-txt">

                                <!-- Title -->
                                <h5 class="h5-xs">Crypto Wallet</h5>

                                <!-- Text -->
                                <p class="p-md grey-color">{{$general->site_name}}'s Crypto Wallet offers secure, user-friendly management for digital assets with multi-currency support, robust security and potential DeFi integration
                                </p>

                            </div>

                        </div>
                    </div>


                    <!-- FEATURE BOX #3 -->
                    <div class="col-md-6">
                        <div class="fbox-3 pc-25 mb-40 wow fadeInUp" data-wow-delay="0.8s">

                            <!-- Icon -->
                            <div class="fbox-ico grey-color ico-65"><span class="flaticon-briefcase"></span></div>

                            <!-- Text -->
                            <div class="fbox-txt">

                                <!-- Title -->
                                <h5 class="h5-xs">All-In-One Portfolio</h5>

                                <!-- Text -->
                                <p class="p-md grey-color">Integrates diverse assest like utility payment, Internet data and airtime, Virtual Card and a host of other features all accesible from one place.
                                </p>

                            </div>

                        </div>
                    </div>


                    <!-- FEATURE BOX #4 -->
                    <div class="col-md-6">
                        <div class="fbox-3 pc-25 mb-40 wow fadeInUp" data-wow-delay="1s">

                            <!-- Icon -->
                            <div class="fbox-ico grey-color ico-65"><span class="flaticon-padlock"></span></div>

                            <!-- Text -->
                            <div class="fbox-txt">

                                <!-- Title -->
                                <h5 class="h5-xs">2FA Security</h5>

                                <!-- Text -->
                                <p class="p-md grey-color">The 2FA protection adds an extra layer of security to accounts
                                </p>

                            </div>

                        </div>
                    </div>


                    <!-- FEATURE BOX #5 -->
                    <div class="col-md-6">
                        <div class="fbox-3 pc-25 mb-40 wow fadeInUp" data-wow-delay="1.2s">

                            <!-- Icon -->
                            <div class="fbox-ico grey-color ico-65"><span class="flaticon-alarm"></span></div>

                            <!-- Text -->
                            <div class="fbox-txt">

                                <!-- Title -->
                                <h5 class="h5-xs">Push Notifications</h5>

                                <!-- Text -->
                                <p class="p-md grey-color">Our Push Notification keeps users informed with real-time updates on transactions,account activity and important alerts for seamless management
                                </p>

                            </div>

                        </div>
                    </div>


                    <!-- FEATURE BOX #6 -->
                    <div class="col-md-6">
                        <div class="fbox-3 pc-25 mb-40 wow fadeInUp" data-wow-delay="1.4s">

                            <!-- Icon -->
                            <div class="fbox-ico grey-color ico-65"><span class="flaticon-keyhole"></span></div>

                            <!-- Text -->
                            <div class="fbox-txt">

                                <!-- Title -->
                                <h5 class="h5-xs">Concrete Security</h5>

                                <!-- Text -->
                                <p class="p-md grey-color">{{$general->site_name}} ensures concrete security measures, safeguarding user data and transactins through encryption,authentication protocols and proactive monitoring for threats
                                </p>

                            </div>

                        </div>
                    </div>


                </div> <!-- End row -->
            </div> <!-- END FEATURES-3 WRAPPER -->


        </div> <!-- End container -->
    </section> <!-- END FEATURES-3 -->




    <!-- CONTENT-4
       ============================================= -->
    <section id="content-4" class="wide-60 content-section division">
        <div class="container">


            <!-- CONTENT BOX-1 -->
            <div id="cb-1-1" class="cbox-1 pb-50">
                <div class="row d-flex align-items-center m-row">


                    <!-- TEXT BLOCK -->
                    <div class="col-md-7 col-lg-6 m-bottom">
                        <div class="txt-block left-column pc-30 mb-40 wow fadeInRight" data-wow-delay="0.6s">

                            <!-- Title -->
                            <h3 class="h3-sm">Bills Payment Needs with {{$general->site_name}}</h3>

                            <!-- Text -->
                            <p class="p-md grey-color">paying all your bill with {{$general->site_name}} is fast as the speed of light!
                            </p>

                            <!-- Text -->
                            <p class="p-md grey-color">It's great to have a platform that centralizes all these tasks, making it easier to manage and stay on top of your bill payment obligations. With everything in one place, you can streamline your bill-paying process and ensure you never miss a payment. Plus, having access to features like electricity bill payment, cable bills, insurance, internet data, and airtime makes it a comprehensive solution for all your needs.
                            </p>

                        </div>
                    </div> <!-- END TEXT BLOCK -->


                    <!-- IMAGE BLOCK -->
                    <div class="col-md-5 col-lg-6 m-top">
                        <div class="img-block right-column mb-40 wow fadeInLeft" data-wow-delay="0.4s">
                            <img class="img-fluid" src="{{ asset(checkTemplate(true) . 'front/images/img-03.png') }}"
                                alt="content-image">
                        </div>
                    </div>


                </div> <!-- End row -->
            </div> <!-- END CONTENT BOX-1 -->


            <!-- CONTENT BOX-2 -->
            <div id="cb-1-2" class="cbox-1">
                <div class="row d-flex align-items-center">


                    <!-- IMAGE BLOCK -->
                    <div class="col-md-5 col-lg-6">
                        <div class="img-block left-column mb-40 wow fadeInRight" data-wow-delay="0.4s">
                            <img class="img-fluid" src="{{ asset(checkTemplate(true) . 'front/images/frontapp3.png') }}"
                                alt="content-image">
                        </div>
                    </div>


                    <!-- TEXT BLOCK -->
                    <div class="col-md-7 col-lg-6">
                        <div class="txt-block right-column pc-30 mb-40 wow fadeInLeft" data-wow-delay="0.6s">

                            <!-- Title -->
                            <h3 class="h3-sm">Keep your favorite people close to you</h3>

                            <!-- List -->
                            <ul class="simple-list grey-color">

                                <li class="list-item">
                                    <p class="p-md"> <strong>Gift Card:</strong>With {{$general->site_name}}'s gift card services, you can easily purchase gift cards for your favorite people,allowing you to treat them to their favorite stores or experiences
                                    </p>
                                </li>

                                <li class="list-item">
                                    <p class="p-md"><strong>Virtual Cards:</strong> {{$general->site_name}}'s Virtual Card feature enambles you to send virtual prepaid cards(USD/NGN) to your loved ones, providing them with a convenient and secure way to make onlibe purchases or manage expenses</p>
                                </li>

                                <li class="list-item">
                                    <p class="p-md"><strong>Savings:</strong> Utilize {{$general->site_name}}'s savings tools to set aside funds for special occasions of future gifts, ensuring that you can always show your appreciation to your favorite people when the time comes
                                    </p>
                                </li>

                            </ul>

                        </div>
                    </div> <!-- END TEXT BLOCK -->


                </div> <!-- End row -->
            </div> <!-- END CONTENT BOX-2 -->


        </div> <!-- End container -->
    </section> <!-- END CONTENT-4 -->




    <!-- STATISTIC-2
       ============================================= -->
    <section id="statistic-2" class="bg-02 wide-60 statistic-section division">
        <div class="container white-color">


            <!-- SECTION TITLE -->
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="section-title text-center mb-60">

                        <!-- Title 	-->
                        <h2 class="h2-xs">Easy and Simple</h2>

                        <!-- Text -->
                        <p class="p-xl">Start trading on {{ $general->site_name }} with these 3 easy steps
                        </p>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-10 col-xl-8 offset-lg-1 offset-xl-2">
                    <div class="row text-center">


                        <!-- STATISTIC BLOCK #1 -->
                        <div class="col-md-4">
                            <div class="statistic-block mb-40 wow fadeInUp" data-wow-delay="0.4s">
                                <h2 class="h2-title-xs statistic-number"><span class="count-element">1</span></h2>
                                <p class="p-md">Sign Up by providing your full name, Phone number, a valid email address and creating a secure password for your account.</p>
                            </div>
                        </div>


                        <!-- STATISTIC BLOCK #2 -->
                        <div class="col-md-4">
                            <div class="statistic-block mb-40 wow fadeInUp" data-wow-delay="0.6s">
                                <h2 class="h2-title-xs statistic-number"><span class="count-element">2</span></h2>
                                <p class="p-md">Complete your KYC verification by uploading the required documents for quick approval.</p>
                            </div>
                        </div>


                        <!-- STATISTIC BLOCK #3 -->
                        <div class="col-md-4">
                            <div class="statistic-block mb-40 wow fadeInUp" data-wow-delay="0.8s">
                                <h2 class="h2-title-xs statistic-number"><span class="count-element">3</span></h2>
                                <p class="p-md">Dive into trading,utilizing the full range of features and services tailored to your prefrences </p>
                            </div>
                        </div>


                    </div>
                </div>
            </div> <!-- End row -->


        </div> <!-- End container -->
    </section> <!-- END STATISTIC-2 -->






    <!-- CONTENT-1
       ============================================= -->
    <section id="content-1" class="wide-60 content-section division">
        <div class="container">
            <div class="row d-flex align-items-center m-row">


                <!-- TEXT BLOCK -->
                <div class="col-md-7 col-lg-6 m-bottom">
                    <div class="txt-block left-column pc-30 mb-40 wow fadeInRight" data-wow-delay="0.4s">

                        <!-- Small Title -->
                        <h5 class="h5-xs sm-title">1. User Data Protection</h5>

                        <!-- Text -->
                        <p class="p-md grey-color">Prioritizing the security of user data, our measures include encryption, access controls, and compliance with industry standards, ensuring privacy and safety.


                        </p>

                        <!-- Small Title -->
                        <h5 class="h5-xs sm-title mt-30">2. DataBase Backup</h5>

                        <!-- Text -->
                        <p class="p-md grey-color">Regular backups of our database are conducted to prevent data loss. Stored securely off-site, they ensure resilience and swift recovery in emergencies.
                        </p>

                        <!-- Small Title -->
                        <h5 class="h5-xs sm-title mt-30">3. Contextual Advertising</h5>

                        <!-- Text -->
                        <p class="p-md grey-color">Tailored to user demographics and interests, our contextual advertising enhances engagement and effectiveness indelivering relevant ads.
                        </p>

                    </div>
                </div> <!-- END ABOUT TEXT -->


                <!-- IMAGE BLOCK -->
                <div class="col-md-5 col-lg-6 m-top">
                    <div class="img-block right-column mb-40 wow fadeInLeft" data-wow-delay="0.6s">
                        <img class="img-fluid" src="{{ asset(checkTemplate(true) . 'front/images/shield1.png') }}"
                            alt="content-image">
                    </div>
                </div>


            </div> <!-- End row -->
        </div> <!-- End container -->
    </section> <!-- END CONTENT-1 -->


    @include(checkTemplate() . 'sections.counter')


    @include(checkTemplate() . 'sections.testimonial')

    @include(checkTemplate() . 'sections.subscribe')



    <!-- DOWNLOAD-1
       ============================================= -->
    <section id="download-1" class="wide-100 bg-fixed download-section division">
        <div class="container">
            <div class="row">


                <!-- DOWNLOAD TXT -->
                <div class="col-md-7 col-lg-6 offset-md-5 offset-lg-6">
                    <div class="download-1-txt">



                        <!-- Title -->
                        <h2 class="h2-md">Reliable and convenient</h2>

                        <!-- Text -->
                        <p class="p-lg">To create reliable and convenient e-payment platform for digital
                            assets and other bill payments using our secured, seamless, cost effective integration models.
                        </p>

                        <!-- STORE BADGES -->
                        <div class="stores-badge">

                            <!-- AppStore -->
                            <a href="#" class="store">
                                <img class="appstore-original"
                                    src="{{ asset(checkTemplate(true) . 'front/images/appstore.png') }}"
                                    alt="appstore-badge" />
                            </a>

                            <!-- Google Play -->
                            <a href="#" class="store">
                                <img class="googleplay-original"
                                    src="{{ asset(checkTemplate(true) . 'front/images/googleplay.png') }}"
                                    alt="googleplay-badge" />
                            </a>

                        </div> <!-- END STORE BADGES -->
                    </div>
                </div> <!-- END DOWNLOAD TXT -->


            </div> <!-- End row -->
        </div> <!-- End container -->
    </section> <!-- END DOWNLOAD-1 -->
@endsection
