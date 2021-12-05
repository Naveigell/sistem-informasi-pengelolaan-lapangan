@extends('layouts.member.member')

@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="d-flex align-items-center justify-content-center h-100">
                <div class="d-flex flex-column card">
                    <div class="card-body">
                        <h5 class="card-title">Konfirmasi pembayaran</h5>
                        <form>
                            @csrf
                            <div class="row card-body">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input class="form-control mt-2" type="text" value="{{ $pemesanan->tanggal_sewa }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input class="form-control mt-2" type="text" value="{{ auth('member')->user()->nama_member }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Jenis</label>
                                    <input class="form-control mt-2" type="text" value="{{ $pemesanan->jenis_sewa }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="waktu">Durasi</label>
                                    @if($pemesanan->jenis_sewa === 'reguler')
                                        <input class="form-control mt-2" type="text" value="{{ $pemesanan->total_durasi }} jam" disabled>
                                    @else
                                        <input class="form-control mt-2" type="text" value="-" disabled>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="total">Total Pembayaran</label>
                                    <input class="form-control mt-2" type="text" value="Rp. {{ number_format($pemesanan->total_harga, 0, ',', '.') }}" disabled>
                                </div>
                                <div class="form-group text text-info mt-5">
                                    <label for="">Silakan melakukan pembayaran Rp. {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</label>
                                    <ul>
                                        <li>Bank Bri (098019204) an Gor Wangaya</li>
                                        <li>Bank BCA (071863812213) an Gor Wangaya</li>
                                    </ul>
                                    <label for="">Kemudian menuju menu pesanan dan lakukan pembayaran dengan nomor transaksi <b></b></label>
                                </div>
                                <div class="form-group mt-3">
                                    <a href="{{ route('member.pemesanans.index') }}" class="btn btn-link btn-success" style="color: white; text-decoration: none;">Ke halaman pemesanan</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
