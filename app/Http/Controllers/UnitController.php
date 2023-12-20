<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $unit = Unit::get();

		return view('unit.index', ['data' => $unit]);
    }

    public function tambah()
	{
		return view('unit.form');
	}
    
    public function simpan(Request $request)
    {
        $data = [
            'nama_unit'     => $request->nama_unit,
            // 'nomor_telepon' => $request->nomor_telepon,
            // 'email'         => $request->email,
        ];

        Unit::create($data);

		return redirect()->route('unit');
    }

    public function edit($id)
	{
		$unit = Unit::findOrFail($id);
		

		return view('unit.form', ['unit' => $unit]);
	}

    public function update($id, Request $request)
	{
		$data = [
			'nama_unit'     => $request->nama_unit,
            // 'nomor_telepon' => $request->nomor_telepon,
            // 'email'         => $request->email,
		];

		Unit::find($id)->update($data);

		return redirect()->route('unit');
	}

    public function hapus($id)
	{
		Unit::find($id)->delete();

		return redirect()->route('unit');
	}


}
