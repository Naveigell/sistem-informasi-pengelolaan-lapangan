<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Karyawan\KasRequest;
use App\Models\Kas;
use Illuminate\Http\Request;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $kas = Kas::with('karyawan')->get();

        return view('karyawan.pages.kas.index', compact('kas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('karyawan.pages.kas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param KasRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(KasRequest $request)
    {
        $input = $request->validated();

        $kas = new Kas($input);
        $kas->fill([
            "karyawan_id" => auth('karyawan')->id(),
            "nilai"       => $request->get('nilai', 0),
        ]);
        $kas->save();

        return redirect(route('karyawan.kas.index'))->with('success', 'Kas berhasil dibuat');
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
     * @param Kas $ka
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Kas $ka)
    {
        return view('karyawan.pages.kas.edit', [
            "kas" => $ka
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param KasRequest $request
     * @param Kas $ka
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(KasRequest $request, Kas $ka)
    {
        $ka->fill($request->validated());
        $ka->save();

        return redirect(route('karyawan.kas.index'))->with('success', 'Kas berhasil diubah');
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
