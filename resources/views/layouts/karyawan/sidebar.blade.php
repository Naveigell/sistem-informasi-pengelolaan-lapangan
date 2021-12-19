<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <li class="mt">
                <a href="{{ route('karyawan.dashboard.index') }}" class="{{ request()->is('*dashboard*') ? 'active' : '' }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('karyawan.members.index') }}" class="{{ request()->is('*members*') ? 'active' : '' }}">
                    <i class="fa fa-user"></i>
                    <span>Member</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('karyawan.lapangans.index') }}" class="{{ request()->is('*lapangans*') ? 'active' : '' }}">
                    <i class="fa fa-bullseye"></i>
                    <span>Lapangan</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('karyawan.jadwals.index') }}" class="{{ request()->is('*jadwal*') ? 'active' : '' }}">
                    <i class="fa fa-calendar-check-o"></i>
                    <span>Penyewaan</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('karyawan.kas.index') }}" class="{{ request()->is('*kas*') ? 'active' : '' }}">
                    <i class="fa fa-money"></i>
                    <span>Kas</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('karyawan.pemesanans.index') }}" class="{{ request()->is('*pemesanan*') ? 'active' : '' }}">
                    <i class="fa fa-motorcycle"></i>
                    <span>Pemesanan</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('karyawan.pembayarans.index') }}" class="{{ request()->is('*pembayaran*') ? 'active' : '' }}">
                    <i class="fa fa-credit-card"></i>
                    <span>Pembayaran</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('karyawan.laporans.index') }}" class="{{ request()->is('*laporan*') ? 'active' : '' }}">
                    <i class="fa fa-print"></i>
                    <span>Laporan</span>
                </a>
            </li>
{{--            <p class="centered">--}}
{{--                <a href="{{ route('admin.dashboard.index') }}">--}}
{{--                    <i class="fa fa-user" style="color: white; font-size: 60px;"></i>--}}
{{--                </a>--}}
{{--            </p>--}}
{{--            <h5 class="centered">{{ auth('pengguna')->user()->nama_pengguna }}</h5>--}}
{{--            <li class="mt">--}}
{{--                <a href="{{ route('admin.dashboard.index') }}" class="{{ request()->is('*dashboard*') ? 'active' : '' }}">--}}
{{--                    <i class="fa fa-dashboard"></i>--}}
{{--                    <span>Dashboard</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            @if(auth('pengguna')->user()->jabatan === 'staff')--}}
{{--                <li class="">--}}
{{--                    <a href="{{ route('admin.member.index') }}" class="{{ request()->is('*member*') ? 'active' : '' }}">--}}
{{--                        <i class="fa fa-user"></i>--}}
{{--                        <span>Member</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="">--}}
{{--                    <a href="{{ route('admin.jadwal.index') }}" class="{{ request()->is('*jadwal*') ? 'active' : '' }}">--}}
{{--                        <i class="fa fa-calendar"></i>--}}
{{--                        <span>Jadwal</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="">--}}
{{--                    <a href="{{ route('admin.lapangan.index') }}" class="{{ request()->is('*lapangan*') ? 'active' : '' }}">--}}
{{--                        <i class="fa fa-bullseye"></i>--}}
{{--                        <span>Lapangan</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="">--}}
{{--                    <a href="{{ route('admin.transaksi.index') }}" class="{{ request()->is('*transaksi*') ? 'active' : '' }}">--}}
{{--                        <i class="fa fa-credit-card"></i>--}}
{{--                        <span>Transaksi</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--            <li class="">--}}
{{--                <a href="{{ route('admin.kas.index') }}" class="{{ request()->is('*kas*') ? 'active' : '' }}">--}}
{{--                    <i class="fa fa-money"></i>--}}
{{--                    <span>Keuangan</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="">--}}
{{--                <a href="{{ route('admin.laporan.index') }}" class="{{ request()->is('*laporan*') ? 'active' : '' }}">--}}
{{--                    <i class="fa fa-print"></i>--}}
{{--                    <span>Laporan</span>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
