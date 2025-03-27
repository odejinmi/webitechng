@extends(checkTemplate() . 'layouts.frontend')
@section('content')

@include(checkTemplate() . 'partials.breadcrumb')

<!-- ====== Product Update Section ====== -->
<section id="product-update" class="bg-lightgrey wide-60 section-padding">
    <div class="container">
        <!-- SECTION TITLE -->
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="section-title text-center mb-60">
                    <!-- Title -->
                    <h2 class="h2-xs">Product Update</h2>
                </div>
            </div>
        </div>

        <!-- PRODUCT UPDATE CONTENT -->
        <div class="row">
            <div class="col-lg-6">
                <img src="https://ltechng.co/assets/templates/basic/front/images/frontapp.png" alt="Mobile Phone" class="img-fluid">
            </div>
            <div class="col-lg-6">
                <div class="countdown-timer-container text-center mb-4">
                    <div id="countdown" class="countdown-timer"></div>
                    <p class="countdown-notification">The LTechNG Pay app will be available on the Apple App store soon</p>
                </div>
                <div class="app-stores text-center mt-4">
                    <a href="#" class="google-play">
                        <img src="https://ltechng.co/assets/templates/basic/front/images/appstore.png" alt="Apple Pay Store">
                    </a>
                    <a href="https://play.google.com/store/apps/details?id=com.ltechng" class="app-store">
                        <img src="https://ltechng.co/assets/templates/basic/front/images/googleplay.png" alt="Google Play Store">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END Product Update Section -->

@endsection

@push('style')
<style>
    .countdown-timer-container {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .countdown-timer {
        font-size: 40px;
        color: #ff6c00;
        font-weight: bold;
    }

    .countdown-notification {
        font-size: 18px;
        color: #333;
        margin-top: 10px;
    }

    .countdown-notification a {
        color: #ff6c00;
        text-decoration: none;
    }

    .countdown-notification a:hover {
        text-decoration: underline;
    }

    .app-stores a {
        display: inline-block;
        margin-top: 20px;
    }

    .app-stores img {
        width: 150px;
    }
</style>
@endpush

@push('script')
<script>
    // Set the date we're counting down to
    var countDownDate = new Date("September 29, 2024 00:00:00").getTime();

    // Update the countdown every 1 second
    var x = setInterval(function() {

        // Get the current date and time
        var now = new Date().getTime();

        // Calculate the remaining time
        var distance = countDownDate - now;

        // Calculate days, hours, minutes, and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the countdown timer
        document.getElementById("countdown").innerHTML = days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";

        // If the countdown is over, display a message
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>
@endpush
