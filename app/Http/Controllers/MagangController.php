<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Http\Requests\StoreMagangRequest;
use App\Http\Requests\UpdateMagangRequest;
use App\Models\Instansi;
use App\Models\Skema;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportExcel\ExportMagangView;

class MagangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nama_unit = User::select('unit')
            ->where('id', Auth::user()->id)
            ->first();

        if (Auth::user()->level == 'Dekan') {
            $magang = Magang::where('status_magang', '!=', 'Belum Disetujui')->get();
        } else if (Auth::user()->level == 'Kaprodi') {
            $magang = Magang::select('magangs.*')
                ->join('users', 'magangs.user_id', '=', 'users.id')
                ->join('skemas', 'magangs.skema_id', '=', 'skemas.id')
                ->where('users.level', 'Tenaga Pendidik')
                ->get();
        } else if (Auth::user()->level == 'Admin Sekolah Vokasi') {
            $magang = Magang::select('magangs.*')
                ->join('users', 'magangs.user_id', '=', 'users.id')
                ->join('skemas', 'magangs.skema_id', '=', 'skemas.id')
                ->where('users.level', 'Tenaga Kependidikan')
                ->get();
        } else {
            $magang = Magang::select('magangs.*')
                ->join('users', 'magangs.user_id', '=', 'users.id')
                ->join('skemas', 'magangs.skema_id', '=', 'skemas.id')
                ->where('users.unit', $nama_unit->unit)
                ->get();
        }





        return view('magang.index', ['data' => $magang]);
    }

    public function tambah()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $data = Skema::get();
        $instansi = Instansi::get();
        // $periode = Periode::get();
        $periode = Periode::all();
        return view('magang.form', ['skema' => $data, 'instansi' => $instansi, 'periode' => $periode, 'user' => $user]);
    }

    public function simpan(Request $request)
    {

        $file =  $request->file('sertifikat');
        $nama_file = $file->getClientOriginalName();
        $file->storeAs('sertifikat_magang', $nama_file, 'public');

        // dd($request);
        if ($request->seumur_hidup == 'on') {
            $data = [
                'topik_magang'  => $request->topik_magang,
                'skema_id'      => $request->skema,
                'instansi_id'   => $request->instansi,
                'periode_id'               => $request->periode,
                'tgl_daftar'  => $request->tgl_daftar,
                'tgl_pelaksanaan'  => $request->tgl_pelaksanaan,
                'tgl_penerbitan' => $request->tgl_penerbitan,
                'status_magang' => $request->status_magang,
                'status_seumur_hidup' => 1,
                'sertifikat' => $nama_file,
                'user_id' =>  $request->user()->id
            ];
        } else {
            // dd($request);
            // if($request->seumur_hidup == 'on'){
            $data = [
                'topik_magang'  => $request->topik_magang,
                'skema_id'      => $request->skema,
                'instansi_id'   => $request->instansi,
                'periode_id'               => $request->periode,
                'tgl_daftar'  => $request->tgl_daftar,
                'tgl_pelaksanaan'  => $request->tgl_pelaksanaan,
                'tgl_penerbitan' => $request->tgl_penerbitan,
                'status_magang' => $request->status_magang,
                'masa_berlaku'  => $request->masa_berlaku,
                'status_seumur_hidup' => 0,
                'sertifikat' => $nama_file,
                'user_id' =>  $request->user()->id
            ];
            // }
        }

        // dd($data);

        Magang::insert($data);

        return redirect()->route('magang');
    }

    public function edit($id)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $magang = Magang::with('periode')->findOrFail($id);
        // $magang = Magang::findOrFail($id);
        $data = Skema::get();
        $instansi = Instansi::get();
        $periode = Periode::all();

        return view('magang.form', ['magang' => $magang, 'skema' => $data, 'instansi' => $instansi, 'periode' => $periode, 'user' => $user]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'topik_magang'          => $request->topik_magang,
            'skema_id'                 => $request->skema,
            'instansi_id'              => $request->instansi,
            'periode_id'               => $request->periode,
            'tgl_daftar'   => $request->tgl_daftar,
            'tgl_penerbitan'             => $request->tgl_penerbitan,
            'masa_berlaku'           => $request->masa_berlaku,
            'anggaran'              => $request->anggaran,
            'status_magang' => $request->status_magang,
        ];
        if ($request->file('sertifikat') != null) {
            $file =  $request->file('sertifikat');
            $nama_file = $file->getClientOriginalName();
            $file->storeAs('sertifikat_magang', $nama_file, 'public');
            $data = collect($data)->merge(['sertifikat' => $nama_file]);
            $data = $data->all();
        }
        // dd($data);

        Magang::find($id)->update($data);

        return redirect()->route('magang');
    }

    public function updateverif(Request $request)
    {
        // dd($request);
        if ($request->statusAwalMod == "Belum Disetujui") {
            $id = $request->magangID;
            $data = [
                'status_magang'          => $request->verifikasi,
            ];
            Magang::find($id)->update($data);
        } else if ($request->statusAwalMod == "Menunggu Validasi") {
            $id = $request->magangID;
            $data = [
                'status_magang'          => $request->verifikasi,
            ];
            Magang::find($id)->update($data);
        }
        return redirect()->route('magang');
    }

    public function hapus($id)
    {
        Magang::find($id)->delete();

        return redirect()->route('magang');
    }

    public function detail($id)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $magang = Magang::with('periode')->findOrFail($id);
        // dd($pengajuan_magang);
        $skema = Skema::get();
        $instansi = Instansi::get();
        $periode = Periode::all();
        return view('magang.detail', ['magang' => $magang, 'skema' => $skema, 'instansi' => $instansi, 'periode' => $periode, 'user' => $user]);
    }

    public function export_excel()
    {
        $nameFIle = 'magang_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new ExportMagangView, $nameFIle);
    }
}
