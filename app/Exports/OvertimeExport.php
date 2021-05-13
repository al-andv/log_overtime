<?php

namespace App\Exports;

use App\Overtime;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Border;

class OvertimeExport implements FromView,ShouldAutoSize
{
    public function view(): View
    {
        $listOvertimes = Overtime::all();
        return view('admin/over_time/export', ['overtime' => $listOvertimes]);
    }
}
