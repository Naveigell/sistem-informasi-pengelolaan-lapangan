@extends('layouts.karyawan.karyawan')

@section('content')
    <h3><i class="fa fa-angle-right"></i> Transaksi</h3>
    <!-- BASIC FORM ELELEMNTS -->
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Detail Pembayaran</h4>
                <form class="form-horizontal style-form" method="post">
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Nama Member</label>
                        <div class="col-sm-10">
                            : {{ $pembayaran->pemesanan->member->nama_member }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Tanggal Pembayaran</label>
                        <div class="col-sm-10">
                            : {{ $pembayaran->tanggal_pembayaran }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Total Pembayaran</label>
                        <div class="col-sm-10">
                            : Rp. {{ number_format($pembayaran->pemesanan->total_harga, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Nomor Rekening Pengirim</label>
                        <div class="col-sm-10">
                            : {{ $pembayaran->nomor_rekening_pengirim }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Bank Tujuan</label>
                        <div class="col-sm-10">
                            : {{ strtoupper($pembayaran->bank_tujuan) }}. No Rek : {{ config('static.bank')[$pembayaran->bank_tujuan] }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Bank Pengirim</label>
                        <div class="col-sm-10">
                            : {{ $pembayaran->bank_pengirim }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Bukti Transaksi</label>
                        <div class="col-sm-9">
                            <img width="400px" height="400px" src="{{ $pembayaran->bukti_transaksi_url }}" alt="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Konfirmasi status</label>
                        <div class="col-sm-10">
                            : {{ $pembayaran->status ? ucfirst($pembayaran->status) : 'Belum terkonfirmasi' }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- col-lg-12-->
    </div>
@endsection
