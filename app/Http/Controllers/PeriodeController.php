<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Http\Requests\StorePeriodeRequest;
use App\Http\Requests\UpdatePeriodeRequest;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = Periode::get();

        return view('periode.index', ['data' => $periode]);
    }

    public function tambah()
    {
        
        return view('periode.form');
    }
    
    public function simpan(Request $request)
    {
        $data = [
            'semester'          => $request->semester,
            'tahun'          => $request->tahun,
            // 'user_id' =>  $request->user()->id   
        ];

        // dd($data);

        Periode::insert($data);

        return redirect()->route('periode');
    }

    public function edit($id)
    {
        $periode = Periode::findOrFail($id);


        return view('periode.form', ['periode' => $periode]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'semester'          => $request->semester,
            'tahun'          => $request->tahun,
            
        ];

        Periode::find($id)->update($data);

        return redirect()->route('periode');
    }

    public function hapus($id)
    {
        Periode::find($id)->delete();

        return redirect()->route('periode');
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
     * @param  \App\Http\Requests\StorePeriodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePeriodeRequest $request)
    {
        //
    }


}
