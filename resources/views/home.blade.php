@extends('layouts.member.member')

@section('content')
    <!-- Masthead-->
    <header class="masthead" style="background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('img/member/header-bg.jpg') }}')">
        <div class="container">
            <div class="masthead-heading text-uppercase">Selamat datang di Sipela!</div>
            @unless(auth('member')->check())
                <div class="masthead-subheading">
                    Silakan login untuk memesan lapangan
                </div>
                <a class="btn btn-primary btn-xl text-uppercase" href="{{ route('member.auth.login.index') }}">Login Member</a>
            @else
                <div class="masthead-subheading">
                    Silakan memesan lapangan yang tersedia
                </div>
            @endunless
        </div>
    </header>
    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">List Lapangan</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
            <div class="row">
                @foreach($lapangans as $lapangan)
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 1-->
                        <div class="portfolio-item">
                            @if(auth('member')->check())
                                <a href="{{ route('member.lapangans.show', $lapangan) }}" class="portfolio-link">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                    </div>
                                    <img class="img-fluid" src="{{ $lapangan->foto_url }}" alt="..." style="max-height: 300px; min-height: 300px; object-fit: cover;"/>
                                </a>
                            @else
                                <div class="portfolio-link">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                    </div>
                                    <img class="img-fluid" src="{{ $lapangan->foto_url }}" alt="..." style="max-height: 300px; min-height: 300px; object-fit: cover;"/>
                                </div>
                            @endif
                            <div class="portfolio-caption">
                                <h6 class="text text-danger" style="text-align: left;">{{ $lapangan->nama_lapangan }}</h6>
                                <div class="portfolio-caption-heading" style="text-align: left;">Harga</div>
                                <div class="portfolio-caption-subheading text-muted" style="text-align: left;">
                                    Reguler : {{ number_format($lapangan->harga_reguler, 0, ',' , '.') }}
                                </div>
                                <div class="portfolio-caption-subheading text-muted" style="text-align: left;">
                                    Turnamen : {{ number_format($lapangan->harga_turnamen, 0, ',' , '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="page-section" id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Peta Lokasi</h2>
                <h3 class="section-subheading text-muted">Berikut merupakan peta lokasi lapangan wangaya</h3>
            </div>
            <div id="map" style="height: 600px; width: 100%;">

            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>

        // default position
        let position = {
            lat: -8.6496383,
            lng: 115.2105341,
        };

        let map, marker;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: position,
            });

            marker = new google.maps.Marker({
                position: position,
                map: map,
                draggable:true,
                animation: google.maps.Animation.DROP,
            });

            const radius = new google.maps.Circle({
                map: map,
                radius: 300, // 30 meter
                fillColor: '#0e92ea',
                strokeColor: '#0e92ea',
            });

            radius.bindTo('center', marker, 'position');

            moveIntoCurrentLocation();
            makeMapListeners();
        }

        function moveIntoCurrentLocation() {
            moveMap(position);
        }

        function makeMapListeners() {
            google.maps.event.addListener(map, 'drag', function (event) {
                position.lng = map.center.lng();
                position.lat = map.center.lat();

                marker.setPosition(position);
            });
        }

        function moveMap(location) {
            map.setCenter(location);
            marker.setPosition(location);
        }
    </script>
@endsection
