<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\PemesananRequest;
use App\Models\Lapangan;
use App\Models\Pemesanan;
use App\Models\Sesi;
use App\Models\SesiPemesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PemesananController extends Controller
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
     * @param PemesananRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PemesananRequest $request)
    {
        \DB::beginTransaction();
        try {
            dump($request->validated());

            $times      = [];
            $pemesanan  = new Pemesanan([
                "member_id"    => auth('member')->id(),
                "karyawan_id"  => 1,
                "tanggal_sewa" => $request->get('tanggal'),
                "jenis_sewa"   => $request->get('jenis_sewa'),
                "total_harga"  => 0,
                "status"       => "open",
            ]);
            $pemesanan->save();

            foreach ($request->validated()['waktu'] as $time) {
                $sesi = new Sesi([
                    "lapangan_id" => $request->get('id'),
                    "nama_sesi"   => \Str::random(15),
                    "jam_mulai"   => Carbon::createFromTime($time),
                    "jam_selesai" => Carbon::createFromTime($time + 2),
                ]);
                $sesi->save();

                $times[] = [
                    "pemesanan_id" => $pemesanan->id,
                    "sesi_id"      => $sesi->id,
                    "created_at"   => now()->toDateTimeString(),
                    "updated_at"   => now()->toDateTimeString(),
                ];
            }

            SesiPemesanan::query()->insert($times);

            \DB::commit();
        } catch (\Exception $exception) {
            \DB::rollBack();
        }
    }

    public function confirmation(PemesananRequest $request, Lapangan $lapangan)
    {
        return view('member.lapangan.confirm-booking', compact('lapangan'));
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
     * @param Request $request
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
