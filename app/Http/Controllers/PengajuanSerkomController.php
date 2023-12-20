<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan_serkom;
use App\Http\Requests\StorePengajuan_serkomRequest;
use App\Http\Requests\UpdatePengajuan_serkomRequest;
use App\Models\Penyelenggara;
use App\Models\Skema;
use App\Models\User;
use App\Models\Periode;
use App\Models\Jenis_sertifikasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Exports\ExportExcel\ExportPengajuanMagang;
use App\Exports\ExportExcel\ExportPengajuanMagangView;
use App\Exports\ExportExcel\ExportPengajuanSerkomView;
use Maatwebsite\Excel\Facades\Excel;

class PengajuanSerkomController extends Controller
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
            $pengajuan_serkom = Pengajuan_serkom::where('status_pengajuanserkom', '!=', 'Belum Disetujui')->get();
        } else if (Auth::user()->level == 'Kaprodi') {
            $pengajuan_serkom = Pengajuan_serkom::select('pengajuan_serkoms.*')
                ->join('users', 'pengajuan_serkoms.user_id', '=', 'users.id')
                ->join('skemas', 'pengajuan_serkoms.skema_id', '=', 'skemas.id')
                ->where('users.level', 'Tenaga Pendidik')
                ->get();
        } else if (Auth::user()->level == 'Admin Sekolah Vokasi') {
            $pengajuan_serkom = Pengajuan_serkom::select('pengajuan_serkoms.*')
                ->join('users', 'pengajuan_serkoms.user_id', '=', 'users.id')
                ->join('skemas', 'pengajuan_serkoms.skema_id', '=', 'skemas.id')
                ->where('users.level', 'Tenaga Kependidikan')
                ->get();
        } else {
            $pengajuan_serkom = Pengajuan_serkom::select('pengajuan_serkoms.*')
                ->join('users', 'pengajuan_serkoms.user_id', '=', 'users.id')
                ->join('skemas', 'pengajuan_serkoms.skema_id', '=', 'skemas.id')
                ->where('users.unit', $nama_unit->unit)
                ->get();
        }

        return view('pengajuan_serkom.index', ['data' => $pengajuan_serkom]);
    }

    public function tambah()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $data = Skema::get();
        $penyelenggara = Penyelenggara::get();
        $periode = Periode::all();
        $jenis_sertifikasi = Jenis_sertifikasi::get();
        return view('pengajuan_serkom.form', ['skema' => $data, 'penyelenggara' => $penyelenggara, 'periode' => $periode, 'user' => $user, 'jenis_sertifikasi' => $jenis_sertifikasi]);
    }

    public function simpan(Request $request)
    {
        $data = [
            'nama_sertifikasi'          => $request->nama_sertifikasi,
            'periode_id'                => $request->periode,
            'skema_id'                 => $request->skema,
            'penyelenggara_id'              => $request->penyelenggara,
            'jenis_sertifikasi_id'      => $request->jenis_sertifikasi,
            'tgl_pelaksanaan'             => $request->tgl_pelaksanaan,
            'anggaran'              => $request->anggaran,
            'status_pengajuanserkom' => $request->status_pengajuanserkom,
            'user_id' =>  $request->user()->id
        ];

        // dd($data);

        Pengajuan_serkom::insert($data);

        return redirect()->route('pengajuan_serkom');
    }

    public function edit($id)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $pengajuan_serkom = Pengajuan_serkom::with('periode')->findOrFail($id);

        $data = Skema::get();
        $penyelenggara = Penyelenggara::get();
        $periode = Periode::all();
        $jenis_sertifikasi = Jenis_sertifikasi::get();
        return view('pengajuan_serkom.form', ['pengajuan_serkom' => $pengajuan_serkom, 'skema' => $data, 'penyelenggara' => $penyelenggara, 'periode' => $periode, 'user' => $user, 'jenis_sertifikasi' => $jenis_sertifikasi]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'nama_sertifikasi'          => $request->nama_sertifikasi,
            'periode_id'            => $request->periode,
            'skema_id'                 => $request->skema,
            'penyelenggara_id'              => $request->penyelenggara,
            'jenis_sertifikasi_id'      => $request->jenis_sertifikasi,
            'tgl_pelaksanaan'             => $request->tgl_pelaksanaan,
            'anggaran'              => $request->anggaran,
            'status_pengajuanserkom' => $request->status_pengajuanserkom,
            'user_id' =>  $request->user()->id
        ];

        Pengajuan_serkom::find($id)->update($data);

        return redirect()->route('pengajuan_serkom');
    }

    public function updateverif(Request $request)
    {
        // dd($request);
        if ($request->statusAwalMod == "Belum Disetujui") {
            $id = $request->magangID;
            $data = [
                'status_pengajuanserkom'          => $request->verifikasi,
            ];
            Pengajuan_serkom::find($id)->update($data);
        } else if ($request->statusAwalMod == "Menunggu Validasi") {
            $id = $request->magangID;
            $data = [
                'status_pengajuanserkom'          => $request->verifikasi,
            ];
            Pengajuan_serkom::find($id)->update($data);
        }
        return redirect()->route('pengajuan_serkom');
    }

    public function hapus($id)
    {
        Pengajuan_serkom::find($id)->delete();

        return redirect()->route('pengajuan_serkom');
    }

    public function detail($id)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $pengajuan_serkom = Pengajuan_serkom::with('periode')->findOrFail($id);
        // dd($pengajuan_serkom);
        $skema = Skema::get();
        $penyelenggara = Penyelenggara::get();
        $jenis_sertifikasi = Jenis_sertifikasi::get();
        $periode = Periode::all();
        return view('pengajuan_serkom.detail', ['pengajuan_serkom' => $pengajuan_serkom, 'skema' => $skema, 'penyelenggara' => $penyelenggara, 'jenis_sertifikasi' => $jenis_sertifikasi, 'periode' => $periode, 'user' => $user]);
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
     * @param  \App\Http\Requests\StorePengajuan_serkomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengajuan_serkomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengajuan_serkom  $pengajuan_serkom
     * @return \Illuminate\Http\Response
     */
    public function show(Pengajuan_serkom $pengajuan_serkom)
    {
        //
    }

    public function export_excel()
    {
        $nameFIle = 'pengajuan_serkom_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new ExportPengajuanSerkomView, $nameFIle);
    }
}
