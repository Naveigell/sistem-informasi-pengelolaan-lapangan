<?php
/**
 * @var \Illuminate\Support\Collection<\App\Models\Lapangan> $lapangans
 * @var \App\Models\Lapangan $lapangan
 */
?>

@extends('layouts.karyawan.karyawan')

@section('content')
    <div style="margin: 20px; padding: 10px;">
        <h3><i class="fa fa-angle-right"></i> Tabel Data Lapangan</h3>
        <div class="row mb">
            <div class="content-panel" style="padding: 20px 20px 60px 20px;">
                <div class="mt" style="margin-bottom: 30px;">
{{--                    @unless(auth('karyawan')->user()->jabatan !== 'staff')--}}
                        <a href="{{ route('karyawan.lapangans.create') }}" class="btn btn-success btn-sm">Tambah</a>
{{--                    @endunless--}}
                </div>
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                        <thead>
                        <tr>
                            <th class="hidden-phone">No</th>
                            <th class="hidden-phone">Nomor lapangan</th>
                            <th class="hidden-phone">Deskripsi lapangan</th>
                            <th class="hidden-phone">Harga reguler (Rp)</th>
                            <th class="hidden-phone">Harga turnamen (Rp)</th>
                            <th class="hidden-phone">Foto</th>
{{--                            @unless(auth('pengguna')->user()->jabatan !== 'staff')--}}
                                <th class="hidden-phone">Aksi</th>
{{--                            @endunless--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lapangans as $lapangan)
                            <tr class="gradeX">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $lapangan->nama_lapangan }}</td>
                                <td>{{ $lapangan->deskripsi_lapangan }}</td>
                                <td style="text-align: right;">Rp &nbsp; {{ number_format($lapangan->harga_reguler, 0, '', '.') }}</td>
                                <td style="text-align: right;">Rp &nbsp; {{ number_format($lapangan->harga_turnamen, 0, '', '.') }}</td>
                                <td>
                                    @unless(!$lapangan->foto)
                                        <img src="{{ $lapangan->foto_url }}" alt="Img" width="100px" height="100px">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('karyawan.lapangans.show', $lapangan) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('karyawan.lapangans.edit', $lapangan) }}" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- page end-->
        </div>
    </div>
@endsection
