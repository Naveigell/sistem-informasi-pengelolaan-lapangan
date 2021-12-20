<?php
/**
 * @var \App\Models\Pembayaran $pembayaran
 */
?>

@extends('layouts.karyawan.karyawan')

@section('content')
    <div style="margin: 20px; padding: 10px;">
        <h3><i class="fa fa-angle-right"></i> Tabel Data Pembayaran</h3>
        <div class="row mb">
            <div class="content-panel" style="padding: 20px 20px 60px 20px;">

                @if(session()->has('success'))
                    <br>
                    <br>
                    <x-alert :title="session()->get('success')"></x-alert>
                @endif
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                        <thead>
                        <tr>
                            <th class="hidden-phone">No</th>
                            <th class="hidden-phone">Tanggal pembayaran</th>
                            <th class="hidden-phone">Total pembayaran (Rp)</th>
                            <th class="hidden-phone">Bukti transaksi</th>
                            <th class="hidden-phone">Nama Member</th>
                            <th class="hidden-phone">Status</th>
                            @if(auth('karyawan')->user()->jabatan === 'staff')
                                <th class="hidden-phone">Aksi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pembayarans as $pembayaran)
                            <tr class="gradeX">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d F Y') }}</td>
                                <td style="text-align: right;">Rp. {{ number_format($pembayaran->pemesanan->total_harga, 0, ',', '.') }}</td>
                                @if($pembayaran->bukti_transaksi_url)
                                    <td>
                                        <img src="{{ $pembayaran->bukti_transaksi_url }}" alt="" style="height: 100px; width: 100px;">
                                    </td>
                                @else
                                    <td>-</td>
                                @endif
                                <td>{{ $pembayaran->pemesanan->member->nama_member ?? '-' }}</td>
                                <td>{{ !$pembayaran->status ? 'Belum terkonfirmasi' : ucfirst($pembayaran->status) }}</td>
                                @if(auth('karyawan')->user()->jabatan === 'staff')
                                    <td>
                                        @unless ($pembayaran->status === 'valid')
                                            <a href="{{ route('karyawan.pembayarans.edit', $pembayaran) }}" class="btn btn-warning btn-sm">Edit</a>
                                        @endunless
                                        <a href="{{ route('karyawan.pembayarans.show', $pembayaran) }}" class="btn btn-primary btn-sm">Detail</a>
                                    </td>
                                @endif
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
        $(document).ready(function() {
            var oTable = $('#hidden-table-info').dataTable();
        });
    </script>
@endsection
