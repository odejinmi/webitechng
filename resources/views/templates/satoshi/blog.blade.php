@extends(checkTemplate() . 'layouts.frontend')
@section('content')
<!-- ============================= Classic Blog Start ================================== -->
@include(checkTemplate() . 'partials.breadcrumb')
<section id="blog-listing-1" class="wide-60 blog-page-section division">
  <div class="container">
    <div class="row">


      <!-- BLOG POSTS WRAPPER -->
       <div class="col-lg-9">
         <div class="posts-wrapper pr-25">

          @forelse($blogElements as $item)
           <!-- BLOG POST #1 -->
           <div class="blog-post b-bottom mb-40">
             <div class="row d-flex align-items-center">


              <!-- BLOG POST IMAGE -->
              <div class="col-md-5">
                <div class="blog-post-img">
                  <img class="img-fluid" src="{{ getImage('assets/images/frontend/blog/thumb_' . @$item->data_values->image, '480x280') }}" alt="blog-post-image">
                </div>
              </div>


              <!-- BLOG POST TEXT -->
              <div class="col-md-7">
                <div class="blog-post-txt">

                  <!-- Post Tag -->
                  <p class="post-tag txt-upcase"><a href="{{ route('blog.details', [$item->id, slug($item->data_values->title)]) }}" class="theme-color">In Blog</a> - 1 min read</p>

                  <!-- Post Link -->
                  <h5 class="h5-md">
                    <a href="{{ route('blog.details', [$item->id, slug($item->data_values->title)]) }}">{{$item->data_values->title}}</a>
                  </h5>

                  <!-- Post Text -->
                  <p class="p-md grey-color"></p>

                  <!-- Author Data -->
                  <div class="post-author">
                    <span>{{diffForHumans($item->created_at)}}</span>
                    <span>By {{$general->site_name}}</span>
                  </div>

                </div>
              </div>	<!-- END BLOG POST TEXT -->


            </div>
          </div>	<!-- END BLOG POST #1 -->

          @empty
          <div class="col-lg-4 col-md-6 col-sm-12 mrb-30">
              {{ alert('danger',$emptyMessage) }}
          </div>
          @endforelse
          <!-- BLOG POST #2 -->


         </div>
       </div>	<!-- END BLOG POSTS WRAPPER -->

    </div>    <!-- End row -->
  </div>     <!-- End container -->
</section>	<!-- END BLOG POSTS LISTING-1 -->



<!-- PAGE PAGINATION
  @if ($blogElements->hasPages())
============================================= -->
<div class="page-pagination division">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <nav aria-label="Page navigation">
          <ul class="pagination ico-20 justify-content-center">
            {{ paginateLinks($blogElements) }}
          </ul>
        </nav>

      </div>
    </div>  <!-- End row -->
  </div> <!-- End container -->
</div>	<!-- END PAGE PAGINATION -->
@endif
@endsection
