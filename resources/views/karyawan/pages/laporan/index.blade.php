@extends('layouts.karyawan.karyawan')

@php
$saldo = 0;
@endphp

@section('content')
    <div style="margin: 20px 20px 0 20px; padding: 10px;">
        <h3><i class="fa fa-angle-right"></i> Cetak Laporan</h3>
        <div class="row mb">
            <div class="content-panel" style="padding: 30px;">
                @php
                    $validated = in_array(request()->get('type'), ['kas', 'pemesanan']) && request()->filled('from') && request()->filled('to');
                @endphp
                <div class="row">
                    <form action="{{ route('karyawan.laporans.index') }}" class="col-lg-10">
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="">Pilih Jenis Data : </label>
                                <select name="type" id="" class="form-control">
                                    <option value="">--- Nothing Selected ---</option>
                                    <option {{ request()->get('type') === 'kas' ? 'selected' : '' }} value="kas">Kas</option>
                                    <option {{ request()->get('type') === 'pemesanan' ? 'selected' : '' }} value="pemesanan">Pemesanan</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="">Dari : </label>
                                <input type="date" class="form-control" name="from" value="{{ request()->get('from') }}">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="">Sampai : </label>
                                <input type="date" class="form-control" name="to" value="{{ request()->get('to') }}">
                            </div>
                            <div class="form-group col-lg-3" style="margin-top: 4px;">
                                <label for=""></label>
                                <button class="btn btn-info btn-sm form-control"><i class="fa fa-filter"></i> &nbsp; Filter</button>
                            </div>
                        </div>
                    </form>
                    @if($validated)
                        <form action="{{ route('karyawan.laporans.print') }}" method="get" class="col-lg-2">
                            <div class="form-group" style="margin-top: 4px;">
                                <label for=""></label>
                                <button type="submit" class="btn btn-success btn-sm form-control"><i class="fa fa-print"></i> &nbsp; Cetak Laporan</button>
                            </div>
                            <select name="type" id="" hidden readonly>
                                <option {{ request()->get('type') === 'kas' ? 'selected' : '' }} value="kas">Kas</option>
                                <option {{ request()->get('type') === 'pemesanan' ? 'selected' : '' }} value="pemesanan">Pemesanan</option>
                            </select>
                            <input type="date" hidden readonly name="from" value="{{ request()->get('from') }}">
                            <input type="date" hidden readonly name="to" value="{{ request()->get('to') }}">
                        </form>
                    @endif
                </div>

            </div>
            <!-- page end-->
        </div>
    </div>

    @if(request('type') === 'kas')
        <div style="margin: 0 20px 20px 20px; padding: 10px;">
            <div class="row mb">
                <div class="content-panel" style="padding: 30px;">
                    <div class="adv-table">
                        <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                            <thead>
                            <tr>
                                <th class="hidden-phone" aria-sort="ascending">No</th>
                                <th class="hidden-phone">Tanggal</th>
                                <th class="hidden-phone">Keterangan</th>
                                <th class="hidden-phone">Debit</th>
                                <th class="hidden-phone">Kredit (Rp)</th>
                                <th class="hidden-phone">Saldo (Rp)</th>
                                <th class="hidden-phone">Penanggung Jawab</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($kas as $ka)
                                    <tr class="gradeX">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $ka->tanggal_transaksi }}</td>
                                        <td style="max-width: 200px;">{{ $ka->keterangan }}</td>
                                        <td style="text-align: right;">Rp &nbsp; {{ number_format($ka->jenis === 'debit' ? $ka->nilai : 0, 0, '', '.') }}</td>
                                        <td style="text-align: right;">Rp &nbsp; {{ number_format($ka->jenis === 'kredit' ? $ka->nilai : 0, 0, '', '.') }}</td>
                                        <td style="text-align: right;">Rp &nbsp; {{ number_format($saldo += $ka->jenis === 'debit' ? $ka->nilai : -$ka->nilai, 0, '', '.') }}</td>
                                        <td style="text-align: right;">{{ $ka->karyawan->nama_pengguna }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Data Kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(request('type') === 'pemesanan')
        <div style="margin: 0 20px 20px 20px; padding: 10px;">
            <div class="row mb">
                <div class="content-panel" style="padding: 30px;">
                    <div class="adv-table">
                        <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                            <thead>
                            <tr>
                                <th class="hidden-phone" aria-sort="ascending">No</th>
                                <th class="hidden-phone">Nama Member</th>
                                <th class="hidden-phone">Tanggal Sewa</th>
                                <th class="hidden-phone">Jenis Sewa</th>
                                <th class="hidden-phone">Total Pembayaran (Rp)</th>
                                <th class="hidden-phone">Total Durasi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($pemesanans as $pemesanan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pemesanan->member->nama_member }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal_sewa)->format('d F Y') }}</td>
                                    <td>{{ ucfirst($pemesanan->jenis_sewa) }}</td>
                                    <td style="text-align: right;">Rp. {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                    <td>{{ $pemesanan->jenis_sewa === 'reguler' ? $pemesanan->total_durasi . ' jam' : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Data Kosong</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
