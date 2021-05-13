<?php

namespace App\Exports;

use App\Overtime;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportOvertimeOneUser implements FromView,ShouldAutoSize
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $getovertime = Overtime::where('user_id',$this->id)->get();
        return view('admin/layout/export_ot_user', ['overtime' => $getovertime]);
    }
}

