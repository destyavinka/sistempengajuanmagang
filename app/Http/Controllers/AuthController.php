<?php

namespace App\Http\Controllers;

use App\Mail\SendVerifMail;
use App\Models\Role;
use App\Models\Unit;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        $roles = Role::get();
        $units = Unit::get();
        return view('auth/register', ['roles' => $roles, 'units' => $units]);
    }

    public function registerSimpan(Request $request)
    {
        Validator::make($request->all(), [
            'nama' => 'required',
            'nip' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'level' => 'required',
        ])->validate();

        $dataOfRegisterNow = User::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'unit' => $request->unit,
        ]);

        $dataOfUserVerifyNow = UserVerify::create([
            'user_id' => $dataOfRegisterNow->id,
            'token' => Str::random(64),
        ]);

        if ($dataOfUserVerifyNow) {
            Mail::to($dataOfRegisterNow->email)->send(new SendVerifMail($dataOfUserVerifyNow->token));
        }
        return redirect()->route('login')->with("info", "Anda perlu mengkonfirmasi akun Anda. Kami telah mengirimkan link aktivasi, silakan periksa email Anda.");
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginAksi(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();
        $data = User::get();
        return redirect()->route('dashboard', ['data' => $data])->with("success", "Login Successfully ");
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }

    public function verifEmail($tokenVerif)
    {
        $verifyUser = UserVerify::where('token', $tokenVerif)->first();
        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $userData = $verifyUser->userData;

            if (!$userData->is_email_verified) {
                $verifyUser->userData->is_email_verified = 1;
                $verifyUser->userData->save();
                $message = "Email Anda telah diverifikasi. Anda sekarang dapat masuk.";
            } else {
                $message = "Email Anda sudah diverifikasi. Anda sekarang dapat masuk.";
            }
        }

        return redirect()->route('login')->with('success', $message);
    }
}
