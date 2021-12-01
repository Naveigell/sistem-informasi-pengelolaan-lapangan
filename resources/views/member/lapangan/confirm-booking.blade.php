@extends('layouts.member.member')

@section('content')
    <?php
    /**
     * @var \App\Models\Lapangan $field
     */
    ?>
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
                                            <td>Rp. {{ number_format($lapangan->harga_reguler, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>{{ request()->get('tanggal') }}</td>
                                        <td>-</td>
                                        <td>{{ request()->get('jenis_sewa') }}</td>
                                        <td>Rp. {{ number_format($lapangan->harga_event, 0, ',', '.') }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="3">Total</td>
                                    @if(request('jenis_sewa') == 'reguler')
                                        <td>Rp. {{ number_format($lapangan->harga_reguler * count(request('waktu', [])), 0, ',', '.') }}</td>
                                    @else
                                        <td>Rp. {{ number_format($lapangan->harga_event, 0, ',', '.') }}</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                            <h5 class="card-title">Konfirmasi booking</h5>
                            <span class="text text-info" style="font-size: 14px;">Klik tombol <b>pesan</b> untuk mengkonfirmasi pemesanan</span>
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
@endsection
