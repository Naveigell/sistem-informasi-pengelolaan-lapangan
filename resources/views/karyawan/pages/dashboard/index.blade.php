@extends('layouts.karyawan.karyawan')

@section('content')
    <div class="container">
        <div class="row mt">
            <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <div class="weather-3 pn centered">
                    <i class="fa fa-user"></i>
                    <h1>{{ number_format($totalMember, 0, '', '.') }}</h1>
                    <div class="info">
                        <div class="row">
                            <h3 class="centered">Member</h3>
                            <div class="col-sm-6 col-xs-6 pull-right">
                                <p class="goright"><i class="fa fa-flag"></i> Total</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <div class="weather-3 pn centered" style="background: #1895ec;">
                    <i class="fa fa-map"></i>
                    <h1>{{ number_format($totalLapangan, 0, '', '.') }}</h1>
                    <div class="info">
                        <div class="row">
                            <h3 class="centered">Lapangan</h3>
                            <div class="col-sm-6 col-xs-6 pull-right">
                                <p class="goright"><i class="fa fa-flag"></i> Total</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <div class="weather-3 pn centered" style="background: #3ae01d;">
                    <i class="fa fa-credit-card"></i>
                    <h1>Rp {{ number_format($totalKas, 0, '', '.') }}</h1>
                    <div class="info">
                        <div class="row">
                            <h3 class="centered">Keuangan</h3>
                            <div class="col-sm-6 col-xs-6 pull-right">
                                <p class="goright"><i class="fa fa-flag"></i> Total</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="content-panel" style="padding: 30px;">
            <h3>Grafik penggunaan lapangan bulan ini</h3>
            <canvas id="graph" class="chart-canvas"></canvas>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script>
        /** @param {Array} data */
        const data = @json($lapangans);
        let name = [], total = [];

        for (const datum of data) {
            name.push(datum['nama_lapangan']);
            total.push(datum['total']);
        }

        let ctx = document.getElementById('graph').getContext('2d');
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: name,
                datasets: [{
                    label: 'Lapangan',
                    data: total,
                    backgroundColor: "rgba(57,149,255,0.36)",
                    borderColor: "rgba(88,154,255,0.6)",
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                }
            }
        });
    </script>
@endsection
