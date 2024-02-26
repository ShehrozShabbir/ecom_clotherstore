<!DOCTYPE html>
<html>
    @include('partials.admin.head') @stack('css')
    <style type="text/css">
        #laravel-notify .notify {
            z-index: +9999999999 !important;
        }

        .alert.alert-success {
            position: fixed;
            top: 20px; /* Adjust the top position as needed */
            right: 20px; /* Adjust the right position as needed */
            z-index: 1000;
            padding: 10px 20px;
            background-color: #63ed7a; /* Success message color */
            color: #fff;
            border-radius: 5px;
            font-size: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px; /* Adjust the max-width as per your preference */
            width: 100%;
        }

        .flash-message.error {
            background-color: #dc3545; /* Error message color */
        }
    </style>

    <body>
        <div id="app">
            <div class="main-wrapper main-wrapper-1">
                <div class="navbar-bg"></div>
                @include('partials.admin.header')

                <div class="main-sidebar sidebar-style-2">
                    @include('partials.admin.aside')
                </div>

                <!-- Main Content -->
                <div class="main-content">
                    @yield('content')

                </div>
            </div>
        </div>

        <!-- General JS Scripts -->
        @include('partials.admin.footer')

    </body>
</html>
@stack('js')
<script>
    // Automatically close flashy messages after 10 seconds
    $(document).ready(function () {
        setTimeout(function () {
            $(".flash-message").fadeOut("slow");
        }, 10000); // 10 seconds
    });
</script>
