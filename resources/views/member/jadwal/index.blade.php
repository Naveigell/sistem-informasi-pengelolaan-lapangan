@extends('layouts.member.member')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="text-center mt-5">
            <h2 class="section-heading text-uppercase">Jadwal</h2>
            <div class="form-group">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-1"></div>
            <div class="col-md-12 text-left">
                <h4 class="my-12">Tabel pemesanan</h4>
                <div class="mt-4 mb-4">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="table">
                        <thead>
                        <tr>
                            <th class="hidden-phone">No</th>
                            <th class="hidden-phone">Nomor Lapangan</th>
                            <th class="hidden-phone">Tanggal Sewa</th>
                            <th class="hidden-phone">Jam Mulai</th>
                            <th class="hidden-phone">Jam Selesai</th>
                            <th class="hidden-phone">Status</th>
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
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="form-group mt-3 mb-5">
            <a href="{{ route('index') }}" class="btn btn-link btn-success" style="color: white; text-decoration: none;">Ke halaman utama</a>
        </div>
    </div>
@endsection
