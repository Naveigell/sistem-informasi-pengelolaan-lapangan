<?php
/**
 * @var \App\Models\Kas $kas
 */
?>
@extends('layouts.karyawan.karyawan')

@section('content')
    <h3><i class="fa fa-angle-right"></i> Edit Kas Baru</h3>
    <!-- BASIC FORM ELELEMNTS -->
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Detail Kas</h4>
                @if($errors->any())
                    <div class="alert-danger alert" style="margin-top: 20px;">
                        <ul>
                            @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-horizontal style-form" method="post" action="{{ route('karyawan.kas.update', $kas) }}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input name="tanggal_transaksi" type="date" value="{{ old('tanggal_transaksi', $kas->tanggal_transaksi) }}" class="form-control">
                            <span class="help-block">Masukkan tanggal kas dimasukkan</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Jenis kas</label>
                        <div class="col-sm-10">
                            <select name="jenis" id="" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option {{ $kas->jenis === 'debit' ? 'selected' : '' }} value="debit">Debit</option>
                                <option {{ $kas->jenis === 'kredit' ? 'selected' : '' }} value="kredit">Kredit</option>
                            </select>
                            <span class="help-block">Masukkan jenis kas. Cth: Debit</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Nominal</label>
                        <div class="col-sm-10">
                            <input name="nilai" type="text" value="{{ old('nilai', $kas->nilai) }}" class="form-control">
                            <span class="help-block">Masukkan jumlah nominal kas. Cth: 300000</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input name="keterangan" type="text" value="{{ old('keterangan', $kas->keterangan) }}" class="form-control">
                            <span class="help-block">Masukkan keterangan dari kas. Cth: Pemasukan dari lapangan B</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-theme">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- col-lg-12-->
    </div>
@endsection
