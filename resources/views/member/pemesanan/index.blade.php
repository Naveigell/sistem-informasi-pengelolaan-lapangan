@extends('layouts.member.member')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Pemesanan</h2>
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
                <h4 class="my-12">Tabel pemesanan</h4>
                <div class="mt-4 mb-4">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="table">
                        <thead>
                        <tr>
                            <th class="hidden-phone">No</th>
                            <th class="hidden-phone">Nama Member</th>
                            <th class="hidden-phone">Tanggal Sewa</th>
                            <th class="hidden-phone">Jenis Sewa</th>
                            <th class="hidden-phone">Total Harga</th>
                            <th class="hidden-phone">Batas Waktu</th>
                            <th class="hidden-phone">Status</th>
                            <th class="hidden-phone">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($pemesanans as $pemesanan)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $pemesanan->member->nama_member }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal_sewa)->format('d F Y') }}</td>
                                    <td>{{ $pemesanan->jenis_sewa }}</td>
                                    <td>Rp. {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pemesanan->batas_waktu)->format('d F Y H:i') }}</td>
                                    <td>{{ $pemesanan->status }}</td>
                                    <td>
                                        @if(!in_array($pemesanan->status, ['cancel']))
                                            <a href="{{ route('member.pemesanans.show', $pemesanan) }}" class="btn btn-success btn-sm">Lakukan Pembayaran</a>
                                            <button class="btn btn-danger btn-sm cancel-button" id="{{ $pemesanan->id }}">Batal</button>
                                            <button class="btn btn-warning btn-sm">History Pembayaran</button>
                                        @else
                                            <span>Pemesanan dibatalkan</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Data emtpy</td>
                                </tr>
                            @endforelse
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

@section('script')
    <script>
        const buttons = document.getElementsByClassName('cancel-button');
        for (const button of buttons) {
            button.addEventListener('click', function () {
                Swal.fire({
                    title: `Batalkan pemesanan?`,
                    text: "Pemesanan yang dibatalkan tidak bisa di pulihkan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e74a3b',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: `{{ request()->root() }}/member/pemesanans/${button.id}/cancel`,
                            data: {
                                _method: 'delete',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                Swal.fire(
                                    'Success!',
                                    'Pemesanan berhasil dibatalkan',
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            },
                        });
                    }
                })
            });
        }
    </script>
@endsection
