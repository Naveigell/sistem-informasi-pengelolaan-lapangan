<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Models\Pemesanan;
use App\Models\Sesi;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param Request $request
     * @param Lapangan $lapangan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Request $request, Lapangan $lapangan)
    {
        $pemesanans = null;

        if ($request->has('date')) {
            $pemesanans = Pemesanan::with('sesiPemesanan.sesi')->whereNotIn('status', [Pemesanan::STATUS_PAID])->whereHas('sesiPemesanan.sesi', function($query) use ($lapangan) {
                $query->where('lapangan_id', $lapangan->id);
            })->whereDate('tanggal_sewa', $request->query('date'))->get();
        }

        return view('member.lapangan.detail', compact('lapangan', 'pemesanans'));
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
