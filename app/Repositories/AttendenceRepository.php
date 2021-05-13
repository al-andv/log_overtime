<?php
namespace App\Repositories;

use App\Attendence;
use App\Notification;

class AttendenceRepository
{
    static function add($request)
    {
        $id = $request->username;
        $dateOff = $request->dateOff;
        $timeOff = $request->timeOff;
        $getOfftime = Attendence::where('user_id', $id)->get();
        foreach ($getOfftime as $att) {
            if ($att->date == $dateOff) {
                if (($att->off_time + $timeOff) > 8) {
                    return redirect('admin/attendence/add')->
                    with('error', 'Staff can not off more 8 hours on 1day');
                }
            }
        }
        $setOfftime = new Attendence();
        $setOfftime->user_id = $id;
        $setOfftime->date = $dateOff;
        $setOfftime->off_time = $timeOff;
        $setOfftime->reason = $request->reason;
        $setOfftime->status = 1;
        $setOfftime->save();
    }

    static function edit($request, $id)
    {
        $userId = $request->username;
        $dateOff = $request->dateOff;
        $timeOff = $request->timeOff;
        $reason = $request->reason;
        $time = 0;
        $getOfftime = Attendence::where('user_id', $userId)->get();
        foreach ($getOfftime as $att) {
            if ($att->date == $dateOff) {
                if ($att->id != $id) {
                    $time += $att->off_time;
                }
            }
        }
        if (($time + $timeOff) > 8) {
            $atten = Attendence::find($id);
            $error = 'Staff can not off more 8 hours on 1day';
            return view('admin/attendence/edit',['error' => $error, 'attendence' => $atten]);
        }
        $updateOfftime = Attendence::find($id);
        $updateOfftime->date = $dateOff;
        $updateOfftime->off_time = $timeOff;
        $updateOfftime->reason = $reason;
        $updateOfftime->status = $request->status;
        $updateOfftime->save();

        $date = getdate();
        $today = ($date['year']."-".$date['mon']."-".$date['mday']);
        if (strtotime($dateOff) >= strtotime($today)) {
            if ($request->old_status == 0) {
                $setNoti = new Notification();
                $setNoti->user_id_from = 1;
                $setNoti->user_id_to = $userId;
                $setNoti->title = "update status off time";
                $setNoti->content = $id;
                $setNoti->save();
            }
        }
    }
}
