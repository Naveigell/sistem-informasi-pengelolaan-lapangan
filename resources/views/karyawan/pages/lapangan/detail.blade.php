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
                            : {{ $lapangan->nama_lapangan }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Deskripsi lapangan</label>
                        <div class="col-sm-10 default-list">
                             : {!! $lapangan->deskripsi_lapangan !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Harga reguler</label>
                        <div class="col-sm-10">
                            : {{ $lapangan->harga_reguler }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Harga turnamen</label>
                        <div class="col-sm-10">
                            : {{ $lapangan->harga_turnamen }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Foto lapangan</label>
                        <div class="col-sm-3">
                            <img width="100px" height="100px" src="{{ $lapangan->foto_url }}" alt="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('karyawan.lapangans.index') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> &nbsp; Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- col-lg-12-->
    </div>
@endsection
