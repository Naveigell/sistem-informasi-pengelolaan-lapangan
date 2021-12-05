<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Kas;
use App\Models\Lapangan;
use App\Models\Member;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $totalMember   = Member::count();
        $totalLapangan = Lapangan::count();
        $totalKas      = Kas::where('jenis', 'debit')->sum('nilai');

        $pemesanans = Pemesanan::with('sesiPemesanan.sesi.lapangan', 'member')->whereMonth('tanggal_sewa', now()->month)->whereYear('tanggal_sewa', now()->year)->where('status', 'paid')->get();

        $collections = [];

        foreach ($pemesanans as $pemesanan) {
            foreach ($pemesanan->sesiPemesanan as $sesiPemesanan) {
                if (array_key_exists($sesiPemesanan->sesi->lapangan->id, $collections)) {
                    $collections[$sesiPemesanan->sesi->lapangan->id]['total'] += 1;
                } else {
                    $collections[$sesiPemesanan->sesi->lapangan->id] = [
                        "nama_lapangan" => $sesiPemesanan->sesi->lapangan->nama_lapangan,
                        "total"         => 1,
                        "id"            => $sesiPemesanan->sesi->lapangan->id,
                    ];
                }
            }
        }

        $collections = collect($collections);
        $lapangans   = [];

        foreach (Lapangan::all() as $lapangan) {
            if (!array_key_exists($lapangan->id, $collections->toArray())) {
                $lapangans[] = [
                    "nama_lapangan" => $lapangan->nama_lapangan,
                    "total"         => 0,
                ];
            } else {
                $lapangans[] = [
                    "nama_lapangan" => $lapangan->nama_lapangan,
                    "total"         => $collections->toArray()[$lapangan->id]['total'],
                ];
            }
        }

        return view('karyawan.pages.dashboard.index', compact('lapangans', 'totalKas', 'totalLapangan', 'totalMember'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
