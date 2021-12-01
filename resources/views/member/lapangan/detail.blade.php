@extends('layouts.member.member')

@section('content')
    <?php
        /**
         * @var \App\Models\Lapangan $lapangan
         * @var \Illuminate\Support\MessageBag $errors
         * @var \Illuminate\Support\Collection<\App\Models\Lapangan> $pemesanan
         */
        /**
         * @param int $hour
         * @param \App\Models\Pemesanan|null $pemesanan
         * @return bool
         */
        function hasBooked(int $hour, \App\Models\Pemesanan $pemesanan = null): bool {
            if (!$pemesanan) {
                return false;
            }

            $filtered = $pemesanan->sesiPemesanan->filter(function ($item) use ($hour) {
                if (!$item->sesi) {
                    return false;
                }

                return $hour >= \Carbon\Carbon::parse($item->sesi->jam_mulai)->hour && $hour < \Carbon\Carbon::parse($item->sesi->jam_selesai)->hour;
            });

            return $filtered->count() > 0;
        }

        $isEvent = $pemesanan && $pemesanan->jenis_sewa === 'event';
    ?>
    <!-- Masthead-->
    <header class="masthead" style="background-image: url({{ $lapangan->foto_url }})">
        <div class="container">
            <div class="masthead-heading text-uppercase">{{ $lapangan->nama_lapangan }}</div>
            <div class="masthead-subheading">
                {{--            Deskripsi lapangan--}}
            </div>
        </div>
    </header>
    <!-- Services-->
    <section class="page-section" id="services">
        <form action="{{ route('member.pemesanans.confirm', $lapangan) }}" method="post">
            @csrf
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Jadwal</h2>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ request()->has('date') ? request()->query('date') : '' }}">
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </div>
                </div>

                @if($errors->any())
                    @foreach($errors->all() as $message)
                        <script>alert('{{ $message }}');</script>
                    @endforeach
                @endif
                <div class="row mt-5" id="time">
                    <div class="col-md-1"></div>
                    <div class="col-md-12 text-left">
                        <h4 class="my-12">Pilih Waktu</h4>
                        @if(!$isEvent)
                            <div class="mt-4">
                                @for($i = 8; $i < 20; $i += 2)
                                    <div class="card bg-light mb-3 inline-block col-2" style="display: inline-block;">
                                        <div class="card-header">
                                            {{ $i }}.00 - {{ $i + 2 }}.00
                                        </div>
                                        <div class="card-body">
                                            @if(!hasBooked($i, $pemesanan))
                                                <input class="checkboxes" name="waktu[]" value="{{ $i }}" type="checkbox" style="width: 18px; height: 18px;" id="time-{{ $i }}">
                                                <label for="time-{{ $i }}">Pilih</label>
                                            @else
                                                <label>Penuh!</label>
                                            @endif
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        @else
                            <div class="mt-4 alert-danger alert">
                                Telah dibooking untuk event
                            </div>
                        @endif
                    </div>
                    <div class="col-md-1"></div>
                </div>
                @unless($isEvent)
                    <div class="row mt-5">
                        <div class="col-md-1"></div>
                        <div class="col-md-12 text-left">
                            <h4 class="my-12">Jenis</h4>
                            <div class="mt-4">
                                <div class="form-group d-inline-block">
                                    <input name="jenis_sewa" value="event" type="radio" id="event">
                                    <label for="event">Event</label>
                                </div>
                                <div class="form-group d-inline-block">
                                    <input name="jenis_sewa" value="reguler" type="radio" id="reguler">
                                    <label for="reguler">Reguler</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-1"></div>
                        <div class="col-md-12 text-left">
                            <h4 class="my-12">Harga</h4>
                            <div class="mt-4">
                                <div class="form-group d-inline-block col-12">
                                    <input name="" type="text" disabled id="harga" class="form-control" checked>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-1"></div>
                        <div class="col-md-12 text-left">
                            <h4 class="my-12">Total Bayar</h4>
                            <div class="mt-4">
                                <div class="form-group d-inline-block col-12">
                                    <input name="" type="text" disabled id="total" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-info btn-lg">
                            Booking
                        </button>
                    </div>
                @endunless
            </div>
            <input type="text" name="id" value="{{ $lapangan->id }}" hidden>
        </form>
    </section>
@endsection

@section('script')
    <script>
        const checkboxes = $(".checkboxes");
        const time = $("#time");
        const date = $("#tanggal");
        let bookingType;

        $('input[name="jenis_sewa"]').change(function (evt) {
            bookingType = evt.target.value;
        });

        let event = $("#event");
        let reguler = $("#reguler");
        let harga = 0;

        event.on('change', function (evt) {
            if (evt.target.checked) {
                harga = '{{ $lapangan->harga_turnamen }}';
                time.hide();
                displayPrice();
            }
        });

        date.on('change', function (evt) {
            window.location.href = '{{ route("member.lapangans.show", $lapangan) }}?date=' + evt.target.value;
        })

        reguler.on('change', function (evt) {
            if (evt.target.checked) {
                harga = '{{ $lapangan->harga_reguler }}';
                time.show();
                displayPrice();
            }
        });

        checkboxes.on('change', function (evt) {
            displayPrice();
        });

        function displayPrice(){
            $("#harga").val(harga);

            if (bookingType === 'reguler') {
                $("#total").val(harga * 2 * bookingCount());
            } else {
                $("#total").val(harga);
            }
        }

        function bookingCount() {
            return checkboxes.filter(function (item) {
                return checkboxes[item].checked;
            }).length;
        }
    </script>
@endsection