<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use App\Http\Requests\StoreSkemaRequest;
use App\Http\Requests\UpdateSkemaRequest;
use Illuminate\Http\Request;

class SkemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skema = Skema::get();

        return view('skema.index', ['data' => $skema]);
    }

    public function tambah()
    {
        return view('skema.form');
    }

    public function simpan(Request $request)
    {
        $data = [
            'nama_skema'          => $request->nama_skema,
            // 'user_id' =>  $request->user()->id   
        ];

        // dd($data);

        Skema::insert($data);

        return redirect()->route('skema');
    }

    public function edit($id)
    {
        $skema = Skema::findOrFail($id);


        return view('skema.form', ['skema' => $skema]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'nama_skema'          => $request->nama_skema
            
        ];

        Skema::find($id)->update($data);

        return redirect()->route('skema');
    }

    public function hapus($id)
    {
        Skema::find($id)->delete();

        return redirect()->route('skema');
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
     * @param  \App\Http\Requests\StoreSkemaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSkemaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skema  $skema
     * @return \Illuminate\Http\Response
     */
    public function show(Skema $skema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skema  $skema
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skema  $skema
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skema $skema)
    {
        //
    }
}
