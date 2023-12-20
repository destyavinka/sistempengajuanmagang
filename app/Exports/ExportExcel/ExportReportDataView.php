<?php

namespace App\Exports\ExportExcel;

use App\Models\User;
use App\Models\Pengajuan_magang;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class ExportReportDataView implements FromView
{
    protected $result;

    function __construct($result)
    {
        $this->result = $result;
    }
    public function view(): View
    {
        $result = $this->result;

        return view('export_excel.report_data', [
            'data' => $result
        ]);
    }
}
