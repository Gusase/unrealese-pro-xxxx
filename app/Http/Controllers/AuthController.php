<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(SignupRequest $request)
    {
        $validated = $request->validated();
        $validated = $request->safe()->only(['fullname', 'username', 'email', 'password']);
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        session()->flash('berhasil', 'Berhasil membuat akun');
        return redirect('signin');
    }

    public function signin()
    {
        $user = User::where('email', request()->username_email)->orWhere('username', request()->username_email)->first();

        if (!$user) {
            session()->flash('gagal', 'Username atau password salah');
            session()->flash('username_email', request()->username_email);
            return back()->withInput(['username_email', request()->username_email]);
        }

        $data = [
            'email' => $user->email,
            'password' => request()->password
        ];


        if (Auth::attempt($data)) {
            if ($user->status == 1 || $user->status == 2) {
                request()->session()->regenerate();
                return redirect()->intended();
            } else {
                session()->flash('gagal', 'Akun belum aktif, harap hubungi administrator');
                session()->flash('username_email', request()->username_email);
                return back()->withInput(['username_email', request()->username_email]);
            }
        }

        session()->flash('gagal', 'Username atau password salah');
        session()->flash('username_email', request()->username_email);
        return back()->withInput(['username_email', request()->username_email]);
    }

    public function signout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return to_route('signin');
    }
}
