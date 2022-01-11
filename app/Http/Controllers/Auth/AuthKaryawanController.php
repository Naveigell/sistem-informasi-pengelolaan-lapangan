<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Karyawan\LoginRequest;
use App\Models\Karyawan;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class AuthKaryawanController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        /**
         * @var User $user
         */
        $user = Karyawan::query()->where('username', $request->username)->first();

        if (!$user) {
            return back()->withErrors([
                "email" => __('auth.failed', '', 'id')
            ])->withInput();
        }

        if ($user->username !== $request->username) {
            return back()->withErrors([
                "username" => __('auth.username', '', 'id')
            ])->withInput();
        }

        if (Hash::check($request->password, $user->password)) {
            \auth('karyawan')->login($user);

            return redirect()->to(route('karyawan.dashboard.index'));
        }

        return back()->withErrors([
            "email" => __('auth.password')
        ])->withInput();
    }
}
