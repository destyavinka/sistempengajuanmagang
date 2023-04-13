<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
	public function register()
	{
		return view('auth/register');
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

		User::create([
			'nama' => $request->nama,
			'nip' => $request->nip,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'level' => $request->level,
			'unit' => $request->unit
		]);

		return redirect()->route('login')->with("success","Hi ".$request->nama.", You Have Successfully Registered");
	}

	public function login()
	{
		return view('auth/login');
	}

	public function loginAksi(Request $request)
	{
		Validator::make($request->all(), [
			'email' => 'required|email',
			'password' => 'required'
		])->validate();

		if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
			throw ValidationException::withMessages([
				'email' => trans('auth.failed')
			]);
		}

		$request->session()->regenerate();

		return redirect()->route('dashboard')->with("success","Login Successfully ");
	}

	public function logout(Request $request)
	{
		Auth::guard('web')->logout();

		$request->session()->invalidate();

		return redirect('/login');
	}
}
