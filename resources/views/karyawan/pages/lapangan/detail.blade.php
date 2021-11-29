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
                <form class="form-horizontal style-form">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Nama lapangan</label>
                        <div class="col-sm-10">
                            <input disabled name="nama_lapangan" type="text" value="{{ $lapangan->nama_lapangan }}" class="form-control">
                            <span class="help-block">Masukkan nama lapangan. Cth: Lapangan B</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Deskripsi lapangan</label>
                        <div class="col-sm-10">
                            <textarea disabled name="deskripsi_lapangan" id="" cols="30" rows="10" class="form-control">{{ $lapangan->deskripsi_lapangan }}</textarea>
                            <span class="help-block">Masukkan deskripsi lapangan. Cth: Lapangan B biasa digunakan oleh ...</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Harga reguler</label>
                        <div class="col-sm-10">
                            <input disabled name="harga_reguler" type="text" value="{{ $lapangan->harga_reguler }}" class="form-control">
                            <span class="help-block">Masukkan harga reguler lapangan. Cth: 100000</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Harga turnamen</label>
                        <div class="col-sm-10">
                            <input disabled name="harga_turnamen" type="text" value="{{ $lapangan->harga_turnamen }}" class="form-control">
                            <span class="help-block">Masukkan harga turnamen lapangan. Cth: 300000</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Foto lapangan</label>
                        <div class="col-sm-3">
                            <img width="100px" height="100px" src="{{ $lapangan->foto_url }}" alt="">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- col-lg-12-->
    </div>
@endsection
