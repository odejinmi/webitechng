@extends(checkTemplate() . 'layouts.frontend')
@section('content')

@include(checkTemplate() . 'partials.breadcrumb')

<!-- Start Career Section -->
<section id="career" class="bg-lightgrey wide-60 contacts-section division">
    <div class="container">
        <!-- SECTION TITLE -->
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="section-title text-center mb-60">
                    <!-- Title 	-->
                    <h2 class="h2-xs">Careers at LtechNG</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Job Openings -->
            <div class="col-md-8 offset-md-2">
                <div class="job-openings">
                    <h3 class="text-center mb-4">Current Job Openings</h3>
                    <ul class="job-list">
                        <li>
                            <h4>Senior Software Engineer</h4>
                            <p>We are seeking an experienced Senior Software Engineer to join our team...</p>
                            <a href="#" class="btn btn-primary btn-lg">Apply Now</a>
                        </li>
                        <li>
                            <h4>UX/UI Designer</h4>
                            <p>We are looking for a talented UX/UI Designer to create amazing user experiences...</p>
                            <a href="#" class="btn btn-primary btn-lg">Apply Now</a>
                        </li>
                        <!-- Add more job openings as needed -->
                    </ul>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <h3 class="text-center mb-4">Why Work With Us?</h3>
                <ul class="reasons-list">
                    <li>Competitive salary and benefits package</li>
                    <li>Opportunity for career growth and development</li>
                    <li>Innovative and collaborative work environment</li>
                    <li>Exciting projects and challenges</li>
                </ul>
            </div>
        </div>
    </div> <!-- End container -->
</section> <!-- END Career Section -->

@endsection
