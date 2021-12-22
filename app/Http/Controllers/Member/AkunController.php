<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\BiodataRequest;
use App\Http\Requests\Member\PasswordRequest;
use App\Models\Member;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $pemesanans = Pemesanan::with('sesiPemesanan.sesi.lapangan', 'member')->where('status', 'paid')->where('member_id', auth('member')->id())->get();

        return view('member.akun.index', compact('pemesanans'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BiodataRequest $request, $id)
    {
        $member = Member::query()->findOrFail(auth('member')->id());
        $member->fill($request->validated());
        $member->save();

        return back()->with('success-biodata', 'Biodata berhasil diubah');
    }

    public function updatePassword(PasswordRequest $request, $id)
    {
        $member = Member::query()->findOrFail(auth('member')->id());
        $member->update([
            "password" => $request->get('new_password'),
        ]);

        return back()->with('success-password', 'Password berhasil diubah');
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
