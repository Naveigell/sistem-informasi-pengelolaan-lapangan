@extends('layouts.member.member')

@section('style')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection

@section('content')
    <div class="container mt-5 pt-5">
        <div class="card mt-5">
            <div class="card-header">
                <h5>History Pembayaran</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="row mt-1">
                            <div class="col-4">Tanggal</div>
                            <div class="col-8">: &nbsp; {{ \Carbon\Carbon::parse($pemesanan->latestPembayaran->tanggal_pembayaran)->format('d F Y') }}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4">Bank</div>
                            <div class="col-8">: &nbsp; {{ $pemesanan->latestPembayaran->bank_pengirim }}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4">No Rekening</div>
                            <div class="col-8">: &nbsp; {{ $pemesanan->latestPembayaran->nomor_rekening_pengirim }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row mt-1">
                            <div class="col-4">Nama</div>
                            <div class="col-8">: &nbsp; {{ auth('member')->user()->nama_member }}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4">Bukti</div>
                            <div class="col-8">: &nbsp; <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal">Lihat bukti</button></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-6">
                        <div class="row mt-1">
                            <div class="col-4">Untuk Tanggal</div>
                            <div class="col-8">: &nbsp; {{ \Carbon\Carbon::parse($pemesanan->tanggal_sewa)->format('d F Y') }}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4">Durasi</div>
                            <div class="col-8">: &nbsp; {{ $pemesanan->total_durasi }} Jam</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="table">
                            <thead>
                            <tr>
                                <th class="hidden-phone">No</th>
                                <th class="hidden-phone">Waktu</th>
                                <th class="hidden-phone">Jenis</th>
                                <th class="hidden-phone">Harga (Rp)</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($pemesanan)
                                    @forelse($pemesanan->sesiPemesanan as $sesiPemesanan)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                @if($pemesanan->jenis_sewa === 'reguler')
                                                    {{ \Carbon\Carbon::parse($sesiPemesanan->sesi->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($sesiPemesanan->sesi->jam_selesai)->format('H:i') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $pemesanan->jenis_sewa }}</td>
                                            <td style="text-align: right;">Rp. {{ number_format($sesiPemesanan->sesi->lapangan->harga_reguler * config('static.minimum_rent'), 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Data emtpy</td>
                                        </tr>
                                    @endforelse
                                @endif
                                <tr>
                                    <td colspan="3">Total</td>
                                    <td style="text-align: right;">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="row mt-1">
                            <div class="col-4 font-weight-bold">Status</div>
                            <div class="col-8 font-weight-bold">: &nbsp; {{ ucfirst($pemesanan->status) }}</div>
                        </div>
                        @if(in_array($pemesanan->status, ['open']))
                            <div class="row mt-1">
                                <span class="text text-danger col-12">Silahkan melakukan konfirmasi pembayaran</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ $pemesanan->latestPembayaran->bukti_transaksi_url }}" alt="" width="100%" height="100%">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection
