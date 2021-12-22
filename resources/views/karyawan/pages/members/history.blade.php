@extends('layouts.karyawan.karyawan')

@section('content')
    <div style="margin: 20px; padding: 10px;">
        <h3><i class="fa fa-angle-right"></i> Tabel History Pembayaran Dari <b>{{ $member->nama_member }}</b></h3>
        <div class="row mb">
            <div class="content-panel" style="padding: 20px 20px 60px 20px;">
                @if(session()->has('success'))
                    <br>
                    <br>
                    <x-alert :title="session()->get('success')"></x-alert>
                @endif
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                        <thead>
                        <tr>
                            <th class="hidden-phone">No</th>
                            <th class="hidden-phone">Tanggal Sewa</th>
                            <th class="hidden-phone">Nomor Lapangan</th>
                            <th class="hidden-phone">Waktu</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $no = 0;
                        @endphp
                        @foreach($pemesanans as $pemesanan)
                            @foreach($pemesanan->sesiPemesanan as $sesiPemesanan)
                                <tr class="gradeX">
                                    <td>{{ ++$no }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal_sewa)->format('d F Y') }}</td>
                                    <td>{{ $sesiPemesanan->sesi->lapangan->nama_lapangan }}</td>
                                    @if($pemesanan->jenis_sewa === 'reguler')
                                        <td>
                                            {{ \Carbon\Carbon::parse($sesiPemesanan->sesi->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($sesiPemesanan->sesi->jam_selesai)->format('H:i') }}
                                        </td>
                                    @else
                                        <td>-</td>
                                    @endif
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                <a href="{{ route('karyawan.members.index') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> &nbsp; Kembali</a>
            </div>
            <!-- page end-->
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var oTable = $('#hidden-table-info').dataTable();
        });
    </script>
@endsection
