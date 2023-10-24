<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Admin | Login</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- BEGIN core-css -->
    <link href="{{ asset('templates/login/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('templates/login/css/google/app.min.css') }}" rel="stylesheet" />
    <!-- END core-css -->
</head>
<body class="pace-top">
    <!-- BEGIN #loader -->
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>
    <!-- END #loader -->

    <!-- BEGIN #app -->
    <div id="app" class="app">
        <!-- BEGIN login -->
        <div class="login login-v1">
            <!-- BEGIN login-container -->
            <div class="login-container">
                <!-- BEGIN login-header -->
                <div class="login-header">
                    <div class="brand">
                        <div>
                            <span class="logo"></span>
                            <b class="me-1">ProWorks</b> Admin
                        </div>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-lock fa-2xl"></i>
                    </div>
                </div>
                <!-- END login-header -->

                <!-- BEGIN login-body -->
                <div class="login-body">
                    <!-- BEGIN login-content -->
                    <div class="login-content fs-13px">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating mb-20px">
                                <input type="email" class="form-control fs-13px h-45px" name="ws_user_email" placeholder="Email Address" required />
                                <label for="ws_user_email" class="d-flex align-items-center">Email Address</label>
                            </div>
                            <div class="form-floating mb-20px">
                                <input type="password" class="form-control fs-13px h-45px" name="ws_user_password" placeholder="Password" required />
                                <label for="ws_user_password" class="d-flex align-items-center">Password</label>
                            </div>
                            <div class="login-buttons">
                                <button type="submit" class="btn btn-theme h-45px d-block w-100 btn-lg">Sign me in</button>
                            </div>
                        </form>
                        @error('ws_user_email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- END login-content -->
                </div>
                <!-- END login-body -->
            </div>
            <!-- END login-container -->
        </div>
        <!-- END login -->

        <!-- BEGIN scroll-top-btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-theme btn-scroll-to-top" data-toggle="scroll-to-top">
            <i class="fa fa-angle-up"></i>
        </a>
        <!-- END scroll-top-btn -->
    </div>
    <!-- END #app -->

    <!-- BEGIN core-js -->
    <script src="{{ asset('templates/login/js/vendor.min.js') }}"></script>
    <script src="{{ asset('templates/login/js/app.min.js') }}"></script>
    <!-- END core-js -->
</body>
</html>
