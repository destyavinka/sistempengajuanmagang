<?php

namespace App\Http\Controllers;

use App\Models\Pekerti;
use App\Http\Requests\StorePekertiRequest;
use App\Http\Requests\UpdatePekertiRequest;

class PekertiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorePekertiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePekertiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pekerti  $pekerti
     * @return \Illuminate\Http\Response
     */
    public function show(Pekerti $pekerti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pekerti  $pekerti
     * @return \Illuminate\Http\Response
     */
    public function edit(Pekerti $pekerti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePekertiRequest  $request
     * @param  \App\Models\Pekerti  $pekerti
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePekertiRequest $request, Pekerti $pekerti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pekerti  $pekerti
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pekerti $pekerti)
    {
        //
    }
}
