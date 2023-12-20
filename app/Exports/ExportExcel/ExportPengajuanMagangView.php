<?php

namespace App\Exports\ExportExcel;

use App\Models\User;
use App\Models\Pengajuan_magang;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPengajuanMagangView implements FromView
{
    public function view(): View
    {
        $nama_unit = User::select('unit')
            ->where('id', Auth::user()->id)
            ->first();
        $dataOfPengajuanMagang = Pengajuan_magang::select('pengajuan_magangs.*')
            ->join('skemas', 'pengajuan_magangs.skema_id', '=', 'skemas.id')
            ->join('users', 'pengajuan_magangs.user_id', '=', 'users.id')
            // ->where('users.unit', $nama_unit->unit)
            ->get();
        // dd($dataOfPengajuanMagang, $nama_unit);
        return view('export_excel.pengajuan_magang', [
            'data' => $dataOfPengajuanMagang
        ]);
    }
}
