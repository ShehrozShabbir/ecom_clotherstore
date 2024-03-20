<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Esparta</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{url('admin/modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('admin/modules/fontawesome/css/all.min.css')}}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{url('admin/modules/bootstrap-social/bootstrap-social.css')}}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{url('admin/css/style.css')}}">
    <link rel="stylesheet" href="{{url('admin/css/components.css')}}">
    <!-- Start GA -->
    <style type="text/css">
        .btn-primary {
            background: #024270;
        }
    </style>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="{{url('logo/ESPARTA.png')}}" alt="logo" width="190" class="">
                        </div>
                        <div class="card card-primary">
                            <div class="card-body">
                                <form method="POST" action="{{ route('loginPost') }}" class="needs-validation"
                                    novalidate="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="text" class="form-control" name="email"
                                            tabindex="1" required autofocus placeholder="Enter your Email">
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <div class="float-right">
                                                <a href="auth-forgot-password.html" class="text-small d-none">
                                                    Forgot Password?
                                                </a>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input type="password" class="form-control" tabindex="2" id="password"
                                                name="password" placeholder="Enter your password">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" id="togglePassword"></i>
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input"
                                                tabindex="3" id="remember-me">
                                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>

                                    </div>



                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('partials.admin.footer')
    <script>
        $(document).ready(function() {
            $('#togglePassword').on('click', function() {
                const passwordField = $('#password');
                const passwordFieldType = passwordField.attr('type');
                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                } else {
                    passwordField.attr('type', 'password');
                }
            });
        });
    </script>
</body>

</html>
