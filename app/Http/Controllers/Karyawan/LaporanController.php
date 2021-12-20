<?php

namespace App\Http\Controllers\Karyawan;

use App\Exports\KasExcelExports;
use App\Exports\PembayaranExcelExports;
use App\Exports\PemesananExcelExports;
use App\Http\Controllers\Controller;
use App\Models\Kas;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index(Request $request)
    {
        $kas = [];
        $pemesanans = [];

        if ($request->filled('from') && $request->filled('to')) {

            if ($request->filled('type')) {

                if ($request->get('type') === 'kas') {

                    $kas = Kas::with('karyawan')->latest()->whereBetween('tanggal_transaksi', [\request()->get('from'), \request()->get('to')])->get();
                } elseif ($request->get('type') === 'pemesanan') {

//                    $pemesanans = Pembayaran::with('pemesanan')->latest()->where('status', Pembayaran::VALID)->whereBetween('tanggal_pembayaran', [\request()->get('from'), \request()->get('to')])->get();
                    $pemesanans = Pemesanan::with('member')->whereHas('pembayaran', function ($query) {
                        $query->where('status', Pembayaran::VALID);
                    })->latest()->whereBetween('tanggal_sewa', [\request()->get('from'), \request()->get('to')])->get();
                }
            }
        }

        return view('karyawan.pages.laporan.index', compact('kas', 'pemesanans'));
    }

    public function print(Request $request)
    {
        if ($request->get('type') === 'kas') {

            $from = \request()->get('from');
            $to   = \request()->get('to');

            return Excel::download(new KasExcelExports($from, $to), 'Laporan kas.xlsx');
        } elseif ($request->get('type') === 'pemesanan') {

            $from = \request()->get('from');
            $to   = \request()->get('to');

            return Excel::download(new PemesananExcelExports($from, $to), 'Laporan pemesanan.xlsx');
        }

        abort(404);
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
