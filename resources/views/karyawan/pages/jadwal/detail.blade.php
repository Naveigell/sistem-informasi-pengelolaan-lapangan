<?php
/**
 * @var \App\Models\Member $member
 */
?>

@extends('layouts.karyawan.karyawan')

@section('content')
    <!-- BASIC FORM ELELEMNTS -->
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Detail Jadwal</h4>
                <form class="form-horizontal style-form">
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Nama Pemesan</label>
                        <div class="col-sm-10">
                            : {{ $pemesanan->member->nama_member }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Nomor Lapangan</label>
                        <div class="col-sm-10">
                            : {{ $lapangan->nama_lapangan }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Jenis</label>
                        <div class="col-sm-10">
                            : {{ $pemesanan->jenis_sewa }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Durasi</label>
                        <div class="col-sm-10">
                            : {{ $pemesanan->total_durasi }} jam
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Tanggal Sewa</label>
                        <div class="col-sm-10">
                            : {{ \Carbon\Carbon::make($pemesanan->tanggal_sewa)->format('d F Y') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Jam</label>
                        <div class="col-sm-10">
                            : {{ \Carbon\Carbon::make($sesi->jam_mulai)->hour }}.00 - {{ \Carbon\Carbon::make($sesi->jam_selesai)->hour }}.00
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- col-lg-12-->
    </div>
@endsection
