<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Http\Requests\StoreInstansiRequest;
use App\Http\Requests\UpdateInstansiRequest;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function index()
    {
        $instansi = Instansi::get();

        return view('instansi.index', ['data' => $instansi]);
    }

    public function tambah()
    {
        return view('instansi.form');
    }

    public function simpan(Request $request)
    {
        $data = [
            'nama_instansi'          => $request->nama_instansi,
            // 'user_id' =>  $request->user()->id   
        ];

        // dd($data);

        Instansi::insert($data);

        return redirect()->route('instansi');
    }

    public function edit($id)
    {
        $instansi = Instansi::findOrFail($id);


        return view('instansi.form', ['instansi' => $instansi]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'nama_instansi'          => $request->nama_instansi
            
        ];

        Instansi::find($id)->update($data);

        return redirect()->route('instansi');
    }

    public function hapus($id)
    {
        Instansi::find($id)->delete();

        return redirect()->route('instansi');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInstansiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInstansiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function show(Instansi $instansi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instansi $instansi)
    {
        //
    }
}
