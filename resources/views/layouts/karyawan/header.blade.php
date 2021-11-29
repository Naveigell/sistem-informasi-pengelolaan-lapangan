<?php
/**
 * @var object $notifications
 */
?>
<header class="header black-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
    <a href="index.html" class="logo"><b>DASH<span>IO</span></b></a>
    <!--logo end-->
    <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
            <!-- inbox dropdown end -->
            <!-- notification dropdown start-->
{{--            @if(auth('pengguna')->user()->jabatan === 'staff')--}}
{{--                <li id="header_notification_bar" class="dropdown">--}}
{{--                    <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">--}}
{{--                        <i class="fa fa-bell-o"></i>--}}
{{--                        @if($notifications['total'] > 0)--}}
{{--                            <span class="badge bg-warning">{{ $notifications['total'] }}</span>--}}
{{--                        @endif--}}
{{--                    </a>--}}
{{--                    <ul class="dropdown-menu extended notification">--}}
{{--                        <div class="notify-arrow notify-arrow-yellow"></div>--}}
{{--                        @if($notifications['total'] > 0)--}}
{{--                            <li>--}}
{{--                                <p class="yellow">You have {{ $notifications['total'] }} new notifications</p>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                        @foreach($notifications['data'] as $notification)--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('admin.notification.index', $notification) }}">--}}
{{--                                    <span class="label label-success"><i class="fa fa-plus"></i></span> &nbsp;--}}
{{--                                    <b>{{ $notification->data["no_transaksi"] }}</b> Booking baru--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                        @unless($notifications['total'] > 0)--}}
{{--                            <li>--}}
{{--                                <a>--}}
{{--                                    You dont have notification--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @else--}}
{{--                            <li>--}}
{{--                                <a href="index.html#">See all notifications</a>--}}
{{--                            </li>--}}
{{--                        @endunless--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endif--}}
            <!-- notification dropdown end -->
        </ul>
        <!--  notification end -->
    </div>
    <div class="top-menu">
        <ul class="nav pull-right top-menu">
            <li><a class="logout" href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </div>
</header>
