@php
    $isDarkMode = request()->is('*pemesanan*') || request()->is('*pembayaran*') || request()->is('*akun*') || request()->is('*jadwal*');
@endphp

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" @if($isDarkMode) style="background: #212529" @endif>
    <div class="container">
{{--        <a href="#page-top" class="logo" style="text-decoration: none; font-size: 25px;"><b>SIPELA <span>WANGAYA</span></b></a>--}}
        <a class="navbar-brandd" href="#page-top"><img src="{{ asset('img/logo.png') }}" width="80px" height="80px"/></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="">Informasi</a></li>
                @unless(!auth('member')->check())
                    <li class="nav-item"><a class="nav-link" href="{{ route('member.pemesanans.index') }}">Pemesanan</a></li>
                @endunless
                @if(!auth('member')->check() && !auth('karyawan')->check())
                    <li class="nav-item"><a class="nav-link" href="{{ route('karyawan.auth.login.index') }}">Login Admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('member.auth.register.index') }}">Register Member</a></li>
                @elseif(auth('member')->check())
                    <li class="nav-item"><a class="nav-link" href="{{ route('member.jadwals.index') }}">Jadwal</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('member.akuns.index') }}">Akun</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
