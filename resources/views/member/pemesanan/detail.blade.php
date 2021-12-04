@extends('layouts.member.member')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Konfirmasi Pembayaran</h2>
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
                <h4 class="my-12">Form Konfirmasi Pembayaran</h4>
                <div class="mt-4 mb-4">
                    <form method="post" class="form-group" action="{{ route('member.pembayarans.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $pemesanan->id }}" name="pemesanan_id">
                        <div class="form-group row">
                            <div class="col-2">
                                <label for="name">Nama</label>
                            </div>
                            <div class="col-10">
                                <input class="form-control col-10" value="{{ auth('member')->user()->nama_member }}" disabled type="text" id="name">
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-2">
                                <label for="account_number">No Rekening</label>
                            </div>
                            <div class="col-10">
                                <input class="form-control col-10" type="number" name="nomor_rekening_pengirim" id="account_number" value="{{ old('nomor_rekening_pengirim') }}">
                                @if($errors->has('nomor_rekening_pengirim'))
                                    <div class="text text-danger mt-1" style="font-size: 13px;">
                                        {{ $errors->first('nomor_rekening_pengirim') }}
                                    </div>
                                @else
                                    <span class="text text-info" style="font-size: 13px;">Masukkan nomor rekening anda</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-2">
                                <label for="bank_tujuan">Bank Tujuan</label>
                            </div>
                            <div class="col-10">
                                <select class="form-control @if($errors->has('bank_tujuan')) is-invalid @endif" name="bank_tujuan" id="bank_tujuan">
                                    <option value="">-- Silakan pilih --</option>
                                    <option @if(old('bank_tujuan') === 'bca') selected @endif value="bca">BCA. &nbsp; No Rek: 071863812213</option>
                                    <option @if(old('bank_tujuan') === 'bri') selected @endif value="bri">BRI. &nbsp; No Rek: 098019204</option>
                                </select>
                                @if($errors->has('bank_tujuan'))
                                    <div class="text text-danger mt-1" style="font-size: 13px;">
                                        {{ $errors->first('bank_tujuan') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-2">
                                <label for="bank_pengirim">Bank Pengirim</label>
                            </div>
                            <div class="col-10">
                                <input class="form-control col-10 @if($errors->has('bank_pengirim')) is-invalid @endif" type="text" id="bank_pengirim" name="bank_pengirim" value="{{ old('bank_pengirim') }}">
                                @if($errors->has('bank_pengirim'))
                                    <div class="text text-danger mt-1" style="font-size: 13px;">
                                        {{ $errors->first('bank_pengirim') }}
                                    </div>
                                @else
                                    <span class="text text-info" style="font-size: 13px;">Masukkan bank pengirim menggunakan huruf latin</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-2">
                                <label for="jumlah">Batas Waktu Pembayaran</label>
                            </div>
                            <div class="col-10">
                                <input class="form-control col-10" value="{{ \Carbon\Carbon::parse($pemesanan->batas_waktu)->format('d F Y H:i') }}" disabled type="text" id="jumal-pembayaran">
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-2">
                                <label for="tanggal">Tanggal Sewa</label>
                            </div>
                            <div class="col-10">
                                <input class="form-control col-10" value="{{ now()->format('d F Y') }}" disabled type="text" id="tanggal">
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-2">
                                <label for="jumlah">Jumlah Pembayaran</label>
                            </div>
                            <div class="col-10">
                                <input class="form-control col-10" value="Rp. {{ number_format($pemesanan->total_harga, 0, ',', '.') }}" disabled type="text" id="jumal-pembayaran">
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-2">
                                <label for="foto">Upload bukti</label>
                            </div>
                            <div class="col-10">
                                <input class="form-control col-10" type="file" name="bukti_transaksi" accept="image/png,image/jpg,image/jpeg" id="foto">
                                <div class="text text-danger mt-1" style="font-size: 13px;">
                                    @error('bukti_transaksi')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-2">
                                <label for="name"></label>
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
@endsection
