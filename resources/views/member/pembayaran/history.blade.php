@extends('layouts.member.member')

@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="d-flex align-items-center justify-content-center h-100">
                <div class="d-flex flex-column card">
                    <div class="card-body">
                        <h5 class="card-title">History pembayaran</h5>
                        <form action="{{ route('member.pemesanans.store') }}" method="post">
                            @csrf
                            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="table">
                                <thead>
                                <tr>
                                    <th class="hidden-phone">Tanggal</th>
                                    <th class="hidden-phone">Waktu</th>
                                    <th class="hidden-phone">Jenis</th>
                                    <th class="hidden-phone">Harga</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(request('jenis_sewa') == 'reguler')
                                    @foreach(request('waktu') as $time)
                                        <tr>
                                            <td>{{ request()->get('tanggal') }}</td>
                                            <td>{{ $time }}.00 - {{ $time + 2 }}.00</td>
                                            <td>{{ request()->get('jenis_sewa') }}</td>
                                            <td>Rp. {{ number_format($lapangan->harga_reguler * config('static.minimum_rent', 2), 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>{{ request()->get('tanggal') }}</td>
                                        <td>-</td>
                                        <td>{{ request()->get('jenis_sewa') }}</td>
                                        <td>Rp. {{ number_format($lapangan->harga_turnamen, 0, ',', '.') }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="3">Total</td>
                                    @if(request('jenis_sewa') == 'reguler')
                                        <td>Rp. {{ number_format($lapangan->harga_reguler * count(request('waktu', [])) * config('static.minimum_rent', 2), 0, ',', '.') }}</td>
                                    @else
                                        <td>Rp. {{ number_format($lapangan->harga_turnamen, 0, ',', '.') }}</td>
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
{{--                            <button class="btn btn-success btn-sm">Pesan</button>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
