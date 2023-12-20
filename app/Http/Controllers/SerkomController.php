<?php

namespace App\Http\Controllers;

use App\Models\Serkom;
use App\Http\Requests\StoreSerkomRequest;
use App\Http\Requests\UpdateSerkomRequest;
use App\Models\Skema;
use App\Models\Penyelenggara;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SerkomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $serkom = Serkom::with('skema')->get();
        // dd($serkom);
        $nama_unit = User::select('unit')
            ->where('id', Auth::user()->id)
            ->first();
        // $magang = Magang::with('skema')->get();


        if (Auth::user()->level == 'Dekan') {
            $serkom = Serkom::where('status_serkom', '!=', 'Belum Disetujui')->get();
        } else if (Auth::user()->level == 'Kaprodi') {
            $serkom = Serkom::select('serkoms.*')
                ->join('users', 'serkoms.user_id', '=', 'users.id')
                ->join('skemas', 'serkoms.skema_id', '=', 'skemas.id')
                ->where('users.level', 'Tenaga Pendidik')
                ->get();
        } else if (Auth::user()->level == 'Admin Sekolah Vokasi') {
            $serkom = Serkom::select('serkoms.*')
                ->join('users', 'serkoms.user_id', '=', 'users.id')
                ->join('skemas', 'serkoms.skema_id', '=', 'skemas.id')
                ->where('users.level', 'Tenaga Kependidikan')
                ->get();
        } else {
            $serkom = Serkom::select('serkoms.*')
                ->join('skemas', 'serkoms.skema_id', '=', 'skemas.id')
                ->join('users', 'serkoms.user_id', '=', 'users.id')
                ->where('users.unit', $nama_unit->unit)
                ->get();
        }

        return view('serkom.index', ['data' => $serkom]);
    }

    public function tambah()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $data = Skema::get();
        $penyelenggara = Penyelenggara::get();
        return view('serkom.form', ['skema' => $data, 'penyelenggara' => $penyelenggara, "user" => $user]);
    }

    public function simpan(Request $request)
    {
        $file =  $request->file('sertifikat');
        $nama_file = $file->getClientOriginalName();
        $file->storeAs('sertifikat_serkom', $nama_file, 'public');

        if ($request->seumur_hidup == 'on') {
            $data = [
                'nama_sertifikasi'  => $request->nama_sertifikasi,
                'skema_id'      => $request->skema,
                'penyelenggara_id'   => $request->penyelenggara,
                'tgl_penerbitan' => $request->tgl_penerbitan,
                'sertifikat'    => $nama_file,
                'status_serkom' => $request->status_serkom,
                'status_seumur_hidup' => 1,
                'user_id' =>  $request->user()->id
            ];
        } else {
            $data = [
                'nama_sertifikasi'  => $request->nama_sertifikasi,
                'skema_id'      => $request->skema,
                'penyelenggara_id'   => $request->penyelenggara,
                'tgl_penerbitan' => $request->tgl_penerbitan,
                'sertifikat'    => $nama_file,
                'status_serkom' => $request->status_serkom,
                'masa_berlaku'  => $request->masa_berlaku,
                'status_seumur_hidup' => 0,
                'user_id' =>  $request->user()->id
            ];
        }



        // dd($data);

        Serkom::insert($data);

        return redirect()->route('serkom');
    }

    public function edit($id)
    {
         $user = User::where('id', Auth::user()->id)->first();
        $serkom = Serkom::findOrFail($id);
        $data = Skema::get();
        $penyelenggara = Penyelenggara::get();


        return view('serkom.form', ['serkom' => $serkom, 'skema' => $data, 'penyelenggara' => $penyelenggara, 'user' => $user]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'nama_sertifikasi'  => $request->nama_sertifikasi,
            'skema_id'      => $request->skema,
            'penyelenggara_id'   => $request->penyelenggara,
            'tgl_penerbitan' => $request->tgl_penerbitan,
            'masa_berlaku'  => $request->masa_berlaku,
            // 'sertifikat'    => $nama_file,
            'status_serkom' => $request->status_serkom,
        ];
        if ($request->file('sertifikat') != null) {
            $file =  $request->file('sertifikat');
            $nama_file = $file->getClientOriginalName();
            $file->storeAs('sertifikat_serkom', $nama_file, 'public');
            $data = collect($data)->merge(['sertifikat' => $nama_file]);
            $data = $data->all();
        }

        Serkom::find($id)->update($data);

        return redirect()->route('serkom');
    }

    public function hapus($id)
    {
        Serkom::find($id)->delete();

        return redirect()->route('serkom');
    }

    public function updateverif(Request $request)
    {
        // dd($request);
        if ($request->statusAwalMod == "Belum Disetujui") {
            $id = $request->serkomID;
            $data = [
                'status_serkom'          => $request->verifikasi,
            ];
            Serkom::find($id)->update($data);
        } else if ($request->statusAwalMod == "Menunggu Validasi") {
            $id = $request->serkomID;
            $data = [
                'status_serkom'          => $request->verifikasi,
            ];
            Serkom::find($id)->update($data);
        }
        return redirect()->route('serkom');
    }
}
