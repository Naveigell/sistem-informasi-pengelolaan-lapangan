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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $pemesanans = Pemesanan::with('member', 'pembayarans')->where('member_id', auth('member')->id())->get();

        return view('member.pemesanan.index', compact('pemesanans'));
    }

    public function history(Pemesanan $pemesanan)
    {
        $pemesanan->load('latestPembayaran', 'sesiPemesanan.sesi.lapangan', 'member');

        return view('member.pemesanan.history', compact('pemesanan'));
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
     * @return string|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function store(PemesananRequest $request)
    {
        $duration  = 0;

        \DB::beginTransaction();
        try {
            $times      = [];
            $lapangan   = Lapangan::query()->findOrFail($request->get('id'));
            $pemesanan  = new Pemesanan([
                "member_id"    => auth('member')->id(),
                "karyawan_id"  => 1,
                "tanggal_sewa" => $request->get('tanggal'),
                "jenis_sewa"   => $request->get('jenis_sewa'),
                "total_harga"  => $request->get('jenis_sewa') == 'reguler' ? count($request->get('waktu', [])) * config('static.minimum_rent', 2) * $lapangan->harga_reguler : $lapangan->harga_turnamen,
                "total_durasi" => $request->get('jenis_sewa') == 'reguler' ? count($request->get('waktu', [])) * config('static.minimum_rent', 2) : 0,
                "batas_waktu"  => now()->addDay()->toDateTimeString(),
                "status"       => "open",
            ]);
            $pemesanan->save();

            // if jenis sewa is reguler
            if (array_key_exists('waktu', $request->validated())) {
                foreach ($request->validated()['waktu'] as $index => $time) {
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

                    $duration += 2;

                    // if we are in the first time, create time limit
                    // from it and add 4 hour into it
                    if ($index == 0) {
                        $timeLimit = $time + 4;

                        if ($pemesanan->tanggal_sewa == date('Y-m-d')) {

                            $pemesanan->batas_waktu = Carbon::createFromTime($timeLimit);
                        } else {
                            $pemesanan->batas_waktu = Carbon::parse($pemesanan->tanggal_sewa)->setHour($timeLimit);
                        }
                    }
                }

                $pemesanan->save();
            } else { // if jenis sewa is event
                $sesi = new Sesi([
                    "lapangan_id" => $request->get('id'),
                    "nama_sesi"   => \Str::random(15),
                    "jam_mulai"   => Carbon::createFromTime(0),
                    "jam_selesai" => Carbon::createFromTime(0),
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

            return $exception->getMessage();
        }

        $total = $request->get('jenis_sewa') == 'reguler' ? count($request->get('waktu', [])) * config('static.minimum_rent', 2) * $lapangan->harga_reguler : $lapangan->harga_turnamen;

        return view('member.lapangan.confirm-booking-success', compact('lapangan', 'total', 'duration'));
    }

    public function confirmation(PemesananRequest $request, Lapangan $lapangan)
    {
        return view('member.lapangan.confirm-booking', compact('lapangan'));
    }

    /**
     * Display the specified resource.
     *
     * @param Pemesanan $pemesanan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Pemesanan $pemesanan)
    {
        return view('member.pemesanan.detail', compact('pemesanan'));
    }

    public function detail(Pemesanan $pemesanan)
    {
        return view('member.pemesanan.detail-pemesanan', compact('pemesanan'));
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

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function cancel(Pemesanan $pemesanan)
    {
        $this->authorize('canCancel', [$pemesanan]);

        $pemesanan->cancel();

        return response()->json([], 204);
    }
}
