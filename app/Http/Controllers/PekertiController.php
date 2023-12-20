<?php

namespace App\Http\Controllers;

use App\Models\Pekerti;
use App\Http\Requests\StorePekertiRequest;
use App\Http\Requests\UpdatePekertiRequest;
use Illuminate\Http\Request;

class PekertiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pekerti = Pekerti::get();

        return view('pekerti.index', ['data' => $pekerti]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah()
    {
        return view('pekerti.form');
    }

    public function simpan(Request $request)
    {
        $file =  $request->file('sertifikat');
        $nama_file = $file->getClientOriginalName();
        $file->storeAs('pekerti', $nama_file, 'public');
        $data = [
            'tgl_pelaksanaan'  => $request->tgl_pelaksanaan,
            'sertifikat'      => $nama_file,
            'status_pekerti'   => $request->status_pekerti,
            'user_id' =>  $request->user()->id
        ];

        // dd($data);

        Pekerti::insert($data);

        return redirect()->route('pekerti.index');
    }

    public function edit($id)
    {
        $pekerti = Pekerti::findOrFail($id);


        return view('pekerti.form', ['pekerti' => $pekerti]);
    }

    public function update($id, Request $request)
    {
        $file =  $request->file('sertifikat');
        $nama_file = $file->getClientOriginalName();
        $file->storeAs('pekerti', $nama_file, 'public');
        $data = [
            'tgl_pelaksanaan'  => $request->tgl_pelaksanaan,
            'sertifikat'      => $nama_file,
            'status_pekerti'   => $request->status_pekerti,
        ];

        Pekerti::find($id)->update($data);

        return redirect()->route('pekerti.index');
    }

    public function hapus($id)
    {
        Pekerti::find($id)->delete();

        return redirect()->route('pekerti.index');
    }
}
