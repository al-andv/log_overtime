<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\OvertimeRequest;
use App\Http\Requests\AttendenceRequest;
use App\User;
use App\Overtime;
use App\Attendence;
use Mail;

class PageController extends Controller
{
    //view home page user
    public function index()
    {
        return view('page/layout/home');
    }

    public function getNotication($id)
    {
        $getNoti = Notification::find($id);
        $getNoti->status = 1;
        $getNoti->save();
        $id = $getNoti->content;
        $listOfftimes = Attendence::where('user_id',$getNoti->user_id_to)
            ->orderBy('date','DESC')->paginate(10);

        return view('page/attendence/list', ['id' => $id, 'attendence' => $listOfftimes]);
    }

    //view contact page
    public function getContact()
    {
        return view('page.layout.contact');
    }

    //post contact page
    public function postContact(ContactRequest $request)
    {
        Mail::send('mail.contact',
            [
                'name' => $request->name,
                'email' => $request->email,
                'content' => $request->message
            ],
            function ($message) use ($request) {
                $message->to('andinh.da@gmail.com')->subject('Account Created Feecback');
                $message->from($request->email);
            }
        );

        return back()->with('global','Your message was sent, thank you!');
    }

    //view profile
    public function getProfile()
    {
        return view('page.profile.profile');
    }

    //view edit profile
    public function getEdit($id)
    {
        $getUser = User::find($id);
        return view('page/profile/edit',['user'=> $getUser]);
    }

    //post edit profile
    public function postEdit(ProfileRequest $request, $id)
    {
        UserRepository::editUser($request, $id);
        return redirect('page/profile');
    }

    // view overtime
    public function getOvertime($id)
    {
        $listOT = Overtime::orderBy('date')->where('user_id',$id)->paginate(10);
        return view('page/over_time/list',['overtime'=> $listOT]);
    }

    //view month overtime
    public function getMonth($id,$i)
    {
        $listOT = Overtime::where('user_id',$id)->whereMonth('date',$i)->paginate(10);
        return view('page/over_time/list',['overtime'=> $listOT,'month' => $i]);
    }

    //view add overtime
    public function getAddOvertime($id)
    {
        $listOT = Overtime::where('user_id',$id)->get();
        $over = [];
        foreach ($listOT as $overTime) {
            if ($overTime->work == null) {
                $over['id'] = $overTime->id;
                $over['date'] = $overTime->date;
                $over['date_type'] = $overTime->date_type;
                $over['start'] = $overTime->time_start;
                $over['end'] = $overTime->time_end;
            }
        }
        return view('page/over_time/add', ['overtime' => $over]);
    }

    //post add overtime
    public function postAddOvertime(Request $request, $id)
    {
        $overId = $request->overtimeId;
        $date = $request->dateOT;
        $dateType = $request->date_type;
        $start = $request->start;
        $end = $request->end;
        $work = $request->work;
        if ($dateType == 1) {
            $type = '1.5';
        } elseif ($dateType == 2) {
            $type = '2';
        } else {
            $type = '3';
        }
        if ($_POST['action'] == "Start") {
            if (isset($overId)) {
                $setOvertimes = Overtime::find($overId);
            } else {
                $setOvertimes = new Overtime();
            }
            if ($end != "") {
                if (strtotime($end) < strtotime($start)) {
                    $over['id'] = $overId;
                    $over['date'] = $date;
                    $over['date_type'] = $dateType;
                    $over['start'] = $start;
                    $over['end'] = $end;
                    $over['work'] = $work;
                    $error = 'The time start was more than the time end !';
                    return view('page/over_time/add', ['error' => $error, 'overtime' => $over]);
                }
            }
            $setOvertimes->time_start = $start;
            $setOvertimes->date = $date;
            $setOvertimes->date_type = $dateType;
            $setOvertimes->user_id = $id;
            $setOvertimes->save();

            return redirect('page/overtime/add/' . $id);

        } elseif ($_POST['action'] == "End") {
            $setOvertimes = Overtime::find($overId);
            if ($start == "") {
                return redirect('page/overtime/add/' . $id)->with('error', 'Enter your start time');
            } else {
                $time = strtotime($end) - strtotime($start);
                $overTime = $time * $type;
                $overTime = gmdate('H:i', $overTime);
                $setOvertimes->time_end = $end;
                $setOvertimes->over_time = $overTime;
                $setOvertimes->save();

                return redirect('page/overtime/add/' . $id);
            }
        } else {
            $this->validate($request,
                [
                    'start' => 'required',
                    'end' => 'required',
                    'work' => 'required'
                ]);
            if (isset($overId)) {
                $setOvertimes = Overtime::find($overId);
            } else {
                $setOvertimes = new Overtime();
            }
            $time = (strtotime($end) - strtotime($start));
            $overTime = $time * $type;
            $overTime = gmdate('H:i', $overTime);
            $setOvertimes->date = $date;
            $setOvertimes->date_type = $dateType;
            $setOvertimes->user_id = $id;
            $setOvertimes->time_start = $start;
            $setOvertimes->time_end = $end;
            $setOvertimes->work = $work;
            $setOvertimes->over_time = $overTime;
            $setOvertimes->save();

            return redirect('page/overtime/add/' . $id)->with('global', 'Add over time was success');
        }
    }

    //view edit over time
    public function getEditOvertime($id)
    {
        $getOvertimes = Overtime::find($id);
        $listOvertime = Overtime::where('user_id', $getOvertimes->user_id)->orderBy('date')->get();
        return view('page/over_time/edit', ['overtime' => $getOvertimes,'list' => $listOvertime]);
    }

    //post edit over time
    public function postEditOvertime(OvertimeRequest $request, $id)
    {
        $updateOvertime = Overtime::find($id);
        $userId = $request->username;
        $dateType = $request->date_type;
        if ($dateType == 1) {
            $type = '1.5';
        } elseif ($dateType ==2) {
            $type = '2';
        } else {
            $type = '3';
        }
        $dateOT = $request->dateOT;
        $start = $request->start;
        $end = $request->end;
        if (strtotime($start) > strtotime($end)) {
            return redirect('page/overtime/edit/'.$id)->
                with('error', 'The end time must be less than the start time !!');
        }
        $over = Overtime::where('user_id',$userId)->where('date', $dateOT)->get();
        foreach ($over as $overtime) {
            if ($overtime->id != $id) {
                if (((strtotime($start) < strtotime($overtime->time_start)) &&
                    (strtotime($end) > strtotime($overtime->time_start))) ||
                    ((strtotime($start) >= strtotime($overtime->time_start)) &&
                    (strtotime($start) <= strtotime($overtime->time_end)))) {
                    return redirect('page/overtime/edit/'.$id)->
                        with('error', 'This time there was a period of overtime !!');
                }
            }
        }
        $time = (strtotime($end) - strtotime($start));
        $overTime = ($time * $type);
        $overTime = gmdate('H:i', $overTime);
        $updateOvertime->date = $dateOT;
        $updateOvertime->date_type = $dateType;
        $updateOvertime->user_id = $userId;
        $updateOvertime->time_start = $start;
        $updateOvertime->time_end = $end;
        $updateOvertime->work = $request->work;
        $updateOvertime->over_time = $overTime;
        $updateOvertime->save();

        return redirect('page/overtime/'.$updateOvertime->user_id)
            ->with('global', 'Repaired successfully');
    }

    //delete over time
    public function getDeleteOvertime($id)
    {
        $getOvertime = Overtime::find($id);
        $getOvertime->delete();
        return redirect('page/overtime/'.$getOvertime->user_id)
            ->with('global', 'Deleted successfully');
    }

    //view all attendence
    public function getOfftime($id)
    {
        $listOfftimes = Attendence::where('user_id',$id)->orderBy('date','DESC')->paginate(10);
        return view('page/attendence/list', ['attendence'=> $listOfftimes]);
    }

    //view select attendence
    public function showMonthAttendence($id, $i)
    {
        $listOfftimes = Attendence::where('user_id',$id)->whereMonth('date',$i)
            ->orderBy('date','DESC')->paginate(10);
        return view('page/attendence/list', ['attendence'=> $listOfftimes, 'month' => $i]);
    }

    //view page add attendence
    public function getAddOfftime($id)
    {
        $list = Attendence::where('user_id',$id)->orderBy('date')->get();
        return view('page/attendence/add',['list' => $list]);
    }

    //post add attendence
    public function postAddOfftime(AttendenceRequest $request, $id)
    {
        $date = getdate();
        $dateOff = $request->dateOff;
        $timeOff = $request->timeOff;
        $today = ($date['year']."-".$date['mon']."-".$date['mday']);
        if (strtotime($dateOff) <= strtotime($today)) {
            return redirect('page/attendence/add/'.$id)->with('error', 'Date is not Invalid !');
        } else {
            $listOfftimes = Attendence::where('user_id', $id)->where('date',$dateOff)->get();
            $count = $listOfftimes->sum('off_time');
            if ($count != 0) {
                if (($count + $timeOff) > 8) {
                    return redirect('page/attendence/add/' . $id)->
                    with('error', 'You can not off more 8 hours on 1day !!');
                } else {
                    foreach ($listOfftimes as $att) {
                        $offId = $att->id;
                        $setOfftime = Attendence::find($offId);
                        $setOfftime->off_time = $timeOff + $att->off_time;
                        $noti = 0;
                    }
                }
            } else {
                $setOfftime = new Attendence();
                $setOfftime->off_time = $timeOff;
                $noti = 1;
            }
            $setOfftime->user_id = $id;
            $setOfftime->date = $dateOff;
            $setOfftime->reason = $request->reason;
            $setOfftime->status = 0;
            $setOfftime->save();

            if ($noti == 1) {
                $setNoti = new Notification();
                $setNoti->user_id_from = $id;
                $setNoti->user_id_to = 1;
                $setNoti->title = 'add an off time';
                $setNoti->content = $dateOff . ' - ' . $timeOff . '(hours)';
                $setNoti->save();
            }

            return redirect('page/attendence/' . $id)->with('global', 'Add off time was success');
        }
    }
}
