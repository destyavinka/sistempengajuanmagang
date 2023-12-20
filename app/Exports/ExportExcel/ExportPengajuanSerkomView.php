<?php

namespace App\Exports\ExportExcel;

use App\Models\User;
use App\Models\Pengajuan_serkom;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPengajuanSerkomView implements FromView
{
    public function view(): View
    {
        $nama_unit = User::select('unit')
            ->where('id', Auth::user()->id)
            ->first();
        $dataOfPengajuanserkom = Pengajuan_serkom::select('pengajuan_serkoms.*')
            // ->join('skemas', 'pengajuan_serkoms.skema_id', '=', 'skemas.id')
            // ->join('users', 'pengajuan_serkoms.user_id', '=', 'users.id')
            // ->where('users.unit', $nama_unit->unit)
            ->get();
        // dd($dataOfPengajuanserkom, $nama_unit);
        return view('export_excel.pengajuan_serkom', [
            'data' => $dataOfPengajuanserkom
        ]);
    }
}
