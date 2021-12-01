<?php
/**
 * @var \App\Models\Lapangan $field
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Agency - Start Bootstrap Theme</title>
    @include('layouts.member.style')
</head>
<body id="page-top">
<!-- Navigation-->
@include('layouts.member.header')
@yield('content')
@include('layouts.member.script')
@yield('script', '')
</body>
</html>
