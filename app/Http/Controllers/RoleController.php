<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $role = Role::get();

		return view('role.index', ['data' => $role]);
    }

    public function tambah()
	{
		return view('role.form');
	}
    
    public function simpan(Request $request)
    {
        $data = [
            'role'     => $request->role,
        ];

        Role::create($data);

		return redirect()->route('role');
    }

    public function edit($id)
	{
		$role = Role::findOrFail($id);
		

		return view('role.form', ['role' => $role]);
	}

    public function update($id, Request $request)
	{
		$data = [
			'role'     => $request->role,
		];

		Role::find($id)->update($data);

		return redirect()->route('role');
	}

    public function hapus($id)
	{
		Role::find($id)->delete();

		return redirect()->route('role');
	}
}
