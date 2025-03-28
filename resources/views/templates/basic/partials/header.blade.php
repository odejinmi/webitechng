<!-- HEADER
   ============================================= -->
<header id="header" class="header tra-menu navbar-dark">
    <div class="header-wrapper">


        <!-- MOBILE HEADER -->
        <div class="wsmobileheader clearfix">
            <span class="smllogo"><img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}"
                    alt="mobile-logo" /></span>
            <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
        </div>


        <!-- NAVIGATION MENU -->
        <div class="wsmainfull menu clearfix">
            <div class="wsmainwp clearfix">


                <!-- HEADER LOGO -->
                <div class="desktoplogo"><a href="{{ url('/') }}" class="logo-black"><img
                            src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="header-logo"></a></div>
                <div class="desktoplogo"><a href="{{ url('/') }}" class="logo-white"><img
                            src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="header-logo"></a></div>


                <!-- MAIN MENU -->
                <nav class="wsmenu clearfix">
                    <ul class="wsmenu-list nav-theme-hover">


                        <!-- DROPDOWN MENU -->
                        <li aria-haspopup="true" class="text-primary"><a style="color:black;"
                                href="{{ route('home') }}">Home </a>

                        </li>



                        <!-- DROPDOWN MENU -->
                        <li aria-haspopup="true"><a style="color:black;" href="#">Company <span
                                    class="wsarrow"></span></a>
                            <ul class="sub-menu">
                                <li>
                                    <a style="color:black;" href="{{ route('page', 'assets') }}">Coin Trading</a>
                                </li>
                                <li>
                                    <a style="color:black;" href="{{ route('page', 'bills') }}">Bills Payment</a>
                                </li>
                                @php
                                    $pages = App\Models\Page::where('tempname', $activeTemplate)
                                        ->where('is_default', 0)
                                        ->get();
                                    //$pages = getContent('pages.element', null, false, true);
                                @endphp
                                @foreach ($pages as $k => $data)
                                    <li>
                                        <a style="color:black;"
                                            href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}</a>
                                    </li>
                                @endforeach



                            </ul>
                        </li>


                        <li aria-haspopup="true" class="text-primary"><a style="color:black;"
                            href="{{ route('blog') }}">Blog </a>

                        </li>
                        <li aria-haspopup="true">
                            <a style="color:black;" href="{{ route('contact') }}">@lang('Contact')</a>
                        </li>

                        <!-- SIMPLE NAVIGATION LINK -->
                        <li class="nl-simple" aria-haspopup="true"><a style="color:black;"
                                href="{{ route('rates') }}">Rates</a></li>




                        <!-- HEADER CALL BUTTON
       <li class="nl-simple header-phone ico-25" aria-haspopup="true">
       <a href="tel:123456789">
       <span class="flaticon-phone-call bg-white theme-color"></span>+12 9 8765 4321
       </a>
       </li> -->

                        @auth
                            <li aria-haspopup="true"><a style="color:black;" href="#">Account <span
                                        class="wsarrow"></span></a>
                                <ul class="sub-menu">
                                    <li>
                                        <a style="color:black;" href="{{ route('user.home') }}">Dashboard</a>
                                    </li>
                                    <li>
                                        <a style="color:black;" href="{{ route('user.logout') }}">Logout</a>
                                    </li>

                                </ul>
                            </li>
                        @else
                            <li aria-haspopup="true"><a style="color:black;" href="#">Login/Register<span
                                        class="wsarrow"></span></a>
                                <ul class="sub-menu">
                                    <li>
                                        <a style="color:black;" href="{{ route('user.home') }}">Login</a>
                                    </li>
                                    <li>
                                        <a style="color:black;" href="{{ route('user.register') }}">Register</a>
                                    </li>

                                </ul>
                            </li>
                            @endif



                            <li class="nl-simple white-color header-socials ico-20 clearfix" aria-haspopup="true">
                                <span><a href="https://www.facebook.com/LTechNG" class="ico-facebook"><span
                                            class="flaticon-facebook"></span></a></span>
                                <span><a href="https://x.com/LTechNG_?t=2Bed2mxW3uU0AClJM6-RKw&s=09" class="ico-twitter"><span
                                            class="flaticon-twitter"></span></a></span>
                                <span><a href="https://www.instagram.com/ltechng.co?igsh=MXVhZjVnbGdqbDY0cQ==" class="ico-instagram"><span
                                            class="flaticon-instagram"></span></a></span>
                                <span><a href="#" class="ico-dribbble"><span
                                            class="flaticon-dribbble"></span></a></span>
                            </li>


                        </ul>
                    </nav> <!-- END MAIN MENU -->


                </div>
            </div> <!-- END NAVIGATION MENU -->


        </div> <!-- End header-wrapper -->
    </header> <!-- END HEADER -->
