<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skema;
use App\Models\Periode;
use App\Models\Instansi;
use Illuminate\Http\Request;
use App\Models\Pengajuan_magang;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportExcel\ExportPengajuanMagang;
use App\Http\Requests\StorePengajuan_magangRequest;
use App\Exports\ExportExcel\ExportPengajuanMagangView;
use Illuminate\Support\Facades\Validator;

class PengajuanMagangController extends Controller
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

        if (Auth::user()->level == 'Dekan' || Auth::user()->level == 'Super Admin') {
            $pengajuan_magang = Pengajuan_magang::where('status_pengajuanmagang', '!=', 'Belum Disetujui')->get();
        } else if (Auth::user()->level == 'Kaprodi') {
            $pengajuan_magang = Pengajuan_magang::select('pengajuan_magangs.*')
                ->join('users', 'pengajuan_magangs.user_id', '=', 'users.id')
                ->join('skemas', 'pengajuan_magangs.skema_id', '=', 'skemas.id')
                ->where('users.level', 'Tenaga Pendidik')
                ->get();
        } else if (Auth::user()->level == 'Admin Sekolah Vokasi') {
            $pengajuan_magang = Pengajuan_magang::select('pengajuan_magangs.*')
                ->join('users', 'pengajuan_magangs.user_id', '=', 'users.id')
                ->join('skemas', 'pengajuan_magangs.skema_id', '=', 'skemas.id')
                ->where('users.level', 'Tenaga Kependidikan')
                ->get();
        } else {
            $pengajuan_magang = Pengajuan_magang::select('pengajuan_magangs.*')
                ->join('users', 'pengajuan_magangs.user_id', '=', 'users.id')
                ->join('skemas', 'pengajuan_magangs.skema_id', '=', 'skemas.id')
                ->where('users.unit', $nama_unit->unit)
                ->get();
        }

        // jika level dekan maka data pengajuan magang rewrite dengan data pengajuan yg status nya bukan belum disetujui
        // dd($pengajuan_magang);

        return view('pengajuan_magang.index', ['data' => $pengajuan_magang]);
    }

    public function tambah()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $data = Skema::get();
        $instansi = Instansi::get();
        // $periode = Periode::get();
        $periode = Periode::all();

        return view('pengajuan_magang.form', ['skema' => $data, 'instansi' => $instansi, 'periode' => $periode, 'user' => $user]);
    }

    public function simpan(Request $request)
    {
        $data = [
            'topik_magang' => $request->topik_magang,
            'skema_id' => $request->skema,
            'instansi_id' => $request->instansi,
            'periode_id' => $request->periode,
            'tgl_daftar' => $request->tgl_daftar,
            'tgl_pelaksanaan' => $request->tgl_pelaksanaan,
            'pengajuan_anggaran' => $request->pengajuan_anggaran,
            'keterangan_anggaran' => $request->keterangan_anggaran,
            'dokumen_dukung' => $request->dokumen_dukung,
            // 'surat_tugas'  => $request->surat_tugas,
            'status_pengajuanmagang' => $request->status_pengajuanmagang,
            'user_id' => $request->user()->id,
        ];

        if ($request->anggaran_disetujui != null) {
            $data = [
                'topik_magang' => $request->topik_magang,
                'skema_id' => $request->skema,
                'instansi_id' => $request->instansi,
                'periode_id' => $request->periode,
                'tgl_daftar' => $request->tgl_daftar,
                'tgl_pelaksanaan' => $request->tgl_pelaksanaan,
                'pengajuan_anggaran' => $request->pengajuan_anggaran,
                'keterangan_anggaran' => $request->keterangan_anggaran,
                'dokumen_dukung' => $request->dokumen_dukung,
                'anggaran_disetujui' => $request->anggaran_disetujui,
                // 'surat_tugas'  => $request->surat_tugas,
                'status_pengajuanmagang' => $request->status_pengajuanmagang,
                'user_id' => $request->user()->id,
            ];
        }
        if ($request->file('surat_tugas') != null) {
            $file = $request->file('surat_tugas');
            $nama_file = $file->getClientOriginalName();
            // $file->storeAs('public/surat_tugas', $nama_file);
            $file->move(public_path('surat_tugas'), $nama_file);

            $data['surat_tugas'] = $nama_file;
        }

        if ($request->file('dokumen_dukung') != null) {
            $file = $request->file('dokumen_dukung');
            $nama_file = $file->getClientOriginalName();
            // $file->storeAs('public/dokumen_dukung', $nama_file);
            $file->move(public_path('dokumen_dukung'), $nama_file);

            $data['dokumen_dukung'] = $nama_file;
        }

        // dd($data);

        Pengajuan_magang::insert($data);

        return redirect()->route('pengajuan_magang');
    }

    public function edit($id)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $pengajuan_magang = Pengajuan_magang::with('periode')->findOrFail($id);
        // dd($pengajuan_magang);
        $data = Skema::get();
        $instansi = Instansi::get();
        $periode = Periode::all();
        return view('pengajuan_magang.form', ['pengajuan_magang' => $pengajuan_magang, 'skema' => $data, 'instansi' => $instansi, 'periode' => $periode, 'user' => $user]);
    }

    public function update($id, Request $request)
    {

        // dd($request);
        $data = [
            'topik_magang' => $request->topik_magang,
            'skema_id' => $request->skema,
            'instansi_id' => $request->instansi,
            'periode_id' => $request->periode,
            'tgl_daftar' => $request->tgl_daftar,
            'tgl_pelaksanaan' => $request->tgl_pelaksanaan,
            'pengajuan_anggaran' => $request->pengajuan_anggaran,
            'keterangan_anggaran' => $request->keterangan_anggaran,
            'dokumen_dukung' => $request->dokumen_dukung,
            'anggaran_disetujui' => $request->anggaran_disetujui,
            'surat_tugas' => $request->surat_tugas,
            'status_pengajuanmagang' => $request->status_pengajuanmagang,
        ];
        if ($request->file('surat_tugas') != null) {
            $file = $request->file('surat_tugas');
            $nama_file = $file->getClientOriginalName();
            // $file->storeAs('public/surat_tugas', $nama_file);
            $file->move(public_path('surat_tugas'), $nama_file);

            $data = collect($data)->merge(['surat_tugas' => $nama_file]);
            $data = $data->all();
        }

        if ($request->file('dokumen_dukung') != null) {
            $file = $request->file('dokumen_dukung');
            $nama_file = $file->getClientOriginalName();
            // $file->storeAs('public/dokumen_dukung', $nama_file);
            $file->move(public_path('dokumen_dukung'), $nama_file);

            $data['dokumen_dukung'] = $nama_file;
        }

        Pengajuan_magang::find($id)->update($data);

        return redirect()->route('pengajuan_magang');
    }

    public function updateverif(Request $request)
    {


        if ($request->statusAwal == "Belum Disetujui") {
            $id = $request->id;
            $data = [
                'status_pengajuanmagang'          => $request->status,
            ];
            Pengajuan_magang::find($id)->update($data);
        } else if ($request->statusAwal == "Menunggu Validasi") {
            if ($request->status == "Pengajuan Ditolak") {
                $id = $request->id;
                $data = [
                    'status_pengajuanmagang'          => $request->status,
                ];
                Pengajuan_magang::find($id)->update($data);
            } else {
                // $validator = Validator::make($request->all(), [
                //     'fileInput' => 'required|mimes:pdf',
                // ]);
                // if ($validator->fails()) {
                //     return response()->json(['errors' => $validator->errors()], 422);
                // }
                $id = $request->id;
                $data = [
                    'status_pengajuanmagang'          => $request->status,
                    'anggaran_disetujui'              => $request->anggaransetuju,
                ];
                Pengajuan_magang::find($id)->update($data);
            }
        } else if ($request->statusAwal == "Pengajuan Disetujui") {
            $id = $request->id;
            if ($request->hasFile('fileInput')) {
                $file =  $request->file('fileInput');
                $nama_file = $file->getClientOriginalName();
                $file->storeAs('surat_tugas', $nama_file, 'public');
            } else {
                $nama_file = null;
            }
            $data = [
                'surat_tugas'                     => $nama_file,
            ];
            Pengajuan_magang::find($id)->update($data);
        }
        return response()->json(['message' => 'Pengajuan Magang updated successfully!']);
    }

    public function hapus($id)
    {
        Pengajuan_magang::find($id)->delete();

        return redirect()->route('pengajuan_magang');
    }

    public function download($id)
    {
        $pengajuan_magang = Pengajuan_magang::findOrFail($id);

        // Path ke file XLSX yang ingin didownload
        // $pathToFile = storage_path('app/public/' . $pengajuan_magang->file_xlsx);
        $pathToFile = public_path('storage/' . $pengajuan_magang->file_xlsx);

        // Mendownload file
        return response()->download($pathToFile);
    }

    public function detail($id)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $pengajuan_magang = Pengajuan_magang::with('periode')->findOrFail($id);
        // dd($pengajuan_magang);
        $skema = Skema::get();
        $instansi = Instansi::get();
        $periode = Periode::all();
        return view('pengajuan_magang.detail', ['pengajuan_magang' => $pengajuan_magang, 'skema' => $skema, 'instansi' => $instansi, 'periode' => $periode, 'user' => $user]);
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

    public function export_excel()
    {
        $nameFIle = 'pengajuan_magang_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new ExportPengajuanMagangView, $nameFIle);
    }
}
