<?php
/**
 * @var \Illuminate\Support\MessageBag $errors
 */
?>
{{--    <!DOCTYPE html>--}}
{{--<html lang="en">--}}

{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <meta name="description" content="">--}}
{{--    <meta name="author" content="Dashboard">--}}
{{--    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">--}}
{{--    <title>Dashio - Bootstrap Admin Template</title>--}}

{{--    <!-- Favicons -->--}}
{{--    <link href="{{ asset('img/favicon.png') }}" rel="icon">--}}
{{--    <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">--}}

{{--    <!-- Bootstrap core CSS -->--}}
{{--    <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">--}}
{{--    <!--external css-->--}}
{{--    <link href="{{ asset('lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />--}}
{{--    <!-- Custom styles for this template -->--}}
{{--    <link href="{{ asset('css/style.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">--}}
{{--</head>--}}

{{--<body>--}}
{{--<!-- **********************************************************************************************************************************************************--}}
{{--    MAIN CONTENT--}}
{{--    *********************************************************************************************************************************************************** -->--}}
{{--<div id="login-page">--}}
{{--    <div class="container">--}}
{{--        <form class="form-login" action="{{ route('karyawan.auth.login.store') }}" method="post">--}}
{{--            @csrf--}}
{{--            <h2 class="form-login-heading">sign in now</h2>--}}
{{--            @if($errors->any())--}}
{{--                <div class="alert-danger alert" style="margin-top: 20px;">--}}
{{--                    <ul>--}}
{{--                        @foreach($errors->all() as $message)--}}
{{--                            <li>{{ $message }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            <div class="login-wrap">--}}
{{--                <input type="text" value="{{ old('username') }}" name="username" class="form-control" placeholder="User ID" autofocus>--}}
{{--                <br>--}}
{{--                <input type="password" name="password" class="form-control" placeholder="Password">--}}
{{--                <br>--}}
{{--                <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>--}}
{{--            </div>--}}
{{--            <!-- Modal -->--}}
{{--            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">--}}
{{--                <div class="modal-dialog">--}}
{{--                    <div class="modal-content">--}}
{{--                        <div class="modal-header">--}}
{{--                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
{{--                            <h4 class="modal-title">Forgot Password ?</h4>--}}
{{--                        </div>--}}
{{--                        <div class="modal-body">--}}
{{--                            <p>Enter your e-mail address below to reset your password.</p>--}}
{{--                            <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">--}}
{{--                        </div>--}}
{{--                        <div class="modal-footer">--}}
{{--                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>--}}
{{--                            <button class="btn btn-theme" type="button">Submit</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- modal -->--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- js placed at the end of the document so the pages load faster -->--}}
{{--<script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>--}}
{{--<script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>--}}
{{--<!--BACKSTRETCH-->--}}
{{--<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->--}}
{{--<script type="text/javascript" src="{{ asset('lib/jquery.backstretch.min.js') }}"></script>--}}
{{--<script>--}}
{{--    $.backstretch("img/login-bg.jpg", {--}}
{{--        speed: 500--}}
{{--    });--}}
{{--</script>--}}
{{--</body>--}}

{{--</html>--}}

<!doctype html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('login/css/style.css') }}">

</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <div class="icon d-flex align-items-center justify-content-center">
{{--                        <span class="fa fa-user-o"></span>--}}
                        <img src="{{ asset('img/logo.png') }}" width="100px" height="100px"/>
                    </div>
                    <h3 class="text-center mb-4">LOGIN SIPELA</h3>
                    @if($errors->any())
                        <div class="alert-danger alert" style="margin-top: 20px;">
                            <ul>
                                @foreach($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('karyawan.auth.login.store') }}" method="post" class="login-form">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="username" class="form-control rounded-left" placeholder="Username" required>
                        </div>
                        <div class="form-group d-flex">
                            <input type="password" name="password" class="form-control rounded-left" placeholder="Password" required>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50">
                                <label class="checkbox-wrap checkbox-primary">Remember Me
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary rounded submit p-3 px-5">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('login/js/jquery.min.js') }}"></script>
<script src="{{ asset('login/js/popper.js') }}"></script>
<script src="{{ asset('login/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('login/js/main.js') }}"></script>

</body>
</html>

