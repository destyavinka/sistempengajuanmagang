<?php

namespace App\Http\Controllers;

use App\Models\Penyelenggara;
use App\Http\Requests\StorePenyelenggaraRequest;
use App\Http\Requests\UpdatePenyelenggaraRequest;
use Illuminate\Http\Request;

class PenyelenggaraController extends Controller
{
    public function index()
    {
        $penyelenggara = Penyelenggara::get();

        return view('penyelenggara.index', ['data' => $penyelenggara]);
    }

    public function tambah()
    {
        return view('penyelenggara.form');
    }

    public function simpan(Request $request)
    {
        $data = [
            'penyelenggara'          => $request->penyelenggara,
            // 'user_id' =>  $request->user()->id   
        ];

        // dd($data);

        Penyelenggara::insert($data);

        return redirect()->route('penyelenggara');
    }

    public function edit($id)
    {
        $penyelenggara = Penyelenggara::findOrFail($id);


        return view('penyelenggara.form', ['penyelenggara' => $penyelenggara]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'penyelenggara'          => $request->penyelenggara
            
        ];

        Penyelenggara::find($id)->update($data);

        return redirect()->route('penyelenggara');
    }

    public function hapus($id)
    {
        Penyelenggara::find($id)->delete();

        return redirect()->route('penyelenggara');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenyelenggaraRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenyelenggaraRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penyelenggara  $penyelenggara
     * @return \Illuminate\Http\Response
     */
    public function show(Penyelenggara $penyelenggara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penyelenggara  $penyelenggara
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penyelenggara  $penyelenggara
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penyelenggara $penyelenggara)
    {
        //
    }
}
