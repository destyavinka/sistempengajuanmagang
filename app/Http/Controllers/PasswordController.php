<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function index()
    {
        return view('password.form');
    }

    public function update(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ], [
            'old_password.required' => 'Password lama wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal terdiri dari :min karakter.',
            'confirm_password.required' => 'Konfirmasi password wajib diisi.',
            'confirm_password.same' => 'Konfirmasi password tidak sesuai dengan password baru.',
        ]);

        if (Hash::check($request->old_password, auth()->user()->password)) {
            if ($request->old_password !== $request->new_password) {
                auth()->user()->update([
                    'password' => bcrypt($request->new_password),
                ]);
                return redirect()->back()->with('success', 'Password berhasil diubah.');
            } else {
                return redirect()->back()->with('error', 'Password baru tidak boleh sama dengan password lama.');
            }
        } else {
            return redirect()->back()->with('error', 'Password lama tidak sesuai.');
        }
    }
}
