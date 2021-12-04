@extends('layouts.karyawan.karyawan')

@section('content')
    <div style="margin: 20px; padding: 10px;">
        <h3><i class="fa fa-angle-right"></i> Jadwal Sewa Lapangan</h3>
        <div class="row mb">
            <div class="content-panel" style="padding: 20px 20px 60px 20px;">
{{--                <form action="{{ route('karyawan.jadwals.index') }}">--}}
{{--                    <div class="row">--}}
{{--                        <div class="form-group col-lg-3">--}}
{{--                            <label for="">Dari : </label>--}}
{{--                            <input type="date" class="form-control" name="from" value="{{ request()->get('from') }}">--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-lg-3">--}}
{{--                            <label for="">Sampai : </label>--}}
{{--                            <input type="date" class="form-control" name="to" value="{{ request()->get('to') }}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <button class="btn btn-info btn-sm">Filter</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--                <br>--}}
{{--                <br>--}}
{{--                <br>--}}
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                        <thead>
                        <tr>
                            <th class="hidden-phone">No</th>
                            <th class="hidden-phone">Nama lapangan</th>
                            <th class="hidden-phone">Tanggal Sewa</th>
                            <th class="hidden-phone">Jam mulai</th>
                            <th class="hidden-phone">Jam selesai</th>
                            <th class="hidden-phone">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $no = 0;
                        @endphp
                        @forelse($pemesanans as $pemesanan)
                            @foreach($pemesanan->sesiPemesanan as $sesiPemesanan)
                                <tr class="gradeX">
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $sesiPemesanan->sesi->lapangan->nama_lapangan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal_sewa)->format('d F Y') }}</td>
                                    <td>{{ $pemesanan->jenis_sewa === 'reguler' ? \Carbon\Carbon::parse($sesiPemesanan->sesi->jam_mulai)->format('H:i') : '-' }}</td>
                                    <td>{{ $pemesanan->jenis_sewa === 'reguler' ? \Carbon\Carbon::parse($sesiPemesanan->sesi->jam_selesai)->format('H:i') : '-' }}</td>
                                    <td>
                                        @if(now()->toDateString() == $pemesanan->tanggal_sewa)
                                            @if(now()->toTimeString() > $sesiPemesanan->sesi->jam_mulai && now()->toTimeString() < $sesiPemesanan->sesi->jam_selesai)
                                                Sedang berlangsung
                                            @elseif(now()->toTimeString() < $sesiPemesanan->sesi->jam_mulai)
                                                Akan berlangsung
                                            @elseif(now()->toTimeString() > $sesiPemesanan->sesi->jam_selesai)
                                                Sudah selesai
                                            @endif
                                        @elseif(now()->toDateString() > $pemesanan->tanggal_sewa)
                                            Sudah selesai
                                        @elseif(now()->toDateString() < $pemesanan->tanggal_sewa)
                                            Akan berlangsung
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data emtpy</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- page end-->
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#hidden-table-info').dataTable();
        });
    </script>
@endsection
