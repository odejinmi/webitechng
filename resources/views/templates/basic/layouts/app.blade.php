@extends($activeTemplate . 'layouts.master')

@section('content')
    <!-- Theme Change Modal -->
    <div class="modal fade" id="themeModal" tabindex="-1" aria-labelledby="themeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="themeModalLabel">New Theme Available</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    A new theme has been introduced! Would you like to switch to the new theme now?
                    You can always change back to the old theme from your profile settings.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="setTheme('basic')" data-bs-dismiss="modal">Keep Old Theme</button>
                    <button type="button" class="btn btn-primary" onclick="setTheme('satoshi')" data-bs-dismiss="modal">Switch to New Theme</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Form for Theme Submission -->
    <form id="themeForm" action="{{ route('user.profile.setting') }}" method="POST">
        @csrf
        <input type="hidden" name="theme" id="themeInput">
    </form>

    <!-- page-wrapper start -->
    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme"  data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        @include($activeTemplate . 'partials.sidenav')
        @include($activeTemplate . 'partials.topnav')
        @yield('panel')
    </div>

    <!-- Theme Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const savedTheme = localStorage.getItem("userTheme");

            // if (!savedTheme) {
                // Show modal if user has not chosen a theme before
                var themeModal = new bootstrap.Modal(document.getElementById("themeModal"));
                themeModal.show();
            // }
        });

        function setTheme(theme) {
            localStorage.setItem("userTheme", theme);
            // Submit the theme to the backend
            document.getElementById("themeInput").value = theme;
            document.getElementById("themeForm").submit();
        }
    </script>
@endsection
