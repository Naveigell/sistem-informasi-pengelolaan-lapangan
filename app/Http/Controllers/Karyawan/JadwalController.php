<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Models\Pemesanan;
use App\Models\Sesi;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Pemesanan::with('sesiPemesanan.sesi.lapangan', 'member')->where('status', 'paid')->orderBy('tanggal_sewa');

        if ($request->filled('filter')) {
            $filter = $request->get('filter');

            if ($filter === 'akan-berlangsung') {
                $query->whereDate('tanggal_sewa', '>', now()->toDateString());
            } elseif ($filter === 'selesai') {
                $query->whereDate('tanggal_sewa', '<', now()->toDateString());
            }
        }

        $pemesanans = $query->get();

        return view('karyawan.pages.jadwal.index', compact('pemesanans'));
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
     * @param int $id
     * @param Lapangan $lapangan
     * @param Sesi $sesi
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id, Lapangan $lapangan, Sesi $sesi)
    {
        $pemesanan = Pemesanan::with('member')->where('id', $id)->firstOrFail();

        return view('karyawan.pages.jadwal.detail', compact('pemesanan', 'lapangan', 'sesi'));
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
