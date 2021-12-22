<?php
/**
 * @var \App\Models\Lapangan $lapangan
 */
?>

@extends('layouts.karyawan.karyawan')

@section('content')
    <h3><i class="fa fa-angle-right"></i> Lapangan <b>{{ $lapangan->nama_lapangan }}</b></h3>
    <!-- BASIC FORM ELELEMNTS -->
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Detail Lapangan</h4>
                @if($errors->any())
                    <div class="alert-danger alert" style="margin-top: 20px;">
                        <ul>
                            @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-horizontal style-form" method="post" action="{{ route('karyawan.lapangans.update', $lapangan) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Nama lapangan</label>
                        <div class="col-sm-10">
                            <input name="nama_lapangan" type="text" value="{{ old('nama_lapangan', $lapangan->nama_lapangan) }}" class="form-control">
                            <span class="help-block">Masukkan nama lapangan. Cth: Lapangan B</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Deskripsi lapangan</label>
                        <div class="col-sm-10">
                            <textarea name="deskripsi_lapangan" id="description" cols="30" rows="10" class="form-control">{{ old('deskripsi_lapangan', $lapangan->deskripsi_lapangan) }}</textarea>
                            <span class="help-block">Masukkan deskripsi lapangan. Cth: Lapangan B biasa digunakan oleh ...</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Harga reguler</label>
                        <div class="col-sm-10">
                            <input name="harga_reguler" type="text" value="{{ old('harga_reguler', $lapangan->harga_reguler) }}" class="form-control">
                            <span class="help-block">Masukkan harga reguler lapangan. Cth: 100000</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Harga turnamen</label>
                        <div class="col-sm-10">
                            <input name="harga_turnamen" type="text" value="{{ old('harga_turnamen', $lapangan->harga_turnamen) }}" class="form-control">
                            <span class="help-block">Masukkan harga turnamen lapangan. Cth: 300000</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Foto lapangan</label>
                        <div class="col-sm-7">
                            <input name="foto" type="file" accept="image/png,image/jpeg,image/jpg" class="form-control">
                            <span class="help-block">Klik tombol di atas untuk memilih foto</span>
                        </div>
                        <div class="col-sm-3">
                            <img width="100px" height="100px" src="{{ $lapangan->foto_url }}" alt="">
                            <span class="help-block">Foto lapangan sebelumnya</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('karyawan.lapangans.index') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> &nbsp; Kembali</a>
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

@section('script')
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
