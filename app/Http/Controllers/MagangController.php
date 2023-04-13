<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Http\Requests\StoreMagangRequest;
use App\Http\Requests\UpdateMagangRequest;
use Illuminate\Http\Request;

class MagangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $magang = Magang::get();

        return view('magang.index', ['data' => $magang]);
    }

    public function tambah()
    {
        return view('magang.form');
    }

    public function simpan(Request $request)
    {
        $data = [
            'topik_magang'  => $request->topik_magang,
            'skema_id'      => $request->skema,
            'instansi_id'   => $request->instansi,
            'tgl_penerbitan'=> $request->tgl_penerbitan,
            'masa_berlaku'  => $request->masa_berlaku,
            'sertifikat'    => $request->sertifikat,
            'status_magang' => $request->status_magang,
            'user_id' =>  $request->user()->id
        ];

        // dd($data);

        Magang::insert($data);

        return redirect()->route('magang');
    }

    public function edit($id)
    {
        $magang = Magang::findOrFail($id);


        return view('magang.form', ['magang' => $magang]);
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
            'status_magang' => $request->status_magang,
        ];

        Magang::find($id)->update($data);

        return redirect()->route('magang');
    }

    public function hapus($id)
    {
        Magang::find($id)->delete();

        return redirect()->route('magang');
    }

}
