<?php
/**
 * @var \App\Models\Pemesanan $pemesanan
 */
?>

@extends('layouts.karyawan.karyawan')

@section('content')
    <div style="margin: 20px; padding: 10px;">
        <h3><i class="fa fa-angle-right"></i> Tabel Data Pemesanan</h3>
        <div class="row mb">
            <div class="content-panel" style="padding: 20px 20px 60px 20px;">
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                        <thead>
                        <tr>
                            <th class="hidden-phone">No</th>
                            <th class="hidden-phone">Tanggal Sewa</th>
                            <th class="hidden-phone">Nama Penyewa</th>
                            <th class="hidden-phone">Jenis Sewa</th>
                            <th class="hidden-phone">Total Harga</th>
                            <th class="hidden-phone">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pemesanans as $pemesanan)
                            <tr class="gradeX">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal_sewa)->format('d F Y') }}</td>
                                <td>{{ $pemesanan->member->nama_member }}</td>
                                <td>{{ $pemesanan->jenis_sewa }}</td>
                                <td>Rp {{ number_format($pemesanan->total_harga, 0, '', '.') }}</td>
                                <td>{{ ucfirst($pemesanan->status) }}</td>
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
