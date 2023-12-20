<?php

namespace App\Http\Controllers;

use App\Models\Jenis_sertifikasi;
use App\Http\Requests\StoreJenis_sertifikasiRequest;
use App\Http\Requests\UpdateJenis_sertifikasiRequest;
use Illuminate\Http\Request;

class JenisSertifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_sertifikasi = Jenis_sertifikasi::get();

        return view('jenis_sertifikasi.index', ['data' => $jenis_sertifikasi]);
    }

    public function tambah()
    {
        return view('jenis_sertifikasi.form');
    }

    public function simpan(Request $request)
    {
        $data = [
            'jenis_sertifikasi'          => $request->jenis_sertifikasi,
            // 'user_id' =>  $request->user()->id   
        ];

        // dd($data);

        Jenis_sertifikasi::insert($data);

        return redirect()->route('jenis_sertifikasi');
    }

    public function edit($id)
    {
        $jenis_sertifikasi = Jenis_sertifikasi::findOrFail($id);


        return view('jenis_sertifikasi.form', ['jenis_sertifikasi' => $jenis_sertifikasi]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'jenis_sertifikasi'          => $request->jenis_sertifikasi
            
        ];

        Jenis_sertifikasi::find($id)->update($data);

        return redirect()->route('jenis_sertifikasi');
    }

    public function hapus($id)
    {
        Jenis_sertifikasi::find($id)->delete();

        return redirect()->route('jenis_sertifikasi');
    }


    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJenis_sertifikasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJenis_sertifikasiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jenis_sertifikasi  $jenis_sertifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Jenis_sertifikasi $jenis_sertifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jenis_sertifikasi  $jenis_sertifikasi
     * @return \Illuminate\Http\Response
     */

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jenis_sertifikasi  $jenis_sertifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jenis_sertifikasi $jenis_sertifikasi)
    {
        //
    }
}
