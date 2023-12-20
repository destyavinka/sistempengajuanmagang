<?php

namespace App\Http\Controllers;

use App\Models\Pekertian;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PekertianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pekerti = Pekertian::get();

        $nama_unit = User::select('unit')
        ->where('id', Auth::user()->id)
        ->first();

        if (Auth::user()->level == 'Dekan'){
            $pekerti = Pekertian::where('status_pekerti', '!=', 'Belum Disetujui')->get();
        } 
        else if(Auth::user()->level == 'Kaprodi'){
            $pekerti = Pekertian::select('pekertians.*')
            ->join('users', 'pekertians.user_id', '=', 'users.id')
            ->where('users.level', 'Tenaga Pendidik')
            ->get();
        } 
        else if(Auth::user()->level == 'Admin Sekolah Vokasi'){
            $pekerti = Pekertian::select('pekertians.*')
            ->join('users', 'pekertians.user_id', '=', 'users.id')
            ->where('users.level', 'Tenaga Kependidikan')
            ->get();
        }
        else{
            $pekerti = Pekertian::select('pekertians.*')
        ->join('users', 'pekertians.user_id', '=', 'users.id')
        ->where('users.unit', $nama_unit->unit)
        ->get();
        }          
        return view('pekertian.index', ['data' => $pekerti]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('pekertian.form', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simpan(Request $request)
    {$file =  $request->file('sertifikat');
        $nama_file = $file->getClientOriginalName();
        $file->storeAs('pekerti', $nama_file, 'public');
        // $data = [
        //     'nomor_sertifikat' => $request->nomor_sertifikat,
        //     'tgl_pelaksanaan'  => $request->tgl_pelaksanaan,
        //     'sertifikat'      => $nama_file,
        //     'tgl_penerbitan' => $request->tgl_penerbitan,
        //     'status_pekerti'   => $request->status_pekerti,

        //     'user_id' =>  $request->user()->id
        // ];

        if($request->seumur_hidup == 'on'){
            $data = [
                'nomor_sertifikat' => $request->nomor_sertifikat,
                'tgl_pelaksanaan'  => $request->tgl_pelaksanaan,
                'sertifikat'      => $nama_file,
                'tgl_penerbitan' => $request->tgl_penerbitan,
                'status_pekerti'   => $request->status_pekerti,
                'status_seumur_hidup' => 1,
                'user_id' =>  $request->user()->id,  
            ];
        }
        else{
            $data = [
                'nomor_sertifikat' => $request->nomor_sertifikat,
                'tgl_pelaksanaan'  => $request->tgl_pelaksanaan,
                'sertifikat'      => $nama_file,
                'tgl_penerbitan' => $request->tgl_penerbitan,
                'status_pekerti'   => $request->status_pekerti,
                'masa_berlaku'  => $request->masa_berlaku,
                'status_seumur_hidup' => 0,
                'user_id' =>  $request->user()->id,
            ];
        }

        // dd($data);

        Pekertian::insert($data);

        return redirect()->route('pekertian.index');
    }

    public function updateverif(Request $request)
    {
        // dd($request);
        if($request->statusAwalMod == "Belum Disetujui"){
            $id = $request->pekertianID;
            $data = [
                'status_pekerti'          => $request->verifikasi,
            ];
            Pekertian::find($id)->update($data);
        }
        else if($request->statusAwalMod == "Menunggu Validasi"){
            $id = $request->pekertianID;
            $data = [
                'status_pekerti'          => $request->verifikasi,
            ];
            Pekertian::find($id)->update($data);
        }
        return redirect()->route('magang');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $user = User::where('id', Auth::user()->id)->first();
            $pekerti = Pekertian::findOrFail($id);
    
    
            return view('pekertian.form', ['pekerti' => $pekerti, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { $file =  $request->file('sertifikat');
        $nama_file = $file->getClientOriginalName();
        $file->storeAs('pekerti', $nama_file, 'public');
        $data = [
            'nomor_sertifikat' => $request->nomor_sertifikat,
            'tgl_pelaksanaan'  => $request->tgl_pelaksanaan,
            'sertifikat'      => $nama_file,
            'tgl_penerbitan' => $request->tgl_penerbitan,
            'status_pekerti'   => $request->status_pekerti,
        ];

        Pekertian::find($id)->update($data);

        return redirect()->route('pekertian.index');
    }

    public function hapus($id)
    {
        Pekertian::find($id)->delete();

        return redirect()->route('pekertian.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pekertian::find($id)->delete();

        return redirect()->route('pekertian.index');
    }
}
