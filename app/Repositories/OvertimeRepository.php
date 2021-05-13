<?php
namespace App\Repositories;

use App\Overtime;

class OvertimeRepository
{
    static function add($request)
    {
        $setOvertime = new Overtime();
        $dateType = $request->date_type;
        if ($dateType == 1) {
            $type = '1.5';
        } elseif ($dateType ==2) {
            $type = '2';
        } else {
            $type = '3';
        }
        $id = $request->username;
        $dateOT = $request->dateOT;
        $start = $request->start;
        $end = $request->end;
        if (strtotime($start) > strtotime($end)) {
            return redirect('admin/overtime/add')->
            with('error', 'The end time must be less than the start time !!');
        }
        $getOvertime = Overtime::where('user_id', $id)->get();
        foreach ($getOvertime as $overtime) {
            if ($overtime->date == $dateOT) {
                if ($overtime->id != $id) {
                    if (((strtotime($start) < strtotime($overtime->time_start)) &&
                            (strtotime($end) > strtotime($overtime->time_start))) ||
                        ((strtotime($start) >= strtotime($overtime->time_start)) &&
                            (strtotime($start) <= strtotime($overtime->time_end)))) {
                        return redirect('admin/overtime/add')->
                        with('error', 'This time there was a period of overtime !!');
                    }
                }
            }
        }
        $time = strtotime($end) - strtotime($start);
        $overTime = $time * $type;
        $overTime = gmdate('H:i', $overTime);

        $setOvertime->date = $dateOT;
        $setOvertime->date_type = $dateType;
        $setOvertime->user_id = $id;
        $setOvertime->time_start = $start;
        $setOvertime->time_end = $end;
        $setOvertime->work = $request->work;
        $setOvertime->over_time = $overTime;
        $setOvertime->save();
    }

    static function edit($request, $id)
    {
        $updateOvertime = Overtime::find($id);
        $dateType = $request->date_type;
        if ($dateType == 1) {
            $type = '1.5';
        } elseif ($dateType ==2) {
            $type = '2';
        } else {
            $type = '3';
        }
        $userId = $updateOvertime->user_id;
        $dateOT = $request->dateOT;
        $start = $request->start;
        $end = $request->end;
        if (strtotime($start) > strtotime($end)) {
            return redirect('admin/overtime/edit/'.$id)->
            with('error', 'The end time must be less than the start time !!');
        }
        $over = Overtime::where('user_id', $userId)->get();//dd($over);
        foreach ($over as $overtime) {
            if ($overtime->date == $dateOT) {
                //dd($overtime->id);
                if ($overtime->id != $id) {
                    if (((strtotime($start) < strtotime($overtime->time_start)) &&
                            (strtotime($end) > strtotime($overtime->time_start))) ||
                        ((strtotime($start) >= strtotime($overtime->time_start)) &&
                            (strtotime($start) <= strtotime($overtime->time_end)))) {
                        return redirect('admin/overtime/edit/'.$id)->
                        with('error', 'This time there was a period of overtime !!');
                    }
                }
            }
        }
        $time = strtotime($end) - strtotime($start);
        $over_time = $time * $type;
        $over_time = gmdate('H:i', $over_time);

        $updateOvertime->date = $request->dateOT;
        $updateOvertime->date_type = $dateType;
        $updateOvertime->user_id = $request->username;
        $updateOvertime->time_start = $start;
        $updateOvertime->time_end = $end;
        $updateOvertime->work = $request->work;
        $updateOvertime->over_time = $over_time;
        $updateOvertime->save();
    }
}
