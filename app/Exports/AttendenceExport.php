<?php

namespace App\Exports;

use App\Attendence;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AttendenceExport implements FromView,ShouldAutoSize
{
    public function view(): View
    {
        $listAttendences = Attendence::all();
        return view('admin/attendence/export', ['attendence' => $listAttendences]);
    }
}
