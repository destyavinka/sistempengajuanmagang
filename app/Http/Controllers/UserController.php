<?php

namespace App\Http\Controllers;

use App\Imports\ImportUser;
use App\Models\Role;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $usser = User::get();

        return view('user.index', ['data' => $usser]);
    }

    public function tambah()
    {
        $unit = Unit::get();
        $role = Role::get();
        return view('user.form', ['unit' => $unit, 'role' => $role]);
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'unit' => 'required',
            'nip' => 'required',
            'level' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // $data = [
        //     'nama' => $data['nama'],
        //     'unit' => $data['unit'],
        //     'nip' => $data['nip'],
        //     'level' => $data['level'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ];

        // dd($data);

        User::create([
            'nama' => $data['nama'],
            'unit' => $data['unit'],
            'nip' => $data['nip'],
            'level' => $data['level'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('user');
    }

    public function edit($id)
    {
        $usser = User::findOrFail($id);
        $roles = Role::get();
        return view('user.form', ['user' => $usser, 'role' => $roles]);
    }

    public function update($id, Request $request)
    {
        $data = [
            // 'nama'          => $request->nama
            'level'          => $request->level

        ];

        User::find($id)->update($data);

        return redirect()->route('user');
    }

    public function hapus($id)
    {
        User::find($id)->delete();

        return redirect()->route('user');
    }

    public function importUser(Request $request)
    {


        $importData = Excel::toCollection(new ImportUser, $request->file('file'))[0];
        // dd($importData);
        foreach ($importData as $key => $value) {
            if ($key == 0) continue;

            if (!$value[1] || !$value[2] || !$value[3] || !$value[4] || !$value[5] || !$value[6]) continue;

            User::create([
                'nama' => $value[1],
                'nip' => $value[2],
                'email' => $value[3],
                'password' => Hash::make($value[4]),
                'unit' => $value[5],
                'level' => $value[6],
            ]);
            // dd($value);
        }

        // User::find($id)->delete();

        return redirect()->route('user');
    }
}
