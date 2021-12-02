@extends('layouts.member.member')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Pembayaran</h2>
            <div class="form-group">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-1"></div>
            <div class="col-md-12 text-left">
                <h4 class="my-12">Tabel pembayaran</h4>
                <div class="mt-4 mb-4">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="table">
                        <thead>
                        <tr>
                            <th class="hidden-phone">No</th>
                            <th class="hidden-phone">No Transaksi</th>
                            <th class="hidden-phone">Tanggal</th>
                            <th class="hidden-phone">Jenis</th>
                            <th class="hidden-phone">Lapangan</th>
                            <th class="hidden-phone">Total Jam</th>
                            <th class="hidden-phone">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="form-group mt-3 mb-5">
            <a href="{{ route('index') }}" class="btn btn-link btn-success" style="color: white; text-decoration: none;">Ke halaman utama</a>
        </div>
    </div>
@endsection
