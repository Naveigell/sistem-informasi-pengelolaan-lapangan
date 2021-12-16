<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Karyawan\LapanganRequest;
use App\Models\Lapangan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $lapangans = Lapangan::query()->latest()->get();

        return view('karyawan.pages.lapangan.index', compact('lapangans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('karyawan.pages.lapangan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LapanganRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(LapanganRequest $request)
    {
        $lapangan = new Lapangan($request->validated());
        $lapangan->save();

        return redirect(route('karyawan.lapangans.index'))->with('success', 'Lapangan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param Lapangan $lapangan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Lapangan $lapangan)
    {
        return view('karyawan.pages.lapangan.detail', compact('lapangan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Lapangan $lapangan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Lapangan $lapangan)
    {
        return view('karyawan.pages.lapangan.edit', compact('lapangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LapanganRequest $request
     * @param Lapangan $lapangan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(LapanganRequest $request, Lapangan $lapangan)
    {
        $lapangan->fill($request->validated());
        $lapangan->save();

        return redirect(route('karyawan.lapangans.index'))->with('success', 'Lapangan berhasil diubah');
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
