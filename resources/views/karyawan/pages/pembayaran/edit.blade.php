@extends('layouts.karyawan.karyawan')

@section('content')
    <h3><i class="fa fa-angle-right"></i> Transaksi</h3>
    <!-- BASIC FORM ELELEMNTS -->
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Detail Pembayaran</h4>
                @if($errors->any())
                    <div class="alert-danger alert" style="margin-top: 20px;">
                        <ul>
                            @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-horizontal style-form" method="post" action="{{ route('karyawan.pembayarans.update', $pembayaran) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Nama Member</label>
                        <div class="col-sm-10">
                            <input type="text" disabled value="{{ $pembayaran->pemesanan->member->nama_member }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Tanggal Pembayaran</label>
                        <div class="col-sm-10">
                            <input type="text" disabled value="{{ $pembayaran->tanggal_pembayaran }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Total Pembayaran</label>
                        <div class="col-sm-10">
                            <input type="text" disabled value="Rp. {{ number_format($pembayaran->pemesanan->total_harga, 0, ',', '.') }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Bank Tujuan</label>
                        <div class="col-sm-10">
                            <input type="text" disabled value="{{ $pembayaran->nomor_rekening_pengirim }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Bank Tujuan</label>
                        <div class="col-sm-10">
                            <input type="text" disabled value="{{ $pembayaran->bank_tujuan }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Bank Tujuan</label>
                        <div class="col-sm-10">
                            <input type="text" disabled value="{{ $pembayaran->bank_pengirim }}" class="form-control">
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
                            <select class="form-control" name="status" id="">
                                <option value="">---- Pilih Status ----</option>
                                <option value="valid">Valid</option>
                                <option value="invalid">Invalid</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('karyawan.pembayarans.index') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> &nbsp; Kembali</a>
                            &nbsp;
                            <button type="submit" class="btn btn-theme">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- col-lg-12-->
    </div>
@endsection
