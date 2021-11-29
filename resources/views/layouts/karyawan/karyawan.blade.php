<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    @include('layouts.karyawan.style')
</head>
<body>
<section id="container">
    @include('layouts.karyawan.header')
    @include('layouts.karyawan.sidebar')

    <section id="main-content">
        <section class="wrapper">
            @yield('content')
        </section>
    </section>

    @include('layouts.karyawan.footer')
    @include('layouts.karyawan.script')

    @yield('script', '')
</section>
</body>
</html>
