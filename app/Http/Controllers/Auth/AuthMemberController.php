<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Member\LoginRequest;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthMemberController extends Controller
{
    public function login(LoginRequest $request)
    {
        /**
         * @var User $user
         */
        $user = Member::query()->where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                "email" => __('auth.failed', [], 'id')
            ])->withInput();
        }

        if (Hash::check($request->password, $user->password)) {
            \auth('member')->login($user);

            return redirect()->to(route('index'));
        }

        return back()->withErrors([
            "email" => __('auth.password', [], 'id')
        ])->withInput();
    }
}
