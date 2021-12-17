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
                                <div class="row">
                                    <div class="form-group row">
                                        <label for="tanggal" class="col-3">Tanggal</label>
                                        <div class="col-9">: {{ $pemesanan->tanggal_sewa }}</div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama" class="col-3">Nama</label>
                                        <div class="col-9">: {{ auth('member')->user()->nama_member }}</div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jenis" class="col-3">Jenis</label>
                                        <div class="col-9">: {{ $pemesanan->jenis_sewa }}</div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="waktu" class="col-3">Durasi</label>
                                        @if($pemesanan->jenis_sewa === 'reguler')
                                            <div class="col-9">: {{ $pemesanan->total_durasi }} jam</div>
                                        @else
                                            <div class="col-9">: -</div>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label for="total" class="col-3">Total Pembayaran</label>
                                        <div class="col-9">: Rp. {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="form-group text text-info mt-5">
                                        <label for="">Silakan melakukan pembayaran Rp. {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</label>
                                        <ul>
                                            <li>Bank Bri (098019204) an Gor Wangaya</li>
                                            <li>Bank BCA (071863812213) an Gor Wangaya</li>
                                        </ul>
                                    </div>
                                    <label for="">Kemudian menuju menu pesanan dan lakukan pembayaran dengan nomor transaksi <b></b></label>
                                    <div class="form-group mt-3">
                                        <a href="{{ route('member.pemesanans.index') }}" class="btn btn-link btn-success" style="color: white; text-decoration: none;">Ke halaman pemesanan</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
