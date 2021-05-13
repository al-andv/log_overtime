<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Overtime;
use App\Http\Requests\OvertimeRequest;
use App\Repositories\OvertimeRepository;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportOvertime;
use App\Exports\OvertimeExport;

class OvertimeController extends Controller
{
    //view over time
    public function index()
    {
        $listOvertimes = Overtime::orderBy('user_id')->orderBy('date')->orderBy('time_start')->paginate(10);
        return view('admin/over_time/list', ['overtime' => $listOvertimes]);
    }

    public function showMonth($month)
    {
        $listOvertimes = Overtime::whereMonth('date',$month)->orderBy('user_id')
            ->orderBy('date')->orderBy('time_start')->paginate(10);
        return view('admin/over_time/list', ['overtime' => $listOvertimes, 'month' => $month]);
    }

    //view add over time
    public function getAdd()
    {
        return view('admin/over_time/add');
    }

    //add over time
    public function postAdd(OvertimeRequest $request)
    {
        OvertimeRepository::add($request);
        return redirect('admin/overtime/add')->with('global', 'Add over time was success');
    }

    //view edit over time
    public function getEdit($id)
    {
        $getOvertime = Overtime::find($id);
        $listOvertimes = Overtime::where('user_id', $getOvertime->user_id)->orderBy('date')->get();
        return view('admin/over_time/edit', ['overtime' => $getOvertime, 'list' => $listOvertimes]);
    }

    //edit over time
    public function postEdit(OvertimeRequest $request, $id)
    {
        OvertimeRepository::edit($request, $id);
        return redirect('admin/overtime/list')->with('global', 'Repaired successfully');
    }

    //delete over time
    public function getDelete($id)
    {
        $getOvertime = Overtime::find($id);
        $getOvertime->delete();
        return redirect('admin/overtime/list')->with('global', 'Deleted successfully');
    }

    //export over time
    public function getExport()
    {
        return Excel::download(new OvertimeExport(), 'overtime.xls');
        return back();
    }

    //import data
    public function postImport(ImportRequest $request)
    {
        $path = "E:/Download/".$_FILES['import']['name'];
        Excel::import(new ImportOvertime(), $path);
        return back();
    }
}
