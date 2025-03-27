@extends(checkTemplate() . 'layouts.frontend')
@section('content')
  <!--Contents-->
  @include(checkTemplate() . 'partials.breadcrumb')

  <main class="blog-page style-5">


<section class="faq section-padding style-4 pt-50 mt-5">
    <div class="container">
            <div class="news-area">
                <div class="row justify-content-center ml-b-30">
                    <div class="col-lg-12 mrb-30">
                        <div class="news-item">
                            <div class="news-content news-details-content">

                                @php
                                    echo $policy->data_values->content;
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- news-section end -->
</main>
@endsection

