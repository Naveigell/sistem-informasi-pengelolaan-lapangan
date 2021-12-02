@extends('layouts.member.member')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Pemesanan</h2>
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
                            <th class="hidden-phone">Nama Member</th>
                            <th class="hidden-phone">Tanggal Sewa</th>
                            <th class="hidden-phone">Jenis Sewa</th>
                            <th class="hidden-phone">Total Harga</th>
                            <th class="hidden-phone">Status</th>
                            <th class="hidden-phone">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($pemesanans as $pemesanan)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $pemesanan->member->nama_member }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal_sewa)->format('d F Y') }}</td>
                                    <td>{{ $pemesanan->jenis_sewa }}</td>
                                    <td>Rp. {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                    <td>{{ $pemesanan->status }}</td>
                                    <td>
                                        <a href="{{ route('member.pemesanans.show', $pemesanan) }}" class="btn btn-success btn-sm">Lakukan Pembayaran</a>
                                        <button class="btn btn-danger btn-sm">Batal</button>
                                        <button class="btn btn-warning btn-sm">History Pembayaran</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Data emtpy</td>
                                </tr>
                            @endforelse
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
