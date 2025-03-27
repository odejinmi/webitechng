    @extends($activeTemplate . 'layouts.frontend')
    @section('content')

    @include($activeTemplate . 'partials.breadcrumb')
    <!-- ====== start contact ====== -->
    @php
    $contactContent = getContent('contact.content', true);
    $addressContent = getContent('address.content', true);
    $user = auth()->user();
    @endphp 

			<!-- PAGE
			============================================= -->
			<section id="contacts-3" class="bg-lightgrey wide-60 contacts-section division">				
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1">
							<div class="section-title text-center mb-60">		

								<!-- Title 	-->	
								<h2 class="h2-xs">{{$pageTitle}}</h2>	 
									
							</div>	
						</div>
					</div>


				 	<div class="row">


                    PAGE CONTENT GOES HERE				 		 

					</div>	<!-- End row -->


				</div>	   <!-- End container -->		
			</section>	<!-- END CONTACTS-3 -->


            
    @endsection
