<html>
<head>
    <meta charset="utf-8">
    <title>RegistrationForm_v1 by Colorlib</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="{{ asset('mem/login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="{{ asset('mem/login_v1/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="{{ asset('mem/login_v1/css/style.css') }}">
</head>

<body>

<div class="wrapper" style="background-image: url('{{ asset("mem/login_v1/images/bg-registration-form-1.jpg") }}');">
    <div class="inner">
        <form method="post" action="{{ route('member.auth.register.store') }}" class="col-12">
            <h3>Registration Form</h3>
            @if($errors->any())
                <div class="alert-danger alert" style="margin-top: 20px;">
                    <ul>
                        @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            <div class="form-wrapper">
                <input value="{{ old('name') }}" name="name" type="text" placeholder="Name" class="form-control">
            </div>
            <div class="form-wrapper">
                <input value="{{ old('email') }}" name="email" type="text" placeholder="Email" class="form-control">
                <i class="zmdi zmdi-email"></i>
            </div>
            <div class="form-wrapper">
                <input value="{{ old('password') }}" name="password" type="password" placeholder="Password" class="form-control">
                <i class="zmdi zmdi-lock"></i>
            </div>
            <div class="form-wrapper">
                <input value="{{ old('confirm_password') }}" name="confirm_password" type="password" placeholder="Confirm Password" class="form-control">
                <i class="zmdi zmdi-lock"></i>
            </div>
            <div class="form-wrapper">
                <input value="{{ old('phone') }}" name="phone" type="text" placeholder="No Telp" class="form-control">
                <i class="zmdi zmdi-phone"></i>
            </div>
            <div class="form-wrapper">
                <textarea name="address" id="" cols="30" rows="60" class="form-control" placeholder="Address" style="height: 100px;">{{ old('address') }}</textarea>
            </div>
            <button type="submit">Register
                <i class="zmdi zmdi-arrow-right"></i>
            </button>
        </form>
    </div>
</div>

</body>
</html>
