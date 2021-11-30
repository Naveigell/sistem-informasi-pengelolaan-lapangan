<?php
/**
 * @var \App\Models\Kas $member
 */
?>
@extends('layouts.karyawan.karyawan')

@section('content')
    <h3><i class="fa fa-angle-right"></i> Edit Member</h3>
    <!-- BASIC FORM ELELEMNTS -->
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Detail Member</h4>
                @if($errors->any())
                    <div class="alert-danger alert" style="margin-top: 20px;">
                        <ul>
                            @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-horizontal style-form" method="post" action="{{ route('karyawan.members.update', $member) }}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Nama member</label>
                        <div class="col-sm-10">
                            <input disabled type="text" value="{{ $member->nama_member }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Alamat member</label>
                        <div class="col-sm-10">
                            <input disabled type="text" value="{{ $member->alamat_member }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">No hp</label>
                        <div class="col-sm-10">
                            <input disabled type="text" value="{{ $member->hp }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input disabled type="text" value="{{ $member->email }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status" id="" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option {{ $member->status === 'aktif' ? 'selected' : '' }} value="aktif">Aktif</option>
                                <option {{ $member->status === 'tidak aktif' ? 'selected' : '' }} value="tidak aktif">Tidak Aktif</option>
                            </select>
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
