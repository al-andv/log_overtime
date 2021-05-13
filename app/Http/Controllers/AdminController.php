<?php

namespace App\Http\Controllers;

use App\Exports\ExportOvertimeOneUser;
use App\Http\Requests\ListToDoRequest;
use App\Http\Requests\SearchRequest;
use App\Notification;
use App\User;
use App\Overtime;
use App\Attendence;
use App\List_to_do;
use Mail;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    //view home page admin
    public function index()
    {
        $lists = List_to_do::orderBy('time','DESC')->paginate(5);
        $getUser = User::orderBy('user_name')->paginate(6);

        return view('admin/layout/home',['lists'=> $lists, 'users' => $getUser]);
    }

    //notification
    public function getNotification($id)
    {
        $getNoti = Notification::find($id);
        $userId = $getNoti->user_id_from;
        $getNoti->status = 1;
        $getNoti->save();

        $getAtten = Attendence::where('user_id', $userId)->get();
        foreach ($getAtten as $att) {
            if (strtotime($att->created_at) == strtotime($getNoti->created_at)) {
                $att_id = $att->id;
            }
        }
        return redirect('admin/attendence/edit/'.$att_id);
    }

    //search user admin
    public function postSearch(SearchRequest  $request)
    {
        $key = $request->searchKey;
        if (isset($key)) {
            $listUsers = User::where('full_name', 'LIKE', "%$key%")->get();
            $data = array('key' => $key, 'user' => $listUsers);

            return view('admin.layout.search', ['data' => $data]);
        }
    }

    //view search detail
    public function getDetails($id)
    {
        $getUser = User::find($id);
        $getOvertime = Overtime::where('user_id', $id)->get();
        $getOfftime = Attendence::where('user_id',$id)->get();
        $data = array('user' => $getUser, 'ot' => $getOvertime, 'off' => $getOfftime);

        return view('admin.layout.details', ['data' => $data]);
    }

    //add list to do
    public function  postListAdd(ListToDoRequest $request)
    {
        $setList = new List_to_do();
        $setList->work_to_do = $request->todo;
        $setList->time = $request->date_todo;
        $setList->save();

        return redirect('admin/home');
    }

    //delete list to do
    public function getListDelete($id)
    {
        $getList = List_to_do::find($id);
        $getList->delete();

        return redirect('admin/home');
    }

    //export Over time one user
    public function getExportOvertimeOneUser($id)
    {
        $getUser = User::find($id);
        return Excel::download(new ExportOvertimeOneUser($id), 'overtime_'.$getUser->full_name.'.xls');

        return back();
    }
}

