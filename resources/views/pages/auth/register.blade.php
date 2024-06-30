<!DOCTYPE html>
<html lang="en">

<head>

    <title>Login | Notaris</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">




</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
    <div class="auth-content text-center">
        <img src="assets/images/logo.png" alt="" class="img-fluid mb-4">
        <!DOCTYPE html>
        <html lang="en">

        <head>

            <title>Flat Able - Premium Admin Template by Phoenixcoded</title>
            <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 11]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                <![endif]-->
            <!-- Meta -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="description" content="" />
            <meta name="keywords" content="">
            <meta name="author" content="Phoenixcoded" />
            <!-- Favicon icon -->
            <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

            <!-- vendor css -->
            <link rel="stylesheet" href="assets/css/style.css">




        </head>
        <style>
            .auth-wrapper {
                background-image: url("/assets/images/login-background.jpg");
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
            }
        </style>

        <!-- [ auth-signup ] start -->
        <div class="auth-wrapper">
            <div class="auth-content text-center">
                <img src="assets/images/logo.png" alt="" class="img-fluid mb-4">
                <div class="card borderless">
                    <div class="row align-items-center text-center">
                        <div class="col-md-12">
                            <div class="card-body">
                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                                <h4 class="f-w-400">Sign up</h4>
                                <hr>
                                <form action="{{ route('register.post') }}" method="POST" id="myForm">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="nama" placeholder="nama"
                                            name="nama">
                                        @error('nama')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="Username" placeholder="Username"
                                            name="username">
                                        @error('username')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="Email" name="email"
                                            placeholder="Email address">
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="password" class="form-control" id="Password"
                                            placeholder="Password" name="password">
                                        @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>
                                    <hr>
                                    <p class="mb-2">Already have an account? <a href="{{ route('login') }}"
                                            class="f-w-400">Signin</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ auth-signup ] end -->

        <!-- Required Js -->
        <script src="assets/js/vendor-all.min.js"></script>
        <script src="assets/js/plugins/bootstrap.min.js"></script>

        <script src="assets/js/pcoded.min.js"></script>



        </body>

        </html>

        <div class="card borderless">
            <div class="row align-items-center ">
                <div class="col-md-12">
                    <div class="card-body">
                        <h4 class="mb-3 f-w-400">Signin</h4>
                        <hr>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="Email" placeholder="Email address">
                        </div>
                        <div class="form-group mb-4">
                            <input type="password" class="form-control" id="Password" placeholder="Password">
                        </div>
                        <div class="custom-control custom-checkbox text-left mb-4 mt-2">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Save credentials.</label>
                        </div>
                        <button class="btn btn-block btn-primary mb-4">Signin</button>
                        <hr>
                        <p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html"
                                class="f-w-400">Reset</a></p>
                        <p class="mb-0 text-muted">Don’t have an account? <a href="auth-signup.html"
                                class="f-w-400">Signup</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/js/pcoded.min.js') }}"></script>



</body>

</html>
