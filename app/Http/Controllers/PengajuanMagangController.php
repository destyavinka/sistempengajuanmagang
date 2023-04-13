<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan_magang;
use App\Http\Requests\StorePengajuan_magangRequest;
use App\Http\Requests\UpdatePengajuan_magangRequest;
use Illuminate\Http\Request;

class PengajuanMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajuan_magang = Pengajuan_magang::get();

        return view('pengajuan_magang.index', ['data' => $pengajuan_magang]);
    }

    public function tambah()
    {
        return view('pengajuan_magang.form');
    }

    public function simpan(Request $request)
    {
        $data = [
            'topik_magang'          => $request->topik_magang,
            'skema_id'                 => $request->skema,
            'instansi_id'              => $request->instansi,
            'tgl_mulai'             => $request->tgl_mulai,
            'tgl_selesai'           => $request->tgl_selesai,
            'anggaran'              => $request->anggaran,
            'status_pengajuanmagang' => $request->status_pengajuanmagang,
            'user_id' =>  $request->user()->id
        ];

        // dd($data);

        Pengajuan_magang::insert($data);

        return redirect()->route('pengajuan_magang');
    }

    public function edit($id)
    {
        $pengajuan_magang = Pengajuan_magang::findOrFail($id);


        return view('pengajuan_magang.form', ['pengajuan_magang' => $pengajuan_magang]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'topik_magang'          => $request->topik_magang,
            'skema'                 => $request->skema,
            'instansi'              => $request->instansi,
            'tgl_mulai'             => $request->tgl_mulai,
            'tgl_selesai'           => $request->tgl_selesai,
            'anggaran'              => $request->anggaran,
            'status_pengajuanmagang' => $request->status_pengajuanmagang,
        ];

        Pengajuan_magang::find($id)->update($data);

        return redirect()->route('pengajuan_magang');
    }

    public function hapus($id)
    {
        Pengajuan_magang::find($id)->delete();

        return redirect()->route('pengajuan_magang');
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
     * @param  \App\Http\Requests\StorePengajuan_magangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengajuan_magangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengajuan_magang  $pengajuan_magang
     * @return \Illuminate\Http\Response
     */
    public function show(Pengajuan_magang $pengajuan_magang)
    {
        //
    }
}
