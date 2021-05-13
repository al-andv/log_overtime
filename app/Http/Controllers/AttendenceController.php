<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendenceRequest;
use App\Attendence;
use App\Repositories\AttendenceRepository;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AttendenceExport;

class AttendenceController extends Controller
{
    public function updateStatus()
    {
        $getOfftimes = Attendence::all();
        foreach ($getOfftimes as $att) {
            if ($att->date < date("Y-m-d")) {
                if ($att->status == 0) {
                    $atten = Attendence::find($att->id);
                    $atten->status = -1;
                    $atten->save();
                }
            }
        }
    }

    //view list attendence
    public function index()
    {
        $this->updateStatus();
        $listOfftimes = Attendence::orderBy('user_id','DESC')->paginate(10);
        return view('admin/attendence/list', ['attendence' => $listOfftimes]);
    }

    public function showMonth($month)
    {
        $listOfftimes = Attendence::whereMonth('date',$month)->orderBy('user_id','DESC')->paginate(10);
        return view('admin/attendence/list', ['attendence' => $listOfftimes,'month' => $month]);
    }

    //view add attendence
    public function getAdd()
    {
        return view('admin/attendence/add');
    }

    //add attendence
    public function postAdd(AttendenceRequest $request)
    {
        AttendenceRepository::add($request);
        return redirect('admin/attendence/add')->with('global', 'Add off time was success');
    }

    //view edit attendence
    public function getEdit($id)
    {
        $getOfftime = Attendence::find($id);
        $listOfftime = Attendence::where("user_id",$getOfftime->user_id)->orderBy('date')->get();
        return view('admin/attendence/edit', ['attendence' => $getOfftime,'list' => $listOfftime]);

    }

    //edit attendence
    public function postEdit(AttendenceRequest $request, $id)
    {
        AttendenceRepository::edit($request, $id);
        return redirect('admin/attendence/list')->with('global', 'Repaired successfully !');
    }

    //delete attendence
    public function getDelete($id)
    {
        $getOfftime = Attendence::find($id);
        $getOfftime->delete();
        return redirect('admin/attendence/list')->with('global', 'Offtime was delete !');
    }

    //export attendence
    public function getExport()
    {
        return Excel::download(new AttendenceExport(), 'attendence.xls');
        return redirect('admin/home');
    }
}

