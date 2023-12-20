<?php

namespace App\Exports\ExportExcel;
use App\Models\User;
use App\Models\Magang;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class ExportMagangView implements FromView
{
    public function view(): View
    {
        $nama_unit = User::select('unit')
        ->where('id', Auth::user()->id)
        ->first();
        $dataOfMagang = Magang::select('magangs.*')
        ->join('skemas', 'magangs.skema_id', '=', 'skemas.id')
        ->join('users', 'magangs.user_id', '=', 'users.id')
        ->where('users.unit', $nama_unit->unit)
        ->get();
        return view('export_excel.magang', [
            'data' => $dataOfMagang
        ]);
    }
}
