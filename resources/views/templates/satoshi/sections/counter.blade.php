@php
    $counterContent = getContent('counter.content', true);
    $counterElements = getContent('counter.element', null, false, true);
@endphp
<!-- ============================ Our Counters Start ================================== -->
<!-- STATISTIC-4
			============================================= -->
			<section id="statistic-4" class="bg-09 statistic-section division">
				<div class="container white-color">
					<div class="row">

                        @forelse($counterElements as $item)
						<!-- STATISTIC BLOCK #1 -->
						<div class="col-sm-6 col-md-3">						
							<div class="statistic-block text-center mb-40 wow fadeInUp" data-wow-delay="0.4s">	

								<!-- Icon  -->
								<div class="statistic-ico ico-60"><span class="flaticon-browser">
                                    @php echo @$item->data_values->icon @endphp    
                                </span></div> 

								<!-- Text -->
								<h3 class="h3-xs statistic-number"><span class="count-element">{{ @$item->data_values->number }}</span></h3>
								<p class="p-md txt-400">{{ @$item->data_values->title }}</p>		

							</div>						
						</div>
                        @empty
                        {!!emptyData!!}
                        @endforelse  

						 
					</div>    <!-- End row -->
				</div>	   <!-- End container -->		
			</section>	<!-- END STATISTIC-4 -->



 