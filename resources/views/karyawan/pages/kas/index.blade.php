<?php
/**
 * @var \App\Models\Kas $kas
 */

$saldo = 0;
?>

@extends('layouts.karyawan.karyawan')

@section('content')
    <div style="margin: 20px; padding: 10px;">
        <h3><i class="fa fa-angle-right"></i> Tabel Data Kas</h3>
        <div class="row mb">
            <div class="content-panel" style="padding: 20px 20px 60px 20px;">
                <div class="mt" style="margin-bottom: 30px;">
{{--                    @if(auth('pengguna')->user()->jabatan === 'staff')--}}
                        <a href="{{ route('karyawan.kas.create') }}" class="btn btn-success btn-sm">Tambah</a>
{{--                    @endif--}}
                    <a href="{{ route('karyawan.kas.print') }}" class="btn btn-success btn-sm">Download .xls</a>
                </div>
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                        <thead>
                        <tr>
                            <th class="hidden-phone" aria-sort="ascending">No</th>
                            <th class="hidden-phone">Tanggal</th>
                            <th class="hidden-phone">Keterangan</th>
                            <th class="hidden-phone">Debit</th>
                            <th class="hidden-phone">Kredit</th>
                            <th class="hidden-phone">Saldo</th>
                            <th class="hidden-phone">Penanggung Jawab</th>
{{--                            @if(auth('pengguna')->user()->jabatan === 'staff')--}}
                                <th class="hidden-phone">Aksi</th>
{{--                            @endif--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($kas as $ka)
                            <tr class="gradeX">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $ka->tanggal_transaksi }}</td>
                                <td style="max-width: 200px;">{{ $ka->keterangan }}</td>
                                <td style="text-align: right;">Rp &nbsp; {{ number_format($ka->jenis === 'debit' ? $ka->nilai : 0, 0, '', '.') }}</td>
                                <td style="text-align: right;">Rp &nbsp; {{ number_format($ka->jenis === 'kredit' ? $ka->nilai : 0, 0, '', '.') }}</td>
                                <td style="text-align: right;">Rp &nbsp; {{ number_format($saldo += $ka->jenis === 'debit' ? $ka->nilai : -$ka->nilai, 0, '', '.') }}</td>
                                <td>{{ $ka->karyawan->nama_pengguna }}</td>
{{--                                @if(auth('pengguna')->user()->jabatan === 'staff')--}}
                                    <td>
                                        <a href="{{ route('karyawan.kas.edit', $ka) }}" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
{{--                                @endif--}}
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

@section('script')
    <script type="text/javascript">
        $('#hidden-table-info').dataTable();
    </script>
@endsection
