@extends('layouts.member.member')

@section('content')
    <?php
    /**
     * @var \App\Models\Lapangan $field
     */
    ?>
    @if(request('jenis_sewa') === 'reguler')
        <section class="h-100">
            <div class="container h-100">
                <div class="d-flex align-items-center justify-content-center h-100">
                    <div class="d-flex flex-column card">
                        <div class="card-body">
                            <h5 class="card-title">Informasi booking</h5>
                            <form action="{{ route('member.pemesanans.store') }}" method="post">
                                @csrf
                                <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="table">
                                    <thead>
                                    <tr>
                                        <th class="hidden-phone">No</th>
                                        <th class="hidden-phone">Tanggal</th>
                                        <th class="hidden-phone">Waktu</th>
                                        <th class="hidden-phone">Jenis</th>
                                        <th class="hidden-phone">Harga (Rp)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(request('jenis_sewa') == 'reguler')
                                        @foreach(request('waktu') as $time)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ request()->get('tanggal') }}</td>
                                                <td>{{ $time }}.00 - {{ $time + 2 }}.00</td>
                                                <td>{{ request()->get('jenis_sewa') }}</td>
                                                <td style="text-align: right;">Rp. {{ number_format($lapangan->harga_reguler * config('static.minimum_rent', 2), 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>1</td>
                                            <td>{{ request()->get('tanggal') }}</td>
                                            <td>-</td>
                                            <td>{{ request()->get('jenis_sewa') }}</td>
                                            <td style="text-align: right;">Rp. {{ number_format($lapangan->harga_turnamen, 0, ',', '.') }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="4">Total</td>
                                        @if(request('jenis_sewa') == 'reguler')
                                            <td style="text-align: right;">Rp. {{ number_format($lapangan->harga_reguler * count(request('waktu', [])) * config('static.minimum_rent', 2), 0, ',', '.') }}</td>
                                        @else
                                            <td style="text-align: right;">Rp. {{ number_format($lapangan->harga_turnamen, 0, ',', '.') }}</td>
                                        @endif
                                    </tr>
                                    </tbody>
                                </table>
                                <h5 class="card-title">Konfirmasi booking</h5>
                                <span class="text text-info" style="font-size: 14px;">Centang tombol persetujuan kemudian klik tombol <b>pesan</b> untuk mengkonfirmasi pemesanan</span>
                                <br>
                                <br>
                                <input type="checkbox" id="checkbox" name="accept"> <label style="font-size: 14px;" for="checkbox" class="text text-success">Saya menyetujui kebijakan yang berlaku</label>
                                <br>
                                <br>
                                <button class="btn btn-success btn-sm">Pesan</button>
                                <input type="text" hidden name="id" value="{{ request()->get('id') }}">
                                <input type="text" hidden name="tanggal" value="{{ request()->get('tanggal') }}">
                                <input type="text" hidden name="jenis_sewa" value="{{ request()->get('jenis_sewa') }}">
                                <input type="text" hidden name="waktu" value="{{ join(',', request()->get('waktu', [])) }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="h-100">
            <div class="container h-100">
                <div class="d-flex align-items-center justify-content-center h-100">
                    <div class="d-flex flex-column card">
                        <div class="card-body">
                            <h5 class="card-title">Konfirmasi booking</h5>
                            <form action="{{ route('member.pemesanans.store') }}" method="post">
                                @csrf
                                <div class="row card-body">
                                    <div class="row">
                                        <div class="form-group row">
                                            <label for="tanggal" class="col-3">Tanggal</label>
                                            <div class="col-9">: {{ request()->get('tanggal') }}</div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama" class="col-3">Nama</label>
                                            <div class="col-9">: {{ auth('member')->user()->nama_member }}</div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="jenis" class="col-3">Jenis</label>
                                            <div class="col-9">: {{ request()->get('jenis_sewa') }}</div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="waktu" class="col-3">Durasi</label>
                                            <div class="col-9">: -</div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="total" class="col-3">Total Pembayaran</label>
                                            <div class="col-9">: Rp. {{ number_format($lapangan->harga_turnamen, 0, ',', '.') }}</div>
                                        </div>
                                        <br>
                                        <br>
                                        <span class="text text-info" style="font-size: 14px;">Centang tombol persetujuan kemudian klik tombol <b>pesan</b> untuk mengkonfirmasi pemesanan</span>
                                        <div class="form-group row">
                                            <div class="col-12 mt-3">
                                                <input type="checkbox" id="checkbox" name="accept"> <label style="font-size: 14px;" for="checkbox" class="text text-success">Saya menyetujui kebijakan yang berlaku</label>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <button class="btn btn-success btn-sm">Pesan</button>
                                            </div>
                                            <input type="text" hidden name="id" value="{{ request()->get('id') }}">
                                            <input type="text" hidden name="tanggal" value="{{ request()->get('tanggal') }}">
                                            <input type="text" hidden name="jenis_sewa" value="{{ request()->get('jenis_sewa') }}">
                                            <input type="text" hidden name="waktu" value="{{ join(',', request()->get('waktu', [])) }}">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
